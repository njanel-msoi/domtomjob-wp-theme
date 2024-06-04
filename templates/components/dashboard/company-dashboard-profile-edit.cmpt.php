<?php

/**
 * Edit company profile
 * 
 * Displays company profile form. Employer can edit his company page here.
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */
/* @var $form Wpjb_Form_Frontend_Company Company edit form */
/* @var $company Wpjb_Model_Employer Currently logged in employer object */
?>

<?php $headerTitle = "Mon profile entreprise"; ?>
<?php include  dirname(__FILE__) . '/company-dashboard-header.cmpt.php' ?>

<?php wpjb_flash() ?>

    <?php

    $formClass = 'wpjb-company-edit-form company-edit-form';
    $formAction = '';
    $groupsToHide = ['important_infos'];
    $fieldsToHide = ['is_public'];
    $groupsHalfSize = ['contact', 'group_2'];
    $groupsWithFullSizeInput = ['contact', 'group_2'];
    $submitBtn = "Enregistrer les modifications";

    include dirname(__FILE__) .  '/../layout/form-layout.cmpt.php';
    ?>
