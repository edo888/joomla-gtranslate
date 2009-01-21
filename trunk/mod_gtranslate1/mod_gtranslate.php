<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2009 Edvard Ananyan. All rights reserved.
* @license   http://creativecommons.org/licenses/by-nc-nd/3.0/
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

$look = $params->def('look', 'both');
$flag_size = $params->def('flag_size', 16);
$orientation = $params->def('orientation', 'h');
$language = $params->def('language', 'en');
$show_en = $params->def('show_en', 2);
$show_ar = $params->def('show_ar', 1);
$show_bg = $params->def('show_bg', 1);
$show_zhCN = $params->def('show_zh-CN', 1);
$show_zhTW = $params->def('show_zh-TW', 1);
$show_hr = $params->def('show_hr', 1);
$show_cs = $params->def('show_cs', 1);
$show_da = $params->def('show_da', 1);
$show_nl = $params->def('show_nl', 1);
$show_fi = $params->def('show_fi', 1);
$show_fr = $params->def('show_fr', 2);
$show_de = $params->def('show_de', 2);
$show_el = $params->def('show_el', 1);
$show_hi = $params->def('show_hi', 1);
$show_it = $params->def('show_it', 2);
$show_ja = $params->def('show_ja', 1);
$show_ko = $params->def('show_ko', 1);
$show_no = $params->def('show_no', 1);
$show_pl = $params->def('show_pl', 1);
$show_pt = $params->def('show_pt', 2);
$show_ro = $params->def('show_ro', 1);
$show_ru = $params->def('show_ru', 2);
$show_es = $params->def('show_es', 2);
$show_sv = $params->def('show_sv', 1);
$show_ca = $params->def('show_ca', 1);
$show_tl = $params->def('show_tl', 1);
$show_iw = $params->def('show_iw', 1);
$show_id = $params->def('show_id', 1);
$show_lv = $params->def('show_lv', 1);
$show_lt = $params->def('show_lt', 1);
$show_sr = $params->def('show_sr', 1);
$show_sk = $params->def('show_sk', 1);
$show_sl = $params->def('show_sl', 1);
$show_uk = $params->def('show_uk', 1);
$show_vi = $params->def('show_vi', 1);
$main_url = $_SERVER['HTTP_HOST'];

if($_SERVER['SERVER_PORT'] != '80')
    $main_url = substr($main_url, 0, strpos($main_url, ':'));

$lang_array = array('en'=>'English','ar'=>'Arabic','bg'=>'Bulgarian','zh-CN'=>'Chinese (Simplified)','zh-TW'=>'Chinese (Traditional)','hr'=>'Croatian','cs'=>'Czech','da'=>'Danish','nl'=>'Dutch','fi'=>'Finnish','fr'=>'French','de'=>'German','el'=>'Greek','hi'=>'Hindi','it'=>'Italian','ja'=>'Japanese','ko'=>'Korean','no'=>'Norwegian','pl'=>'Polish','pt'=>'Portuguese','ro'=>'Romanian','ru'=>'Russian','es'=>'Spanish','sv'=>'Swedish','ca'=>'Catalan','tl'=>'Filipino','iw'=>'Hebrew','id'=>'Indonesian','lv'=>'Latvian','lt'=>'Lithuanian','sr'=>'Serbian','sk'=>'Slovak','sl'=>'Slovenian','uk'=>'Ukrainian','vi'=>'Vietnamese');

if(!defined('GTRANSLATE_INCLUDED')) {
    define('GTRANSLATE_INCLUDED', 1);
?>
<script type="text/javascript">
//<![CDATA[
if(top.location!=self.location)top.location=self.location;
window['_tipoff']=function(){};window['_tipon']=function(a){};
function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(location.hostname=='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')return;else if(location.hostname!='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')location.href=unescape(gfg('u'));else if(location.hostname=='<?php echo $main_url; ?>' && lang_pair!='<?php echo $language; ?>|<?php echo $language; ?>')location.href='http://translate.google.com/translate_c?client=tmpg&hl=en&langpair='+lang_pair+'&u='+escape(location.href);else location.href='http://translate.google.com/translate_c?client=tmpg&hl=en&langpair='+lang_pair+'&u='+unescape(gfg('u'));}
function gfg(name) {name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(location.href);if(results==null)return '';return results[1];}
//]]>
</script>

<?php
}

if($look == 'flags') {
    $i = $j = 0;
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this):
            echo '<a href="javascript:doTranslate(\''.$language.'|'.$lang.'\')" title="'.$lang_name.'" style="font-size:'.$flag_size.'px;padding:1px 0;background:url(\'modules/flags/'.$flag_size.'.png\') no-repeat scroll -'.($i*100).'px -'.($j*100).'px;"><img src="modules/flags/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" style="border:0;vertical-align:top;" alt="'.$lang_name.'" /></a>';
            if($orientation == 'v')
                echo '<br />';
            else
                echo ' ';
        endif;
        if($lang != 'zh-CN') {
            if($i == 7) {
                $i = 0;
                $j++;
            } else {
                $i++;
            }
        }
    }
} elseif ($look == 'dropdown') {
    echo '<select onchange="doTranslate(this);">';
    echo '<option value="">Select Language</option>';
    $i = 0;
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this)
            echo '<option value="'.$language.'|'.$lang.'" style="background:url(\'modules/flags/16l.png\') no-repeat scroll 0 -'.($i*16).'px;padding-left:18px;">'.$lang_name.'</option>';
        if($lang != 'zh-CN')
            $i++;
    }
    echo '</select>';
} else {
    $i = $j = 0;
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this == '2'):
            echo '<a href="javascript:doTranslate(\''.$language.'|'.$lang.'\')" title="'.$lang_name.'" style="font-size:'.$flag_size.'px;padding:1px 0;background:url(\'modules/flags/'.$flag_size.'.png\') no-repeat scroll -'.($i*100).'px -'.($j*100).'px;"><img src="modules/flags/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" style="border:0;vertical-align:top;" alt="'.$lang_name.'" /></a> ';
        endif;
        if($lang != 'zh-CN') {
            if($i == 7) {
                $i = 0;
                $j++;
            } else {
                $i++;
            }
        }
    }
    echo '<br/><select onchange="doTranslate(this);">';
    echo '<option value="">Select Language</option>';
    $i = 0;
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this)
            echo '<option value="'.$language.'|'.$lang.'">'.$lang_name.'</option>';
    }
    echo '</select>';
}
?>