<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->footer(); 
?>

<script src="//cdn.bootcss.com/highlight.js/9.9.0/highlight.min.js"></script>
<script>$('pre code').each(function(i, block) {hljs.highlightBlock(block);});</script>
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/mdui/0.4.0/js/mdui.min.js"></script>
<?php $this->options->tongji(); ?>
<script src="<?php $this->options->themeUrl('js/main.js'); ?>"></script>