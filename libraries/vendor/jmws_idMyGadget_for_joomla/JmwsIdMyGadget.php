<?php
/**
 * Creates an object of the desired idMyGadget subclass and uses it for device detection.
 */
if( !defined('DS') )
{
	define('DS', DIRECTORY_SEPARATOR);
}
require_once 'php/IdMyGadget.php';

class JmwsIdMyGadget
{
	/**
	 * Valid values for the gadget string.  Use invalid values at your own risk!
	 */
	const GADGET_STRING_DETECTOR_NOT_INSTALLED = IdMyGadget::GADGET_STRING_DETECTOR_NOT_INSTALLED;
	const GADGET_STRING_UNKNOWN_DEVICE = IdMyGadget::GADGET_STRING_UNKNOWN_DEVICE;
	const GADGET_STRING_DESKTOP = IdMyGadget::GADGET_STRING_DESKTOP;
	const GADGET_STRING_TABLET = IdMyGadget::GADGET_STRING_TABLET;
	const GADGET_STRING_PHONE = IdMyGadget::GADGET_STRING_PHONE;

	/**
	 * URLs of the device-specific jquery files we are using
	 */
//	const JQUERY_DESKTOP_JS_URL = 'http://code.jquery.com/jquery-1.11.3.min.js';
	const JQUERY_MOBILE_CSS_URL = 'http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css';
	const JQUERY_MOBILE_JS_URL = 'http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js';

	/**
	 * The directory containing the idMyGadget code
	 * Used to determine whether the selected gadget detector code is installed.
	 */
	protected $idMyGadgetDir = ''; // set by subclass in its constructor
	/**
	 * The gadget detector we are using
	 */
	protected $gadgetDetectorString = null;
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
	protected $gadgetString = '';

	/**
	 * Constructor: for best results, specify a different gadgetDetector
	 */
	public function __construct( $gadgetDetectorString=null, $debugging=FALSE, $allowOverridesInUrl=TRUE )
	{
		require_once 'gadget_detectors/all_detectors/getIdMyGadgetStringAllDevices.php';

		if ( $gadgetDetectorString === null )
		{
			$gadgetDetectorString = IdMyGadget::GADGET_DETECTOR_DETECT_MOBILE_BROWSERS;
		}

		$this->gadgetDetectorString = $gadgetDetectorString;

		if ( $gadgetDetectorString === IdMyGadget::GADGET_DETECTOR_DETECT_MOBILE_BROWSERS )
		{
			global $usingMobilePhone;
			include_once 'gadget_detectors/detect_mobile_browsers/php/detectmobilebrowser.php';     // sets $usingMobilePhone global variable
			include_once 'php/IdMyGadgetDetectMobileBrowsers.php';
			$this->idMyGadget = new IdMyGadgetDetectMobileBrowsers( $debugging, $allowOverridesInUrl );
		}
		else if ( $gadgetDetectorString === IdMyGadget::GADGET_DETECTOR_MOBILE_DETECT )
		{
			include_once 'gadget_detectors/mobile_detect/Mobile-Detect/Mobile_Detect.php' ;
			include_once 'php/IdMyGadgetMobileDetect.php';
			$this->idMyGadget = new IdMyGadgetMobileDetect( $debugging, $allowOverridesInUrl );
		}
		else if ( $gadgetDetectorString === IdMyGadget::GADGET_DETECTOR_TERA_WURFL )
		{
			include_once 'gadget_detectors/tera_wurfl/Tera-Wurfl/wurfl-dbapi/TeraWurfl.php';
			include_once 'php/IdMyGadgetTeraWurfl.php';
			$this->idMyGadget = new IdMyGadgetTeraWurfl( $debugging, $allowOverridesInUrl );
		}

		if ( $this->idMyGadget !== null )
		{
			$this->idMyGadget->idMyGadgetDir = $this->idMyGadgetDir;
			if ( $this->idMyGadget->isInstalled() )
			{
				$this->deviceData = $this->idMyGadget->getDeviceData();
				$this->gadgetString = getIdMyGadgetStringAllDevices( $this->deviceData );
			}
			else
			{
				$this->gadgetString = self::GADGET_STRING_DETECTOR_NOT_INSTALLED;
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
	 * Returns TRUE if the device is a phone, else FALSE
	 */
	public function isPhone()
	{
		$isPhone = FALSE;
		if ( $this->getGadgetString() === $this::GADGET_STRING_PHONE )
		{
			$isPhone = TRUE;
		}
		return $isPhone;
	}
	/**
	 * Returns TRUE if the device is a phone, else FALSE
	 */
	public function isTablet()
	{
		$isTablet = FALSE;
		if ( $this->getGadgetString() === $this::GADGET_STRING_TABLET )
		{
			$isTablet = TRUE;
		}
		return $isTablet;
	}
	/**
	 * Returns TRUE if the device is a phone, else FALSE
	 */
	public function isDesktop()
	{
		$isDesktop = FALSE;
		if ( $this->getGadgetString() === $this::GADGET_STRING_DESKTOP )
		{
			$isDesktop = TRUE;
		}
		return $isDesktop;
	}

	/**
	 * Returns a link to the appropriate README.md file on github
	 */
	public function getLinkToReadme()
	{
		return $this->idMyGadget->getLinkToReadme();
	}
	/**
	 * The gadgetDetector String is read-only!
	 */
	public function getGadgetDetectorString()
	{
		return $this->gadgetDetectorString;
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
}
