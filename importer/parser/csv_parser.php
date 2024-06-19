<?php
include_once dirname(__FILE__) . '/../importer.php';

function importJobFromCSV($csvFile, $company, $mappingFields)
{
    $handle = fopen($csvFile, "r");
    if ($handle === FALSE) exit("problem with file opening");

    $headers = fgetcsv($handle, 10000, ";");
    if ($headers === FALSE) exit("headers are missing");

    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {
        $sourceJob = [];
        foreach ($headers as $id => $field) {
            $sourceJob[$field] = $data[$id];
        }
        // here we got an associative array with source fields & value

        // the parser common method
        map_and_import_job($sourceJob, $mappingFields, $company);

        // import only 1 for test
        break;
    }
    fclose($handle);
}
