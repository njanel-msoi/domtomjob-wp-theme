<?php

/**
 * Template Name: DTJ CVTheque
 */
get_header();
?>

<?php $headerCode = "CV"; ?>
<?php include 'components/dashboard/company-dashboard-header.cmpt.php' ?>

<?php
$fullname = isset($_GET['fullname']) ? $_GET['fullname'] : '';
echo do_shortcode('[wpjb_resumes_list fullname="' . $fullname . '"]');
?>


<?php get_footer(); ?>