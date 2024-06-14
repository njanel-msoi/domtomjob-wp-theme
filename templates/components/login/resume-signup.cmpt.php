<?php
$isLogin = false;
$isCompany = false;

$fieldsToHide = ['candidate_country', 'phone', 'birthdate', 'image', 'study_level', 'resume_contract_searched', 'motivation_file', 'candidate_location'];

$noGroups = true;
$groupsHalfSize = ['default', 'resume', 'location', 'group_optin'];
$groupsWithFullSizeInput = ['default', 'resume', 'location', 'group_optin'];

include 'generic-login-form.cmpt.php';
