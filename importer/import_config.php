<?php

define("JOB_EXPIRATION", strtotime("today +60 day"));
// if true, some important fields of a job cannot be changed by the job importer and default values are used (e.g. featured status, expiration date)
$GLOBALS['PROTECT_JOB_FIELDS'] = true;
$GLOBALS['FAKE_IMPORT'] = false;
