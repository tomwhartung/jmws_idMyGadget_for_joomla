<!DOCTYPE html>
<html lang='en'>
<?php
$pageTitle = basename( $_SERVER['PHP_SELF'], '.php' );

require_once 'php/detectmobilebrowser.php';
require_once '../../php/IdMyGadgetDetectMobileBrowsers.php';
require_once '../all_detectors/getGadgetString.php';
require_once '../all_detectors/printStyleSheetLinkTags.php';
require_once '../all_detectors/printSampleContent.php';
require_once '../all_detectors/printFooterForms.php';

$debugging = FALSE;
$allowOverridesInUrl = TRUE;   // Needed for footer forms to work
$idMyGadget = new IdMyGadgetDetectMobileBrowsers( $debugging, $allowOverridesInUrl );
$deviceData = $idMyGadget->getDeviceData();
$gadgetString = getGadgetString( $deviceData );
$styleSheetFile = getStyleSheetFile( $deviceData );
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
	if ( $deviceData["gadgetType"] !== IdMyGadget::GADGET_TYPE_PHONE )
	{
		print '<h1>' . $pageTitle . '</h1>';
	}
?>
<div id="content">
	<h3><?php print get_class($idMyGadget); ?></h3>
	<h3><?php print $gadgetString; ?></h3>
	<?php
		printSampleContent( $deviceData );
	?>
</div> <!-- #content -->
<footer>
	<?php printFooterForms( $styleSheetFile, $deviceData ); ?>
</footer>
</div> <!-- #container -->
</body>
</html>
