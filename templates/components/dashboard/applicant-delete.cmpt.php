<?php include 'applicant-dashboard-header.cmpt.php'; ?>

<?php wpjb_flash() ?>

<h3 class="mt-0 text-center">Suppression du compte candidat</h3>
<?php
$noGroups = true;
$groupsHalfSize = ['default'];
$groupsWithFullSizeInput = ['default'];
include dirname(__FILE__) . "/../layout/form-layout.cmpt.php"; ?>

<?php include 'applicant-dashboard-footer.cmpt.php'; ?>