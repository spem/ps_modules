<?php 
require("feed_config/config_functions.php");

if(isset($_GET["fieldID"])){
	echo "<h2>" . $GLOBALS["merchant"] . " Feed Settings</h2>";
	displayFieldConfig();
} else {
	echo "
	<h1>" . $GLOBALS['merchant'] . " Merchant Control Panel</h1>
	<img src=\"images/" . $GLOBALS['merchantID'] . "_logo.png\" alt=\"" . $GLOBALS['merchant'] . " Product Feed\" class=\"merchLogo\">
	";

	echo messageReporting();

	$file = "submissions/AHS_" . $GLOBALS["merchantID"] . "_product_submission.txt"; 

	if(file_exists($file)){
		$fileCreation = date('l m/d/Y H:i:s', filemtime($file));
		$fileSize = round(((filesize($file)/1024)/1024),2,PHP_ROUND_HALF_UP); 
		
		echo "
	<div class=\"clear\" style=\"height: 30px !important;\"></div>
	<a href=\"functions/merchant_create.php?f=" . $GLOBALS["merch"] . "\" class=\"button\" title=\"Create New File\">Create New " . $GLOBALS["merchant"] . " Merchant File</a> <a class=\"button\" href=\"functions/merchant_create.php?f=" . $GLOBALS["merch"] . "&del=true\" title=\"\">Purge Current File</a> <a href=\"submissions/AHS_" . $GLOBALS["merchantID"] . "_product_submission.txt\" class=\"button\" target=\"_blank\" title=\"Download Merchant File - CURRENT SIZE: " . $fileSize . " MB\">Download " . $GLOBALS["merchant"] ." Merchant File</a><br/>
	<div class=\"notes\">
	  <h2>File Information</h2>
	  <p class=\"cdate\">File Last Created: <span>" . $fileCreation . "</span></p>
	  <p class=\"cdate\">File Size: <span style=\"color: red;\">" . $fileSize . " MB</span></p>
	</div>
	";
	} else { 
		echo "
	<p style=\"font-weight:bold; color: red; font-size:18px;\">We were unable to locate your file, please start by creating a new file below</p>
	<div class=\"clear\" style=\"height: 30px !important;\"></div>
	<a href=\"functions/merchant_create.php?f=" . $_GET["f"] . "\" class=\"button\" title=\"Create New File\">Create New " . $GLOBALS["merchant"] . " Merchant File</a>
	"; 
	}
	//Feed configuration
	echo displayAllFields() ;

	//Call merchant specific information
	if(isset($GLOBALS["merch"])){
		require ("merchants/" . $GLOBALS["merchantID"] . "/" . $GLOBALS["merchantID"] . ".php");
	}
}
?>