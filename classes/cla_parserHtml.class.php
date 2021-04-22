<?php

if (!defined('H2P_ROOT')) {

}

class ParserHTML {
	
	private $cs_html;

	private $ca_explodedHtml;

	private $ca_acceptedTag = array('title','style','table','tr','td','div','img','p','span','br','strong','small','h1','h2','h3','h4','h5','h6','h7','h8','b','u','i','a');

	function __construct($ps_htmlContent = null) {
		$this->cs_html = $ps_htmlContent;
	}

	/**
	 * @author ObscureAngel
	 * @since 22/04/2021
	 * 
	 */
	private function _parseHtml () {
		$this->cs_html = str_replace("\n",' ',$this->cs_html);
		$this->cs_html = str_replace("	",' ',$this->cs_html);
		$this->cs_html = html_entity_decode($this->cs_html);
		$this->cs_html = str_replace('&#039;', "'", $this->cs_html);

		$this->ca_explodedHtml = preg_split('/(<.*>)/U', $this->cs_html, NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

		foreach ($this->ca_explodedHtml as $fi_index => $fs_htmlElement) { 
			if (!preg_match('/\S/', $fs_htmlElement)) {
				unset($this->ca_explodedHtml[$fi_index]);
			}
			else {
				$this->ca_explodedHtml[$fi_index] = trim($this->ca_explodedHtml[$fi_index]);
			}

			if (preg_match('/(<.*[ >])/U', $fs_htmlElement)) {
				$a2 = preg_split('/(<.*[ >])/U', $fs_htmlElement, NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				$test = str_replace('<', '', $a2[0]);
				$test = str_replace('>', '', $test);
				$test = str_replace('/', '', $test);
				$test = trim($test);
				if (!in_array(strtolower($test), $this->ca_acceptedTag)) {
					unset($this->ca_explodedHtml[$fi_index]);
				}
			}
		}
	}

	/**
	 * @author ObscureAngel
	 * @since 22/04/2021
	 * 
	 */
	function fct_setHtmlContent ($ps_htmlContent) {
		$this->cs_html = $ps_htmlContent;
	}

	/**
	 * @author ObscureAngel
	 * @since 22/04/2021
	 * 
	 * @return array A parsed HTML array
	 * 
	 */
	function fct_getParsedHtml () {
		$this->_parseHtml();

		return $this->ca_explodedHtml;
	}
}
