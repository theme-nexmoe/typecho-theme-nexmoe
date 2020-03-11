<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeInit($archive) {
    Helper::options()->commentsAntiSpam = false;
    if ($archive->is('single')) {
    $archive->content = createCatalog($archive->content);
}
}

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl',NULL,"https://avatar.dawnlab.me/qq/776194970?s=0",'博客头像','在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO<br>可使用QQ头像链接作为LOGO https://avatar.dawnlab.me/qq/（这里填QQ）');
    $form->addInput ($logoUrl);
    $background = new Typecho_Widget_Helper_Form_Element_Text('background',NULL,'https://nexmoe.com/images/5c3aec85a4343.jpg','博客默认封面图','在这里填入一个图片URL地址, 给博客添加一个默认封面图');
    $form->addInput ($background);

    $widget = new Typecho_Widget_Helper_Form_Element_Textarea('widget',NULL,'category,tagcloud,archive','侧边栏部件','侧边栏部件，用英文的 “,” 隔开，按先后排序，可选值 category,tagcloud,archive,social,search');
    $form->addInput ($widget);
    
    $bilibili = new Typecho_Widget_Helper_Form_Element_Text('bilibili', NULL, NULL, _t('哔哩哔哩地址'), _t('社交按钮部件-哔哩哔哩'));
    $form->addInput($bilibili); 
      
    $github = new Typecho_Widget_Helper_Form_Element_Text('github', NULL, NULL, _t('github地址'), _t('社交按钮部件-github'));
    $form->addInput($github); 
        
    $zhihu = new Typecho_Widget_Helper_Form_Element_Text('zhihu', NULL, NULL, _t('知乎地址'), _t('社交按钮部件-知乎'));
    $form->addInput($zhihu); 
        
     $telegram = new Typecho_Widget_Helper_Form_Element_Text('telegram', NULL, NULL, _t('telegram地址'), _t('社交按钮部件-telegram'));
        $form->addInput($telegram); 
        
     $twitter = new Typecho_Widget_Helper_Form_Element_Text('twitter', NULL, NULL, _t('推特地址'), _t('社交按钮部件-推特'));
        $form->addInput($twitter); 
        
         $steam = new Typecho_Widget_Helper_Form_Element_Text('steam', NULL, NULL, _t('steam地址'), _t('社交按钮部件-steam'));
        $form->addInput($steam); 
    
     $game = new Typecho_Widget_Helper_Form_Element_Text('game', NULL, NULL, _t('游戏ID'), _t('社交按钮部件-游戏ID'));
        $form->addInput($game); 
        
        
        
    $function = new Typecho_Widget_Helper_Form_Element_Checkbox('function',
        array('fancybox' => '灯箱功能',
            'SmoothScroll' => '平滑滚动',
            'enableMathjax' => '全局启用Mathjax'),
        array('fancybox', 'SmoothScroll'), '功能开关');
    $form->addInput($function->multiMode());

    $mdui_css = new Typecho_Widget_Helper_Form_Element_Text('mdui_css',NULL,'https://cdn.jsdelivr.net/npm/mdui@0.4.3/dist/css/mdui.min.css','CDN > mdui > CSS',NULL);
    $form->addInput ($mdui_css);
    $mdui_js = new Typecho_Widget_Helper_Form_Element_Text('mdui_js',NULL,'https://cdn.jsdelivr.net/npm/mdui@0.4.3/dist/js/mdui.min.js','CDN > mdui > JS',NULL);
    $form->addInput ($mdui_js);

    $jquery_js = new Typecho_Widget_Helper_Form_Element_Text('jquery_js',NULL,'https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js','CDN > jquery > JS',NULL);
    $form->addInput ($jquery_js);

    $fancybox_css = new Typecho_Widget_Helper_Form_Element_Text('fancybox_css',NULL,'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css','CDN > fancybox > CSS',NULL);
    $form->addInput ($fancybox_css);
    $fancybox_js = new Typecho_Widget_Helper_Form_Element_Text('fancybox_js',NULL,'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js','CDN > fancybox > JS',NULL);
    $form->addInput ($fancybox_js);

    $SmoothScroll_js = new Typecho_Widget_Helper_Form_Element_Text('SmoothScroll_js',NULL,'https://cdn.jsdelivr.net/npm/smoothscroll-for-websites@1.4.9/SmoothScroll.min.js','CDN > SmoothScroll > JS',NULL);
    $form->addInput ($SmoothScroll_js);

    $lazysizes_js = new Typecho_Widget_Helper_Form_Element_Text('lazysizes_js',NULL,'https://cdn.jsdelivr.net/npm/lazysizes@5.1.0/lazysizes.min.js','CDN > lazysizes > JS',NULL);
    $form->addInput ($lazysizes_js);

    $highlight_css = new Typecho_Widget_Helper_Form_Element_Text('highlight_css',NULL,'https://cdn.jsdelivr.net/npm/highlight.js@9.15.8/styles/atom-one-dark.css','CDN > highlight > CSS',NULL);
    $form->addInput ($highlight_css);
    $highlight_js = new Typecho_Widget_Helper_Form_Element_Text('highlight_js',NULL,'https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.15.8/build/highlight.min.js','CDN > highlight > JS',NULL);
    $form->addInput ($highlight_js);

    $tongji = new Typecho_Widget_Helper_Form_Element_Textarea('tongji',NULL,'<script src="https://mixcm.com/core.js"></script>','统计代码','为你的网站添加统计代码');
    $form->addInput ($tongji);
}

