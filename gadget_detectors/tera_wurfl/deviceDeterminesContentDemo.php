<!DOCTYPE html>
<html lang='en'>
<?php
/**
 * Instantiate an IdMyGadget object and use it to display a page with links that allow
 * the user to see information about the device making the request in various forms.
 * These "various forms" include raw WURFL information, key capabilities, and
 * summary device data based on key WURFL device capabilities.
 */
$pageTitle = basename( $_SERVER['PHP_SELF'], '.php' );

require_once 'Tera-Wurfl/wurfl-dbapi/TeraWurfl.php';
require_once '../../php/IdMyGadgetTeraWurfl.php';
require_once '../all_detectors/getGadgetString.php';
require_once '../all_detectors/printStyleSheetLinkTags.php';
require_once '../all_detectors/printFooterForms.php';
require_once '../all_detectors/printSampleContent.php';
//
// debugging: displays verbose information; we don't need to use this very often
// allowOverridesInUrl: Allow testing with overrides as GET variables, TRUE is OK 
//    for example:
//       <a href="http://localhost/resume/?gadgetType=phone&gadgetModel=iPhone&gadgetBrand=Apple">
//
$debugging = FALSE;
$allowOverridesInUrl = TRUE;   // Needed for footer forms to work
$idMyGadget = new IdMyGadgetTeraWurfl( $debugging, $allowOverridesInUrl );

$deviceData = $idMyGadget->getDeviceData();
$gadgetString = getGadgetString( $deviceData );
$gadgetType = $deviceData["gadgetType"];
?>

<head>
	<title><?php print $pageTitle; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php
		$styleSheetFile = printStyleSheetLinkTags( $deviceData );
	?>
</head>

<body>
<div id="container">
<?php
	if ( $gadgetType !== IdMyGadget::GADGET_TYPE_PHONE )
	{
		print '<h1>' . $pageTitle . '</h1>';
	}
?>
<div id='content'>
	<h3><?php print get_class($idMyGadget); ?></h3>
	<h3><?php print $gadgetString; ?></h3>
	<?php
		printSampleContent( $deviceData );
	?>
	<hr />
	<p class="centered">|&nbsp;<a href="index.php">Back</a>&nbsp;|</p>
	<hr />
</div> <!-- #content -->
<footer>
	<?php printFooterForms( $styleSheetFile, $deviceData ); ?>
</footer>
</div> <!-- #container -->
</body>
</html>
