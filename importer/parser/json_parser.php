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
    importJobsFromObjects($json, $company, $mappingFields);
}
