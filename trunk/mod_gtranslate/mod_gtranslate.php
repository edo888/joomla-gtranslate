<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2009 Edvard Ananyan. All rights reserved.
* @license   http://creativecommons.org/licenses/by-nc-nd/3.0/
*/

defined('_JEXEC') or die('Restricted access');

require_once (dirname(__FILE__).DS.'helper.php');

$params = modGTranslateHelper::getParams($params);

$look = $params->get('look');
$orientation = $params->get('orientation');
$flag_size = $params->get('flag_size');
$language = $params->get('language');
$show_en = $params->get('show_en');
$show_ar = $params->get('show_ar');
$show_bg = $params->get('show_bg');
$show_zhCN = $params->get('show_zh-CN');
$show_zhTW = $params->get('show_zh-TW');
$show_hr = $params->get('show_hr');
$show_cs = $params->get('show_cs');
$show_da = $params->get('show_da');
$show_nl = $params->get('show_nl');
$show_fi = $params->get('show_fi');
$show_fr = $params->get('show_fr');
$show_de = $params->get('show_de');
$show_el = $params->get('show_el');
$show_hi = $params->get('show_hi');
$show_it = $params->get('show_it');
$show_ja = $params->get('show_ja');
$show_ko = $params->get('show_ko');
$show_no = $params->get('show_no');
$show_pl = $params->get('show_pl');
$show_pt = $params->get('show_pt');
$show_ro = $params->get('show_ro');
$show_ru = $params->get('show_ru');
$show_es = $params->get('show_es');
$show_sv = $params->get('show_sv');
$show_ca = $params->get('show_ca');
$show_tl = $params->get('show_tl');
$show_iw = $params->get('show_iw');
$show_id = $params->get('show_id');
$show_lv = $params->get('show_lv');
$show_lt = $params->get('show_lt');
$show_sr = $params->get('show_sr');
$show_sk = $params->get('show_sk');
$show_sl = $params->get('show_sl');
$show_uk = $params->get('show_uk');
$show_vi = $params->get('show_vi');
$main_url = $_SERVER['HTTP_HOST'];

if($_SERVER['SERVER_PORT'] != '80')
    $main_url = substr($main_url, 0, strpos($main_url, ':'));

require(JModuleHelper::getLayoutPath('mod_gtranslate'));