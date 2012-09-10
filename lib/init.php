<?php require_once('lessc.inc.php'); 
/*
* Goal: Build dynamic less driven php scripts on the fly
* - All the magic happens in this file. Init will instantiate a less object
* - pass it multiple scripts to process
* - accept variables via php
* - strip and format them to match less syntax
* - output one processed less file to the browser
*
*/
$less = new lessc;

echo '<p>init</p>';

function init(){
	try{
		$less->compileFile("http://localhost/dynamicCSS/styles.less", 'http://localhost/dynamicCSS/lib/stylesheets/styles.css');
	} catch( exception $e ) {
		echo 'Error: '. $e->getMessage();
	}

	return '<link rel="stylesheet" href="styles/styles.css">';
}

init();