<?php
/**
 * Bundles and sets the data that we use to create the phone burger menu icons
 */

class PhoneBurgerMenuIcon
{
	const LEFT = 'left';
	const RIGHT = 'right';

	public $html = '';
	public $js = '';
	public $fileName = '';      // used for hack needed for phones
	public $useImage = FALSE;

	protected $leftOrRight = '';
	protected $template = '';
	protected $params = null;
	protected $jmwsIdMyGadget = null;

	/**
	 * Constructor: use the parameters set in the joomla back end to set the data members
	 */
	public function __construct( $leftOrRight, $template, $params, $jmwsIdMyGadget )
	{
		$this->leftOrRight = $leftOrRight ;
		$this->template = $template;
		$this->params = $params;
		$this->jmwsIdMyGadget = $jmwsIdMyGadget ;
		$this->setPublicDataMembers();
	}

	protected function setPublicDataMembers()
	{
		$this->fileName = $this->template . '/images/idMyGadget/phoneBurgerMenuIcon' .
			ucfirst($this->leftOrRight) .
			ucfirst($this->jmwsIdMyGadget->getGadgetString()) .
			'.png';
		if ( file_exists(JPATH_THEMES . DS . $this->fileName) )
		{
			$this->useImage = TRUE;
		}
		if ( $this->leftOrRight === self::LEFT &&
		     $this->jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft )
		{
			$this->html = '<a href="#phone-burger-menu-left" data-rel="dialog">';
			if ( $this->useImage )
			{
				$this->html .=
					'<img id="phone-burger-icon-image-left" ' .
						'width="' . $this->params->get('phoneBurgerMenuLeftSize') . '" ' .
						'height="' . $this->params->get('phoneBurgerMenuLeftSize') . '" ' .
						'src="templates/' . $this->fileName . '" />';
			}
			else
			{
				$this->html .=
					'<canvas id="phone-burger-icon-left" ' .
						'width="' . $this->params->get('phoneBurgerMenuLeftSize') . '" ' .
						'height="' . $this->params->get('phoneBurgerMenuLeftSize') . '">' .
						'&nbsp;Menu&nbsp;' . '</canvas>';
			}
			$this->html .= '</a>';
			$this->js =
				'<script>' .
					'var phoneBurgerIconLeftOptions = {};' .
					'phoneBurgerIconLeftOptions.color = "' . $this->params->get('phoneBurgerMenuLeftColor') . '";' .
					'phoneBurgerIconLeftOptions.lineCap = "' . $this->params->get('phoneBurgerMenuLeftLineCap') . '";' .
					'phoneBurgerIconLeftOptions.lineSize = "' . $this->params->get('phoneBurgerMenuLeftLineSize') . '";' .
				'</script>';
		}
		if ( $this->leftOrRight === self::RIGHT &&
		     $this->jmwsIdMyGadget->phoneBurgerIconThisDeviceRight )
		{
			$this->html =
				'<a href="#phone-burger-menu-right" class="pull-right" data-rel="dialog">';
			if ( $this->useImage )
			{
				$this->html .=
					'<img id="phone-burger-icon-image-right"' .
						'width="' . $this->params->get('phoneBurgerMenuRightSize') . '" ' .
						'height="' . $this->params->get('phoneBurgerMenuRightSize') . '" ' .
						' src="templates/' . $this->fileName . '" />';
			}
			else
			{
				$this->html .=
					'<canvas id="phone-burger-icon-right" ' .
						'width="' . $this->params->get('phoneBurgerMenuRightSize') . '" ' .
						'height="' . $this->params->get('phoneBurgerMenuRightSize') . '">' .
						'&nbsp;Menu&nbsp;' . '</canvas>';
			}
			$this->html .= '</a>';
			$this->js =
				'<script>' .
					'var phoneBurgerIconRightOptions = {};' .
					'phoneBurgerIconRightOptions.color = "' . $this->params->get('phoneBurgerMenuRightColor') . '";' .
					'phoneBurgerIconRightOptions.lineCap = "' . $this->params->get('phoneBurgerMenuRightLineCap') . '";' .
					'phoneBurgerIconRightOptions.lineSize = "' . $this->params->get('phoneBurgerMenuRightLineSize') . '";' .
				'</script>';
		}
	}
}
