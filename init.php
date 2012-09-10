<?php 
$basename = dirname(__FILE__).'/';
$ssdir = $basename.'lib/stylesheets/';
require_once('lessc.inc.php'); 
$less = new lessc;

//While we have filenames open a css file, for each file open a resource, write it to $css, then close it
function init($file_array){
	global $ssdir;
	$pre_compiled_less = $ssdir.'styles.less';
	$css = fopen($pre_compiled_less, 'a');
	$counter = 0;

	foreach($file_array as $file){
		$f = fopen($file, 'a+');
		echo 'opening file <br>';

		while($contents = fread($f, filesize($file))){
			
			fwrite($css, 'pass # '.$counter.$contents);
		}
		$counter++;
		fclose($f);
	}
	fclose($css);

	return $pre_compiled_less;
}
$less_files = array($ssdir.'styles1.less', $ssdir.'styles2.less');
$input = init($less_files);


function compileLess($less, $input, $out_path){
	$less = $less;
	try{
		$less->checkedCompile($input, $out_path);
	} catch( exception $e ) {
		echo 'Error: '. $e->getMessage();
	}
	echo '<link rel="stylesheet" href="'.$out_path.'">';
}
compileLess($less, $input, 'styles.css');