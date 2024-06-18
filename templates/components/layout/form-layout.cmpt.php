<?php

/**
 * This template needs variables :
 *      $formClass = '';
 *      $formAction = '';
 *     $groupsToHide = ['important_infos'];
 *     $fieldsToHide = ['is_public'];
 *     $defaultValues = [];
 *     $groupsHalfSize = ['company', 'billing'];
 *     $groupsWithFullSizeInput = ['coupon', 'captcha', 'billing', 'company'];
 *     $submitBtn = 'Prévisualiser l'offre';
 *     $noGroups = false;
 */
if (!isset($formClass)) $formClass = '';
if (!isset($formAction)) $formAction = '';
if (!isset($submitBtn)) $submitBtn = 'Enregistrer';
if (!isset($groupsToHide)) $groupsToHide = [];
if (!isset($fieldsToHide)) $fieldsToHide = [];
if (!isset($groupsHalfSize)) $groupsHalfSize = [];
if (!isset($groupsWithFullSizeInput)) $groupsWithFullSizeInput = [];
if (!isset($defaultValues)) $defaultValues = [];

$groupsToHide[] = 'important_infos';


if (!isset($noGroups)) $noGroups = false;

$hasBeenSubmited = isset($_POST['submitted']);
?>

<form action="<?= $formAction ?>" method="post" enctype="multipart/form-data" class="form <?= $formClass ?>">
    <input type="hidden" name="submitted" value="1">

    <?php echo $form->renderHidden() ?>
    <div class="row justify-content-center">
        <?php foreach ($form->getReordered() as $group) : ?>
            <?php if ($group->isTrashed()) continue; ?>
            <div class="col-12 <?= in_array($group->getName(), $groupsHalfSize) ? 'col-md-6' : '' ?> <?= in_array($group->getName(), $groupsToHide) ? 'd-none' : '' ?>">
                <div class="<?= $noGroups ? '' : 'box-border-single mb-30' ?> group-<?= esc_attr($group->getName()) ?> <?= $noGroups ? 'mb-30' : '' ?>">
                    <?php /* Check groups on half or full width */
                    $colClass =  in_array($group->getName(), $groupsWithFullSizeInput) ? 'col-12' : 'col-md-6' ?>
                    <!-- One bloc per group -->
                    <?php if (!$noGroups) : ?>
                        <h6 class="pb-10 mb-10 border-bottom">
                            <?= esc_attr($group->title) ?>
                        </h6>
                    <?php endif ?>
                    <div class="row g-3">
                        <?php foreach ($group->getReordered() as $field) : ?>
                            <?php $isRadioOrCheckbox = in_array($field->getType(), ['radio', 'checkbox']); ?>
                            <?php if (in_array($field->getName(), $fieldsToHide)) $colClass .= ' d-none'; ?>

                            <?php /* @var $field Daq_Form_Element Daq_Form_Element_Select */ ?>
                            <div class="<?= $colClass ?> field-container <?php wpjb_form_input_features($field) ?>">

                                <?php if ($field->getType() != 'label') : ?>

                                    <?php // for radio/checkbox, label is inside input rendering 
                                    if (!$isRadioOrCheckbox) : ?>
                                        <label class="form-label <?= $field->isRequired() ? 'required' : '' ?>"><?= esc_html($field->getLabel()) ?></label>
                                    <?php endif ?>

                                    <div>
                                        <?php if (!$isRadioOrCheckbox) $field->addClass('form-control'); ?>

                                        <?php if (!$hasBeenSubmited && isset($defaultValues[$field->getName()])) $field->setValue($defaultValues[$field->getName()]); ?>

                                        <?php wpjb_form_render_input($form, $field) ?>
                                        <?php wpjb_form_input_hint($field) ?>
                                        <?php wpjb_form_input_errors($field) ?>
                                    </div>
                                <?php endif ?>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if ($noGroups) : ?><div class="w-100"></div><?php endif ?>
        <?php endforeach; ?>
    </div>

    <div class="submit-box">
        <button type="submit" class="btn btn-default hover-up submit-btn">
            <?= $submitBtn ?>
        </button>
    </div>

</form>