<?php
/**
 * Plugin Name:     Get Empenhos
 * Plugin URI:      https://agencia.fixonweb.com.br/plugin/fix-get-empenhos
 * Description:     Consultar registros de empenhos via API em portaltransparencia.gov.br
 * Author:          FIXONWEB
 * Author URI:      https://agencia.fixonweb.com.br
 * Text Domain:     fix-get-empenhos
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Fix_Get_Empenhos
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
require 'plugin-update-checker.php';
$fix1607600504_url_update 	= 'https://github.com/fixonweb/fix-get-empenhos';
$fix1607600504_slug 		= 'fix-get-empenhos/fix-get-empenhos';
$fix1607600504_check 		= Puc_v4_Factory::buildUpdateChecker($fix1607600504_url_update,__FILE__,$fix1607600504_slug);
