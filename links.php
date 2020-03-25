<?php 
/**
 * 友情链接
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/_partial/head.php'); 
?>
<style>
article ul li {
    transition: all .03s;
    width: calc(12.5% - 10px);
    margin: 5px;
    border-radius: 4px;
    border: 1px solid #eee;

    overflow: hidden;
}

article ul {
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    margin: -5px;
}

article ul li img {
  height:110px;
    width: 100%;
    border-radius: 0;
    border: none;
    display: block;
}
      article ul li a {
 top: 10px;
    font-size: 15px;
    color: #606266;
    -webkit-transition: none;
    transition: none;
 margin-bottom: 5px;
    display: block;
    position: relative;
    width: 100%;
    border: none;
height:30px;
    margin-top: -2px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
@media screen and (max-width: 768px) {
article ul li {
    width: calc(33.3333333333% - 10px);
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
           
            <article>
                            <?php
                            $str = preg_replace('#<li>(.*?)</li>#','<li>$1</li>', $this->content);
                          $str = preg_replace('#<li></li>#','<li>$1<a href="$2"><p>$3</p></a>',$str);
                            $str = preg_replace('#<ul>#','<ul>', $str);
                            $str = preg_replace('#</ul>#','</ul>', $str);
                         
                            $str = preg_replace('#<a href="(.*?)">(.*?)</a>#','<a href="$1"  target="_blank" >$2</a>',$str);
                            echo $str;
                            ?>
            </article>
            <div id="comments">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>
        
        
    </div>
  </div>
  <?php $this->need('layout/_partial/after-footer.php'); ?>
   <script src="<?php echo $this->options->jquery_js ?>"></script>

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
