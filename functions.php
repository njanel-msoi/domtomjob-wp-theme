<?php
// TODO: dynamic version number
$VERSION = "0.1.3";

/**
 * The functions.php file, called by wordpress to initialize php part of our theme
 * This file is responsible to call the data initialization, homemade helper functions and wp related initialization
 */

include_once dirname(__FILE__) . '/functions/utils.php';
include_once dirname(__FILE__) . '/functions/pages-urls.php';
include_once dirname(__FILE__) . '/functions/renderers.php';

include_once dirname(__FILE__) . '/data/data.php';

include_once dirname(__FILE__) . '/functions/enqueue_style_scripts.php';
include_once dirname(__FILE__) . '/functions/wp_theme_init.php';
include_once dirname(__FILE__) . '/functions/routes.php';

include_once dirname(__FILE__) . '/importer/importer.php';
