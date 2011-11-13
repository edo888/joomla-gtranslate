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


/**
 * Class ModuleGTranslate
 *
 * @copyright  Edvard Ananyan 2009
 * @author     Edvard Ananyan
 * @package    Controller
 */
class ModuleGTranslate extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_gtranslate_google_default';

    /**
     * Generate module
     */
    protected function compile()
    {
        if($this->gtranslate_template) {
            if($this->gtranslate_method == 'google-default')
                $this->gtranslate_template = 'mod_gtranslate_google_default';
            $this->strTemplate = $this->gtranslate_template;
            $this->Template = new FrontendTemplate($this->strTemplate);
        }

        $languages = array('en'=>'English','ar'=>'Arabic','bg'=>'Bulgarian','zh-CN'=>'Chinese (Simplified)','zh-TW'=>'Chinese (Traditional)','hr'=>'Croatian','cs'=>'Czech','da'=>'Danish','nl'=>'Dutch','fi'=>'Finnish','fr'=>'French','de'=>'German','el'=>'Greek','hi'=>'Hindi','it'=>'Italian','ja'=>'Japanese','ko'=>'Korean','no'=>'Norwegian','pl'=>'Polish','pt'=>'Portuguese','ro'=>'Romanian','ru'=>'Russian','es'=>'Spanish','sv'=>'Swedish','ca'=>'Catalan','tl'=>'Filipino','iw'=>'Hebrew','id'=>'Indonesian','lv'=>'Latvian','lt'=>'Lithuanian','sr'=>'Serbian','sk'=>'Slovak','sl'=>'Slovenian','uk'=>'Ukrainian','vi'=>'Vietnamese','sq'=>'Albanian','et'=>'Estonian','gl'=>'Galician','hu'=>'Hungarian','mt'=>'Maltese','th'=>'Thai','tr'=>'Turkish','fa'=>'Persian','af'=>'Afrikaans','ms'=>'Malay','sw'=>'Swahili','ga'=>'Irish','cy'=>'Welsh','be'=>'Belarusian','is'=>'Icelandic','mk'=>'Macedonian','yi'=>'Yiddish','hy'=>'Armenian','az'=>'Azerbaijani','eu'=>'Basque','ka'=>'Georgian','ht'=>'Haitian Creole','ur'=>'Urdu');

        $this->Template->mainurl = $_SERVER['HTTP_HOST'];
        $this->Template->mainlang = $this->gtranslate_mainlang;
        $this->Template->method = $this->gtranslate_method;
        $this->Template->pro = $this->gtranslate_pro;
        $this->Template->new_window = $this->gtranslate_new_window;
        $this->Template->flag_size = $this->gtranslate_flag_size;
        $this->Template->languages = $languages;
        foreach($languages as $lang => $language) {
            $gtranslate_lang = 'gtranslate_'.$lang;
            $this->Template->$lang = $this->$gtranslate_lang;
        }

        if($this->strTemplate == 'mod_gtranslate_google_default') {
            $includeLanguages = array();
            foreach($languages as $lang => $language) {
                $gtranslate_lang = 'gtranslate_'.$lang;
                if($this->$gtranslate_lang) {
                    switch($lang) {
                        case 'zhCN': $includeLanguages[] = 'zh-CN'; break;
                        case 'zhTW': $includeLanguages[] = 'zh-TW'; break;
                        default: $includeLanguages[] = $lang; break;
                    }
                }
            }
            $this->Template->includeLanguages = implode(',', $includeLanguages);
        }

        $root_id = $this->getRootIdFromUrl();
        $root_details = $this->getPageDetails($root_id);

        //$this->Template->google_id = $root_details->dlh_googlemaps_id;
    }
}