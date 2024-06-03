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
?>

<?php if ($can_post) : ?>


    <?php $bannerTitle = '<span class="color-brand-2">Rédigez</span> votre offre';
    include 'add-job-steps-header.cmpt.php'; ?>

    <?php wpjb_flash() ?>

    <form action="<?php esc_attr_e($urls->preview) ?>" method="post" enctype="multipart/form-data" class="form">

        <?php echo $form->renderHidden() ?>
        <?php foreach ($form->getReordered() as $group) : ?>
            <?php $groupsToHide = ['important_infos'];
            if (in_array($group->getName(), $groupsToHide)) continue; ?>

            <?php /* @var $group stdClass */ ?>
            <div class="box-border-single mb-30 group-<?= esc_attr($group->getName()) ?>">
                <?php /* Check groups on half or full width */
                $fullSizeGroups = ['coupon', 'captcha'];
                $colClass = in_array($group->getName(), $fullSizeGroups) ? 'col' : 'col-md-6' ?>
                <!-- One bloc per group -->
                <h6 class="pb-10 mb-10 border-bottom"><?= esc_attr($group->title) ?></h5>
                    <div class="row g-3">
                        <?php foreach ($group->getReordered() as $name => $field) : ?>
                            <?php /* @var $field Daq_Form_Element Daq_Form_Element_Select */ ?>
                            <div class="<?= $colClass ?> field-container <?php wpjb_form_input_features($field) ?>">

                                <?php if ($field->getType() != 'label') : ?>

                                    <label for="inputEmail4" class="form-label <?= $field->isRequired() ? 'required' : '' ?>"><?= esc_html($field->getLabel()) ?></label>

                                    <div>
                                        <?php if ($field->getType() != 'radio') $field->addClass('form-control'); ?>

                                        <?php wpjb_form_render_input($form, $field) ?>
                                        <?php wpjb_form_input_hint($field) ?>
                                        <?php wpjb_form_input_errors($field) ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; ?>
                    </div>
            </div>
        <?php endforeach; ?>

        <div class="submit-box">
            <button type="submit" class="btn btn-default hover-up submit-btn">
                Prévisualiser l'offre
            </button>
        </div>

    </form>
<?php endif; ?>