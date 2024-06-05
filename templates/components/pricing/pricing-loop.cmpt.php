<?php

/** 
 * This template needs the following variables :
 * - $title
 * - $subtitle
 * - $pricesArr : array of object with structure : {title, price, link}
 * - $buyBtnTxt 
 * */

if (!isset($buyBtnTxt)) $buyBtnTxt = 'Acheter';
?>

<section class="section-box">
    <div class="container">
        <?php if ($title) : ?><h2 class="text-center mb-15 mt-15 wow animate__animated animate__fadeInUp"><?= $title ?></h2><?php endif ?>
        <?php if ($subtitle) : ?><div class="font-lg color-text-paragraph-2 text-center wow animate__animated animate__fadeInUp">
                <?= $subtitle ?>
            </div><?php endif ?>
        <div class="max-width-price">
            <div class="block-pricing mt-30">
                <div class="row justify-content-center">
                    <?php foreach ($pricesArr as $pricing) : ?>
                        <div class="col-xl-4 col-lg-6 col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <div class="box-pricing-item text-center">
                                <h3><?= esc_html($pricing->title); ?></h3>
                                <div class="box-info-price">
                                    <span class="text-price color-brand-2"><?= str_replace('.00', '', $pricing->price) ?>€</span>
                                    <!-- <span class="text-month">/month</span> -->
                                </div>
                                <!-- <div class="border-bottom mb-30"> -->
                                <!-- <p class="text-desc-package font-sm color-text-paragraph mb-30">For most businesses that want to optimize web queries</p> -->
                                <!-- </div> -->
                                <!-- <ul class="list-package-feature">
                                    <li>Nombre d'offres défini</li>
                                    <li>Valable pendant jours</li>
                                </ul> -->
                                <div>
                                    <?php /* if (array_key_exists($pricing->id, $subscriptions) && $subscriptions[$pricing->id]->stripe_id && $subscriptions[$pricing->id]->stripe_status == -1) : ?>
                                        <?php _e("You canceled this plan. Wait till subscription expire, before you buy new one.", "jobeleon"); ?>
                                    <?php elseif (array_key_exists($pricing->id, $subscriptions) && $subscriptions[$pricing->id]->stripe_id) : ?>
                                        <?php _e("You Already Have This Plan", "jobeleon"); ?>
                                    <?php else : ?>
                                        <a href="<?php the_permalink() ?>?membership_id=<?php echo esc_html(intval($pricing->id)); ?>" class="btn btn-border">
                                            <?php if ($pricing->price == 0) : ?>
                                                <?php _e("Get It Now!", "jobeleon"); ?>
                                            <?php else : ?>
                                                <?php _e("Purchase Now!", "jobeleon"); ?>
                                            <?php endif; ?>
                                        </a>
                                    <?php endif; */ ?>
                                    <?php if ($pricing->link) : ?>
                                        <a href="<?= $pricing->link ?>" class="btn btn-border">
                                            <?= $buyBtnTxt ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>