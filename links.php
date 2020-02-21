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
	.link-area {
	font-size:0;
	margin-left:-4px;
	width:calc(100% + 8px)
}
.link-area a {
	border:none!important;
	margin:4px;
	box-sizing:border-box;
	display:inline-block;
	border-radius:3px;
	background:#fff;
	box-shadow:0 0 0 1px #eee
}
.link-area a:before {
	display:none
}
.link-area img {
	width:115px;
	max-width:200px;
	margin:0;
	border-radius:3px 3px 0 0;
	box-shadow:none
}
.link-area p {
	width:100%;
	margin:0!important;
	font-size:14px;
	padding:8px;
	text-align:center;
	box-sizing:border-box;
	overflow:hidden;
	text-overflow:ellipsis;
	white-space:nowrap;
	text-transform:none;
	color:#5a5f69
}
@media screen and (max-width:850px) {
	.link-area a {
	width:calc(33.333333333333336% - 8px)
}
}@media screen and (min-width:1920px) {
	.link-area a {
	width:calc(10% - 8px)
}
}@media screen and (min-width:2560px) {
	.link-area a {
	width:calc(8.333333333333334% - 8px)
}
</style>
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
                            $str = preg_replace('#<li>(.*?)<a href="(.*?)">(.*?)</a></li>#','<a class="mdui-ripple" href="$2" target="_blank" >$1<p>$3</p></a>',$str);
                            $str = preg_replace('#<ul>#','<div class="link-area">', $str);
                            $str = preg_replace('#</ul>#','</div>', $str);
                         
                            $str = preg_replace('#<a href="(.*?)">(.*?)</a>#','<a href="$1" target="_blank" >$2</a>',$str);
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
</body>

</html>