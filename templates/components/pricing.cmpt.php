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

<div id="wpjb-main">
    <div class="wpjb wpjb-page-memberships">

        <?php foreach ($memberships as $pricing) : ?>
            <?php if ($pricing->is_active != 1) : continue;
            endif; ?>
            <div class="wpjb-single-membership <?php if ($pricing->id == $featured || (!isset($featured) && $pricing->meta->is_featured->value() == 1)) : ?>wpjb-single-membership-featured<?php endif; ?>">
                <h2 class="jobeleon-normal-bg"><?php echo esc_html($pricing->title); ?></h2>
                <div class="wpjb-membership-price">
                    <?php if ($pricing->price == 0) : ?>
                        <?php _e("Free", "jobeleon") ?>
                    <?php else : ?>
                        <?php echo esc_html(wpjb_price($pricing->price, $pricing->currency)) ?>
                        <?php if ($pricing->meta->is_recurring->value()) : ?>
                            <small><?php _e("/mth", "jobeleon"); ?></small>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="wpjb-membership-time">
                    <?php if ($pricing->meta->visible->value() > 0) : ?>
                        <span><?php printf(__('%s days', 'jobeleon'), $pricing->meta->visible->value()) ?></span>
                    <?php else : ?>
                        <span><?php _e("Unlimited", "jobeleon") ?></span>
                    <?php endif; ?>


                </div>
                <div class="wpjb-membership-details">
                    <?php $package = unserialize($pricing->meta->package->value()) ?>
                    <?php $single_job = $package[Wpjb_Model_Pricing::PRICE_SINGLE_JOB]; ?>
                    <?php $single_resume = $package[Wpjb_Model_Pricing::PRICE_SINGLE_RESUME]; ?>
                    <ul>

                        <?php if (!empty($single_job)) : ?>
                            <li class="wpjb-membership-item-title jobeleon-normal-color"><strong><?php _e("Job Postings Included", "jobeleon") ?></strong></li>

                            <?php foreach ($single_job as $id => $usage) : ?>
                                <?php $product = new Wpjb_Model_Pricing($id); ?>
                                <li class="wpjb-membership-details-product">
                                    <?php esc_html_e($product->title) ?>
                                </li>
                                <?php if ($product->meta->is_featured->value()) : ?>
                                    <li>
                                        <span class="wpjb-glyphs wpjb-icon-flag"></span>
                                        <?php _e("Featured", "jobeleon"); ?>
                                    </li>
                                <?php endif; ?>

                                <?php if ($product->meta->visible->value()) : ?>
                                    <li>
                                        <span class="wpjb-glyphs wpjb-icon-calendar"></span>
                                        <?php printf(__("Days Visible: %d", "jobeleon"), $product->meta->visible->value()); ?>
                                    </li>
                                <?php endif; ?>

                                <?php if ($usage["status"] == "unlimited") : ?>
                                    <li>
                                        <span class="wpjb-glyphs wpjb-icon-arrows-cw"></span>
                                        <?php printf(__("Max Uses: Unlimited", "jobeleon")); ?>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <span class="wpjb-glyphs wpjb-icon-arrows-cw"></span>
                                        <?php printf(__('Max Uses: %1$d ', "jobeleon"), $usage["usage"]); ?>
                                    </li>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!empty($single_resume)) : ?>
                            <li class="wpjb-membership-item-title jobeleon-normal-color"><strong><?php _e("Resumes Access Included", "jobeleon") ?></strong></li>
                            <?php foreach ($single_resume as $id => $usage) : ?>
                                <?php $product = new Wpjb_Model_Pricing($id); ?>
                                <li class="wpjb-membership-details-product">
                                    <?php esc_html_e($product->title) ?>
                                </li>
                                <li>
                                    <span class="wpjb-glyphs wpjb-icon-arrows-cw"></span>
                                    <?php if ($usage["status"] == "unlimited") : ?>
                                        <?php printf(__("Max Uses: Unlimited", "jobeleon")); ?>
                                    <?php else : ?>
                                        <?php printf(__('Max Uses: %1$d', "jobeleon"), $usage["usage"]); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </ul>
                </div>
                <div class="wpjb-membership-actions">

                    <?php if (array_key_exists($pricing->id, $subscriptions) && $subscriptions[$pricing->id]->stripe_id && $subscriptions[$pricing->id]->stripe_status == -1) : ?>
                        <?php _e("You canceled this plan. Wait till subscription expire, before you buy new one.", "jobeleon"); ?>
                    <?php elseif (array_key_exists($pricing->id, $subscriptions) && $subscriptions[$pricing->id]->stripe_id) : ?>
                        <?php _e("You Already Have This Plan", "jobeleon"); ?>
                    <?php else : ?>
                        <a href="<?php the_permalink() ?>?membership_id=<?php echo esc_html(intval($pricing->id)); ?>" class="wpjb-button">
                            <?php if ($pricing->price == 0) : ?>
                                <?php _e("Get It Now!", "jobeleon"); ?>
                            <?php else : ?>
                                <?php _e("Purchase Now!", "jobeleon"); ?>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>