<?php
/**
 * GitHub：https://github.com/nexmoe/typecho-theme-nexmoe
 * 欢迎使用、star、贡献
 * QQ群：482634342
 * @package Nexmoe
 * @author 折影轻梦
 * @version 1.0
 * @link https://nexmoe.com/
 */
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
        
        <section class="nexmoe-posts" id="brand-waterfall">
            <?php while($this->next()): ?>
            <div class="nexmoe-post">
                <a href="<?php $this->permalink() ?>">
                    <div class="nexmoe-post-cover mdui-ripple"> 
                        <?php if ($this->fields->Cover){ ?>
                            <img src="<?php echo $this->fields->Cover ?>">
                        <?php } else { ?>
                            <img src="<?php echo $this->options->background ?>">
                        <?php } ?>
                        <h1><?php $this->title() ?></h1>
                    </div>
                </a>
                <div class="nexmoe-post-meta">
                    <a><i class="nexmoefont icon-calendar-fill"></i><?php $this->date('Y年n月d日');?></a>
                    <a><?php artCount($this->cid);?> 汉字</a>
                    <a><?php post_view($this);?> 围观</a>
                    <a><?php $this->commentsNum('%d'); ?> 评论</a>
                    <?php $this->category(','); ?>
                    <?php $this->tags(' ', true); ?>
                </div>
                <article>
                    <?php $this->content(''); ?>
                </article>
            </div>
            <?php endwhile; ?>
        </section>
        
        <?php $this->need('layout/_partial/paginator.php'); ?>
        
    </div>
  </div>
  <?php $this->need('layout/_partial/after-footer.php'); ?>
</body>

</html>