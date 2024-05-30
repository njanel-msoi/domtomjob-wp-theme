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

    <section class="section-box">
        <div class="pb-20 banner-hero banner-single banner-single-bg">
            <div class="block-banner text-center">
                <h3>
                    <span class="color-brand-2">Publier</span> une offre
                </h3>
                <div class="font-sm color-text-paragraph-2 mt-10">
                    Ajouter une offre d'emploi sur DomTomJob pour être visible par 100 000 candidats par mois.
                </div>

                <div class="mt-40">
                    <?php include $this->getTemplate("job-board", "step") ?>
                </div>
            </div>
        </div>
    </section>

    <?php wpjb_flash() ?>

    <form action="<?php esc_attr_e($urls->preview) ?>" method="post" enctype="multipart/form-data">

        <?php echo $form->renderHidden() ?>
        <?php foreach ($form->getReordered() as $group) : ?>
            <?php $groupsToHide = ['important_infos'];
            if (in_array($group->getName(), $groupsToHide)) continue; ?>

            <?php /* @var $group stdClass */ ?>
            <div class="box-border-single mt-30 group-<?= esc_attr($group->getName()) ?>">
                <!-- One bloc per group -->
                <h6 class="pb-10 mb-10 border-bottom"><?= esc_attr($group->title) ?></h5>
                    <div class="row g-3">
                        <?php foreach ($group->getReordered() as $name => $field) : ?>
                            <?php /* @var $field Daq_Form_Element Daq_Form_Element_Select */ ?>
                            <div class="col-md-6 field-container <?php wpjb_form_input_features($field) ?>">

                                <?php if ($field->getType() != 'label') : ?>

                                    <?php if ($field->getLabel() != 'Captcha') : ?>
                                        <label for="inputEmail4" class="form-label <?= $field->isRequired() ? 'required' : '' ?>"><?= esc_html($field->getLabel()) ?></label>
                                    <?php endif; ?>

                                    <div>
                                        <?php $field->addClass('form-control'); ?>

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

        <div class="mt-30">
            <input type=" submit" class="btn btn-default hover-up" name="wpjb_preview" id="wpjb_submit" value="Prévisualiser l'annonce" />
            <!-- <span class="wpjb-submit-info">
                <?php _e("or", "jobeleon") ?>
                <a href="<?php esc_attr_e($urls->reset) ?>"><?php _e("Reset add job form", "jobeleon") ?></a>
            </span> -->
        </div>

    </form>
<?php endif; ?>