<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/_partial/head.php'); 
?>
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
            </div>
            <article>
                <?php $this->content(''); ?>
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