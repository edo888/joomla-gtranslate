<?php if (!$this->searchable): ?>
<!-- indexer::stop -->
<?php endif; ?>

<style type="text/css">
<!--
a.flag {background-image:url('system/modules/gtranslate/html/<?php echo $this->flag_size; ?>a.png');}
a.flag:hover {background-image:url('system/modules/gtranslate/html/<?php echo $this->flag_size; ?>.png');}
-->
</style>

<?php if($this->method == 'on-fly'): ?>
<script type="text/javascript" src="system/modules/gtranslate/html/jquery-translate.js"></script>
<script type="text/javascript">
//<![CDATA[
if(jQuery.cookie('glang') && jQuery.cookie('glang') != '<?php echo $this->mainlang; ?>') jQuery(function($){$('body').translate('<?php echo $language; ?>', $.cookie('glang'), {not:'script'});});
//]]>
</script>
<?php endif; ?>

<script type="text/javascript">
//<![CDATA[
<?php if($this->method == 'on-fly'): ?>
    function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;var lang=lang_pair.split('|')[1];if(lang=='pt')lang='pt-PT';jQuery.cookie('glang', lang);jQuery(function($){$('body').translate('<?php echo $this->mainlang; ?>', lang, {not:'script'})});}
<?php else: ?>
    <?php if($this->new_window): ?>
        function openTab(url) {var form=document.createElement('form');form.method='post';form.action=url;form.target='_blank';document.body.appendChild(form);form.submit();}
        <?php if($this->pro): ?>
        function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;var lang=lang_pair.split('|')[1];var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW')plang='<?php echo $this->mainlang; ?>';if(lang == '<?php echo $this->mainlang; ?>')openTab(location.protocol+'//'+location.host+location.pathname.replace('/'+plang, '')+location.search);else openTab(location.protocol+'//'+location.host+'/'+lang+location.pathname.replace('/'+plang, '')+location.search);}
        <?php else: ?>
        if(top.location!=self.location)top.location=self.location;
        window['_tipoff']=function(){};window['_tipon']=function(a){};
        function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(location.hostname=='<?php echo $this->mainurl; ?>' && lang_pair=='<?php echo $this->mainlang; ?>|<?php echo $this->mainlang; ?>')return;else if(location.hostname!='<?php echo $this->mainurl; ?>' && lang_pair=='<?php echo $this->mainlang; ?>|<?php echo $mainlang; ?>')openTab(unescape(gfg('u')));else if(location.hostname=='<?php echo $this->mainurl; ?>' && lang_pair!='<?php echo $this->mainlang; ?>|<?php echo $this->mainlang; ?>')openTab('http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+escape(location.href));else openTab('http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+unescape(gfg('u')));}
        function gfg(name) {name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(location.href);if(results==null)return '';return results[1];}
        <?php endif; ?>
    <?php else: ?>
        <?php if($this->pro): ?>
        function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;var lang=lang_pair.split('|')[1];var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW')plang='<?php echo $this->mainlang; ?>';if(lang == '<?php echo $this->mainlang; ?>')location.pathname=location.pathname.replace('/'+plang, '');else location.pathname='/'+lang+location.pathname.replace('/'+plang, '');}
        <?php else: ?>
        if(top.location!=self.location)top.location=self.location;
        window['_tipoff']=function(){};window['_tipon']=function(a){};
        function doTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(location.hostname=='<?php echo $this->mainurl; ?>' && lang_pair=='<?php echo $this->mainlang; ?>|<?php echo $this->mainlang; ?>')return;else if(location.hostname!='<?php echo $this->mainurl; ?>' && lang_pair=='<?php echo $this->mainlang; ?>|<?php echo $this->mainlang; ?>')location.href=unescape(gfg('u'));else if(location.hostname=='<?php echo $this->mainurl; ?>' && lang_pair!='<?php echo $this->mainlang; ?>|<?php echo $this->mainlang; ?>')location.href='http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+escape(location.href);else location.href='http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+unescape(gfg('u'));}
        function gfg(name) {name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(location.href);if(results==null)return '';return results[1];}
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
//]]>
</script>
<noscript>Javascript is required to use this <a href="http://gtranslate.net/">online translator</a>, <a href="http://gtranslate.net/">free translator</a></noscript>

<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
    <?php if ($this->headline): ?>
    <<?php echo $this->hl; ?>><a href="http://gtranslate.net/" rel="follow" target="_blank"><?php echo $this->headline; ?></a></<?php echo $this->hl; ?>>
    <?php endif; ?>

    <?php
    $i = $j = 0;
    foreach($this->languages as $lang => $lang_name) {
        if($this->$lang):
            switch($lang) {
                case 'zhCN': $lang = 'zh-CN'; break;
                case 'zhTW': $lang = 'zh-TW'; break;
                default: break;
            }
            echo '<a href="javascript:doTranslate(\''.$this->mainlang.'|'.$lang.'\')" title="'.$lang_name.'" class="flag" style="font-size:'.$flag_size.'px;padding:1px 0;background-repeat:no-repeat;background-position:-'.($i*100).'px -'.($j*100).'px;"><img src="system/modules/gtranslate/html/blank.png" height="'.$this->flag_size.'" width="'.$this->flag_size.'" style="border:0;vertical-align:top;" alt="'.$lang_name.'" /></a> ';
        endif;
        if($i == 7) {
            $i = 0;
            $j++;
        } else {
            $i++;
        }
    }
    ?>
</div>

<?php if (!$this->searchable): ?>
<!-- indexer::continue -->
<?php endif; ?>