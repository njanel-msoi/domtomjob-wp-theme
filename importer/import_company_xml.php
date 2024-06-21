<?php

$COMPANY_ROOT_FIELDS = [
    "user_login",
    "user_email",
    "company_name",
    "company_website",
    "company_info",
    "company_zip_code",
    "company_location",
    "company_country",
    "is_public",
    "is_active",
    "is_verified"
];
$COMPANY_META_FIELDS = [
    "region",
    "company_type",
    "category",
    "company_siret",
    "billing_tax",
    "company_size",
    "company_contact_company_name",
    "company_contact_name",
    "company_contact_function",
    "company_phone",
    "company_address",
    "billing_company_name",
    "billing_contact_name",
    "billing_contact_function",
    "billing_email",
    "billing_phone",
    "billing_address",
    "billing_zipcode",
    "billing_city",
    "billing_country",
    "optin_group",
    "old_response_url",
    "old_company_id"
];
$COMPANY_FILE_FIELDS = ["company_logo"];

/* This values are used for job imported from external source in order to keep job engine and rules correct 
For exemple, external source cannot choose to be approved or featured and cannot choose the creation date
*/
$COMPANY_PROTECTED_VALUES = [
    "is_public" => 1,
    "is_active" => 1,
    "is_verified" => 1
];

$COMPANY_DEFAULT_VALUES = array_merge($COMPANY_PROTECTED_VALUES, [
    "optin_group" => 0
]);

/**
 * $plainJob : the job where all fields are at root level
 * $protected : if true, protected fields cannot be set and have a mandatory default value
 */
function dtj_import_company($plainCompany)
{
    global $COMPANY_ROOT_FIELDS, $COMPANY_META_FIELDS, $COMPANY_TAG_FIELDS, $COMPANY_FILE_FIELDS, $COMPANY_PROTECTED_VALUES;
    $apiCompany = ["metas" => [], "files" => []];

    // convert job plain data to api format

    // field at root level
    foreach ($COMPANY_ROOT_FIELDS as $field) {
        $value = __get_company_field_value($plainCompany, $field);
        $apiCompany[$field] = $value;
    }
    // field at meta level
    foreach ($COMPANY_META_FIELDS as $field) {
        $value = __get_company_field_value($plainCompany, $field);
        $meta = ["name" => $field, "values" => [$value]];
        $apiCompany['metas'][] = $meta;
    }
    // files
    foreach ($COMPANY_FILE_FIELDS as $field) {
        $fileContent = __get_company_field_value($plainCompany, $field);
        if (!$fileContent) continue;

        $fileName = __get_company_field_value($plainCompany, $field . '_filename');
        $filePath = str_replace('_', '-', $field);

        $apiCompany['files'][] = [
            "path" => $filePath . '/' . $fileName,
            "content" => $fileContent
        ];
    }

    if ($GLOBALS['FAKE_IMPORT']) {
        preDump($apiCompany);
    }
    return $apiCompany;
}

/**
 * Used to get the proper field value
 */
function __get_company_field_value($plainJob, $field)
{
    global $COMPANY_DEFAULT_VALUES, $COMPANY_PROTECTED_VALUES;
    $protected = $GLOBALS['PROTECT_JOB_FIELDS'];

    if ($protected && isset($COMPANY_PROTECTED_VALUES[$field]))
        return $COMPANY_PROTECTED_VALUES[$field];

    $value = null;
    if (isset($plainJob[$field]) && $plainJob[$field] && $plainJob[$field] != 'NULL')
        $value = $plainJob[$field];
    else if (!$value && isset($COMPANY_DEFAULT_VALUES[$field])) {
        $value = $COMPANY_DEFAULT_VALUES[$field];
    }

    return $value;
}
