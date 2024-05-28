<?php

/**
 * Advanced search form
 */
/* @var $form Wpjb_Form_AdvancedSearch */
?>

<form action="<?php echo esc_html($redirect_to) ?>" method="get">
    <?php echo $form->renderHidden() ?>
    <div class="box-industry">
        <select class="form-input mr-10 select-active input-industry">
            <option value="0">Industry</option>
        </select>
    </div>
    <select class="form-input mr-10 select-active">
        <option value="">Location</option>
        <option value="AX">Aland Islands</option>
    </select>

    <?php foreach ($form->getReordered() as $group) : ?>
        <?php /* @var $group stdClass */ ?>
        <fieldset class="wpjb-fieldset-<?php esc_attr_e($group->getName()) ?>">
            <legend class="wpjb-empty"><?php esc_html_e($group->title) ?></legend>
            <?php foreach ($group->getReordered() as $name => $field) : ?>
                <?php /* @var $field Daq_Form_Element */ ?>
                <div class="<?php wpjb_form_input_features($field) ?>">

                    <label class="wpjb-label">
                        <?php esc_html_e($field->getLabel()) ?>
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
    <fieldset>
        <legend class="wpjb-empty"></legend>
        <input type="submit" class="wpjb-submit" id="wpjb_submit" value="<?php _e("Search", "jobeleon") ?>" />
    </fieldset>

    <input class="form-input input-keysearch mr-10" type="text" placeholder="Your keyword... ">
    <button class="btn btn-default btn-find font-sm">Search</button>
</form>