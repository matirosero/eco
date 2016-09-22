<?php
/**
 * Kickoff theme setup and build
 */

namespace Eco;

define( 'ECO_VERSION', '1.0.0' );
define( 'ECO_DIR', __DIR__ );
define( 'ECO_URL', get_template_directory_uri() );

require_once __DIR__ . '/vendor/autoload.php';

\AaronHolbrook\Autoload\autoload( __DIR__ . '/includes' );