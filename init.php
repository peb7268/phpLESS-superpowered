<?php 
$basename = dirname(__FILE__).'/';
$ssdir = $basename.'lib/stylesheets/';
require_once('lessc.inc.php'); 
$less = new lessc;

//While we have filenames open a css file, for each file open a resource, write it to $css, then close it
function init($file_array){
	global $ssdir;
	$pre_compiled_less = $ssdir.'styles.less';
	$css = fopen($pre_compiled_less, 'w');
	
	foreach($file_array as $file){
		$f = fopen($file, 'a+');
		$contents = fread($f, filesize($file));

		fwrite($css, $contents);
		
		fclose($f);
	}
	fclose($css);

	return $pre_compiled_less;
}
function compileLess($less, $input, $out_path){
	$less = $less;
	try{
		$less->compileFile($input, $out_path);
	} catch( exception $e ) {
		echo 'Error: '. $e->getMessage();
	}
	echo '<link rel="stylesheet" href="'.$out_path.'">';
}


$less_files = array($ssdir.'styles1.less', $ssdir.'styles2.less');	//Tell It what to watch
$input = init($less_files);											//Init it
compileLess($less, $input, 'styles.css');							//Compile passing in the less object, $input from init() and the output path you want it to go to