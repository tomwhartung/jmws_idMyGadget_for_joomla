<?php
/**
 * Creates an object of the desired idMyGadget subclass and uses it for device detection.
 * NOTE:
 * *IF* we can keep all the joomla-specific code here,
 * *THEN* we can reuse the rest of the code in this project for WP and Drupal (and...?)
 */
if( !defined('DS') )
{
	define('DS', DIRECTORY_SEPARATOR);
}

class Detector
{
	const DETECT_MOBILE_BROWSERS = 'detect_mobile_browsers';
	const MOBILE_DETECT = 'mobile_detect';
	const TERA_WURFL = 'tera_wurfl';
	/**
	 * The gadget detector that we are using
	 */
	protected $gadgetDetector = self::DETECT_MOBILE_BROWSERS;  // default is to use the small, minimal one
	/**
	 * The idMyGadget object we are using
	 */
	protected $idMyGadget = null;
	/**
	 * The device data we get from the detector
	 */
	protected $deviceData = null;
	/**
	 * A string that represents the gadget being used
	 */
	protected $gadgetString = "";

	/**
	 * Constructor: for best results, specify a different gadgetDetector
	 */
	public function __construct( $gadgetDetector=null, $debugging=FALSE, $allowOverridesInUrl=TRUE )
	{
		if ( $gadgetDetector === null )
		{
			$gadgetDetector = self::DETECT_MOBILE_BROWSERS;  // default is to use the small, minimal one
		}

		$this->gadgetDetector = $gadgetDetector;
		$application = &JFactory::getApplication();
		$templateName = $application->getTemplate();
		$idMyGadgetDir = JPATH_THEMES . DS . $templateName . DS . 'jmws_idMyGadget_for_joomla';
		set_include_path( get_include_path() . PATH_SEPARATOR . $idMyGadgetDir );
		print '<p>Hi from the constructor in Device, where $templateName = ' . $templateName . '</p>';
		print '<p>Hi from the constructor in Device, where JPATH_THEMES = ' . JPATH_THEMES . '</p>';
		print '<p>Hi from the constructor in Device, where $idMyGadgetDir = ' . $idMyGadgetDir . '</p>';

		if ( $gadgetDetector === self::DETECT_MOBILE_BROWSERS )
		{
			require_once 'gadget_detectors/detect_mobile_browsers/php/detectmobilebrowser.php';     // sets $usingMobilePhone global variable
			require_once 'php/IdMyGadgetDetectMobileBrowsers.php';
			$this->idMyGadget = new IdMyGadgetDetectMobileBrowsers( $debugging, $allowOverridesInUrl );
		}
		else if ( $gadgetDetector === self::MOBILE_DETECT )
		{
			require_once 'gadget_detectors/mobile_detect/Mobile-Detect/Mobile_Detect.php' ;
			require_once 'php/IdMyGadgetMobileDetect.php';
			$this->idMyGadget = new IdMyGadgetMobileDetect( $debugging, $allowOverridesInUrl );
		}
		else if ( $gadgetDetector === self::TERA_WURFL )
		{
			require_once 'gadget_detectors/tera_wurfl/Tera-Wurfl/wurfl-dbapi/TeraWurfl.php';
			require_once 'php/IdMyGadgetTeraWurfl.php';
			$this->idMyGadget = new IdMyGadgetTeraWurfl( $debugging, $allowOverridesInUrl );
		}

		if ( $this->idMyGadget !== null )
		{
			require_once 'gadget_detectors/all_detectors/getGadgetString.php';
			$this->idMyGadget->idMyGadgetDir = $idMyGadgetDir;
			$this->deviceData = $this->idMyGadget->getDeviceData();
			$this->gadgetString = getGadgetString( $this->deviceData );
		}
	}

	/**
	 * Returns TRUE if the desired detector (subclass) is installed, else FALSE
	 */
	public function isInstalled()
	{
		return $this->idMyGadget->isInstalled();
	}
	/**
	 * Returns a link to the appropriate README.md file on github
	 */
	public function getLinkToReadme()
	{
		return $this->idMyGadget->getLinkToReadme();
	}
	/**
	 * The idMyGadget object is read-only!
	 */
	public function getGadgetDetector()
	{
		return $this->gadgetDetector;
	}
	/**
	 * The idMyGadget object is read-only!
	 */
	public function getIdMyGadget()
	{
		return $this->idMyGadget;
	}
	/**
	 * The device data is read-only!
	 */
	public function getDeviceData()
	{
		return $this->deviceData;
	}
	/**
	 * The gadget string is read-only!
	 */
	public function getGadgetString()
	{
		return $this->gadgetString;
	}

		}