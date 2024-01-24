<?php
/**
 * Real Estate Management
 *
 * @package       REM
 * @author        SmartyLab
 *
 * @wordpress-plugin
 * Plugin Name:       Real Estate Management
 * Plugin URI:        https://www.smartymedia.biz
 * Description:       Real Estate Management.
 * Version:           1.0.0
 * Author:            SmartyLab Web Developer
 * Requires PHP:      7.0
 * Requires at least: 5.8
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define('REM_PLUGIN_DIR', __DIR__);
define('REM_CLASSES_DIR', REM_PLUGIN_DIR . '/classes');
define('REM_TEMLATES_DIR', REM_PLUGIN_DIR . '/templates');
define('REM_ASSETS_URL', plugin_dir_url( __FILE__ ) . 'assets');

require_once REM_PLUGIN_DIR . '/classes/class-rem.php';
require_once REM_PLUGIN_DIR . '/classes/class-rem-widget.php';
require_once REM_PLUGIN_DIR . '/classes/class-rem-filter.php';

$rem = new REM();