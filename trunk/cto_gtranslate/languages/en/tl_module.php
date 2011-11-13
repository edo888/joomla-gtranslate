<?php
if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v3
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License v3 for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/gpl.html
 *
 * PHP version 5
 * @copyright  Edvard Ananyan 2009
 * @author     Edvard Ananyan
 * @package    GTranslate
 * @license    GNU/GPL v3
 * @filesource
 */

global $languages;
$languages = array('en'=>'English','ar'=>'Arabic','bg'=>'Bulgarian','zhCN'=>'Chinese (Simplified)','zhTW'=>'Chinese (Traditional)','hr'=>'Croatian','cs'=>'Czech','da'=>'Danish','nl'=>'Dutch','fi'=>'Finnish','fr'=>'French','de'=>'German','el'=>'Greek','hi'=>'Hindi','it'=>'Italian','ja'=>'Japanese','ko'=>'Korean','no'=>'Norwegian','pl'=>'Polish','pt'=>'Portuguese','ro'=>'Romanian','ru'=>'Russian','es'=>'Spanish','sv'=>'Swedish','ca'=>'Catalan','tl'=>'Filipino','iw'=>'Hebrew','id'=>'Indonesian','lv'=>'Latvian','lt'=>'Lithuanian','sr'=>'Serbian','sk'=>'Slovak','sl'=>'Slovenian','uk'=>'Ukrainian','vi'=>'Vietnamese','sq'=>'Albanian','et'=>'Estonian','gl'=>'Galician','hu'=>'Hungarian','mt'=>'Maltese','th'=>'Thai','tr'=>'Turkish','fa'=>'Persian','af'=>'Afrikaans','ms'=>'Malay','sw'=>'Swahili','ga'=>'Irish','cy'=>'Welsh','be'=>'Belarusian','is'=>'Icelandic','mk'=>'Macedonian','yi'=>'Yiddish');

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['gtranslate_template'] = array('Module template', 'Select the look of the module.');
$GLOBALS['TL_LANG']['tl_module']['gtranslate_method'] = array('Translation method', 'Select which method shall be used when translating the page. Google Default will show only a dropdown provided by Google and it will translate the page on the fly, but you cannot configure it\'s appearance. On Fly (jQuery) can be configured, it will also use the on the fly translation method. Redirect method will redirect the visitor to the translated page, if the Pro version is installed it will use SEF URLs and keep the visitor on your domain, however this method cannot translate non-public pages.');
$GLOBALS['TL_LANG']['tl_module']['gtranslate_mainlang'] = array('Main language', 'The main language of your website.');
$GLOBALS['TL_LANG']['tl_module']['gtranslate_new_window'] = array('Open translated page in a new window', 'The translated page will appear in a new window.');
$GLOBALS['TL_LANG']['tl_module']['gtranslate_pro'] = array('Operate with the Pro version', 'If you have installed the <a href="http://edo.webmaster.am/gtranslate" target="_blank">Pro version</a> you need to check this.');
$GLOBALS['TL_LANG']['tl_module']['gtranslate_flag_size'] = array('Flag size', 'Select the flag size in pixels.');
foreach($languages as $lang => $language)
    $GLOBALS['TL_LANG']['tl_module']['gtranslate_'.$lang] = array('Show '.$language, 'Show '.$language.' in the language list');

/**
 * References
 */

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_module']['gtranslate_appearance_legend']= 'Appearance configuration';
$GLOBALS['TL_LANG']['tl_module']['gtranslate_language_legend']= 'Language configuration';
$GLOBALS['TL_LANG']['tl_module']['gtranslate_general_legend']= 'General configuration';