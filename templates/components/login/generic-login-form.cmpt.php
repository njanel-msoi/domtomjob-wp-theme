<?php

/**
 * Variables to configure this template :
 * - $isCompany = true;
 * - $isLogin = true;
 */

$isResume = !$isCompany;
$isSignup = !$isLogin;

$partTitle = $isCompany ? 'Espace Recruteur' : 'Espace Candidat';
$title = $isLogin ? 'Connectez-vous' : 'Inscrivez-vous';
$subtitle = $title . ' à votre espace ' . ($isCompany ? 'recruteur' : 'candidat') . '.';
$submitTxt = ($isLogin ? 'Connexion' : 'Inscription') . ' ' . ($isCompany ? 'Espace Recuteur' : 'Espace Candidat');
$footerHeader = $isLogin ? 'Pas encore inscrit ?' : 'Déja inscrit ?';
$footerLinkTxt = ($isLogin ? 'Créer mon compte' : 'Connexion à mon compte') . ' ' . ($isCompany ? 'recruteur' : 'candidat');
$footerLinkUrl = ($isLogin ? ($isCompany ? PAGES_URLS->CreationRecruteur : PAGES_URLS->CreationCandidat) : ($isCompany ? PAGES_URLS->EspaceRecruteur : PAGES_URLS->EspaceCandidat));
?>

<div class="box-nav-tabs pt-10 mb-5">
    <ul class="nav justify-content-center" role="tablist">
        <li><a class="btn btn-grey-small people-icon mr-15 mb-5 <?= $isResume ? 'selected' : '' ?>" href="<?= $isLogin ? PAGES_URLS->EspaceCandidat : PAGES_URLS->CreationCandidat ?>">Accès Candidats</a></li>
        <li><a class="btn btn-grey-small recruitment-icon mb-5 <?= $isCompany ? 'selected' : '' ?>" href="<?= $isLogin ? PAGES_URLS->EspaceRecruteur : PAGES_URLS->CreationRecruteur ?>">Accès Recruteurs</a></li>
    </ul>
</div>
<section class="login-register pt-40">
    <div class="row login-register-cover">
        <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
            <div class="text-center">
                <p class="font-sm text-brand-2"><?= $title ?></p>
                <h2 class="mt-10 mb-5 text-brand-1"><?= $partTitle ?></h2>
                <p class="font-sm text-muted mb-30"><?= $subtitle ?></p>

                <?php
                // doesn't display "need connexion" error
                $flash = new Wpjb_Utility_Session();
                foreach ($flash->getError() as $error) : if ($error == __("Login to access this page.", "wpjobboard")) continue; ?>
                    <div class="wpjb-flash-error">
                        <span class="wpjb-glyphs <?php esc_attr_e($flash->getErrorIcon()) ?>"><?php echo apply_filters("wpjb_flash_message", $error, "error"); ?></span>
                    </div>
                <?php endforeach; ?>

                <div class="no-errors-display">
                    <?php wpjb_flash(); ?>
                </div>
            </div>
            <form class="login-register text-start mt-20" action="<?php esc_attr_e($action) ?>" method="post" enctype="multipart/form-data">
                <?php echo $form->renderHidden() ?>
                <?php foreach ($form->getReordered() as $group) : ?>
                    <?php foreach ($group->getReordered() as $name => $field) : ?>
                        <?php /* @var $field Daq_Form_Element */ ?>
                        <?php $radioCheckbox = in_array($field->getType(), ['radio', 'checkbox']) ?>

                        <div class="form-group <?php wpjb_form_input_features($field) ?>">

                            <label class="form-label  <?= $field->isRequired() ? 'required' : '' ?>">
                                <?php if ($radioCheckbox) wpjb_form_render_input($form, $field) ?>
                                <span class="text-small"><?= esc_html($field->getLabel()) ?></span>
                            </label>
                            <?php if (!$radioCheckbox) {
                                $field->addClass('form-control');
                                wpjb_form_render_input($form, $field);
                            } ?>

                            <?php wpjb_form_input_hint($field) ?>
                            <?php wpjb_form_input_errors($field) ?>
                        </div>


                    <?php endforeach; ?>
                <?php endforeach; ?>

                <div class="form-group">
                    <button class="btn btn-brand-1 hover-up w-100" type="submit" name="login">
                        <?= $submitTxt ?>
                    </button>
                </div>
            </form>

            <div class="divider-text-center mb-20"><span><?= $footerHeader ?></span></div>

            <a class="btn social-login recruitment-icon mb-20" href="<?= $footerLinkUrl ?>"><strong><?= $footerLinkTxt ?></strong></a>
        </div>
        <div class="img-1 d-none d-lg-block"><img class="shape-1" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/login-register/img-<?= $isCompany ? '4' : '1' ?>.svg" alt="JobBox"></div>
        <div class="img-2"><img src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/login-register/img-3.svg" alt="JobBox"></div>
    </div>
</section>