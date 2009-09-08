<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2009 Edvard Ananyan. All rights reserved.
* @license   GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

$look = $params->def('look', 'both');
$flag_size = $params->def('flag_size', 16);
$orientation = $params->def('orientation', 'h');
$pro_version = $params->def('pro_version', 0);
$new_tab = $params->def('new_tab', 0);
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
$show_sq = $params->def('show_sq', 1);
$show_et = $params->def('show_et', 1);
$show_gl = $params->def('show_gl', 1);
$show_hu = $params->def('show_hu', 1);
$show_mt = $params->def('show_mt', 1);
$show_th = $params->def('show_th', 1);
$show_tr = $params->def('show_tr', 1);
$show_fa = $params->def('show_fa', 1);
$show_af = $params->def('show_af', 1);
$show_ms = $params->def('show_ms', 1);
$show_sw = $params->def('show_sw', 1);
$show_ga = $params->def('show_ga', 1);
$show_cy = $params->def('show_cy', 1);
$show_be = $params->def('show_be', 1);
$show_is = $params->def('show_is', 1);
$show_mk = $params->def('show_mk', 1);
$show_yi = $params->def('show_yi', 1);
$main_url = $_SERVER['HTTP_HOST'];

if($_SERVER['SERVER_PORT'] != '80')
    $main_url = substr($main_url, 0, strpos($main_url, ':'));

$lang_array = array('en'=>'English','ar'=>'Arabic','bg'=>'Bulgarian','zh-CN'=>'Chinese (Simplified)','zh-TW'=>'Chinese (Traditional)','hr'=>'Croatian','cs'=>'Czech','da'=>'Danish','nl'=>'Dutch','fi'=>'Finnish','fr'=>'French','de'=>'German','el'=>'Greek','hi'=>'Hindi','it'=>'Italian','ja'=>'Japanese','ko'=>'Korean','no'=>'Norwegian','pl'=>'Polish','pt'=>'Portuguese','ro'=>'Romanian','ru'=>'Russian','es'=>'Spanish','sv'=>'Swedish','ca'=>'Catalan','tl'=>'Filipino','iw'=>'Hebrew','id'=>'Indonesian','lv'=>'Latvian','lt'=>'Lithuanian','sr'=>'Serbian','sk'=>'Slovak','sl'=>'Slovenian','uk'=>'Ukrainian','vi'=>'Vietnamese','sq'=>'Albanian','et'=>'Estonian','gl'=>'Galician','hu'=>'Hungarian','mt'=>'Maltese','th'=>'Thai','tr'=>'Turkish','fa'=>'Persian');

if(!defined('GTRANSLATE_INCLUDED')) {
    define('GTRANSLATE_INCLUDED', 1);
?>
<script type="text/javascript">
//<![CDATA[
<?php if($new_tab): ?>
    function openTab(url) {var form=document.createElement('form');form.method='post';form.action=url;form.target='_blank';document.body.appendChild(form);form.submit();}
    <?php if($pro_version): ?>
    function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;var lang=lang_pair.split('|')[1];var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW')plang='<?php echo $language; ?>';if(lang == '<?php echo $language; ?>')openTab(location.protocol+'//'+location.host+location.pathname.replace('/'+plang, '')+location.search);else openTab(location.protocol+'//'+location.host+'/'+lang+location.pathname.replace('/'+plang, '')+location.search);}
    <?php else: ?>
    if(top.location!=self.location)top.location=self.location;
    window['_tipoff']=function(){};window['_tipon']=function(a){};
    function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(location.hostname=='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')return;else if(location.hostname!='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')openTab(unescape(gfg('u')));else if(location.hostname=='<?php echo $main_url; ?>' && lang_pair!='<?php echo $language; ?>|<?php echo $language; ?>')openTab('http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+escape(location.href));else openTab('http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+unescape(gfg('u')));}
    function gfg(name) {name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(location.href);if(results==null)return '';return results[1];}
    <?php endif; ?>
<?php else: ?>
    <?php if($pro_version): ?>
    function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;var lang=lang_pair.split('|')[1];var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW')plang='<?php echo $language; ?>';if(lang == '<?php echo $language; ?>')location.pathname=location.pathname.replace('/'+plang, '');else location.pathname='/'+lang+location.pathname.replace('/'+plang, '');}
    <?php else: ?>
    if(top.location!=self.location)top.location=self.location;
    window['_tipoff']=function(){};window['_tipon']=function(a){};
    function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(location.hostname=='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')return;else if(location.hostname!='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')location.href=unescape(gfg('u'));else if(location.hostname=='<?php echo $main_url; ?>' && lang_pair!='<?php echo $language; ?>|<?php echo $language; ?>')location.href='http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+escape(location.href);else location.href='http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+unescape(gfg('u'));}
    function gfg(name) {name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(location.href);if(results==null)return '';return results[1];}
    <?php endif; ?>
<?php endif; ?>
//]]>
</script>
<style type="text/css">
<!--
a.flag {background-image:url('<?php echo $mosConfig_live_site.'/modules/flags/'.$flag_size.'a.png';?>');}
a.flag:hover {background-image:url('<?php echo $mosConfig_live_site.'/modules/flags/'.$flag_size.'.png';?>');}
-->
</style>

<?php
}

if($look == 'flags') {
    $i = $j = 0;
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this):
            echo '<a href="javascript:doTranslate(\''.$language.'|'.$lang.'\')" title="'.$lang_name.'" class="flag" style="font-size:'.$flag_size.'px;padding:1px 0;background-repeat:no-repeat;background-position:-'.($i*100).'px -'.($j*100).'px;"><img src="'.$mosConfig_live_site.'/modules/flags/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" style="border:0;vertical-align:top;" alt="'.$lang_name.'" /></a>';
            if($orientation == 'v')
                echo '<br />';
            else
                echo ' ';
        endif;
        if($i == 7) {
            $i = 0;
            $j++;
        } else {
            $i++;
        }
    }
} elseif ($look == 'dropdown') {
    echo '<select onchange="doTranslate(this);">';
    echo '<option value="">Select Language</option>';
    $i = 0;
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this)
            echo '<option value="'.$language.'|'.$lang.'" style="background:url(\''.$mosConfig_live_site.'/modules/flags/16l.png\') no-repeat scroll 0 -'.($i*16).'px;padding-left:18px;">'.$lang_name.'</option>';
        $i++;
    }
    echo '</select>';
} else {
    $i = $j = 0;
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this == '2'):
            echo '<a href="javascript:doTranslate(\''.$language.'|'.$lang.'\')" title="'.$lang_name.'" class="flag" style="font-size:'.$flag_size.'px;padding:1px 0;background-repeat:no-repeat;background-position:-'.($i*100).'px -'.($j*100).'px;"><img src="'.$mosConfig_live_site.'/modules/flags/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" style="border:0;vertical-align:top;" alt="'.$lang_name.'" /></a>';
        endif;
        if($i == 7) {
            $i = 0;
            $j++;
        } else {
            $i++;
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