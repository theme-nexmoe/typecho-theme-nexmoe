<script src="<?php echo $this->options->jquery_js ?>"></script>
<script src="<?php echo $this->options->mdui_js ?>"></script>
<?php if (!empty($this->options->function) && in_array('SmoothScroll', $this->options->function)): ?>
<script src="<?php echo $this->options->SmoothScroll_js ?>"></script>
<?php endif; ?>
<script src="<?php $this->options->themeUrl('source/js/app.js'); ?>"></script>
<script src="<?php echo $this->options->lazysizes_js ?>"></script>
<?php $this -> footer(); ?>
