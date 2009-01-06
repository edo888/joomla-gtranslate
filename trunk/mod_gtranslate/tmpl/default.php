<?php
/**
* @version   $Id: mod_gtranslate.php 148 2006-07-28 21:30:43Z edo888 $
* @package   GTranslate
* @copyright Copyright (C) 2008-2009 Edvard Ananyan. All rights reserved.
* @license   http://creativecommons.org/licenses/by-nc-nd/3.0/
*/

defined('_JEXEC') or die('Restricted access');

$lang_array = array(
'en' => 'English',
'ar' => 'Arabic',
'bg' => 'Bulgarian',
'zh-CN' => 'Chinese (Simplified)',
'zh-TW' => 'Chinese (Traditional)',
'hr' => 'Croatian',
'cs' => 'Czech',
'da' => 'Danish',
'nl' => 'Dutch',
'fi' => 'Finnish',
'fr' => 'French',
'de' => 'German',
'el' => 'Greek',
'hi' => 'Hindi',
'it' => 'Italian',
'ja' => 'Japanese',
'ko' => 'Korean',
'no' => 'Norwegian',
'pl' => 'Polish',
'pt' => 'Portuguese',
'ro' => 'Romanian',
'ru' => 'Russian',
'es' => 'Spanish',
'sv' => 'Swedish',
'ca' => 'Catalan',
'tl' => 'Filipino',
'iw' => 'Hebrew',
'id' => 'Indonesian',
'lv' => 'Latvian',
'lt' => 'Lithuanian',
'sr' => 'Serbian',
'sk' => 'Slovak',
'sl' => 'Slovenian',
'uk' => 'Ukrainian',
'vi' => 'Vietnamese'
);
?>
<script type="text/javascript">
//<![CDATA[
// google translate
<?php if($look == 'flags') { ?>
function doTranslate(lang_pair) {
        if (location.hostname == '<?php echo $main_url; ?>' && lang_pair == '<?php echo $language; ?>|<?php echo $language; ?>') return;
        else if(location.hostname != '<?php echo $main_url; ?>' && lang_pair == '<?php echo $language; ?>|<?php echo $language; ?>') location.href = unescape(gfg('u'));
        else if(location.hostname == '<?php echo $main_url; ?>' && lang_pair != '<?php echo $language; ?>|<?php echo $language; ?>') location.href = 'http://translate.google.com/translate_p?client=tmpg&hl=en&langpair=' + lang_pair + '&u=' + escape(location.href);
        else location.href = 'http://translate.google.com/translate_p?client=tmpg&hl=en&langpair=' + lang_pair + '&u=' + unescape(gfg('u'));
}
<?php } else { ?>
function doTranslate(select_obj) {
        if (location.hostname == '<?php echo $main_url; ?>' && select_obj.value == '<?php echo $language; ?>|<?php echo $language; ?>') return;
        else if(location.hostname != '<?php echo $main_url; ?>' && select_obj.value == '<?php echo $language; ?>|<?php echo $language; ?>') location.href = unescape(gfg('u'));
        else if(location.hostname == '<?php echo $main_url; ?>' && select_obj.value != '<?php echo $language; ?>|<?php echo $language; ?>') location.href = 'http://translate.google.com/translate_p?client=tmpg&hl=en&langpair=' + select_obj.value + '&u=' + escape(location.href);
        else location.href = 'http://translate.google.com/translate_p?client=tmpg&hl=en&langpair=' + select_obj.value + '&u=' + gfg('u');
}
<?php } ?>
// get from get
function gfg(name) {
        name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
        var regexS = "[\\?&]"+name+"=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(location.href);
        if(results == null) return '';
        return results[1];
}
//]]>
</script>

<?php
if($look == 'flags') {
        $i = $j = 0;
        foreach($lang_array as $lang => $lang_name) {
                $show_this = 'show_'.str_replace('-', '', $lang);
                if($$show_this):
                        echo '<a href="javascript:doTranslate(\''.$language.'|'.$lang.'\')" title="'.$lang_name.'" style="font-size:'.$flag_size.'px;padding:1px 0;background:url(\'modules/mod_gtranslate/tmpl/lang/'.$flag_size.'.png\') no-repeat scroll -'.($i*100).'px -'.($j*100).'px;"><img src="modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" style="border:0;vertical-align:top;" alt="'.$lang_name.'" /></a>';
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
} else {
        echo '<select onchange="doTranslate(this);">';
        echo '<option value="">Select Language</option>';
        $i = 0;
        foreach($lang_array as $lang => $lang_name) {
                $show_this = 'show_'.str_replace('-', '', $lang);
                if($$show_this)
                        echo '<option value="'.$language.'|'.$lang.'" style="background:url(\'modules/mod_gtranslate/tmpl/lang/16l.png\') no-repeat scroll 0 -'.($i*16).'px;padding-left:18px;">'.$lang_name.'</option>';
                if($lang != 'zh-CN')
                        $i++;
        }
        echo '</select>';
}
?>