<?php
	include 'interface.php';
	startModel();
	if($_POST){
		$arr = $_POST;
		$arrSize = count($arr);

		$params = array();

		for( $i = 0; $i < $arrSize; $i++){
				array_push($params,$arr[$i]);
		}

		$output = prediction($params);
		#print($output);
		ini_set('error_reporting',E_ALL);
	}
?>
