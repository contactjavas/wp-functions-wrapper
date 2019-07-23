<?php
/**
 * Autoloading
 *
 * @package WPFW
 */

defined('ABSPATH') || die("Can't access directly");

// require utility classes.
require_once __DIR__ . '/utilities/class-asset.php';
require_once __DIR__ . '/utilities/class-debug.php';
require_once __DIR__ . '/utilities/class-file-util.php';
require_once __DIR__ . '/utilities/class-vars.php';

// require helper classes.
require_once __DIR__ . '/helpers/class-admin-ajax-helper.php';
require_once __DIR__ . '/helpers/class-css-helper.php';
require_once __DIR__ . '/helpers/class-file-helper.php';
require_once __DIR__ . '/helpers/class-image-size-helper.php';
require_once __DIR__ . '/helpers/class-js-helper.php';
require_once __DIR__ . '/helpers/class-metabox-helper.php';
require_once __DIR__ . '/helpers/class-post-type-helper.php';
require_once __DIR__ . '/helpers/class-taxonomy-helper.php';

// require utility classes.
require_once __DIR__ . '/utilities/class-admin-ajax.php';
require_once __DIR__ . '/utilities/class-css.php';
require_once __DIR__ . '/utilities/class-image-size.php';
require_once __DIR__ . '/utilities/class-js.php';
require_once __DIR__ . '/utilities/class-metabox.php';
require_once __DIR__ . '/utilities/class-post-type.php';
require_once __DIR__ . '/utilities/class-taxonomy.php';
