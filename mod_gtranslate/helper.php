<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2009 Edvard Ananyan. All rights reserved.
* @license   http://creativecommons.org/licenses/by-nc-nd/3.0/
*/

defined('_JEXEC') or die('Restricted access');

class modGTranslateHelper {
    function getParams(&$params) {
        $params->def('look', 'both');
        $params->def('orientation', 'h');
        $params->def('flag_size', '24');
        $params->def('language', 'en');
        $params->def('show_en', '2');
        $params->def('show_ar', '1');
        $params->def('show_bg', '1');
        $params->def('show_zh-CN', '1');
        $params->def('show_zh-TW', '1');
        $params->def('show_hr', '1');
        $params->def('show_cs', '1');
        $params->def('show_da', '1');
        $params->def('show_nl', '1');
        $params->def('show_fi', '1');
        $params->def('show_fr', '2');
        $params->def('show_de', '2');
        $params->def('show_el', '1');
        $params->def('show_hi', '1');
        $params->def('show_it', '2');
        $params->def('show_ja', '1');
        $params->def('show_ko', '1');
        $params->def('show_no', '1');
        $params->def('show_pl', '1');
        $params->def('show_pt', '2');
        $params->def('show_ro', '1');
        $params->def('show_ru', '2');
        $params->def('show_es', '2');
        $params->def('show_sv', '1');
        $params->def('show_ca', '1');
        $params->def('show_tl', '1');
        $params->def('show_iw', '1');
        $params->def('show_id', '1');
        $params->def('show_lv', '1');
        $params->def('show_lt', '1');
        $params->def('show_sr', '1');
        $params->def('show_sk', '1');
        $params->def('show_sl', '1');
        $params->def('show_uk', '1');
        $params->def('show_vi', '1');
        return $params;
    }
}