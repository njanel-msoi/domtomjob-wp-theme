<?php

header("Content-type: text/plain; charset=utf-8");

include_once "access-token.php";

$url = API_URL . '/api/jobs/';
$headers = array("X-Authorization: " . encrypt(API_CRYPT, API_ACCESS_TOKEN));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_VERBOSE, API_DEBUG);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
    "wpjb-job" => array(
        "id"                => null, // if the ID exists in the database the job with this ID will be updated
        "job_title"         => "New Job 2",
        "job_description"   => "New job description.",
        "employer_id"       => 3,
        "job_created_at"    => date("Y-m-d"),
        "job_modified_at"   => date("Y-m-d"),
        "job_expires_at"    => date("Y-m-d", strtotime("today +30 day")), // set it to 9999-12-31 to have the job never expire
        "is_approved"       => 1,
        "is_active"         => 1,
        "is_filled"         => 0,
        "is_featured"       => 0,
        "job_country"       => 840, // country ISO 3166-1 numeric code
        "job_state"         => "New York",
        "job_zip_code"      => "10001",
        "job_city"          => "New York",
        "job_address"       => "20 W 34th St.",
        "company_name"      => "ACME Corp.",
        "company_url"       => "https://example.com",
        "company_email"     => "acme@example.com",

        "meta" => array(
            array(
                "name"      => "form_code", // saved form scheme name
                "values"    => array(null)
            ),
            array(
                "name"      => "geo_longitude", // location longitude
                "values"    => array("40.748817")
            ),
            array(
                "name"      => "geo_latitude", // location latitude
                "values"    => array("-73.985428")
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
                "title"     => "PHP",      // <required (if empty "id")
                "slug"      => "php"
            )
        ),

        "files" => array(
            array(
                "path" => "company-logo/new-job-logo.png",
                "content" => base64_encode(file_get_contents(dirname(__FILE__) . "/assets/new-job-logo.png"))
            )
        )
    )
)));

$result = curl_exec($ch);

curl_close($ch);

print_r($result);
