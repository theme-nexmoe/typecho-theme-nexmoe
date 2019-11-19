<script src="<?php echo $this->options->mdui_js ?>"></script>
<script src="<?php echo $this->options->jquery_js ?>"></script>

<?php if (!empty($this->options->function) && in_array('fancybox', $this->options->function)): ?>
<script src="<?php echo $this->options->fancybox_js ?>"></script>
<?php endif; ?>

<?php if (!empty($this->options->function) && in_array('SmoothScroll', $this->options->function)): ?>
<script src="<?php echo $this->options->SmoothScroll_js ?>"></script>
<?php endif; ?>
<?php if (!empty($this->options->function) && in_array('enableMathjax', $this->options->function)): ?>
    <?php if ($this->fields->math != "No"): ?>
        <script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});</script>'
        <script type="text/javascript" src="https://cdn.bootcss.com/mathjax/2.7.6/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <?php endif; ?>
<?php endif; ?>
<?php if (empty($this->options->function) || !in_array('enableMathjax', $this->options->function)): ?>
    <?php if ($this->fields->math == "Yes"): ?>
        <script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});</script>'
        <script type="text/javascript" src="https://cdn.bootcss.com/mathjax/2.7.6/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <?php endif; ?>
<?php endif; ?>

<script src="<?php echo $this->options->highlight_js ?>"></script>
<script>hljs.initHighlightingOnLoad();</script>

<script src="<?php $this->options->themeUrl('source/js/app.js'); ?>"></script>
<script src="<?php echo $this->options->lazysizes_js ?>"></script>
