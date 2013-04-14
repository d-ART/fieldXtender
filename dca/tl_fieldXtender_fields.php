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
 * Table tl_fieldXtender_fields
 */
$GLOBALS['TL_DCA']['tl_fieldXtender_fields'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'switchToEdit'				  => true,
		'ptable'                      => 'tl_fieldXtender',
		'dynamicPtable'               => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
				'ptable' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('sorting', 'alias'),
			'panelLayout'             => 'filter;search,limit',
			'headerFields'            => array('module'),
			'child_record_callback'   => array('tl_fieldXtender_fields', 'listFields')
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
			
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['show'],
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
		'default'                     => '{title_legend},title,alias,label,inputType,class;{title_options},mandatory,filter;'
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
		'pid' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'ptable' => array
		(
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>50, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['alias'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'alias', 'unique'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array
			(
				array('fieldXtender_fields', 'generateAlias')
			),
			'sql'                     => "varbinary(128) NOT NULL default ''"
		),
		'label' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['label'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'inputType' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['inputType'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'select',
			'options'				  => array(
											'text' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['inputType']['text'],
										/*	'password' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['inputType']['password'],*/
											'textarea' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['inputType']['textarea'],
										/*	'select' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['inputType']['select'],*/
											'checkbox' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['inputType']['checkbox'],
											/*'radio' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['inputType']['radio']*/
										),
			'eval'                    => array('mandatory'=>true, 'maxlength'=>50, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'class' => array
		(
				'label'                   => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['class'],
				'exclude'                 => true,
				'search'                  => true,
				'inputType'               => 'select',
				'options'				  => array(
												'w50' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['class']['w50'],
												'clr' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['class']['clr'],
												'wizard' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['class']['wizard'],
												'long' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['class']['long'],
												'm12' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['class']['m12'],
												'w50 wizard' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['class']['w50wizard'],
												'w50 m12' => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['class']['w50m12'],
						
											),
				'eval'                    => array('helpwizard' => true, 'mandatory'=>true, 'maxlength'=>50, 'tl_class'=>'w50'),
				'explanation'			  => 'class_types',
				'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'mandatory' => array
		(
				'label'                   => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['mandatory'],
				'exclude'                 => true,
				'inputType'               => 'checkbox',
				'eval'                    => array('tl_class'=>'w50 m12'),
				'sql'                     => "char(1) NOT NULL default ''"
		),
		/*'filter' => array
		(
				'label'                   => &$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['filter'],
				'exclude'                 => true,
				'inputType'               => 'checkbox',
				'eval'                    => array('tl_class'=>'w50 m12'),
				'sql'                     => "char(1) NOT NULL default ''"
		)*/
	)
);

/**
 * Class tl_fieldXtender_fields
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Pascal Diener 2013
 * @author     Pascal Diener <http://www.d-art.ch>
 * @package    fieldXtender
 */
class tl_fieldXtender_fields extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
	/**
	 * List the Fields
	 */
	public function listFields($arrRow)
	{

		return '<div><b>Name:</b> '.$arrRow['title'].'<br/><b>Alias:</b> '.$arrRow['alias'].'<br/><br/><b>Typ:</b> '.$GLOBALS['TL_LANG']['tl_fieldXtender_fields']['inputType'][$arrRow['inputType']].'</div>' . "\n";
	
	
	}


}

