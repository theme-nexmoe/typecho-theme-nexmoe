<?php 
/**
 * 归档页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/_partial/head.php'); 
?>
<style>
.nexmoe-archives li {
    position: relative;
    padding: 10px 0;
}
.nexmoe-archives li::before {
    content: "";
    width: 14px;
    height: 14px;
    background: #ff4e6a;
    display: inline-block;
    vertical-align: middle;
    margin-top: -2px;
    margin-right: 11px;
    border-radius: 100%;
    border: 3px solid #fff;
    z-index: 100;
    position: relative;
}
.nexmoe-archives ul {
    list-style: none;
    padding-left: 0!important;
}
.nexmoe-archives li::after {
    content: "";
    height: 100%;
    width: 2px;
    background: rgba(255,78,106,.2);
    position: absolute;
    left: 6px;
    top: 20px;
}
.nexmoe-archives span {
    margin-right: 15px;
}
</style>
<body class="mdui-drawer-body-left">
    <?php $this->need('layout/_partial/background.php'); ?>
  <div id="nexmoe-header">
      <?php $this->need('layout/_partial/header.php'); ?>
  </div>
  <div id="nexmoe-content">
    <div class="nexmoe-primary">
<div class="nexmoe-archives">
        <div class="nexmoe-post">
            <article>
              <?php 

    $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);   
    $year=0; $mon=0; $i=0; $j=0;   
    $output = '<div id="archives">';   
    while($archives->next()):   
        $year_tmp = date('Y',$archives->created);   
        $mon_tmp = date('m',$archives->created);   
        $y=$year; $m=$mon;   
        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';   
        if ($year != $year_tmp && $year > 0) $output .= '</ul>';   
        if ($year != $year_tmp) {   
            $year = $year_tmp;   
            $output .= '<h2 >'. $year .' 年</h2><ul class="article1">';    
        }   
        $output .= '<li><span>'.date('n月d日    ',$archives->created).'</span><a href="'.$archives->permalink .'">'. $archives->title .'</a></li>'; //输出文章日期和标题   
    endwhile;   
    $output .= '</ul></li></ul></div>';
    echo $output;
?>
            </article>
        </div>
        </div>
        
    </div>
  </div>
  <?php $this->need('layout/_partial/after-footer.php'); ?>
</body>

</html>