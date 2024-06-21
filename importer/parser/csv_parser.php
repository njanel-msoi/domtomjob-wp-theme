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

        echo 'job imported<br>';
    });
}

function importCompanyFromCSV($csvFile, $mappingFields)
{
    echo '<?xml version="1.0" encoding="UTF-8"?>
<wpjb>
    <companies>';

    readCSVAndHandleEachLine($csvFile, function ($sourceCompany) use ($mappingFields) {
        // called for each company to import
        $destCompany = map_fields($sourceCompany, [], $mappingFields);
        $company = dtj_import_company($destCompany);

        echo '
        <company>';

        foreach ($company as $key => $value) {
            if (!is_array($value)) {
                // root keys
                echo "
            <$key>$value</$key>";
            }
        }

        if (isset($company['metas'])) {
            echo '
            <metas>';
            foreach ($company['metas'] as $meta) {

                $name = $meta['name'];
                $value = $meta['values'][0];
                echo "
                <meta>
                    <name>$name</name>
                    <value>$value</value>
                </meta>";
            }
            echo '
            </metas>';
        }

        if (isset($company['files'])) {
            echo '
            <files>';
            foreach ($company['files'] as $file) {
                extract($file);
                echo "
                <file>
                    <path>$path</path>
                    <content>$content</content>
                </file>";
            }
            echo '
            </files>';
        }

        echo "
        </company>
";
    });

    echo '
    </companies>
</wpjb>';
}
