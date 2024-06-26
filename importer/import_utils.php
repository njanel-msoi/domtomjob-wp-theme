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
