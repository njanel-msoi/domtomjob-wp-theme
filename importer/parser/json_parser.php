<?php
include_once dirname(__FILE__) . '/../importer.php';

function importJobsFromJSON($json, $company, $mappingFields)
{
    // browse JSON
    foreach ($json as $data) {
        $sourceJob = [];
        foreach ($headers as $id => $field) {
            $sourceJob[$field] = $data[$id];
        }
        // here we got an associative array with source fields & value
        map_and_import_job($sourceJob, $mappingFields, $company);
    }
}
