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
 * Table tl_fieldXtender
 */
$GLOBALS['TL_DCA']['tl_fieldXtender'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => false,
		'ctable'                      => array('tl_fieldXtender_fields'),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('module'),
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('module'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'sync' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['sync'],
				'href'                => 'key=sync',
				'class'               => 'header_sync',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fieldXtender']['edit'],
				'href'                => 'table=tl_fieldXtender_fields',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fieldXtender']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fieldXtender']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => 'module;'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),

		'module' => array
		(
				'label'                 => &$GLOBALS['TL_LANG']['tl_fieldXtender']['module'],
				'exclude'               => true,
				'search'                => true,
				'inputType'             => 'select',
				'options'				  => array(
						'tl_calendar' => &$GLOBALS['TL_LANG']['tl_fieldXtender']['module']['tl_calendar'],
						'tl_calendar_events' => &$GLOBALS['TL_LANG']['tl_fieldXtender']['module']['tl_calendar_events']
						
				),
				'eval'                    => array('unique'=>true, 'mandatory'=>true, 'maxlength'=>50, 'tl_class'=>'w50'),
				'sql'                     => "varchar(50) NOT NULL default ''"
		),
	)
);

/**
 * Class tl_fieldXtender
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Pascal Diener 2012
 * @author     Pascal Diener <http://www.d-art.ch>
 * @package    fieldXtender
 */
class tl_fieldXtender extends Backend
{
	

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

}
