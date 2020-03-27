<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/_partial/head.php');
?>
<style>
.nexmoe-valign {
    display: -webkit-box!important;
    display: -webkit-flex!important;
    display: -ms-flexbox!important;
    display: flex!important;
    -webkit-box-align: center!important;
    -webkit-align-items: center!important;
    -ms-flex-align: center!important;
    align-items: center!important;
    height: 100%;
}
	.mdui-tab-indicator {
		display: none;
	}
	.mdui-tab .mdui-tab-active {
    color: #fff;
    background: #f4a7b9;
    opacity: 1;
}
.nexmoe-post-right .nexmoe-toc {
    margin-left: 16px;
    width: 240px;
    margin-left: 0px;
    text-align: left;
}
.nexmoe-post-right .nexmoe-toc>ol {
    padding-left: 0;
}
	.nexmoe-post-right .nexmoe-fixed {
    position: fixed;
    z-index: 1000;
    height: 100vh;
    display: inline-block;
    top: 0;
}
.nexmoe-post-right {
    margin: 0 -25px;
    text-align: right;
}
.nexmoe-post-right .nexmoe-toc li {
    margin: 1em 0;
}
.nexmoe-toc a {
    color: rgba(0,0,0,.6);
}
.nexmoe-toc * {
    list-style-type: decimal;
    color: rgba(0,0,0,.6);
    
}

.hljs {
    font-family: Consolas,Monaco,'Andale Mono','Ubuntu Mono',monospace;
}

</style>
        <link rel="stylesheet" href="<?php echo $this->options->highlight_css ?>">
        <link rel="stylesheet" href="<?php echo $this->options->fancybox_css ?>">
<body class="mdui-drawer-body-left">
      <?php $this->need('layout/_partial/background.php'); ?>
  <div id="nexmoe-header">
      <?php $this->need('layout/_partial/header.php'); ?>
  </div>
  <div id="nexmoe-content">
    <div class="nexmoe-primary">

        <div class="nexmoe-post">
            <div class="nexmoe-post-cover mdui-ripple">
                <?php if ($this->fields->Cover){ ?>
                    <img src="<?php echo $this->fields->Cover ?>">
                <?php }  else{ ?>
                    <img src="<?php echo $this->options->background ?>">
                <?php } ?>
                <h1><?php $this->title() ?></h1>
            </div>
            <div class="nexmoe-post-meta">
                <a><i class="nexmoefont icon-calendar-fill"></i><?php $this->date('Y年n月d日');?></a>
                <a><?php artCount($this->cid);?> 汉字</a>
                <a><?php post_view($this);?> 围观</a>
                <a><?php $this->commentsNum('%d'); ?> 评论</a>
                <?php $this->category(','); ?>
                <?php $this->tags(' ', true); ?>
            </div>
            <article>
               <?php
$content = preg_replace('#<h(.*?)>(.*?)</h(.*?)>#','<h$1 id="$2">$2</h$3>',$this->content);
echo $content;
?>

            </article>
		 <div class="nexmoe-post-right"><div class="nexmoe-fixed"><div class="nexmoe-valign"><div class="nexmoe-toc"><ol class="toc"><?php getCatalog(); ?></ol></div></div></div></div>
            <div id="comments">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>
    </div>
  </div>
  <?php $this->need('layout/_partial/after-footer.php'); ?>
<?php if (!empty($this->options->function) && in_array('fancybox', $this->options->function)): ?>
<script src="<?php echo $this->options->fancybox_js ?>"></script>
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

</body>

</html>
