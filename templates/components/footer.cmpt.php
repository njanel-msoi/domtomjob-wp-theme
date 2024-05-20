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
    </nav>
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>

<script src="<?= get_stylesheet_directory_uri() . '/js/dtj.js' ?>"></script>

</body>

</html>