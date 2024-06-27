<?php
include_once '../functions/utils.php';

function map_job($sourceJob, $fieldsMapping, $company)
{
    // initialize with company field as most are missing
    $destJob = fillJobCompanyFromCompany([], $company);

    $destJob = map_fields($sourceJob, $destJob, $fieldsMapping, $company);

    return $destJob;
}

function map_and_import_job($sourceJob, $fieldsMapping, $company)
{
    try {
        // map jobs fields
        $job = map_job($sourceJob, $fieldsMapping, $company);
        // here we got a job in the correct format for API
        dtj_import_job($job);
    } catch (Exception $ex) {
        // display error and go for next job
        print_r($ex->getMessage());
        echo '<br>';
    }
}

function map_fields($source, $dest, $fieldsMapping, $param1 = null)
{
    // for each field of the group, we map the linked field
    foreach ($fieldsMapping as $destField => $fieldMapping) {
        // for html chars
        // if ($source[$destField]) $source[$destField] = html_entity_decode($source[$destField]);

        $value = null;
        if (is_callable($fieldMapping)) {
            $value = $fieldMapping($source, $param1);
        } else {
            $value = $fieldMapping ? $source[$fieldMapping] : "";
        }
        // do not override if no value
        if ($value == "NULL" || $value == "") $value = null;
        if ($value)
            $dest[$destField] = $value;
    }

    return $dest;
}

function get_wpjb_metas($meta_id, $value)
{
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM wpdtj_wpjb_meta_value WHERE meta_id = $meta_id AND value = $value");

    $results = array_filter($results, function ($c) {
        return !!$c->object_id;
    });

    return $results;
}

function get_company_from_old_id($oldId)
{
    // "l'id de l'employeur est la valeur de la colonne object_id, dans la table wpdtj_wpjb_meta_value où meta_id=220 et value est égal à l'ancien id de l'employeur
    // SELECT value FROM wpdtj_wpjb_meta_value WHERE meta_id=220 AND value =  ""valeur de off_ent"""

    $results = get_wpjb_metas(220, $oldId);

    if (count($results) == 0) throw ("missing reference from old company ID in meta company description");
    if (count($results) > 1) throw ("multiple company for same old ID, need correction");

    $id = array_pop($results)->object_id;
    return get_company($id);
}

function has_job_from_old_id($oldId)
{
    $results = get_wpjb_metas(225, $oldId);

    if (count($results) > 1) throw  new Exception("multiple company for same old ID, need correction");

    return count($results) > 0;
}

function get_company($companyId)
{
    $query = new Daq_Db_Query();
    $query->from("Wpjb_Model_Company t");
    $query->where("id = ?", $companyId);
    $query->limit(1);

    $result = $query->execute();

    if (!isset($result[0])) {
        return null;
    }

    return $result[0];
}

function fillJobCompanyFromCompany($job, $company, $copyLogo = false)
{
    /* Map from Job field => Company field */
    $mappingFromCompany = [
        "employer_id" => "id",

        "company_name" => "company_name",
        "company_url" => "company_website",
        "company_description" => "company_info",

        "company_contact_company_name" => "_company_contact_company_name",
        "company_contact" => "_company_contact_name",
        "company_contact_function" => "_company_contact_function",
        "company_phone" => "_company_phone",
        "job_address" => "_company_address",
        "job_zip_code" => "company_zip_code",
        "company_city" => "company_location",
        "job_country" => "company_country",

        "billing_company_name" => "_billing_company_name",
        "billing_contact" => "_billing_contact_name",
        "billing_contact_function" => "_billing_contact_function",
        "billing_email" => "_billing_email",
        "billing_phone" => "_billing_phone",
        "billing_address" => "_billing_address",
        "billing_zipcode" => "_billing_zipcode",
        "billing_city" => "_billing_city",
        "billing_country" => "_billing_country"
    ];
    foreach ($mappingFromCompany as $jobField => $companyField) {
        $is_meta = str_starts_with($companyField, '_');
        if ($is_meta) $companyField = substr($companyField, 1);

        $companyValue = $is_meta ? get_meta_value($company, $companyField) : $company->$companyField;

        $job[$jobField] = $companyValue;
    }
    // special case for email which needs company user
    $job["company_email"] = $company->getUser(true)->user_email;

    return $job;

    // read the enterprise logo in base64
    // company
}

