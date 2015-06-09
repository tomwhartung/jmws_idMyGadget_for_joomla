<?php
//
// idMyGadget device detection:
//
define( 'DETECT_MOBILE_BROWSERS', 'detect_mobile_browsers' );
define( 'MOBILE_DETECT',  'mobile_detect' );
define( 'TERA_WURFL', 'tera_wurfl' );

//
$gadgetDetector = DETECT_MOBILE_BROWSERS;
// $gadgetDetector = MOBILE_DETECT;
// $gadgetDetector = TERA_WURFL;

$idMyGadget = null;
$debugging = FALSE;
$allowOverridesInUrl = TRUE;
$cwd = getcwd();
$dir_to_add = $cwd . '/templates/jmws_protostar_idmygadget/jmws_idMyGadget_for_joomla';
set_include_path( get_include_path() . PATH_SEPARATOR . $dir_to_add );

if ( $gadgetDetector === DETECT_MOBILE_BROWSERS )
{
	require_once 'gadget_detectors/detect_mobile_browsers/php/detectmobilebrowser.php';     // sets $usingMobilePhone global variable
	require_once 'php/IdMyGadgetDetectMobileBrowsers.php';
	$idMyGadget = new IdMyGadgetDetectMobileBrowsers( $debugging, $allowOverridesInUrl );
}
else if ( $gadgetDetector === MOBILE_DETECT )
{
	require_once 'gadget_detectors/mobile_detect/Mobile-Detect/Mobile_Detect.php' ;
	require_once 'php/IdMyGadgetMobileDetect.php';
	$idMyGadget = new IdMyGadgetMobileDetect( $debugging, $allowOverridesInUrl );
}
else if ( $gadgetDetector === TERA_WURFL )
{
	require_once 'gadget_detectors/tera_wurfl/Tera-Wurfl/wurfl-dbapi/TeraWurfl.php';
	require_once 'php/IdMyGadgetTeraWurfl.php';
	$idMyGadget = new IdMyGadgetTeraWurfl( $debugging, $allowOverridesInUrl );
}

if ( $idMyGadget !== null )
{
	require_once 'gadget_detectors/all_detectors/getGadgetString.php';
	$deviceData = $idMyGadget->getDeviceData();
	$gadgetString = getGadgetString( $deviceData );
}

