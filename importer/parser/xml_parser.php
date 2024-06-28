<?php

/**
 * xmlFile : path to the xml file to import
 * pathToFields : xml path to the root of fields e.g. //rootNode/parent/childRootField
 */
function importJobsFromXMLFile($xmlFile, $pathToFields, $company, $mappingFields)
{
    // simplexml_load_string
    $xml = simplexml_load_file($xmlFile);
    $root = $xml->xpath($pathToFields);
    $count = 1;
    foreach ($root as $job) {
        // for each job, create associative array
        $sourceJob = [];
        foreach ($job as $jobField) {
            $value = (string)$jobField;
            $intVal = intval($value);
            if ($value == $intVal) $value = $intVal;
            $sourceJob[$jobField->getName()] = $value;
        }

        map_and_import_job($sourceJob, $mappingFields, $company);

        $count++;
        // TODO: remove
        break;
        if ($count > 10)
            break;
    }
}
