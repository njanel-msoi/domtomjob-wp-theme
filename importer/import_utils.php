<?php
include_once '../functions/utils.php';


function map_job($sourceJob, $fieldsMapping, $company)
{
    // initialize with company field as most are missing
    $destJob = fillJobCompanyFromCompany([], $company);

    // for each field of the group, we map the linked field
    foreach ($fieldsMapping as $destField => $fieldMapping) {
        $value = null;
        if (is_callable($fieldMapping)) {
            $value = $fieldMapping($sourceJob, $company);
        } else {
            $value = $fieldMapping ? $sourceJob[$fieldMapping] : "";
        }
        $destJob[$destField] = $value;
    }

    return $destJob;
}

function map_and_import_job($sourceJob, $mappingFields, $company)
{
    // map jobs fields
    $job = map_job($sourceJob, $mappingFields, $company);
    // here we got a job in the correct format for API
    dtj_import_job($job);
}


function get_company_from_old_id($oldId)
{
    // "l'id de l'employeur est la valeur de la colonne object_id, dans la table wpdtj_wpjb_meta_value où meta_id=220 et value est égal à l'ancien id de l'employeur
    // SELECT value FROM wpdtj_wpjb_meta_value WHERE meta_id=220 AND value =  ""valeur de off_ent"""

    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM wpdtj_wpjb_meta_value WHERE meta_id = 220 AND value = $oldId");
    if (count($results) == 0) exit("missing reference from old company ID in meta company description");
    if (count($results) > 1) exit("multiple company for same old ID, need correction");

    $id = $results[0]->object_id;
    return get_company($id);
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
