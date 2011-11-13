<?php if (!$this->searchable): ?>
<!-- indexer::stop -->
<?php endif; ?>

<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>

<?php if ($this->headline): ?>
<<?php echo $this->hl; ?>><a href="http://gtranslate.net/" rel="follow" target="_blank"><?php echo $this->headline; ?></a></<?php echo $this->hl; ?>>
<?php endif; ?>

<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: '<?php echo $this->mainlang; ?>',
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
    includedLanguages: '<?php echo $this->includeLanguages; ?>'
  }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<noscript>Javascript is required to use this <a href="http://gtranslate.net/">website translator</a>, <a href="http://gtranslate.net/">translator</a></noscript>
</div>

<?php if (!$this->searchable): ?>
<!-- indexer::continue -->
<?php endif; ?>