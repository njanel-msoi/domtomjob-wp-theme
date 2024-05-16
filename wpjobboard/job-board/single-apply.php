<?php if (!wpjb_conf("front_hide_apply_link")): ?>
    <div id="wpjb-form-job-apply" class="wpjb-form-slider <?php if(!$show->apply): ?>wpjb-none<?php endif; ?>">

        <?php if (isset($form_error)): ?>
            <div class="wpjb-flash-error" style="margin:5px">
                <span><?php esc_html_e($form_error) ?></span>
            </div>
        <?php endif; ?>

        <form id="wpjb-apply-form" action="<?php esc_attr_e(wpjb_link_to("job", $job, array("form"=>"apply"))) ?>#wpjb-scroll" method="post" enctype="multipart/form-data" class="wpjb-form wpjb-form-nolines">
            <?php echo $form->renderHidden() ?>
            <?php foreach ($form->getReordered() as $group): ?>
                <?php /* @var $group stdClass */ ?> 
                <fieldset class="wpjb-fieldset-<?php esc_attr_e($group->getName()) ?>">

                    <?php if ($group->title): ?>
                        <?php // <legend><?php esc_html_e($group->title) </legend>  ?>
                    <?php endif; ?>

                    <?php foreach ($group->getReordered() as $name => $field): ?>
                        <?php /* @var $field Daq_Form_Element */ ?>
                        <div class="<?php wpjb_form_input_features($field) ?>">

                            <label class="wpjb-label">
                                <?php esc_html_e($field->getLabel()) ?>
                                <?php if ($field->isRequired()): ?><span class="wpjb-required">*</span><?php endif; ?>
                            </label>

                            <div class="wpjb-field">
                                <?php 
                                set_field_value_from_resume($field, ['first_name','last_name']);
                                ?>
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
                <input type="submit" class="wpjb-submit" id="wpjb_submit" value="<?php _e("Send Application", "jobeleon") ?>" />
            </fieldset>
        </form>
    </div>
<?php endif; ?>