function themeFields($layout) {
    $Cover = new Typecho_Widget_Helper_Form_Element_Textarea('Cover', NULL, NULL, '自定义缩略图', '输入缩略图地址');
    $layout->addItem($Cover);
    $math = new Typecho_Widget_Helper_Form_Element_Textarea('math', NULL, NULL, '单独控制Mathjax', '输入Yes启用，No禁用，否则跟随全局');
    $layout->addItem($math);
}

function createCatalog($obj) {
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function ($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
        return '<h'.$obj[1].$obj[2].'>'.$obj[3].'</h'.$obj[1].'>';
    }, $obj);
    return $obj;
}

function getCatalog() {
    global $catalog;
    $index = '';
    if ($catalog) {
        $index = '<ul>' . "\n";
        $prev_depth = '';
        $to_depth = 0;
        foreach ($catalog as $catalog_item) {
            $catalog_depth = $catalog_item['depth'];
            if ($prev_depth) {
                if ($catalog_depth == $prev_depth) {
                    $index .= '</li>' . "\n";
                } elseif ($catalog_depth > $prev_depth) {
                    $to_depth++;
                    $index .= '<ul>' . "\n";
                } else {
                    $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                    if ($to_depth2) {
                        for ($i = 0; $i < $to_depth2; $i++) {
                            $index .= '</li>' . "\n" . '</ul>' . "\n";
                            $to_depth--;
                        }
                    }
                    $index .= '</li>';
                }
            }
            $index .= '<li><a href="#'. $catalog_item['text'] .'">' . $catalog_item['text'] . '</a>';
            $prev_depth = $catalog_item['depth'];
        }
        for ($i = 0; $i <= $to_depth; $i++) {
            $index .= '</li>' . "\n" . '</ul>' . "\n";
        }
       
            
    }
    echo $index;
}


function  artCount ($cid) {
    $db = Typecho_Db::get ();
    $rs = $db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u","",$rs['text']);
    echo mb_strlen($text,'UTF-8');
}

function  post_view ($archive) {
    $cid = $archive->cid ;
    $db = Typecho_Db::get ();
    $prefix = $db->getPrefix ();
    if (!array_key_exists('viewsNum',$db->fetchRow ($db->select ()->from ('table.contents')))) {
        $db->query ('ALTER TABLE `'.$prefix.'contents` ADD `viewsNum` INT(10) DEFAULT 0;');
        echo 0;
        return ;
    }
    $row = $db->fetchRow ($db->select ('viewsNum')->from ('table.contents')->where ('cid = ?',$cid));
    if ($archive->is ('single')) {
        $views = Typecho_Cookie::get ('extend_contents_viewsNum');
        if (empty($views)) {
            $views = array ();
        } else {
            $views = explode(',',$views);
        }
        if (!in_array($cid,$views)) {
            $db->query ($db->update ('table.contents')->rows (array ('viewsNum' => (int)$row['viewsNum']+1))->where ('cid = ?',$cid));
            array_push($views,$cid);
            $views = implode(',',$views);
            Typecho_Cookie::set ('extend_contents_viewsNum',$views);
            //记录查看cookie
        }
    }
    echo $row['viewsNum'];
}

function comment_at($coid) {
    $db = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')
        ->from('table.comments')
        ->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $parent, 'approved'));
        $author = $arow['author'];
        $href = '<a class="at" href="#comment-'.$parent.'">回复 '.$author.':</a> ';
        echo $href;
    } else {
        echo '';
    }
}

function  cid_info ($cid,$biao) {
    $db = Typecho_Db::get ();
    $rs = $db->fetchRow ($db->select ('table.contents.'.$biao)->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    return $rs[$biao];
}

/**
 * 获取标签数目
 * https://github.com/typecho/typecho/blob/master/var/Widget/Stat.php
 * @return integer
 */
function tagsNum() {
    $db = Typecho_Db::get ();
    return $db->fetchobject($db->select(array('COUNT(mid)' => 'num'))
        ->from('table.metas')
        ->where('table.metas.type = ?', 'tag'))->num;
}

/**
 * 获取模板信息
 * 可选值 package,author,version,link
 * http://docs.qqdie.com/#/post/常用模板函数?id=获取模板版本号
 * @return string
 */
function getThemeInfo($key) {
    $info = Typecho_Plugin::parseInfo(__DIR__ . '/index.php');
    return $info[$key];
}
?>
