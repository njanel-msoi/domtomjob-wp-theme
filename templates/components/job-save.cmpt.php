<?php

/**
 * Save job
 * 
 * Template displayed when job is being saved
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */

/* @var $job Wpjb_Model_Job */
/* @var $info array List of generated messages */
/* @var $cart boolean Show cart? */

?>

<?php $bannerTitle = '<span class="color-brand-2">Publiez</span> votre offre';
include 'add-job-steps-header.cmpt.php'; ?>

<?php wpjb_flash(); ?>

<?php if (!empty($info)) : ?>
    <div class="wpjb-flash-info">
        <div class="wpjb-flash-icon">
            <span class="wpjb-glyphs wpjb-icon-ok"></span>
        </div>
        <div class="wpjb-flash-body">
            <?php foreach ($info as $message) : ?>
                <p><?php echo $message ?></p>
            <?php endforeach; ?>
        </div>
    </div>

<?php endif; ?>

<?php if ($cart) : ?>
    <?php include $this->getTemplate("default", "payment.php") ?>
<?php endif; ?>