<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2009 Edvard Ananyan. All rights reserved.
* @license   GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

$lang_array = array('en'=>'English','ar'=>'Arabic','bg'=>'Bulgarian','zh-CN'=>'Chinese (Simplified)','zh-TW'=>'Chinese (Traditional)','hr'=>'Croatian','cs'=>'Czech','da'=>'Danish','nl'=>'Dutch','fi'=>'Finnish','fr'=>'French','de'=>'German','el'=>'Greek','hi'=>'Hindi','it'=>'Italian','ja'=>'Japanese','ko'=>'Korean','no'=>'Norwegian','pl'=>'Polish','pt'=>'Portuguese','ro'=>'Romanian','ru'=>'Russian','es'=>'Spanish','sv'=>'Swedish','ca'=>'Catalan','tl'=>'Filipino','iw'=>'Hebrew','id'=>'Indonesian','lv'=>'Latvian','lt'=>'Lithuanian','sr'=>'Serbian','sk'=>'Slovak','sl'=>'Slovenian','uk'=>'Ukrainian','vi'=>'Vietnamese','sq'=>'Albanian','et'=>'Estonian','gl'=>'Galician','hu'=>'Hungarian','mt'=>'Maltese','th'=>'Thai','tr'=>'Turkish','fa'=>'Persian','af'=>'Afrikaans','ms'=>'Malay','sw'=>'Swahili','ga'=>'Irish','cy'=>'Welsh','be'=>'Belarusian','is'=>'Icelandic','mk'=>'Macedonian','yi'=>'Yiddish');
$flag_map = array();
$i = $j = 0;
foreach($lang_array as $lang => $lang_name) {
    $flag_map[$lang] = array($i*100, $j*100);
    if($i == 7) {
        $i = 0;
        $j++;
    } else {
        $i++;
    }
}

$flag_map_vertical = array();
$i = 0;
foreach($lang_array as $lang => $lang_name) {
    $flag_map_vertical[$lang] = $i*16;
    $i++;
}

asort($lang_array);
// Move the default language to the first position
$lang_array = array_merge(array($language => $lang_array[$language]), $lang_array);


if(!defined('GTRANSLATE_INCLUDED')) {
    define('GTRANSLATE_INCLUDED', 1);
?>

<?php
if($method == 'ajax'):
    $document =& JFactory::getDocument();
    if($load_jquery)
        $document->addScript(JURI::root(true).'/modules/mod_gtranslate/jquery.js');
    $document->addScript(JURI::root(true).'/modules/mod_gtranslate/jquery-translate.js');
?>
    <script type="text/javascript">
    //<![CDATA[
    if(jQuery.cookie('glang') && jQuery.cookie('glang') != '<?php echo $language; ?>') jQuery(function($){$('body').translate('<?php echo $language; ?>', $.cookie('glang'), {toggle:true});});
    //]]>
    </script>
<?php endif; ?>

<script type="text/javascript">
//<![CDATA[
<?php if($method == 'ajax'): ?>
    function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;var lang=lang_pair.split('|')[1];if(lang=='pt')lang='pt-PT';jQuery.cookie('glang', lang);jQuery(function($){$('body').translate('<?php echo $language; ?>', lang, {toggle:true});});}
