<?php

/**
 * Import jobs with a WP Cron from the config defined in the admin page
 * 
 * @idxImport : the id in the employer config array
 */
add_action('import_from_config_action', 'importFromConfig', 10, 1);

function importFromConfig($idxImport)
{
    // logs of ats imports
    define('ATS_LOG_FOLDER', WP_ROOT_DIR . '/logs/ats_import');
    if (!is_dir(ATS_LOG_FOLDER))
        mkdir(ATS_LOG_FOLDER);

    ob_start(function ($output) {
        if (!$output) return $output;

        $date = date("Ymd_His");
        file_put_contents(ATS_LOG_FOLDER . '/' . $date . '_ats_import_' . $GLOBALS['import_company_name'] . '.log', $output);
        return $output;
    });

    if (!isset($idxImport)) {
        finish('Idx param is missing, import aborted.');
    };


    // 1. Read list of config from option ACF
    // 2. For each one, read the appropriate config
    // (if an error occurs, go to the next one)
    // 3. Launch the appropriate importer based on the config
    $recruteursConfigs = get_field('recruteurs', 'option');
    if (!isset($recruteursConfigs[$idxImport])) {
        finish('No ATS import config for IDX ' . $idxImport, false);
    }

    $recruteurConfig = $recruteursConfigs[$idxImport];

    $companyId = $recruteurConfig['recruteur'];
    $company = wpjb_get_object_from_post_id($companyId);

    if (!$recruteurConfig['actif']) {
        finish('Import for recruteur ' . $company->company_name . ' is not active');
    }

    $GLOBALS['import_company_name'] = $company->company_name;
    echo '
        Start import for ' . $company->company_name . '<br>
        ';

    $mappingFile = dirname(__FILE__) . '/fields_mapping/' . $recruteurConfig['mapping'] . '_mapping.php';
    $mapping = include $mappingFile;

    switch ($recruteurConfig['import_type']) {
        case 'json_url':
            $file_url = $recruteurConfig['file_url'];
            importJobsFromJsonURL($file_url, $company, $mapping);
            break;
        case 'xml_url':
            $file_url = $recruteurConfig['file_url'];
            $xpath = $recruteurConfig['xpath_root'];
            importJobsFromXMLFile($file_url, $xpath, $company, $mapping);
            break;
    }
    finish("Import terminé");
}

function finish($message = '')
{
    echo '
    ' . $message;
    ob_flush();
    exit();
}
