<?php

/**
 * Template Name: _DTJ API Test
 */

if (!current_user_can('administrator')) exit("no way");

include_once dirname(__FILE__) . '/../importer/importer.php';

if (!isset($_POST['option']) || !$_POST['option']) : ?>
    <form method="post" enctype="multipart/form-data">
        <select name="option">
            <option value=""></option>
            <option value="CREATE_OLD_COMPANY_USERS">Création anciens comptes entreprise</option>
            <option value="IMPORT_OLD_COMPANIES">Import anciennes entreprises</option>
            <option value="IMPORT_OLD_JOBS">Import anciens jobs</option>
            <option value="IMPORT_FROM_CONFIG">Import from config (first index)</option>
        </select>
        <input type="file" name="import_file">
        <button>GO</button>
    </form>
<?php
    exit();
endif;

if (isset($_FILES["import_file"]))
    $file_upload_path = $_FILES["import_file"]['tmp_name'];
else
    $file_upload_path = null;

echo 'OPTION choisie : ' . $_POST['option'] . '<br><hr>';

switch ($_POST['option']) {

    case 'IMPORT_FROM_CONFIG':
        ///// READ IMPORTERS FROM CONFIG /////
        $GLOBALS['PROTECT_JOB_FIELDS'] = true;
        $GLOBALS['FAKE_IMPORT'] = true;
        importFromConfig(0);
        break;

    case 'CREATE_OLD_COMPANY_USERS':
        ///////////////// create old company users
        $GLOBALS['FAKE_IMPORT'] = true;
        include_once dirname(__FILE__) . '/../importer/users/create_old_company_account.php';
        break;

    case 'IMPORT_OLD_COMPANIES':
        if (!$file_upload_path) exit('file is needed');
        /////////////////// create company from csv (user are needed)
        // $companyCSVFile = get_field('old_companies_import_csv_file');
        $companyCSVFile = $file_upload_path;

        $oldCompanyMapping = include dirname(__FILE__) . '/../importer/fields_mapping/old_company_mapping.php';

        $GLOBALS['PROTECT_JOB_FIELDS'] = false;
        echo '<textarea style="width: 1000px;height:600px">';
        importCompanyFromCSV($companyCSVFile, $oldCompanyMapping);
        echo '</textarea>';
        $GLOBALS['PROTECT_JOB_FIELDS'] = true;
        break;

    case 'IMPORT_OLD_JOBS':
        $GLOBALS['FAKE_IMPORT'] = true;
        if (!$file_upload_path) exit('file is needed');
        ///////////////// IMPORT ANCIEN JOBS
        $GLOBALS['FAKE_IMPORT'] = true;
        $oldJobMapping = include dirname(__FILE__) . '/../importer/fields_mapping/old_jobs_mapping.php';
        //$offersCSVFile = get_field('old_offers_import_csv_file');
        $offersCSVFile = $file_upload_path;

        // company = get_company_from_old_id(5);
        // for this specific case we don't protect fields
        $GLOBALS['PROTECT_JOB_FIELDS'] = false;
        importJobFromCSV($offersCSVFile, $oldJobMapping, function ($sourceJob) {
            return get_company_from_old_id($sourceJob['off_ent']);
        });
        $GLOBALS['PROTECT_JOB_FIELDS'] = true;
        break;
}
