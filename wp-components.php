<?php
/**
 * Plugin Name:     WP Components
 * Plugin URI:      alley.co
 * Description:     Build WordPress themes using Components.
 * Author:          jameswalterburke
 * Text Domain:     wp-components
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         WP_Component
 */

namespace WP_Component;

define( 'WP_COMPONENTS_PATH', dirname( __FILE__ ) );

// Load classes.
require_once 'inc/classes/class-component.php';

// Load traits.
require_once 'inc/traits/trait-author.php';
require_once 'inc/traits/trait-guest-author.php';
require_once 'inc/traits/trait-menu.php';
require_once 'inc/traits/trait-wp-post.php';
require_once 'inc/traits/trait-wp-query.php';
require_once 'inc/traits/trait-wp-term.php';
require_once 'inc/traits/trait-wp-user.php';

// Load Components.
require_once 'components/body/class-body.php';
require_once 'components/byline/class-byline.php';
require_once 'components/head/class-head.php';
require_once 'components/image/class-image.php';

// Load PHP renderer
require_once 'wp-components-php/wp-components-php.php';
