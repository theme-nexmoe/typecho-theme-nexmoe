<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeInit($archive){
    Helper::options()->commentsAntiSpam = false; 
}

function themeConfig($form){
	$logoUrl=new Typecho_Widget_Helper_Form_Element_Text('logoUrl',NULL,"https://avatar.dawnlab.me/qq/776194970?s=0",_t ('博客头像'),_t ('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO<br>可使用QQ头像链接作为LOGO https://avatar.dawnlab.me/qq/（这里填QQ）'));
	$form->addInput ($logoUrl);
	$background=new Typecho_Widget_Helper_Form_Element_Text('background',NULL,'https://nexmoe.com/images/5c3aec85a4343.jpg',_t ('博客默认封面图'),_t ('在这里填入一个图片URL地址, 给博客添加一个默认封面图'));
	$form->addInput ($background);
	$tongji=new Typecho_Widget_Helper_Form_Element_Textarea('tongji',NULL,'<script src="https://mixcm.com/core.js"></script>',_t ('统计代码'),_t ('为你的网站添加统计代码'));
	$form->addInput ($tongji);
}

function themeFields($layout) {
    $Cover = new Typecho_Widget_Helper_Form_Element_Textarea('Cover', NULL, NULL, _t('自定义缩略图'), _t('输入缩略图地址'));
    $layout->addItem($Cover);
}

function  artCount ($cid){
	$db=Typecho_Db::get ();
	$rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
	$text=preg_replace("/[^\x{4e00}-\x{9fa5}]/u","",$rs['text']);
	echo mb_strlen($text,'UTF-8');
}

function  post_view ($archive){
	$cid=$archive->cid ;
	$db=Typecho_Db::get ();
	$prefix=$db->getPrefix ();
	if (!array_key_exists('viewsNum',$db->fetchRow ($db->select ()->from ('table.contents')))){
		$db->query ('ALTER TABLE `'.$prefix.'contents` ADD `viewsNum` INT(10) DEFAULT 0;');
		echo 0;
		return ;
	}
	$row=$db->fetchRow ($db->select ('viewsNum')->from ('table.contents')->where ('cid = ?',$cid));
	if ($archive->is ('single')){
		$views=Typecho_Cookie::get ('extend_contents_viewsNum');
		if (empty($views)){
			$views=array ();
		}else {
			$views=explode(',',$views);
		}
		if (!in_array($cid,$views)){
			$db->query ($db->update ('table.contents')->rows (array ('viewsNum'=>(int )$row['viewsNum']+1))->where ('cid = ?',$cid));
			array_push($views,$cid);
			$views=implode(',',$views);
			Typecho_Cookie::set ('extend_contents_viewsNum',$views);
			//记录查看cookie
		}
	}
	echo $row['viewsNum'];
}

function comment_at($coid){
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')
        ->from('table.comments')
        ->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $parent, 'approved'));
        $author = $arow['author'];
        $href   = '<a class="at" href="#comment-'.$parent.'">回复 '.$author.':</a> ';
        echo $href;
    } else {
        echo '';
    }
}

function  cid_info ($cid,$biao){
	$db=Typecho_Db::get ();
	$rs=$db->fetchRow ($db->select ('table.contents.'.$biao)->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
	return $rs[$biao];
}

/**
 * 获取标签数目
 * https://github.com/typecho/typecho/blob/master/var/Widget/Stat.php
 * @return integer
 */
function tagsNum() {
    $db=Typecho_Db::get ();
    return $db->fetchObject($db->select(array('COUNT(mid)' => 'num'))
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