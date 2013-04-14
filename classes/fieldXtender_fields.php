<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package   fieldXtender
 * @author    Pascal Diener <http://www.d-art.ch>
 * @license   GNU
 * @copyright d-ART.ch 2013
 */


/**
 * Namespace
 */
//namespace fieldXtender;


/**
 * Class fieldXtender_fields
 *
 * @copyright  d-ART 2013
 * @author     Pascal Diener <contact@d-art.ch>
 * @package    Devtools
 */
class fieldXtender_fields extends \Backend
{

	/**
	 * Auto-generate the event alias if it has not been set yet
	 * @param mixed
	 * @param \DataContainer
	 * @return mixed
	 * @throws \Exception
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;
	
		// Generate alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = standardize(String::restoreBasicEntities($dc->activeRecord->title));
		}
	
		$objAlias = $this->Database->prepare("SELECT id FROM tl_fieldXtender_fields WHERE alias=?")
		->execute($varValue);
	
		// Check whether the alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}
	
		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}
	
		return $varValue;
	}
	
	
	

	
	
	
	
	/**
	 * Generate the module
	 */
	protected function compile()
	{

	}
}
