<?php
include_once 'api.php';

$JOB_ROOT_FIELDS = [
    "employer_id",
    "old_job_id",
    "job_title",
    "type",
    "job_city",
    "job_description",
    "job_created_at",
    "job_modified_at",
    "job_expires_at",
    "is_approved",
    "is_active",
    "is_filled",
    "is_featured",
    "job_is_anonymous",
    "company_name",
    "company_url",
    "category",
    "company_contact_company_name",
    "company_email",
    "job_address",
    "job_zip_code",
    "job_country",
    "billing_company_name"
];
$JOB_META_FIELDS = [
    "region",
    "job_profile",
    "type_fulltime",
    "job_function",
    "salary_min",
    "salary_max",
    "job_experience",
    "job_study_level",
    "job_salary_txt",
    "job_duration",
    "company_logo",
    "company_siret",
    "company_description",
    "job_phone",
    "job_apply_type",
    "job_apply_url",
    "company_contact",
    "company_contact_function",
    "company_phone",
    "company_city",
    "billing_contact",
    "billing_contact_function",
    "billing_email",
    "billing_phone",
    "billing_address",
    "billing_zipcode",
    "billing_city",
    "billing_country",
    "optin_group"
];
$JOB_TAG_FIELDS = ['category', 'type'];
$JOB_FILE_FIELDS = ['company-logo'];

/* This values are used for job imported from external source in order to keep job engine and rules correct 
For exemple, external source cannot choose to be approved or featured and cannot choose the creation date
*/
$JOB_PROTECTED_VALUES = [
    'job_created_at' => date("Y-m-d"),
    "job_modified_at"   => date("Y-m-d"),
    "job_expires_at"    => date("Y-m-d", JOB_EXPIRATION),
    'is_approved' =>    0,
    'is_active' =>    1,
    'is_filled' =>    0,
    'is_featured' =>    0,
    'job_is_anonymous' =>    0
];

$JOB_DEFAULT_VALUES = array_merge($JOB_PROTECTED_VALUES, [
    'job_country' =>    638,
    'job_apply_type' =>    "FORM",
    'billing_country' =>    638,
    'optin_group' => 0
]);

/**
 * $plainJob : the job where all fields are at root level
 * $protected : if true, protected fields cannot be set and have a mandatory default value
 */
function post_job($plainJob, $protected = true)
{
    global $JOB_ROOT_FIELDS, $JOB_META_FIELDS, $JOB_TAG_FIELDS, $JOB_FILE_FIELDS;
    $apiJob = ["id" => null, "meta" => [], "tags" => [], "files" => []];

    // convert job plain data to api format

    // field at root level
    foreach ($JOB_ROOT_FIELDS as $field) {
        $value = get_field_value($plainJob, $field, $protected);
        $apiJob[$field] = $value;
    }
    // field at meta level
    foreach ($JOB_META_FIELDS as $field) {
        $value = get_field_value($plainJob, $field, $protected);
        $meta = ["name" => $field, $value => [$value]];
        $apiJob['metas'][] = $meta;
    }
    // field at tag level
    foreach ($JOB_META_FIELDS as $field) {
        $value = get_field_value($plainJob, $field, $protected);
        $tag = ["type" => $field, "id" => $value];
        $apiJob['tags'][] = $tag;
    }

    return post('/jobs/', ["wpjb-job" => $apiJob]);
}

function get_field_value($plainJob, $field, $protected)
{
    global $JOB_DEFAULT_VALUES, $JOB_PROTECTED_VALUES;

    if ($protected && isset($JOB_PROTECTED_VALUES[$field]))
        return $JOB_PROTECTED_VALUES[$field];

    $value = "";
    if (isset($plainJob[$field]))
        $value = $plainJob[$field];
    else if (!$value && isset($JOB_DEFAULT_VALUES[$field])) {
        $value = $JOB_DEFAULT_VALUES[$field];
    }
}
