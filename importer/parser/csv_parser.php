<?php
include_once dirname(__FILE__) . '/../importer.php';

function importCompanyJobFromCSV($csvFile, $mappingFields, $company)
{
    readCSVAndHandleEachLine($csvFile, function ($sourceJob) use ($company, $mappingFields) {
        // the parser common method
        map_and_import_job($sourceJob, $mappingFields, $company);
    });
}
function importJobFromCSV($csvFile, $mappingFields, $companyFunc)
{
    readCSVAndHandleEachLine($csvFile, function ($sourceJob) use ($mappingFields, $companyFunc) {
        // get the company
        $company = $companyFunc($sourceJob);
        // the parser common method
        map_and_import_job($sourceJob, $mappingFields, $company);

        ob_start();
        echo 'job imported<br>';
        ob_flush();
    });
}
