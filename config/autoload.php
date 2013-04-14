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
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'fieldXtender',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'fieldXtender' => 'system/modules/fieldXtender/classes/fieldXtender.php',
	'fieldXtender_fields' => 'system/modules/fieldXtender/classes/fieldXtender_fields.php',
	

));


/**
 * Register the templates
 */
/*TemplateLoader::addFiles(array
(
	'saveFileTemplate' => 'system/modules/fieldXtender/templates',
));*/
