<?php
/**
 * Plugin Name:     Get Empenhos
 * Plugin URI:      https://agencia.fixonweb.com.br/plugin/fix-get-empenhos
 * Description:     Consultar registros de empenhos via API em portaltransparencia.gov.br
 * Author:          FIXONWEB
 * Author URI:      https://agencia.fixonweb.com.br
 * Text Domain:     fix-get-empenhos
 * Domain Path:     /languages
 * Version:         0.1.2
 *
 * @package         Fix_Get_Empenhos
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
require 'plugin-update-checker.php';
$fix1607600504_url_update 	= 'https://github.com/fixonweb/fix-get-empenhos';
$fix1607600504_slug 		= 'fix-get-empenhos/fix-get-empenhos';
$fix1607600504_check 		= Puc_v4_Factory::buildUpdateChecker($fix1607600504_url_update,__FILE__,$fix1607600504_slug);

add_action( 'parse_request', 'fix1607593459_parse_request');
function fix1607593459_parse_request( &$wp ) {
	if($wp->request == 'fix1607580637_get_empenho'){
		$vai = 0;
		if(current_user_can('administrator')) $vai = 1;
		if(current_user_can('fix-administrativo')) $vai = 1;
		if(!$vai) {	echo '--nao-disponivel--';exit;}

		$favorecido = isset($_REQUEST['favorecido']) ? $_REQUEST['favorecido'] : '';
		if(!$favorecido) {	echo '--favorecido-nao-informado--';exit;}

		$fase = isset($_REQUEST['fase']) ? $_REQUEST['fase'] : '';
		if(!$fase) {	echo '--fase-nao-informado--';exit;}

		$ano = isset($_REQUEST['ano']) ? $_REQUEST['ano'] : '';
		if(!$ano) {	echo '--ano-nao-informado--';exit;}

		$pagina = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : '';
		if(!$pagina) {	echo '--pagina-nao-informado--';exit;}

		fix1607580637_get_empenho($favorecido, $fase, $ano, $pagina);
		exit;
	}
}

function fix1607580637_get_empenho($favorecido,$fase,$ano,$pagina){
	// include "fix1607580637_get_empenho_config.php";
	$chave_api_dados = "THpaWzh4HnFL1KEWEcqyiGLLxg6It9wR";
	$url = "http://www.portaltransparencia.gov.br/api-de-dados/despesas/documentos-por-favorecido?codigoPessoa=".$favorecido."&fase=".$fase."&ano=".$ano."&pagina=".$pagina;
	$headers = array();
	$headers[] = 'Accept: application/json';
	$headers[] = 'chave-api-dados: '.$chave_api_dados;
	$headers[] = 'Content-Type: application/json';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	echo '<pre>';
	print_r ( json_decode( $result ) );
	echo '</pre>';
	return '';
}
