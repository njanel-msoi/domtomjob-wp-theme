<?php

/**
 * Template Name: _DTJ API Test
 */

if (!current_user_can('administrator')) exit("no way"); ?>

<?php

include_once dirname(__FILE__) . '/../importer/importer.php';



$companyCSVFile = get_field('old_companies_import_csv_file');
$oldCompanyMapping = include dirname(__FILE__) . '/../importer/mapping/old_company_mapping.php';

$GLOBALS['PROTECT_JOB_FIELDS'] = false;

echo '<textarea style="width: 1000px;height:600px">';
importCompanyFromCSV($companyCSVFile, $oldCompanyMapping);
echo '</textarea>';

$GLOBALS['PROTECT_JOB_FIELDS'] = true;

/*
$GLOBALS['FAKE_IMPORT'] = true;
$oldJobMapping = include dirname(__FILE__) . '/../importer/mapping/old_jobs_mapping.php';
$offersCSVFile = get_field('old_offers_import_csv_file');

// TODO: parse csv by company and import by company
$company = get_company(3);

//$company = get_company_from_old_id(5);

// for this specific case we don't protect fields
$GLOBALS['PROTECT_JOB_FIELDS'] = false;
importJobFromCSV($offersCSVFile, $company, $oldJobMapping);
$GLOBALS['PROTECT_JOB_FIELDS'] = true;
*/