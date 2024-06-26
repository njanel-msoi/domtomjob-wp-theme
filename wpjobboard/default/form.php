<?php

/**
 * Add job form
 * 
 * Template displays add job form
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */

/* @var $form Wpjb_Form_AddJob */
/* @var $can_post boolean User has job posting priviledges */
/* @var $action string Form action URL */
/* @var $submit string Text on the submit button */

// redirection for some specifics forms
$templateToLoad = NULL;

if (isset($page_class)) {
    if ($page_class == 'wpjb-company-edit-form')
        $templateToLoad = 'dashboard/company-dashboard-profile-edit.cmpt.php';
    else if ($page_class == 'wpjb-page-company-login')
        $templateToLoad = 'login/company-login.cmpt.php';
    else if ($page_class == 'wpjb-page-resume-login')
        $templateToLoad = 'login/resume-login.cmpt.php';
    else if ($page_class == 'wpjb-page-company-new')
        $templateToLoad = 'login/company-signup.cmpt.php';
}
global $wp;
$currentPath = $wp->request;
if ($currentPath == 'candidate-panel/password')
    $templateToLoad = 'dashboard/applicant-change-password.cmpt.php';
if ($currentPath == 'candidate-panel/delete')
    $templateToLoad = 'dashboard/applicant-delete.cmpt.php';
if ($currentPath == 'employer-panel/password')
    $templateToLoad = 'dashboard/company-change-password.cmpt.php';
if ($currentPath == 'employer-panel/delete')
    $templateToLoad = 'dashboard/company-delete.cmpt.php';

if ($templateToLoad) {
    include  dirname(__FILE__) . '/../../templates/components/' . $templateToLoad;
    return;
}

?>

<?php wpjb_flash() ?>
<?php include dirname(__FILE__) . "/../../templates/components/layout/form-layout.cmpt.php";

/*
<?php
$standalone = true; // !( (defined("DOING_AJAX") && DOING_AJAX) || ($page_class == "wpjb-form-nested") ); ?>

<div <?php if ($action) : ?>id="wpjb-main" <?php endif; ?> class="wpjb-page-default-form <?php if (isset($page_class)) echo $page_class ?>">

    <?php wpjb_flash() ?>

    <form class="wpjb-form" action="<?php esc_attr_e($action) ?>" method="post" enctype="multipart/form-data">

        <?php echo $form->renderHidden() ?>
        <?php foreach ($form->getReordered() as $group) : ?>

            <fieldset class="wpjb-fieldset-<?php esc_attr_e($group->getName()) ?>">
                <?php if (!empty($group->title)) : ?><legend><?php esc_html_e($group->title) ?></legend><?php endif; ?>
                <?php foreach ($group->getReordered() as $name => $field) : ?>
                    <div class="<?php wpjb_form_input_features($field) ?>">

                        <label class="wpjb-label">
                            <?php if (strlen($field->getLabel()) > 0) : ?>
                                <?php esc_html_e($field->getLabel()) ?>
                            <?php else : ?>
                                &nbsp;
                            <?php endif; ?>
                            <?php if ($field->isRequired()) : ?><span class="wpjb-required">*</span><?php endif; ?>
                        </label>

                        <div class="wpjb-field">
                            <?php wpjb_form_render_input($form, $field) ?>
                            <?php wpjb_form_input_hint($field) ?>
                            <?php wpjb_form_input_errors($field) ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>

        <?php if (!empty($submit) || (isset($buttons) && is_array($buttons))) : ?>
            <fieldset>
                <div>
                    <?php if (!empty($submit)) : ?>
                        <input type="submit" class="wpjb-submit" name="wpjb_submit" id="wpjb_submit" value="<?php esc_attr_e($submit) ?>" />
                    <?php endif; ?>

                    <?php if (isset($buttons) && is_array($buttons)) : ?>
                        <?php foreach ($buttons as $button) : ?>
                            <?php echo Daq_Helper_Html::build($button["tag"], array_replace($button, array("tag" => null, "html" => null)), $button["html"]) ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </fieldset>
        <?php endif; ?>
    </form>

</div>*/
