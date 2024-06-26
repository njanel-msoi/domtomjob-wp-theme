<?php

/**
 * A mapping file should return an array with list of fields of DTJ Job
 * For each field you can set a value which can be :
 * - the name of a key of the source job
 * - a function which returns the value for this field. This function accept 2 parameters : the source job and the company object which posted the job
 * 
 */

$old_country_mapping = include dirname(__FILE__) . '/old_country_mapping.php';
$country_reunion = 638;

$olddb_ucwords = function ($source) {
    return ucwords(strtolower($source['ent_lb']), " -\t\r\n\f\v'");
};

/**
 * Mapping for to import old DB company
 */
return [
    "user_login" => "ent_email", // nécessite la liste des utilisateurs liés aux entreprises (requete / table de correspondance ?)
    "user_email" => "ent_email",
    "company_name" => $olddb_ucwords, //"ent_lb",
    "company_website" => "ent_url",
    "company_info" => "ent_description",
    "company_zip_code" => "ent_cp",
    "company_location" => "ent_ville",
    "company_country" => function ($source) {
        global $old_country_mapping, $country_reunion;
        // "ent_domtom (clé vers T_domtom)", //attention il faut ici le code pays de la table de correspndance "pays"
        $oldCountryId = $source['ent_domtom'];
        if ($oldCountryId && isset($old_country_mapping[$oldCountryId])) {
            return $old_country_mapping[$oldCountryId];
        }
        return $country_reunion;
    },
    "region" => function ($source) {
        $region = $source['ent_domtom'];
        if (!$region) return 4;

        if ($region == 19) return 17;
        if ($region == 12) return 99;
        if ($region == 13) return 99;

        return $region;
    },
    "company_type" => "ent_type",
    "category" => function ($source) {
        // TODO: "ent_secteur (lien vers T_secteur)", // utiliser la table de correspondance "catégorie"
        return null;
    },
    "company_logo" => function ($source) {
        // "ent_logo", //"prefixe pour avoir l'url de l'image : https://www.domtomjob.com/Entreprises/Logo/ "on stocke dans le XML la représentation en base64 de l'image (cf. exemple XML)"
        $logourl = $source['ent_logo'];
        if (!$logourl) return null;

        $logourl = 'https://www.domtomjob.com/Entreprises/Logo/' . $logourl;
        $data = file_get_contents($logourl);
        if ($data === FALSE) return null;

        return base64_encode($data);
    },
    "company_logo_filename" => "ent_logo",
    "company_size" => function ($source) {
        // "ent_effectif (si > 0)",
        $effectif = $source['ent_effectif'];
        if (!$effectif) return null;
        $effectif = intval($effectif);
        if ($effectif && $effectif > 0) return $effectif;
        return null;
    },
    "company_contact_company_name" => $olddb_ucwords, //"ent_lb",
    "company_contact_name" => "ent_contact",
    "company_contact_function" => "",
    "company_phone" => "ent_tel",
    "company_address" => "ent_adresse",
    "billing_company_name" => $olddb_ucwords, // "ent_lb",  
    "billing_contact_name" => "ent_contact",
    "billing_contact_function" => "",
    "billing_email" => "ent_email",
    "billing_phone" => "ent_tel",
    "billing_address" => "ent_adresse",
    "billing_zipcode" => "ent_cp",
    "billing_city" => "ent_ville",
    "billing_country" => function ($source) {
        // "ent_domtom (clé vers T_domtom)", //attention il faut ici le code pays de la table de correspndance "pays"
        return 638;
    },
    "optin_group" => 0,
    "old_response_url" => "ent_reponsepar_url", //ce champs n'est plus utilisé mais est importé pour facilité l'import des offres existantes
    "old_company_id" => "ent_code", //permet de faire le lien pour l'import d'offres depuis l'ancien site
];
