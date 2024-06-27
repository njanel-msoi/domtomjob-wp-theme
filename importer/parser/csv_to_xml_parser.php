<?php

function importCompanyFromCSV($csvFile, $mappingFields)
{
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><wpjb/>');
    $companiesXML = $xml->addChild('companies');

    $GLOBALS['startCompanyID'] = 1001;

    readCSVAndHandleEachLine($csvFile, function ($sourceCompany) use ($mappingFields, $companiesXML) {
        // called for each company to import
        $destCompany = map_fields($sourceCompany, [], $mappingFields);
        $company = dtj_import_company($destCompany);

        $companyXML = $companiesXML->addChild('company');
        // $companyXML->addChild('id', $GLOBALS['startCompanyID']++);

        foreach ($company as $key => $value) {
            if (!is_array($value)) {
                $companyXML->addChild($key, $value);
            }
        }

        if (isset($company['metas'])) {
            $metasXML = $companyXML->addChild('metas');
            foreach ($company['metas'] as $meta) {

                $name = $meta['name'];
                $value = $meta['values'][0];

                $metaXML = $metasXML->addChild('meta');

                $metaXML->addChild('name', $name);
                $metaXML->addChild('value', $value);
            }
        }

        if (isset($company['files'])) {
            $filesXML = $companyXML->addChild('files');
            foreach ($company['files'] as $file) {
                extract($file);
                $fileXML = $filesXML->addChild('file');

                $fileXML->addChild('path', $path);
                $fileXML->addChild('content', $content);
            }
        }
    });
    print($xml->asXML());
}
