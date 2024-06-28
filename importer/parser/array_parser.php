<?php
include_once dirname(__FILE__) . '/../importer.php';

/**
 * The headers array must be the same size than every row of the data array
 * associative array are not used here, its the index which is linked to the header array
 */
function importJobsFromArray($headers, $dataArr, $company, $mappingFields)
{
    foreach ($dataArr as $data) {
        $sourceJob = [];
        foreach ($headers as $id => $field) {
            $sourceJob[$field] = $data[$id];
        }
        // here we got an associative array with source fields & value
        map_and_import_job($sourceJob, $mappingFields, $company);
    }
}

/**
 * Here every row of the data array is an associative array with the source field name as a key
 */
function importJobsFromAssociativeArray($dataArr, $company, $mappingFields)
{
    foreach ($dataArr as $sourceJob) {
        // here we got an associative array with source fields & value
        map_and_import_job($sourceJob, $mappingFields, $company);
    }
}

function importJobsFromObjects($dataArr, $company, $mappingFields)
{
    foreach ($dataArr as $sourceJob) {
        // convert object to associative array as supported by import job
        $sourceJob = (array)$sourceJob;
        map_and_import_job($sourceJob, $mappingFields, $company);

        break;
    }
}
