<?php

/**
 * The template for displaying the footer.
 * 
 * Responsible for closing tags opened in footer.cmpt.php
 */
?>

<?php
$isRecruteurPage = isRecruteurPage();
?>

<!-- main content end -->
</div>

<footer id="footer" role="contentinfo" class="<?php if ($isRecruteurPage) echo 'pro-bg' ?>">
    <nav class="container list-inline">

        <?php wp_nav_menu(array('theme_location' => 'footer')); ?>

        <hr>
        <?php
        global $REGIONS;
        foreach ($REGIONS as $region) : ?>

            <a href="/regions/<?= urlencode($region) ?>" title="Offres d'emploi <?= $region ?>"><?= $region ?></a>&nbsp;

        <?php endforeach; ?>

        <hr>
        <?php
        global $CATEGORIES;
        foreach ($CATEGORIES as $category) : ?>

            <a href="/categories/<?= urlencode($category->get('id')) ?>/<?= urlencode($category->get('title')) ?>" title="Offres d'emploi <?= $category->get('title') ?>"><?= $category->get('title') ?></a>&nbsp;

        <?php endforeach; ?>


    </nav>
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>

<script src=" <?= get_stylesheet_directory_uri() . '/js/dtj.js' ?>"></script>

</body>

</html>