<?php
$headerCode = 'ALERTS';
include 'applicant-dashboard-header.cmpt.php'; ?>


<h3 class="mt-0">Mes alertes email</h3>

<?php wpjb_flash() ?>

<div class="wpjb wpjb-page-job-applications applicant-alerts-manage">

    <form action="" method="POST" id="wpjb-save-alerts-form">

        <div id="wpjb-alerts-list" class="wpjb-grid wpjb-grid-compact">

            <div class="wpjb-flash-error wpjb-flash-alert-error" style="display: none;">
                <span class="wpjb-glyphs wpjb-icon-attention"><?php _e("'Save' or 'Cancel' all single Alert boxes before continuing.", "wpjobboard"); ?></span>
            </div>

            <div class="wpjb-grid-row" style="display: none">
                <div class="wpjb-grid-col wpjb-col-50">
                    <!--input type="submit" class="wpjb-button wpjb-button-primary" value="<?php _e("Save Alerts", "wpjobboard"); ?>" /-->
                    <!--a href="#" class="wpjb-button wpjb-button-primary" onclick="document.getElementById('wpjb-save-alerts-form').submit();"><?php _e("Save Alerts", "wpjobboard"); ?></a-->
                    <input type="submit" class="wpjb-button wpjb-button-primary" value="<?php _e("Save Alerts", "wpjobboard"); ?>" />
                    <?php if ($alerts['max'] > 0) : ?>
                        <?php printf(__("Alerts Limit: %d/%d", "wpjobboard"), $alerts['current'], $alerts['max']); ?>
                    <?php endif; ?>
                </div>
                <div class="wpjb-grid-col wpjb-grid-col-last wpjb-grid-col-right wpjb-col-50">
                    <?php if ($alerts['current'] < $alerts['max'] || $alerts['max'] == -1) : ?>
                        <a href="#" data-alertmax="<?php echo $alerts['max']; ?>" data-alertcur="<?php echo $alerts['current']; ?>" data-form="Wpjb_Form_Alert" data-before="wpjb-alerts-list" data-template="wpjb-utpl-alert" class="wpjb-button wpjb-glyphs wpjb-icon-plus" id="wpjb-add-new-alert"><?php _e("Add New Alert", "wpjobboard"); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include 'applicant-dashboard-footer.cmpt.php';
