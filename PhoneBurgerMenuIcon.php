<?php
/**
 * Bundles the data that we use to create the phone burger menu icons
 */

class PhoneBurgerMenuIcon
{
	public html = '';
	public js = '';
	public fileName = '';      // used for hack needed for phones
	public useImage = FALSE;

	/**
	 * Constructor: use the parameters set in the joomla back end to set the data members
	 */
	public function __construct( $leftOrRight, $params, $$jmwsIdMyGadget )
	{
		$application = JFactory::getApplication();
		$templateName = $application->getTemplate();
		$this->idMyGadgetDir = JPATH_THEMES . DS . $templateName . DS . 'jmws_idMyGadget_for_joomla';
		set_include_path( get_include_path() . PATH_SEPARATOR . $this->idMyGadgetDir );

		parent::__construct( $gadgetDetector, $debugging, $allowOverridesInUrl );
	}

	protected function copiedCodeGiveMeAName()
	{
		if ( $jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft )
		{
			if ( $jmwsIdMyGadget->getGadgetString() === $jmwsIdMyGadget::GADGET_STRING_PHONE )
			{
				$phoneBurgerIconLeft->fileName = $this->template . '/images/idMyGadget/phoneBurgerMenuIconLeft.png';
				if ( file_exists(JPATH_THEMES . DS . $phoneBurgerIconLeft->fileName) )
				{
					$phoneBurgerIconLeft->useImage = TRUE;
				}
			}
			$phoneBurgerIconLeft->html = '<a href="#phone-burger-menu-left" data-rel="dialog">';
			if ( $phoneBurgerIconLeft->useImage )
			{
				$phoneBurgerIconLeft->html .=
					'<img id="phone-burger-icon-image-left" ' .
						'width="' . $this->params->get('phoneBurgerMenuLeftSize') . '" ' .
						'height="' . $this->params->get('phoneBurgerMenuLeftSize') . '" ' .
						'src="templates/' . $phoneBurgerIconLeft->fileName . '" />';
			}
			else
			{
				$phoneBurgerIconLeft->html .=
					'<canvas id="phone-burger-icon-left" ' .
						'width="' . $this->params->get('phoneBurgerMenuLeftSize') . '" ' .
						'height="' . $this->params->get('phoneBurgerMenuLeftSize') . '">' .
						'&nbsp;Menu&nbsp;' . '</canvas>';
			}
			$phoneBurgerIconLeft->html .= '</a>';
			$phoneBurgerIconLeft->js =
				'<script>' .
					'var phoneBurgerIconLeftOptions = {};' .
					'phoneBurgerIconLeftOptions.color = "' . $this->params->get('phoneBurgerMenuLeftColor') . '";' .
					'phoneBurgerIconLeftOptions.lineCap = "' . $this->params->get('phoneBurgerMenuLeftLineCap') . '";' .
					'phoneBurgerIconLeftOptions.lineSize = "' . $this->params->get('phoneBurgerMenuLeftLineSize') . '";' .
				'</script>';
		}
	}
}
}
