<?php
// main page of applicant dashboard is directly the profile
?>
<script>
    window.location.href = "<?= candidateDashboardUrl('my-resume') ?>";
</script>
<?php exit() ?>