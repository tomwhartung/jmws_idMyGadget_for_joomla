<?php
/**
 * Prints forms in footer of demo pages
 * @param type $styleSheetFile
 * @param type $deviceData
 */
function printFooterForms( $styleSheetFile, $deviceData )
{
	$rmAllDevicesCss = filter_input( INPUT_GET, 'rmAllDevicesCss', FILTER_SANITIZE_NUMBER_INT );
	$rmAllDevicesCssChecked = $rmAllDevicesCss ? 'checked' : '';

	$rmStyleSheetCss = filter_input( INPUT_GET, 'rmStyleSheetCss', FILTER_SANITIZE_NUMBER_INT );
	$rmStyleSheetCssChecked = $rmStyleSheetCss ? 'checked' : '';

	$gadgetType = filter_input( INPUT_GET, 'gadgetType', FILTER_SANITIZE_STRING );
	if ( isset($gadgetType) &&
			$gadgetType !== IdMyGadget::GADGET_TYPE_UNKNOWN )
	{
		$gadgetTypeDetectChecked = '';
		$gadgetTypeDesktopChecked =
			$gadgetType === IdMyGadget::GADGET_TYPE_DESKTOP ? 'checked' : '';
		$gadgetTypeTabletChecked =
			$gadgetType === IdMyGadget::GADGET_TYPE_TABLET ? 'checked' : '';
		$gadgetTypePhoneChecked =
			$gadgetType === IdMyGadget::GADGET_TYPE_PHONE ? 'checked' : '';
		$gadgetTypeUnrecognizedChecked =
			$gadgetType === IdMyGadget::GADGET_TYPE_UNRECOGNIZED ? 'checked' : '';
	}
	else // gadgetType NOT set in request
	{
		$gadgetType = $deviceData['gadgetType'];
		$gadgetTypeDetectChecked = 'checked';
		$gadgetTypeDesktopChecked = '';
		$gadgetTypeTabletChecked = '';
		$gadgetTypePhoneChecked = '';
		$gadgetTypeUnrecognizedChecked = '';
	}

 ?>
	<hr />
	<div class="footerForms">
	<form action="" method="GET">
		<div class="rmCssForm">
			<fieldset>
				<label for="rmAllDevicesCss">
					<input type="checkbox" id="rmAllDevicesCss" name="rmAllDevicesCss" value="1"
						<?php print $rmAllDevicesCssChecked ?> />
					Remove allDevices.css
				</label>
				<label for="rmStyleSheetCss">
					<input type="checkbox" id="rmStyleSheetCss" name="rmStyleSheetCss" value="1"
						<?php print $rmStyleSheetCssChecked ?> />
					Remove <?php print basename($styleSheetFile) ?>
				</label>
				<div class="centered">
					<input type="submit" value="Remove Css" />
				</div> <!-- .centered -->
			</fieldset>
		</div> <!-- .rmCssForm -->
		<div class="gadgetTypeForm">
			<fieldset>
				<label for="gadgetTypeDesktop" class="left">
					<input type="radio" id="gadgetTypeDesktop" name="gadgetType"
						value="<?php print IdMyGadget::GADGET_TYPE_DESKTOP; ?>"
						<?php print $gadgetTypeDesktopChecked ?> />
					Emulate Desktop
				</label>
				<label for="gadgetTypeDetect" class="right">
					<input type="radio" id="gadgetTypeDetect" name="gadgetType"
						value="<?php echo IdMyGadget::GADGET_TYPE_UNKNOWN; ?>"
						<?php print $gadgetTypeDetectChecked; ?> />
					Detect Device
				</label>
				<label for="gadgetTypePhone" class="left">
					<input type="radio" id="gadgetTypePhone" name="gadgetType"
						value="<?php echo IdMyGadget::GADGET_TYPE_PHONE; ?>"
						<?php print $gadgetTypePhoneChecked; ?> />
					Emulate Phone
				</label>
				<label for="gadgetTypeUnrecognized" class="right">
					<input type="radio" id="gadgetTypeUnrecognized" name="gadgetType"
						value="<?php echo IdMyGadget::GADGET_TYPE_UNRECOGNIZED; ?>"
						<?php print $gadgetTypeUnrecognizedChecked; ?> />
					Emulate Unrecognized Device
				</label>
				<label for="gadgetTypeTablet" class="left">
					<input type="radio" id="gadgetTypeTablet" name="gadgetType"
						value="<?php print IdMyGadget::GADGET_TYPE_TABLET; ?>"
						<?php print $gadgetTypeTabletChecked; ?> />
					Emulate Tablet
				</label>
				<div class="centered">
					<input type="submit" value="Force Gadget Type" />
				</div> <!-- .centered -->
			</fieldset>
		</div> <!-- .gadgetTypeForm -->
	</form>
	</div><!-- .footerForms -->
	<div class="footerLink">
		<p class="centered">|&nbsp;<a href="index.php">Back</a>&nbsp;|</p>
	</div> <!-- .footerLink -->
	<hr />
<?php
}
