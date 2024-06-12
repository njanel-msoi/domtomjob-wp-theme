<?php
$headerTitle = 'Suppression du compte';
include 'company-dashboard-header.cmpt.php'; ?>

<?php wpjb_flash() ?>
<?php
$noGroups = true;
$groupsHalfSize = ['default'];
$groupsWithFullSizeInput = ['default'];
include dirname(__FILE__) . "/../layout/form-layout.cmpt.php"; ?>

