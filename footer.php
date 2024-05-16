<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package wpjobboard_theme
 * @since wpjobboard_theme 1.0
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
    </nav>
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>
</body>

</html>