function readCSVAndHandleEachLine($csvFile, $callback, $oneOnly = false)
{
    $handle = fopen($csvFile, "r");
    if ($handle === FALSE) exit("problem with file opening");

    $headers = fgetcsv($handle, 10000, ";");
    if ($headers === FALSE) exit("headers are missing");

    $nb = 0;
    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {
        $source = [];
        foreach ($headers as $id => $field) {
            $source[$field] = $data[$id];
        }
        // here we got an associative array with source fields & value

        $callback($source);

        if ($oneOnly)
            break;
        $nb++;
    }
    fclose($handle);
}

function import_regionNameToCode($region)
{
    $jsonRegions = [
        "GUADELOUPE" => 1,
        "MARTINIQUE" => 2,
        "GUYANE" => 3,
        "REUNION" => REUNION_CODE,
        "MAYOTTE" => 5,
        "NOUVELLE CALÉDONIE" => 6,
        "POLYNESIE FRANÇAISE" => 7,
        "WALLIS ET FUTUNA" => 8,
        "SAINT-PIERRE ET MIQUELON" => 9,
        "SAINT-MARTIN" => 10,
        "T.A.A.F." => 11,
        "OUTRE-MER" => 99,
        "PAYS VOISINS" => 99,
        "ILE MAURICE" => 14,
        "MADAGASCAR" => 15,
        "LES COMORES" => 16,
        "MÉTROPOLE" => FRANCE_METROPOLE_CODE,
        "SAINT BARTHÉLÉMY" => 18,
        "FRANCE" => FRANCE_METROPOLE_CODE,
        "SEYCHELLES" => 20
    ];
    if (isset($jsonRegions[$region])) return $jsonRegions[$region];
    else return REUNION_CODE;
}

function import_oldFunctionToJobFunctionCode($function)
{
    if (!$function) return null;

    $jobFunctions = [
        1    => "Indifférent",
        2    => "Administration / Secrétariat",
        3    => "BTP & second oeuvre",
        4    => "Commercial / Vente",
        5    => "Formation / Enseignement",
        6    => "Gestion / Comptabilité / Finance",
        7    => "Hôtellerie / Restauration / Tourisme",
        8    => "Informatique & Technologies / Telecom",
        9    => "Installation / Maintenance / Réparation",
        10    => "Juridique",
        11    => "Logistique / Approvisionnement / Transport",
        12    => "e-Marketing - Marketing",
        13    => "Qualité / Inspection",
        14    => "Recherche & Analyses",
        15    => "Ressources Humaines",
        16    => "Santé / Social",
        17    => "Sécurité",
        18    => "Services clientèle & aux particuliers",
        19    => "Ingénierie / Industrie / Production",
        20    => "Direction, Stratégie & Management",
        21    => "Architecture / Création / Spectacle",
        22    => "Edition & Ecriture",
        23    => "Gestion de projet, programme / Environnement",
        24    => "Communication",
        25    => "Agricole",
        26    => "Emplois verts"
    ];

    $ID = null;
    foreach ($jobFunctions as $oldId => $oldText) {
        if (str_contains($function, $oldText) || str_contains($oldText, $function)) {
            $ID = $oldId;
        }
    }
    if (!$ID) return null;

    $oldJobFunctions = include dirname(__FILE__) . '/mapping/old_job_function_mapping.php';
    return $oldJobFunctions[$ID];
}

function import_contractNameToCode($contract)
{
    $contractName = [
        "CDI" =>    1,
        "CDD" =>    2,
        "INT" =>    3,
        "INTERIM" =>    3,
        "STAGE" =>    4,
        "FREELANCE / INDÉPENDANT" =>    5,
        "FRANCHISE" =>    6,
        "FORMATION" =>    7,
        "VIE" =>    8,
        "APPRENTISSAGE" =>    9,
        "CONTRAT D&#X27;APPRENTISSAGE" =>    9,
        "CONTRAT D'APPRENTISSAGE" =>    9,
        "INDÉPENDANT" =>    10,
        "AUTRE" =>    11,
        "CONTRAT EN ALTERNANCE" =>    12,
        "CONTRAT PRO" => 2
    ];
    $oldContract = 1;
    if (isset($contractName[$contract])) $oldContract = $contractName[$contract];

    $contractTypeMapping = include dirname(__FILE__) . '/mapping/old_contract_type_mapping.php';
    return $contractTypeMapping[$oldContract];
}

