<?php
include_once "config.php";
include_once "functions.php";

// read company id in query

$postJobBody = array(
    "wpjb-job" => array(
        "id"                => null, // if the ID exists in the database the job with this ID will be updated
        "job_title"         => "New Job 2",
        "job_description"   => "New job description.",
        "employer_id"       => 3,
        "job_created_at"    => date("Y-m-d"),
        "job_modified_at"   => date("Y-m-d"),
        "job_expires_at"    => date("Y-m-d", JOB_EXPIRATION), // set it to 9999-12-31 to have the job never expire
        "is_approved"       => 1, // TODO: auto approved ?
        "is_active"         => 1,
        "is_filled"         => 0,
        "is_featured"       => 0, // TODO: auto fill from company config ?
        "job_country"       => 840, // country ISO 3166-1 numeric code IMPORTANT add it even if not revelant to app compatibilité
        "job_state"         => "",
        "job_zip_code"      => "10001",
        "job_city"          => "New York",
        "job_address"       => "20 W 34th St.",
        "company_name"      => "ACME Corp.", // TODO: get from company
        "company_country"   => 840,  // country ISO 3166-1 numeric code IMPORTANT add it even if not revelant to app compatibilité
        "company_url"       => "https://example.com", // TODO: get from company
        "company_email"     => "acme@example.com", // TODO: get from company

        "meta" => array(
            array(
                "name"      => "form_code", // saved form scheme name
                "values"    => array(null)
            ),
            array(
                "name"      => "geo_longitude", // location longitude
                "values"    => array("0")
            ),
            array(
                "name"      => "geo_latitude", // location latitude
                "values"    => array("0")
            ),
            array(
                "name"      => "geo_status", // geolocatiion status 
                "values"    => array(1)
            ),
            array(
                "name"      => "job_description_format",
                "values"    => array("html")
            ),
        ),

        "tags" => array(
            array(
                "type"      => "category", // required, allowed values: category, type
                "id" => 15
            )
        ),

        // "files" => array(
        //     array(
        //         "path" => "company-logo/new-job-logo.png",
        //         "content" => base64_encode(file_get_contents(dirname(__FILE__) . "/assets/new-job-logo.png"))
        //     )
        // )
    )
);
exec_curl_request('/api/jobs/', $postJobBody);
