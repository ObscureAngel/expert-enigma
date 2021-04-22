<?php

if (!defined('H2P_ROOT')) {
	define('H2P_ROOT', str_replace('\\', '/', __DIR__) . '/');
}

require_once(H2P_ROOT . 'lib/fpdf/fpdf.php');
require_once(H2P_ROOT . 'classes/cla_parserHtml.class.php');

class Html2Pdf extends FPDF {

	/**
	 * @var ParserHTML
	 */
	private $co_htmlParser;
	
	function __construct() {
		
		$this->co_htmlParser = new ParserHTML();
	}

	/**
	 * @author ObscureAngel
	 * @since 22/04/2021
	 * 
	 */
	function fct_loadHtmlContent ($ps_htmlContent) {
		$this->co_htmlParser->fct_setHtmlContent($ps_htmlContent);
	}
}
