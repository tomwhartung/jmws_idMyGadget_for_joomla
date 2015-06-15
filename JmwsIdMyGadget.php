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

class JmwsIdMyGadget
{
	/**
	 * The gadget detector that we are using
	 */
	protected $gadgetDetector = null;
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
		$application = &JFactory::getApplication();
		$templateName = $application->getTemplate();
		$idMyGadgetDir = JPATH_THEMES . DS . $templateName . DS . 'jmws_idMyGadget_for_joomla';
		set_include_path( get_include_path() . PATH_SEPARATOR . $idMyGadgetDir );
		require_once 'php/IdMyGadget.php';

		if ( $gadgetDetector === null )
		{
			$gadgetDetector = IdMyGadget::GADGET_DETECTOR_DETECT_MOBILE_BROWSERS;
		}

		$this->gadgetDetector = $gadgetDetector;

		if ( $gadgetDetector === IdMyGadget::GADGET_DETECTOR_DETECT_MOBILE_BROWSERS )
		{
			global $usingMobilePhone;
			include_once 'gadget_detectors/detect_mobile_browsers/php/detectmobilebrowser.php';     // sets $usingMobilePhone global variable
			require_once 'php/IdMyGadgetDetectMobileBrowsers.php';
			$this->idMyGadget = new IdMyGadgetDetectMobileBrowsers( $debugging, $allowOverridesInUrl );
		}
		else if ( $gadgetDetector === IdMyGadget::GADGET_DETECTOR_MOBILE_DETECT )
		{
			include_once 'gadget_detectors/mobile_detect/Mobile-Detect/Mobile_Detect.php' ;
			require_once 'php/IdMyGadgetMobileDetect.php';
			$this->idMyGadget = new IdMyGadgetMobileDetect( $debugging, $allowOverridesInUrl );
		}
		else if ( $gadgetDetector === IdMyGadget::GADGET_DETECTOR_TERA_WURFL )
		{
			include_once 'gadget_detectors/tera_wurfl/Tera-Wurfl/wurfl-dbapi/TeraWurfl.php';
			require_once 'php/IdMyGadgetTeraWurfl.php';
			$this->idMyGadget = new IdMyGadgetTeraWurfl( $debugging, $allowOverridesInUrl );
		}

		if ( $this->idMyGadget !== null )
		{
			require_once 'gadget_detectors/all_detectors/getGadgetString.php';
			$this->idMyGadget->idMyGadgetDir = $idMyGadgetDir;
			if ( $this->idMyGadget->isInstalled() )
			{
				$this->deviceData = $this->idMyGadget->getDeviceData();
				$this->gadgetString = $this->setGadgetString();
			}
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
		return $this->gadgetString;   // set in constructor
	}
	/**
	 * Display the device data
	 * @return string of <li> tags listing the device data
	 */
	public function displayDeviceData()
	{
		return $this->idMyGadget->displayDeviceData();
	}
	/**
	 * Return a short string describing the device, based on the device data passed in
	 * @return string gadgetString
	 */
	protected function setGadgetString()
	{
		$gadgetString = "Unknown Device";
		$gadgetType = $this->deviceData["gadgetType"];
		$gadgetModel = $this->deviceData["gadgetModel"];
		$gadgetBrand = $this->deviceData["gadgetBrand"];

		if ( $gadgetType === IdMyGadget::GADGET_TYPE_DESKTOP )
		{
			$gadgetString = "Desktop";
		}
		else if ( $gadgetType === IdMyGadget::GADGET_TYPE_TABLET )
		{
			$gadgetString = "Tablet";
		}
		else if ( $gadgetType === IdMyGadget::GADGET_TYPE_PHONE )
		{
			if ( $gadgetModel === IdMyGadget::GADGET_MODEL_APPLE_PHONE )
			{
				$gadgetString = "iPhone";
			}
			else if ( $gadgetModel === IdMyGadget::GADGET_MODEL_ANDROID_PHONE )
			{
				$gadgetString = "Android Phone";
			}
			else
			{
				$gadgetString = "Mobile Phone";
			}
		}
		return $gadgetString;
	}
}