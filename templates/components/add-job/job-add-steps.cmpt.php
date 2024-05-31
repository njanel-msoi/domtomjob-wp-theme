<?php if ($mode == "standalone") : ?>
    <div class="stepper">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
            <?php $current = $i == $current_step;
            $done = $current_step > $i ?>
            <div class="step <?= $current ? 'current' : ($done ? 'done' : '') ?>">
                <div class="step-nb"><?= $i ?></div>
                <div class="step-txt"><?php esc_html_e(wpjb_conf("seo_step_" . $i, $steps[$i])) ?></div>
                <div class="step-bar"></div>
            </div>
        <?php endfor ?>
    </div>
<?php else : ?>
    <?php do_action("wpjb_jobs_add_steps", $current_step, $this->view); ?>
<?php endif; ?>