function import_simple_study_level($level)
{
    $level = strtolower($level);
    $simpleLevels = [
        1 => ['collège', 'lycée'],
        3 => ['bac pro', 'bep', 'cap'],
        4 => ['dut', 'bts', 'bac +2', 'bac+2', 'bac + 2'],
        5 => ['license', 'iep', 'bac +3', 'bac+3', 'bac + 3'],
        6 => ['maitrise', 'iup', 'bac +4', 'bac+4', 'bac + 4'],
        7 => ['dess', 'dea', 'grandes écoles', 'grandes ecoles', 'bac +5', 'bac+5'],

        // this one after all which include larger word with "bac"
        2 => ['bac'],

        8 => ['doctorat', '3ème cycle', '3e cycle'],
        9 => ['expert', 'recherche', 'thèse']
    ];
    foreach ($simpleLevels as $id => $words) {
        foreach ($words as $word) {
            if (str_contains($level, $word)) return $id;
        }
    }
    return null;
}

function import_clientSectorToCategory($clientSector)
{
    if (!$clientSector) return null;

    // TODO map from client sector to NEW IDX
    $sectors = [
        13 => 99, //'Services Administratifs et Commerciaux',
        40 => 99,  'Distribution Et Vente',
        7  => 99,  'Services aux Personnes et Collectivité',
        39 => 99,  'Transport et Logistique',
        27 => 99,  'Industrie Mécanique et des métaux',
        21 => 99,  'Batiment, Travaux Publics',
        37 => 99,  'Santé',
        28 => 99,  'Formation',
        17 => 99,  'Type Artisanal',
        38 => 99,  'Hôtellerie – Restauration',
        33 => 99,  'Autres Industries'
    ];
    if (isset($sectors[$clientSector])) return $sectors[$clientSector];

    $categoryMapping = include dirname(__FILE__) . '/mapping/old_category_mapping.php';
    if (isset($categoryMapping[$clientSector])) return $categoryMapping[$clientSector];

    return null;
}

function import_oldSectorsNameToCategoryId($secteurName)
{
    $secteurs = [
        1 => "Indifférent",
        2 => "Administration / Services publics",
        3 => "Aéronautique / Espace",
        4 => "Agriculture / Pêche / Navigation",
        5 => "Agroalimentaire",
        6 => "Architecture",
        7 => "Art / Culture",
        8 => "Artisanat / Commerce",
        9 => "Automobile",
        10 => "Banque / Assurance / Finance",
        11 => "Biologie / Biochimie / Botanique / Zoologie",
        12 => "BTP / Génie civil",
        13 => "Matières plastiques",
        14 => "Commerce - Distribution",
        15 => "Electricité / Electronique",
        16 => "Energie / Pétrole / Gaz",
        17 => "Enseignement / Education / Formation",
        18 => "Environnement",
        19 => "Etudes / Conseil",
        20 => "Immobilier",
        21 => "Industrie",
        22 => "Informatique / Internet / Télécom",
        23 => "Luxe",
        24 => "Mécanique / Métallurgie",
        25 => "Optique",
        26 => "Presse / Edition / Média / Publicité",
        27 => "Restauration / Hôtellerie",
        28 => "Santé / Médical / Social",
        29 => "Sécurité",
        30 => "Textile / Mode",
        31 => "Transport",
        32 => "Tourisme / Sports / Loisirs",
        33 => "Services Administratifs et Commerciaux",
        34 => "Distribution Et Vente",
        35 => "Services aux Personnes et Collectivité",
        36 => "Transport et Logistique",
        37 => "Industrie Mécanique et des métaux",
        38 => "Batiment, Travaux Publics",
        39 => "Santé",
        40 => "Formation",
        41 => "Type Artisanal",
        42 => "Hôtellerie – Restauration",
        43 => "Autres Industries",
        44 => "Agricole",
        45 => "Assistanat - Secrétariat",
        46 => "Commercial - Vente"
    ];

    $ID = null;
    foreach ($secteurs as $oldId => $oldText) {
        if (str_contains($secteurName, $oldText) || str_contains($oldText, $secteurName)) {
            $ID = $oldId;
        }
    }
    if (!$ID) return null;

    $categoryMapping = include dirname(__FILE__) . '/mapping/old_category_mapping.php';
    return $categoryMapping[$ID];
}

function import_jobtitle($title)
{
    return str_replace('h/f', 'H/F', str_replace('f/h', 'H/F', ucfirst(strtolower($title))));
}
