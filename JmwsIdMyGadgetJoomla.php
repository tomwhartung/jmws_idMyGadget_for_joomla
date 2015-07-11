<?php
/**
 * Creates an object of the desired idMyGadget subclass and uses it for device detection.
 * NOTE:
 * *IF* we can keep all the joomla-specific code here,
 * *THEN* we can reuse the rest of the code in this project for WP and Drupal (and...?)
 */
require_once 'JmwsIdMyGadget.php';

class JmwsIdMyGadgetJoomla extends JmwsIdMyGadget
{
	/**
	 * Boolean: determines whether we want the hamburger menu in the upper left corner
	 * of this page for this device.
	 * Set by the template, based on options set in the back end.
	 * Kept here so that modules can access it without us polluting the global namespace.
	 */
	public $phoneBurgerIconThisDeviceLeft = FALSE;
	/**
	 * Boolean: analogous to phoneBurgerIconThisDeviceLeft, but for the right side.
	 */
	public $phoneBurgerIconThisDeviceRight = FALSE;

	/**
	 * Constructor: for best results, install and use a gadgetDetector other than the default
	 */
	public function __construct( $gadgetDetector=null, $debugging=FALSE, $allowOverridesInUrl=TRUE )
	{
		print 'Hi there cutie!';
		$application = JFactory::getApplication();
		$templateName = $application->getTemplate();
		$idMyGadgetDir = JPATH_THEMES . DS . $templateName . DS . 'jmws_idMyGadget_for_joomla';
		set_include_path( get_include_path() . PATH_SEPARATOR . $idMyGadgetDir );
		require_once 'php/IdMyGadget.php';

		if ( $gadgetDetector === null )
		{
			$gadgetDetector = IdMyGadget::GADGET_DETECTOR_DETECT_MOBILE_BROWSERS;
		}

		parent::__construct( $gadgetDetector, $debugging, $allowOverridesInUrl );
	}
}
