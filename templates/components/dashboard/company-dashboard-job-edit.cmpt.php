<?php $headerCode = "JOBS"; ?>
<?php include  dirname(__FILE__) . '/company-dashboard-header.cmpt.php' ?>

<h4 class="mb-20">Editer l'offre "<span class="job-title"></span>"</h4>

<?php
$groupsToHide = ['company', 'billing', 'group_optin'];
include  dirname(__FILE__) . '/../layout/form-layout.cmpt.php' ?>

<script>
    jQuery(".job-title").text(jQuery("#job_title").val());
</script>