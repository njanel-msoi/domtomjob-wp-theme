<?php

/**
 * Advanced search form
 */
/* @var $form Wpjb_Form_AdvancedSearch */
?>



<form action="<?php echo esc_html($redirect_to) ?>" method="get" class="bar-search-form">
    <?php echo $form->renderHidden() ?>
    <!-- <div class="box-industry">
        <select class="form-input mr-10 select-active input-industry">
            <option value="0">Industry</option>
        </select>
    </div> -->
    <!-- <select class="form-input mr-10 select-active">
        <option value="">Location</option>
        <option value="AX">Aland Islands</option>
    </select> -->

    <?php foreach ($form->getReordered() as $group) : ?>
        <?php foreach ($group->getReordered() as $name => $field) : ?>
            <?php /* @var $field Daq_Form_Element */ ?>
            <?php wpjb_form_render_input($form, $field) ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <!-- <input class="form-input input-keysearch mr-10" type="text" placeholder="Your keyword... "> -->


    <button class="btn btn-default btn-find font-sm">Search</button>
</form>