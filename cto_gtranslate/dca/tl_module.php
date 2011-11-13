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


$languages_flags = array('en', 'fr', 'de', 'it', 'pt', 'ru', 'es');
global $languages;

$languages_list = array();
foreach($languages as $lang => $language)
    $languages_list[] = 'gtranslate_'.$lang;
$languages_list = implode(',', $languages_list);

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['gtranslate']  = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['gtranslate'] .= '{gtranslate_general_legend},gtranslate_method,gtranslate_pro;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['gtranslate'] .= '{gtranslate_appearance_legend},gtranslate_template,gtranslate_new_window,gtranslate_flag_size;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['gtranslate'] .= '{gtranslate_language_legend},gtranslate_mainlang,'.$languages_list.';';
$GLOBALS['TL_DCA']['tl_module']['palettes']['gtranslate'] .= '{protected_legend},guests,protected;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['gtranslate'] .= '{expert_legend},align,space,cssID';


/**
 * Add subpalettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['gtranslate_mainlang'] = '';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['gtranslate_method'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['gtranslate_method'],
    'inputType'               => 'radio',
    'options'                 => array('google-default'=>'Google Default', 'on-fly'=>'On Fly (jQuery)', 'redirect'=>'Redirect'),
    'default'                 => 'google-default',
    'search'                  => false,
    'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
);

$GLOBALS['TL_DCA']['tl_module']['fields']['gtranslate_flag_size'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['gtranslate_flag_size'],
    'inputType'               => 'radio',
    'options'                 => array(16, 24, 32),
    'default'                 => 16,
    'search'                  => false,
    'eval'                    => array('mandatory'=>true, 'rgxp' => digit, 'maxlength'=>255),
);

$GLOBALS['TL_DCA']['tl_module']['fields']['gtranslate_template'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['gtranslate_template'],
    'default'                 => 'mod_gtranslate_google_default',
    'search'                  => false,
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => $this->getTemplateGroup('mod_gtranslate'),
    'eval'                    => array('mandatory'=>true),
);

$GLOBALS['TL_DCA']['tl_module']['fields']['gtranslate_new_window'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['gtranslate_new_window'],
    'search'                  => false,
    'exclude'                 => true,
    'inputType'               => 'checkbox',
);

$GLOBALS['TL_DCA']['tl_module']['fields']['gtranslate_pro'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['gtranslate_pro'],
    'search'                  => false,
    'exclude'                 => true,
    'inputType'               => 'checkbox',
);

$GLOBALS['TL_DCA']['tl_module']['fields']['gtranslate_mainlang'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['gtranslate_mainlang'],
    'inputType'               => 'select',
    'options'                 => $languages,
    'default'                 => 'en',
    'search'                  => false,
    'eval'                    => array('mandatory'=>true),
);

foreach($languages as $lang => $language)
    $GLOBALS['TL_DCA']['tl_module']['fields']['gtranslate_'.$lang] = array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_module']['gtranslate_'.$lang],
        'search'                  => false,
        'exclude'                 => true,
        'inputType'               => 'radio',
        'options'                 => array(1=>'Yes', 0=>'No', 2=>'As a flag'),
        'default'                 => in_array($lang, $languages_flags) ? 2 : 1,
        'eval'                    => array('mandatory'=>true),
    );

class GTranslate extends Backend
{
}