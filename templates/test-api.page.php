<?php

/**
 * Template Name: _DTJ API Test
 */

if (!current_user_can('administrator')) exit("no way"); ?>

<h1>Page d'import de données de l'ancien site DTJ..</h1>

<?php

include_once dirname(__FILE__) . '/../importer/importer.php';

$mapping = include dirname(__FILE__) . '/../importer/mapping/old_jobs_mapping.php';

$csvFileUrl = get_field('old_offers_import_csv_file');

// TODO: parse csv by company and import by company
$company = get_company(3);
$GLOBALS['FAKE_IMPORT'] = true;

//$company = get_company_from_old_id(5);

// for this specific case we don't protect fields
$GLOBALS['PROTECT_JOB_FIELDS'] = false;
importJobFromCSV($csvFileUrl, $company, $mapping);
