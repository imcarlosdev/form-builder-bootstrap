<?php
//Docs for simple_html_dom.php: http://simplehtmldom.sourceforge.net/manual.htm
include '../classes/simple_html_dom.php'; //DOM operations
include '../classes/dindent/src/Indenter.php'; //Beautify
$indenter = new \Gajus\Dindent\Indenter();

//Note: Save this string to continue editing the form
//$dom_development = stripslashes($_POST['html']);

//Begin cleaning
$dom_production = new simple_html_dom();
$dom_production->load( stripslashes($_POST['html']) );

//Clean the HTML from floating tools
foreach($dom_production->find('*[class*="floating-options"]') as $e){
	$e->outertext = '';
}

//Remove data-type tags (only useful for development mode)
$dom_production = preg_replace("/data-type=\"[^\"]*\"/", "", $dom_production);
//Remove all id tags
$dom_production = preg_replace("/id=\"[^\"]*\"/", "", $dom_production);
//Remove al inline styles tags (drag and drop tool generates some inline css styles)
$dom_production = preg_replace("/style=\"[^\"]*\"/", "", $dom_production);

//Clean individual classes
$a = array(
	"ui-droppable",
	"ui-sortable",
	"xform  ",
	" >"
	);
$b = array(
	"",
	"",
	"xform",
	">"
	);


//Show clean html
echo str_replace($a, $b, $indenter->indent($dom_production) );