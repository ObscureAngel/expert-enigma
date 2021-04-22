<?php

require_once('./cla_html2pdf.class.php');

$html = file_get_contents('exemple.html');

$obj = new ParserHTML($html);

$a = $obj->fct_getParsedHtml();

var_dump($a);