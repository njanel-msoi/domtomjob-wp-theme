<?php

/**
 * Import jobs with a WP Cron from the config defined in the admin page
 */

function importFromConfig()
{
    // 1. Read list of config from option ACF
    // 2. For each one, read the appropriate config
    // (if an error occurs, go to the next one)
    // 3. Launch the appropriate importer based on the config
    $recruteursConfigs = get_field('recruteurs', 'option');

    // TODO: one by one to avoid memory & timeout issue

    foreach ($recruteursConfigs as $recruteurConfig) {
        if (!$recruteurConfig['actif']) continue;

        $companyId = $recruteurConfig['recruteur'];
        $company = wpjb_get_object_from_post_id($companyId);

        $mappingFile = dirname(__FILE__) . '/fields_mapping/' . $recruteurConfig['mapping'] . '_mapping.php';
        $mapping = include $mappingFile;

        switch ($recruteurConfig['import_type']) {
            case 'json_url':
                $file_url = $recruteurConfig['file_url'];
                importJobsFromJSON($file_url, $company, $mapping);
                break;
            case 'xml_url':
                $file_url = $recruteurConfig['file_url'];
                $xpath = $recruteurConfig['xpath_root'];
                importJobsFromXMLFile($file_url, $xpath, $company, $mapping);
                break;
        }
    }
}
