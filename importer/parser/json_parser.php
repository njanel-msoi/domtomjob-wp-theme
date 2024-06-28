<?php
include_once dirname(__FILE__) . '/../importer.php';

function importJobsFromJsonURL($json_url, $company, $mappingFields)
{
    $jsonStr = file_get_contents($json_url);
    importJobsFromJSON($jsonStr, $company, $mappingFields);
}

function importJobsFromJSON($jsonStr, $company, $mappingFields)
{
    $json = json_decode($jsonStr);
    if (!$json) throw new Exception("Problem reading json file for company " . $company->company_name);
    importJobsFromObjects($json, $company, $mappingFields);
}
