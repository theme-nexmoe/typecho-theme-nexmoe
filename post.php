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
                            $str = preg_replace('#<a href="(.*?)">(.*?)</a>#','<a href="$1" target="_blank" >$2</a>',$this->content);
                            $str = preg_replace('#\@\((.*?)\)#','<img src="https://nexmoe.com/usr/themes/catui/newpaopao/$1.png" class="biaoqing">',$str);
                            $str = preg_replace('#<h(.*?)>(.*?)</h(.*?)>#','<h$1 id="$2">$2</h$3>',$str);
                            $str = preg_replace('#<li><p>\[OPEN\](.*?)</p><ul>(.*?)</ul></li>#','<li><details open><summary><i class="mdui-icon material-icons add">add_circle</i><i class="mdui-icon material-icons remove">remove_circle</i> $1</summary><ul>$2</ul></details></li>',$str);
                            $str = preg_replace('#<li><p>(.*?)</p><ul>(.*?)</ul></li>#','<li><details><summary><i class="mdui-icon material-icons add">add_circle</i><i class="mdui-icon material-icons remove">remove_circle</i> $1</summary><ul>$2</ul></details></li>',$str);
                            $str = preg_replace('#<li>(.*?)\[Y\](.*?)</li>#','<li>$1<label class="mdui-checkbox">
                                <input type="checkbox" disabled checked>
                                <i class="mdui-checkbox-icon"></i> 
                                </label><del>$2</del></li>',$str);
                            $str = preg_replace('#<li>(.*?)\[N\](.*?)</li>#','<li>$1<label class="mdui-checkbox">
                                <input type="checkbox" disabled><i class="mdui-checkbox-icon"></i></label>$2</li>',$str);
                            $str = preg_replace('#<p>\[PIC(.*?)\]</p>(.*?)<p>\[/PIC(.*?)\]</p>#','<div class="catui-pic-$1">$2</div>',$str);
                            $str = preg_replace('#<p><img src="(.*?)"(.*?)title="(.*?)"></p>#','<p title="$3">
                            <a class="catui-pic" data-fancybox="gallery" href="$1"><img src="$1"$2title="$3"></a></p>',$str);
                            preg_match_all('/<p>\[PAGE(.*?)\]<\/p>/i',$str,$page);
                            $str = preg_replace('#<p>\[PAGE(.*?)\]</p>#','<div id="catui-page-$1">',$str);
                            $str = preg_replace('#<p>\[/PAGE(.*?)\]</p>#','</div>',$str);
                            echo $str;
                            if(isset($page[1][1])){
                                echo '<div class="mdui-tab catui-page" mdui-tab>';
                                foreach($page[1] as $id){
                                    echo '<a href="#catui-page-'.$id.'" class="mdui-ripple">'.$id.'</a>';   
                                }
                                echo '</div>';
                            }
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
