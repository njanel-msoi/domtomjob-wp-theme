<?php

function dtj_listing_renderer(Daq_Form_Element $field, $form)
{
    // items are filtered with item prefix, base on "connected" and "haveCredit" status
    // you can refer to doc https://dtarecettedeselsia05e2f81bf65a4be6a75b5060edb76a86.notion.site/Gestion-tarifs-achat-offre-b9c138105c1b4da1b14193b1405f0da2?pvs=74
    $connected = is_company_connected();
    $hasCredits = count(array_filter($field->getOptions(), function ($o) {
        return str_starts_with($o['value'], Wpjb_Model_Pricing::PRICE_EMPLOYER_MEMBERSHIP);
    })) > 0;
    $prefixesToInclude = [];
    if (!$connected || !$hasCredits) $prefixesToInclude[] = LISTING_PREFIX_NoCredits;
    if ($connected && !$hasCredits) $prefixesToInclude[] = LISTING_PREFIX_ConnectedNoCredits;
    if ($connected && $hasCredits) $prefixesToInclude[] = LISTING_PREFIX_ConnectedCredits;

    $group_titles = array();
    $groups = array(
        Wpjb_Model_Pricing::PRICE_EMPLOYER_MEMBERSHIP => array("item" => array(), "title" => __("Purchased Membership", "wpjobboard")),
        Wpjb_Model_Pricing::PRICE_SINGLE_JOB => array("item" => array(), "title" => __("Single Job Posting", "wpjobboard")),
        // group for "new package" listing
        PRICE_PACKAGE_DURING_ADDJOB => array("item" => array(), "title" => "Abonnement et packs d'offres")
    );
    foreach ($field->getOptions() as $o) {
        list($price_for, $package_id, $id) = explode("_", $o["value"]);
        $desc = $o['desc'];
        $isActiveSubscription = str_contains($desc, '/');

        // filter item by prefix included (if desc include some prefix)
        if (!$isActiveSubscription) {
            $isIncluded = false;
            foreach ($prefixesToInclude as $prefix) {
                if (str_contains($desc, $prefix)) $isIncluded = true;
            }
            if (!$isIncluded) continue;
        }

        // if single job but already paid, add it to "bought" group
        if ($isActiveSubscription) {
            $price_for = Wpjb_Model_Pricing::PRICE_EMPLOYER_MEMBERSHIP;
        }

        // remove order prefix
        if (str_contains('-', $desc)) {
            list($a, $o['desc']) = explode("-", $desc);
        }

        // put "packages" in a different group
        if (str_contains($desc, LISTING_PREFIX_ConnectedNoCredits)) {
            $price_for = PRICE_PACKAGE_DURING_ADDJOB;
        }

        $groups[$price_for]["item"][] = $o;
        $group_titles[$price_for] = 1;
    }

    $group_titles = array_sum($group_titles) > 1 ? true : false;

    // this boolean is true only on first row display
    $selectFirstOption = !$field->getValue();
    foreach ($groups as $k => $group) {

        if ($group_titles && !empty($group["item"])) {
            echo "<div class='wpjb-listing-group'>" . $group["title"] . "</div>";
        }

        foreach ($group["item"] as $option) {

            $lid = $option["value"];

            list($price_for, $membership_id, $id) = explode("_", $lid);

            if ($membership_id > 0) {
                $membership = new Wpjb_Model_Membership($membership_id);
                $usage = $membership->package();
                $usage = $usage[Wpjb_Model_Pricing::PRICE_SINGLE_JOB];
                foreach ($usage as $k => $use) {

                    if ($k == $id) {
                        $u = $use;
                    }

                    if ($k == $id && $use["status"] == "limited") {
                        $credits = absint($use["usage"]) - absint($use["used"]);
                        break;
                    }
                }
            } else {
                $membership = null;
            }

            $l = new Wpjb_Model_Pricing($id);

            // remove prefix in item description
            $prefixParts = explode("]", $option['desc']);
            $option['desc'] = array_pop($prefixParts);

?>

            <label class="wpjb-listing-type-x">
                <div class="wpjb-listing-type wpjb-listing-radio">
                    <label class="wpjb-cute-input wpjb-cute-radio ">
                        <input name="listing" class="wpjb-listing-type-input" id="listing_<?php echo $lid ?>" type="radio" value="<?php echo $lid ?>" <?php checked($selectFirstOption || $field->getValue() == $lid) ?> />
                        <div class="wpjb-cute-input-indicator"></div>
                    </label>
                </div>
                <div class="wpjb-listing-type">
                    <div class="wpjb-listing-type-name">
                        <span class="wpjb-listing-type-title"><?php esc_html_e($option["desc"]) ?></span>
                        <span class="wpjb-listing-type-cost wpjb-motif-bg">
                            <?php if ($membership && $u["status"] == "limited") : ?>
                                <?php printf(_n("(1 ad left)", "(%d ads left)", $credits, "wpjobboard"), $credits) ?>
                            <?php elseif ($membership && $u["status"] == "unlimited") : ?>
                                <?php _e("(Unlimited)", "wpjobboard") ?>
                            <?php elseif (!$membership) : ?>
                                <?php esc_html_e(wpjb_price($l->price, $l->currency)) ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <!-- <div class="wpjb-listing-type-features">
                        <span class="wpjb-listing-type-feature-duration">
                            <span class="wpjb-glyphs wpjb-icon-clock"></span>
                            <?php $visible = (int)$l->meta->visible->value(); ?>
                            <?php if ($visible > 0) : ?>
                                <?php printf(_n("Visible 1 day", "Visible %d days", $visible, "wpjobboard"), $visible) ?>
                            <?php else : ?>
                                <?php _e("Never Expires", "wpjobboard"); ?>
                            <?php endif; ?>
                        </span>
                        <?php if ($l->meta->is_featured->value()) : ?>
                            <span class="wpjb-listing-type-feature-featured wpjb-listing-border">
                                <span class="wpjb-glyphs wpjb-icon-flag">
                                    <?php _e("Featured", "wpjobboard") ?>
                                </span>
                            </span>
                        <?php endif; ?>

                        <?php do_action("wpjb_listing_helper_features", $l) ?>
                    </div> -->
                </div>

            </label>
<?php
            $selectFirstOption = false;
        }
    }
}
