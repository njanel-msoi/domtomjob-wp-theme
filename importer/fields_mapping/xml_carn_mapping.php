<?php
// this mapping is used for the following clients :
// - CNARM

return [
    "old_job_id" => "ref", //<ref>48768</ref>
    "job_title" => "offre", //<offre><![CDATA[ Conducteur de lignes automatis&eacute;es de conditionnement - H/F ]]></offre>
    "job_city" => "lieu_travail", //<lieu_travail><![CDATA[ Loire Atlantique - Nantes - Ancenis - 44 ]]></lieu_travail>
    "job_description" => function ($source) {
        $entreprise_name = $source['entreprise'];
        $description = $source['description'];

        if (str_contains($entreprise_name, ' - RECRUTEMENT DU')) {
            $parts = explode(" - ", $entreprise_name);
            return array_pop($parts) . "<br><br>";
        }
        return $description;
    }, // EUREDEN - AUBRET - RECRUTEMENT DU 16/07/24 AU 19/07/24 ]]></entreprise> //<description><![CDATA[ Vous pilotez la ligne de conditionnement en respectant des standards de production (sécurité / qualité / coût / délai / animation / environnement) ]]></description>
    "company_name" => function ($source) {
        $entreprise_name = $source['entreprise'];

        if (str_contains($entreprise_name, ' - RECRUTEMENT DU')) {
            $parts = explode(" - RECRUTEMENT DU", $entreprise_name);
            return $parts[0];
        }
        return $entreprise_name;
    }, //<entreprise><![CDATA[ EUREDEN - AUBRET - RECRUTEMENT DU 16/07/24 AU 19/07/24 ]]></entreprise>
    "company_url",
    "company_email",
    "job_address",
    "job_zip_code",
    "job_country",
    "region" => function ($source) {
        //<localite><![CDATA[ 44540 LE PIN FRANCE ]]></localite>
        // if localite include 974 we're in reunion, else we're in metropole
        if (str_contains($source['localite'], '974')) return REUNION_CODE;
        else FRANCE_METROPOLE_CODE;
    },
    "job_profile" => "exigences_partculieres", //<exigences_partculieres><![CDATA[ Capacité d'observation, Compréhension et respect des normes techniques, Curiosité, Savoir passer une consigne, Sens du relationnel, Connaissance des règles d'hygiène et de sécurité. ]]></exigences_partculieres>
    // "type_fulltime", // mapping <horaires><![CDATA[ 1 ]]></horaires>
    "job_function" => function ($source) {
        $domaine = $source['domaine'];
        if (!$domaine) return null;
        return import_oldFunctionToJobFunctionCode($domaine);
    }, // <domaine>
    "salary_min" => "salaire_min", // <salaire_min><![CDATA[ 1783 ]]></salaire_min>
    "salary_max" => "salaire_max", // <salaire_max><![CDATA[ 1783 ]]></salaire_max>
    "job_experience" => function ($source) {
        if ($source['experiences']) return $source['experiences'];
        return 1;
    }, // mapping <experiences><![CDATA[ 1 ]]></experiences>
    // "job_study_level", // mapping <niveau_etude><![CDATA[ Sans niveau sp&eacute;cifique ]]></niveau_etude>
    "job_apply_url" => "url", //<url><![CDATA[ http://www.cnarm.fr/offres_emplois/conducteur-de-lignes-automatis-es-de-conditionnement-h-f,48768.do ]]></url>
    "category" => function ($source) {
        $secteur = $source['secteur'];
        if (!$secteur) return null;
        return import_oldSectorsNameToCategoryId($secteur);
    }, // mapping<secteur><![CDATA[ Artisanat (alimentation) ]]></secteur>
    "type" => function ($source) {
        $contractName = $source['type_de_contrat'];
        if (!$contractName) $contractName = 'CDI';
        return import_contractNameToCode($contractName);
    }, // mapping <type_de_contrat><![CDATA[ CDI ]]></type_de_contrat>
];

// TODO: handle job duration :         $off_date_lim = (isset($offre->visibilite) && $offre->visibilite == '1 mois') ? 1 : 2;


// <date_embauche>23/09/2024</date_embauche>
// <mission_profil><![CDATA[ ]]></mission_profil>
// <activites_profil><![CDATA[ ]]></activites_profil>
// <taches_profil><![CDATA[ ]]></taches_profil>
// <domaine_etude><![CDATA[ ]]></domaine_etude>
// <domaine><![CDATA[ ]]></domaine>
// <diplome><![CDATA[ AUCUN ]]></diplome>
// <experience_autres><![CDATA[ ]]></experience_autres>
// <condition_emploi><![CDATA[ ]]></condition_emploi>
// <nature_travail><![CDATA[ ]]></nature_travail>
// <deplacement><![CDATA[ NON ]]></deplacement>
// <salaire_min_net><![CDATA[ 1391 ]]></salaire_min_net>
// <salaire_max_net><![CDATA[ 1391 ]]></salaire_max_net>
// <smic><![CDATA[ 0 ]]></smic>
// <logement><![CDATA[ 0 ]]></logement>
// <moyen_transport><![CDATA[ 0 ]]></moyen_transport>
// <type_emploi_autres><![CDATA[ ]]></type_emploi_autres>