<!DOCTYPE html>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<html>
    <head>
       <title><?php $this->archiveTitle(array( 'category' => _t('分类 %s 下的文章'), 'search' => _t('包含关键字 %s 的文章'), 'tag' => _t('标签 %s 下的文章'), 'author' => _t('%s 发布的文章') ), '', ' - '); ?><?php $this->options->title(); ?><?php if($this->is('index')): ?> - <?php $this->options->description() ?><?php endif; ?></title>
        <meta charset="<?php $this->options->charset(); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="<?php $this->options->logoUrl();?>">
        <link rel="stylesheet" href="<?php echo $this->options->mdui_css ?>">

        <link rel="stylesheet" href="<?php $this->options->themeUrl('source/css/style.css'); ?>">
        <link rel="stylesheet" href="//at.alicdn.com/t/font_1038733_0xvrvpg9c0r.css">
        <?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw=&commentReply=&rss1=&rss2=&atom='); ?>
    </head>