<?php else: ?>
    <?php if($new_tab): ?>
        function openTab(url) {var form=document.createElement('form');form.method='post';form.action=url;form.target='_blank';document.body.appendChild(form);form.submit();}
        <?php if($pro_version): ?>
        function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW')plang='<?php echo $language; ?>';if(lang == '<?php echo $language; ?>')openTab(location.protocol+'//'+location.host+location.pathname.replace('/'+plang, '')+location.search);else openTab(location.protocol+'//'+location.host+'/'+lang+location.pathname.replace('/'+plang, '')+location.search);}
        <?php else: ?>
        if(top.location!=self.location)top.location=self.location;
        window['_tipoff']=function(){};window['_tipon']=function(a){};
        function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(location.hostname=='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')return;else if(location.hostname!='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')openTab(unescape(gfg('u')));else if(location.hostname=='<?php echo $main_url; ?>' && lang_pair!='<?php echo $language; ?>|<?php echo $language; ?>')openTab('http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+escape(location.href));else openTab('http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+unescape(gfg('u')));}
        function gfg(name) {name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(location.href);if(results==null)return '';return results[1];}
        <?php endif; ?>
    <?php else: ?>
        <?php if($pro_version): ?>
        function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW')plang='<?php echo $language; ?>';if(lang == '<?php echo $language; ?>')location.href=location.protocol+'//'+location.host+location.pathname.replace('/'+plang, '')+location.search;else location.href=location.protocol+'//'+location.host+'/'+lang+location.pathname.replace('/'+plang, '')+location.search;}
        <?php else: ?>
        if(top.location!=self.location)top.location=self.location;
        window['_tipoff']=function(){};window['_tipon']=function(a){};
        function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(location.hostname=='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')return;else if(location.hostname!='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')location.href=unescape(gfg('u'));else if(location.hostname=='<?php echo $main_url; ?>' && lang_pair!='<?php echo $language; ?>|<?php echo $language; ?>')location.href='http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+escape(location.href);else location.href='http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+unescape(gfg('u'));}
        function gfg(name) {name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(location.href);if(results==null)return '';return results[1];}
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
//]]>
</script>

<?php if($method == 'google_default'): ?>
<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: '<?php echo $language; ?>',
    includedLanguages: '<?php
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this)
            echo $lang.',';
    }
    ?>'
  }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php return; endif; ?>

<?php
    $document =& JFactory::getDocument();
    $document->addStyleDeclaration("
        a.flag {background-image:url('" . JURI::root(true) . '/modules/mod_gtranslate/tmpl/lang/' . $flag_size . 'a.png' . "');}
        a.flag:hover {background-image:url('" . JURI::root(true) . '/modules/mod_gtranslate/tmpl/lang/' . $flag_size.'.png' . "');}
    ");
}

if($look == 'flags') {
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        list($flag_x, $flag_y) = $flag_map[$lang];
        if($$show_this) {
            echo '<a href="javascript:doTranslate(\''.$language.'|'.$lang.'\')" title="'.$lang_name.'" class="flag" style="font-size:'.$flag_size.'px;padding:1px 0;background-repeat:no-repeat;background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" style="border:0;vertical-align:top;" alt="'.$lang_name.'" /></a>';
            if($orientation == 'v')
                echo '<br />';
            else
                echo ' ';
        }
    }
} elseif ($look == 'dropdown') {
    echo '<select onchange="doTranslate(this);">';
    echo '<option value="">Select Language</option>';
    $i = 0;
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        $flag_y = $flag_map_vertical[$lang];
        if($$show_this)
            echo '<option value="'.$language.'|'.$lang.'" style="'.($lang == $language ? 'font-weight:bold;' : '').'background:url(\''.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/16l.png\') no-repeat scroll 0 -'.$flag_y.'px;padding-left:18px;">'.$lang_name.'</option>';
    }
    echo '</select>';
} else {
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        list($flag_x, $flag_y) = $flag_map[$lang];
        if($$show_this == '2')
            echo '<a href="javascript:doTranslate(\''.$language.'|'.$lang.'\')" title="'.$lang_name.'" class="flag" style="font-size:'.$flag_size.'px;padding:1px 0;background-repeat:no-repeat;background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" style="border:0;vertical-align:top;" alt="'.$lang_name.'" /></a> ';
    }
    echo '<br/><select onchange="doTranslate(this);">';
    echo '<option value="">Select Language</option>';
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this)
            echo '<option '.($lang == $language ? 'style="font-weight:bold;"' : '').' value="'.$language.'|'.$lang.'">'.$lang_name.'</option>';
    }
    echo '</select>';
}
?>