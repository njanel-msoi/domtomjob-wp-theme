<?php

/**
 * Dashboard of registered company
 */
?>

<?php wpjb_flash() ?>

<?php do_action("wpjb_employer_panel_heading", "top") ?>
<?php
$dashboard['manage']['links']['membership']['icon'] = 'wpjb-icon-star';
$dashboard['manage']['links']['cvtheque'] = array('title' => "CVThèque", "icon" => "wpjb-icon-users", "capability" => NULL, "url" => get_page_link(10))
?>

<?php do_action("wpjb_employer_panel_heading", "bottom") ?>

<?php $headerTitle = "Espace recruteur" ?>
<?php include 'company-dashboard-header.cmpt.php' ?>

<?php foreach ($dashboard as $gname => $group) : ?>
    <div class="border-bottom mb-20 mt-20"></div>
    <!-- <h2 class="section-title mb-10"><?= esc_html($group["title"]) ?></h2> -->
    <ul class="nav nav-tabs">
        <?php foreach ($group["links"] as $lname => $link) : ?>
            <li>
                <a class="<?= $gname == 'manage' ? 'active' : '' ?>" href="<?= esc_attr($link["url"]) ?>">
                    <span class="wpjb-box-icon wpjb-glyphs <?php echo esc_attr($link["icon"]) ?>"></span>
                    <span class="name">
                        <?= esc_html($link["title"]) ?>
                        <?php do_action("wpjb_employer_panel_after_title", $lname, $link) ?>
                    </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>