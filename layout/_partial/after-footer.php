<script src="<?php echo $this->options->mdui_js ?>"></script>
<script src="<?php echo $this->options->jquery_js ?>"></script>
<% if(theme.function.fancybox == true) { %> 
<?php if (!empty($this->options->function) && in_array('fancybox', $this->options->function)): ?>
<script src="<?php echo $this->options->fancybox_js ?>"></script>
<?php endif; ?>

<?php if (!empty($this->options->function) && in_array('SmoothScroll', $this->options->function)): ?>
<script src="<?php echo $this->options->SmoothScroll_js ?>"></script>
<?php endif; ?>

<script src="<?php echo $this->options->highlight_js ?>"></script>
<script>hljs.initHighlightingOnLoad();</script>

<script src="<?php $this->options->themeUrl('source/js/app.js'); ?>"></script>
<script src="<?php echo $this->options->lazysizes_js ?>"></script>
