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
 * Class fieldXtender
 *
 * @copyright  d-ART 2013
 * @author     Pascal Diener <contact@d-art.ch>
 * @package    Devtools
 */
class fieldXtender extends \Backend
{


	/**
	 * Generate the Field with the fields
	 */
	public function generateField()
	{
		$updated_files = '';
		$file_path_dca = 'system/modules/fieldXtender/dca/';
		$file_path_lang_en = 'system/modules/fieldXtender/languages/en/';
		$file_path_lang_de = 'system/modules/fieldXtender/languages/de/';
		
		$replaceSpace = array(
			'tl_calendar' 			=> 'allowComments',
			'tl_calendar_events'	=> '{source_legend:hide},source',
			/*'tl_calendar_events'	=> 'endDate'*/
	
		);

		$resultModules = $this->Database->prepare("SELECT * FROM tl_fieldXtender")->execute();
		//var_dump($resultModules);
		if($resultModules->numRows){
			
			while($resultModules->next()) {
				
				$palettes_add = ';{fieldXtender},';
				$fieldArray = '';
				$fieldAdd = '';
				$field_lang = '';
				/*$field_lang = '
$GLOBALS[\'TL_LANG\'][\''.$resultModules->module.'\'][\'fieldXtender\'] = \'fieldXtender\';
';*/
				
				$result = $this->Database->prepare("SELECT * FROM tl_fieldXtender_fields WHERE pid =".$resultModules->id." ")->execute();
				
				// Check whether the alias exists
				if ($result->numRows)
				{
				
				
					// Zugriff auf Datenbankinhalte
					while($result->next()) {
						$palettes_add .= 'fXt_'.$result->alias.',';
						
						if($result->mandatory)
							$mandatory = '\'mandatory\' => true, ';
						if($result->class)
							$class = '\'tl_class\'=>\''.$result->class.'\'';
						
						
						switch($result->inputType){
							case 'text':
						
								$typAdd = '
	\'inputType\'         => \''.$result->inputType.'\',
	\'eval\'              => array('.$mandatory.'\'maxlength\'=>255, '.$class.'),
	\'sql\'               => "varchar(255) NOT NULL default \'\'"
						';
						
								break;
	/*						case 'password':
	 $typAdd = '
	\'inputType\'         => \''.$result->inputType.'\',
	\'eval\'              => array('.$mandatory.'\'maxlength\'=>255, '.$class.'),
	\'sql\'               => "varchar(255) NOT NULL default \'\'"
	';
						
								break;*/
							case 'textarea':
								$typAdd = '
	\'inputType\'         => \''.$result->inputType.'\',
	\'eval\'              => array(\'rte\'=>\'tinyMCE\', '.$mandatory.$class.'),
	\'sql\'               => "text NULL"
						';
						
								break;
		/*					case 'select':
	$typAdd = '
	\'inputType\'         => \''.$result->inputType.'\',
	\'eval\'              => array('.$mandatory.'\'maxlength\'=>255, '.$class.'),
	\'sql\'               => "varchar(255) NOT NULL default \'\'"
	';
									
								break;*/
							case 'checkbox':
								$typAdd = '
	\'inputType\'         => \''.$result->inputType.'\',
	\'eval\'              => array('.$mandatory.$class.'),
	\'sql\'               => "char(1) NOT NULL default \'\'"
						';
						
								break;
		/*					case 'radio':
	$typAdd = '
	\'inputType\'         => \''.$result->inputType.'\',
	\'eval\'              => array('.$mandatory.'\'maxlength\'=>255, '.$class.'),
	\'sql\'               => "varchar(255) NOT NULL default \'\'"
	';
						
								break;*/
	
						}
						
						
						$fieldAdd .= '
$GLOBALS[\'TL_DCA\'][\''.$resultModules->module.'\'][\'fields\'][\'fXt_'.$result->alias.'\'] = array(
	\'label\'             => &$GLOBALS[\'TL_LANG\'][\''.$resultModules->module.'\'][\'fXt_'.$result->alias.'\'],
	\'exclude\'           => true,
	\'search\'            => true,'.$typAdd.'
);';
						
						
						$field_lang .= '
$GLOBALS[\'TL_LANG\'][\''.$resultModules->module.'\'][\'fXt_'.$result->alias.'\'] = array(\''.$result->title.'\', \''.$result->label.'\');';

					}
					
					// DCA connect Contents
					$file_content_dca = '<?php';
					
					$palettes_string = '
$GLOBALS[\'TL_DCA\'][\''.$resultModules->module.'\'][\'palettes\'][\'default\'] = str_replace(\''.$replaceSpace[$resultModules->module].'\',\''.$replaceSpace[$resultModules->module].substr($palettes_add, 0, -1).'\', $GLOBALS[\'TL_DCA\'][\''.$resultModules->module.'\'][\'palettes\'][\'default\']);
					
';
					$file_content_dca .= $palettes_string;
					$file_content_dca .= $fieldAdd;
					
					// Write file DCA
					if(class_exists('File::putContent')){
						File::putContent($file_path_dca.$resultModules->module.'.php', $file_content_dca);
					}else{
						$file_path_dca1 = $_SERVER['DOCUMENT_ROOT'].'/'.$file_path_dca.$resultModules->module.'.php';

						$f = fopen($file_path_dca1,'w');
						fwrite($f,$file_content_dca,strlen($file_content_dca));
						fclose($f);
					}
					
					// Languages connect Contents
					$file_lang_en = '';
					$file_lang_de = '';
					$file_content_lang = '<?php
							';
					
					$file_lang_en = $file_content_lang.$field_lang;
					$file_lang_de = $file_content_lang.$field_lang;
					
					
					// Write file languages
					if(class_exists('File::putContent')){
						File::putContent($file_path_lang_en.$resultModules->module.'.php', $file_lang_en);
						File::putContent($file_path_lang_de.$resultModules->module.'.php', $file_lang_de);
					}else{
						$file_path_lang_en1 = $_SERVER['DOCUMENT_ROOT'].'/'.$file_path_lang_en.$resultModules->module.'.php';

						$f = fopen($file_path_lang_en1,'w');
						fwrite($f,$file_lang_en,strlen($file_lang_en));
						fclose($f);
						
						$file_path_lang_de1 = $_SERVER['DOCUMENT_ROOT'].'/'.$file_path_lang_de.$resultModules->module.'.php';
						
						$f = fopen($file_path_lang_de1,'w');
						fwrite($f,$file_lang_de,strlen($file_lang_de));
						fclose($f);
					}
					
					$updated_files .= $file_path_dca.$resultModules->module.'.php<br />'.$file_path_lang_en.$resultModules->module.'.php<br />'.$file_path_lang_de.$resultModules->module.'.php<br />';
				
				}
			}
		}
	
		return '<div id="tl_buttons">
<a href="contao/main.php?do=fieldXtender" class="header_back" title="" accesskey="b" onclick="Backend.getScrollOffset()">'.$GLOBALS['TL_LANG']['MOD']['back'].'</a>
</div><h2 class="files_updated_msg">'.$GLOBALS['TL_LANG']['MOD']['files_updated'].'</h2><div class="files_updated">'.$updated_files.'</div>';
	}
	
	
	
	
	/**
	 * Generate the module
	 */
	protected function compile()
	{

	}
}
