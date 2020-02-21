<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
$textarea = Helper::options()->commentsHTMLTagAllowed;
function threadedComments($comments, $options) {
    $commentClass = '站外';
    if ($comments->authorId) {
        if($comments->authorId == $comments->ownerId) {
            $commentClass = '作者';
        }elseif($comments->authorId == 1){
            $commentClass = '站长';
        }else{
            $commentClass = '站内';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels +1;
    if ($comments->url) {
        $author = '<a href="'.$comments->url.'"target="_blank" rel="external nofollow" tooltip="'.$comments->author.'">'.$comments->author.'</a>';
    } else {
        $author = $comments->author;
    }
?>
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
if ($depth > 1 && $depth < 3) {
    echo ' comment-child ';
    $comments->levelsAlt('comment-level-odd', ' comment-level-even');
}
else if( $depth > 2){
    echo ' comment-child2';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
}
else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
?>">
    <div id="<?php $comments->theId(); ?>">
         <?php
            $host = '//avatar.dawnlab.me';
            $url = '/gravatar/';
            $size = '100';
            $rating = Helper::options()->commentsAvatarRating;
            $hash = md5(strtolower($comments->mail));
            $email = strtolower($comments->mail);
            $sjtx = Typecho_Widget::widget('Widget_Options')->motx;
            $qq = str_replace('@qq.com','',$email);
            if(strstr($email,"qq.com") && is_numeric($qq)){
              $avatar = '//avatar.dawnlab.me/qq/'.$qq;
            }else{
              $avatar = $host.$url.$hash.'?s='.$size.'&r='.$rating.'&d='.$sjtx;
            }
        ?>
        <div class="comment-view">
            <div class="comment-header">
                <a href="<?php echo $comments->url; ?>"target="_blank" rel="external nofollow"><img class="avatar" src="<?php echo $avatar ?>"></a>
            </div>
            <div class="comment-content">
                <div class="comment-meta">
                    <span class="comment-author mdui-ripple"><?php echo $author; ?></span>
                    <span class="comment-time mdui-ripple"><?php $comments->date('n月j日'); ?></span>
                    <span class="comment-reply mdui-ripple" data-no-instant><?php $comments->reply('回复'); ?></span>
                </div>
                <div class="comment-text">
                <?php 
                comment_at($comments->coid);
                $cos = preg_replace('#\@\((.*?)\)#','<img src="//i.chainwon.com/usr/themes/catui/newpaopao/$1.png" class="biaoqing">',$comments->content);
                $cos1 = preg_replace('#<p>#','',$cos);
                $cos2 = preg_replace('#</p>#','',$cos1);
                echo $cos2;
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>
<?php } ?>


<div class="comment">
    <h1 class="icon icon-bubbles"> <?php $this->commentsNum('%d'); ?> 评论</h1>
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
    <div class="comment-respond" id="<?php $this->respondId(); ?>">
        <div class="cancel-comment-reply" data-no-instant>
        <?php $comments->cancelReply(); ?>
        </div>
    	<form class="comment-form"  method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <textarea name="text" id="textarea" placeholder='允许使用的HTML标签：<?php echo $textarea; ?>'><?php $this->remember('text'); ?></textarea>
            <div class="comment-form-tab">
                <a class="mdui-ripple icon icon-emotsmile" onclick="get_sider_catui_item_fixed('OwO');"></a>
                <button class="mdui-ripple" type="submit" id="comment-btn"><i class="mdui-icon material-icons">send</i></button>
            </div>
            <?php if($this->user->hasLogin()): ?>
            <?php else: ?>
    		<input type="text" name="author" id="author" class="text" placeholder="称呼" value="<?php $this->remember('author'); ?>">
    		
    		<?php if ($this->options->commentsRequireMail): ?>
    	    <input type="email" name="mail" id="mail" class="text" placeholder="Email" value="<?php $this->remember('mail'); ?>">
    	    <?php endif; ?>
    	    
    	    <?php if ($this->options->commentsRequireURL): ?>
    		<input type="url" name="url" id="url" class="text" placeholder="http://" value="<?php $this->remember('url'); ?>">
    		<?php endif; ?>
    		
            <?php endif; ?>
    	</form>
    </div>
    
    <?php else: ?>
    <h1><?php _e('评论已关闭'); ?></h1>
    <?php endif; ?>
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    
    <?php endif; ?>
</div><!-- .comment -->

<script>
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
        create : function (tag, attr) {
            var el = document.createElement(tag);
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
            return el;
        },
        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php echo $this->respondId(); ?>'),
                input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];
            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });
                form.appendChild(input);
            }
            input.setAttribute('value', coid);
            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });
                response.parentNode.insertBefore(holder, response);
            }
            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';
            if (null != textarea && 'text' == textarea.name 

) {
                textarea.focus();
            }
            return false;
        },
        cancelReply : function () {
            var response = this.dom('<?php echo $this->respondId(); ?>'),
            holder = this.dom('comment-form-place-holder'),
            input = this.dom('comment-parent');
            if (null != input) {
                input.parentNode.removeChild(input);
            }
            if (null == holder) {
                return true;
            }
            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
</script>

<style>
#comments .comment h1 {
    text-align:center;
    color:#7a7b7c;
    margin:35px
}
#comments .comment h1::before {
    margin-top:-9px;
    vertical-align:middle;
    display:inline-block
}
#comments .comment .comment-respond .comment-form {
    font-size:0;
    overflow:hidden;
    box-shadow:0 0 0 1px #f5f6f9;
    position:relative
}
#comments .comment .comment-respond .comment-form textarea {
    transition:all .35s;
    resize:none;
    border:none;
    padding:10px;
    padding-bottom:40px;
    font-size:15px;
    width:100%;
    height:100px;
    color:#5b6064;
    box-sizing:border-box
}
#comments .comment .comment-respond .comment-form .comment-form-tab {
    height:30px;
    position:absolute;
    right:0;
    top:69px;

    border-top:1px solid #f5f6f9;
    box-sizing:border-box
}
#comments .comment .comment-respond .comment-form .comment-form-tab a {
    height:26px;
    line-height:26px;
    text-align:center;
    margin:2px 5px;
    width:26px;
    border-radius:100%;
    display:inline-block;
    font-size:16px;
    color:#5a5f69
}
#comments .comment .comment-respond .comment-form .comment-form-tab a:first-child {
    margin-left:10px
}
#comments .comment .comment-respond .comment-form .comment-form-tab button {
    position:absolute;
    height:50px;
    border-radius:100%;
    width:50px;
    border:none;
    background:#f4a7b9;
    color:#fff;
    right:15px;
    top:-25px;
    box-shadow:0 2px 6px rgba(0, 64, 128, .2);
    display: -webkit-box!important;
    display: -ms-flexbox!important;
    display: flex!important;
    -webkit-box-align: center!important;
    -ms-flex-align: center!important;
    align-items: center!important;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
}
#comments .comment .comment-respond .comment-form .comment-form-tab button .mdui-spinner-layer {
    border-color:#fff
}
#comments .comment .comment-respond .comment-form input {
    background:#fff;
    padding:8px 10px;
    border:none;
    font-size:14px;
    width:33.33333333333333%;
    box-sizing:border-box;
    border-right:1px solid #f5f6f9;
    border-top:1px solid #f5f6f9
}
#comments .comment .comment-respond .comment-form input:last-child {
    border-right:none
}
#comments .comment .comment-list {
    list-style:none;
    margin:0;
    background:#fff;
    padding:0
}
#comments .comment .comment-list .comment-list {
    margin-top:15px
}
#comments .comment .comment-list li {
    padding:15px;
    border-bottom:1px solid #eee
}
#comments .comment .comment-list li:last-child {
    border-bottom:none
}
#comments .comment .comment-list li:last-child .comment-time::after {
    display:none
}
#comments .comment .comment-list .comment-children {
    margin-left: 64px;
}
#comments .comment .comment-list .comment-children .comment-children {
    margin-left:0!important;
    padding-left: 0!important;
}
#comments .comment .comment-list .comment-children li {
    border-right:none;
    padding:0;
    padding-top:15px;
    margin-top:0;
    border:none
}
#comments .comment .comment-list .comment-children li:first-child {
    padding-top: 0;
    margin-top: 0;
    padding-bottom: 0;
}
#comments .comment .comment-view {
    position:relative
}
#comments .comment .comment-view .comment-header {
    float:left;
    font-size:0;
    display:block
}
#comments .comment .comment-view .comment-header img {
    height:55px;
    width:55px;
    border-radius:100%;
    box-sizing:border-box;
    background:#fff;
    box-shadow:0 0 0 1px #f5f6f9
}
#comments .comment .comment-content {
    display:inline-block;
    min-height:50px;
    margin-left:8px;
    max-width:calc(100% - 63px)
}
#comments .comment .comment-content .comment-text {
    margin:0;
    font-size:16px;
    word-wrap:break-word;
    float: left;
    width: 100%;
    margin-bottom: 10px;
}
#comments .comment .comment-content .comment-text .catui-gallery {
    font-size: 0;
}
#comments .comment .comment-content .comment-text .catui-gallery a {
    margin-right: 10px;
}
#comments .comment .comment-content .comment-text .catui-gallery a:nth-child(4n+4) {
    margin-right: 0;
}
#comments .comment .comment-content .comment-text img {
    border-radius: 10px;
    max-width: 100%;
    border: 1px solid #eee;
    box-sizing: border-box;

    margin-top: 10px;
}
#comments .comment .comment-content .at {
    transition:all .35s;
    color:#999
}
#comments .comment .comment-content .at:hover {
    color:#f4a7b9
}
#comments .comment .comment-content .comment-meta {
    font-size:15px;
    margin-bottom:8px;
    height:26px;
    line-height:30px;
}
#comments .comment .comment-content .comment-meta span {
    float:left;
    border-radius:10px;
    padding:2px 8px;
    color:#fff;
    display:inline-block;
    line-height:22px;
    margin-bottom:4px;
    margin-right:8px
}
#comments .comment .comment-content .comment-author a, #comments .comment .comment-content .comment-meta span a {
    color:#fff
}
#comments .comment .comment-content .comment-meta .comment-author {
    background:#f4a7b9
}
#comments .comment .comment-content .comment-meta .comment-class {
    background:#72afeb
}
#comments .comment .comment-content .comment-meta .comment-time {
    background:#fed466
}
#comments .comment .comment-content .comment-meta .comment-time p {
    margin:0;
    display:inline-block
}
#comments .comment .comment-content .comment-meta .comment-os {
    background:#64b9ff
}
#comments .comment .comment-content .comment-meta .comment-browser {
    background:#ffaa73
}
#comments .comment .comment-content .comment-meta .comment-reply {
    background:#fa6c6f
}
#comments .comment .comment-list .cancel-comment-reply {
    text-align:right;
    margin-bottom:10px;
    margin-top:-20px
}
#comments .comment .comment-list .cancel-comment-reply #cancel-comment-reply-link {
    border-radius:3px;
    padding:4px 20px;
    color:#fff;
    font-size:12px;
    background:#fa6c6f;
    position:relative
}
#comments .page-navigator {
    padding:10px;
    border-top:1px solid #eee
}
#comments.diary {
    overflow:hidden;
    padding:0 10px
}
#comments.diary .comment h1, #comments.diary .comment .comment-respond {
    display:none
}
#comments.diary .comment .comment-list .comment-respond, #catui-content .haslogin #comments .comment .comment-respond {
    display:block
}
#comments.diary .comment .comment-view .comment-header, #comments.diary .comment .comment-content .comment-meta .comment-author {
    display:none
}
#comments.diary .comment .comment-children .comment-view .comment-header, #comments.diary .comment .comment-children .comment-content .comment-meta .comment-author {
    display:inline-block
}
#comments.diary .comment .comment-list {
    background-color:transparent;
    margin-top:0
}
#comments.diary .comment .comment-list li {
    margin-top:20px;
    border:none;
    padding:0;
    padding-bottom:13px
}
#comments.diary .comment .comment-list .comment-children li {
    box-shadow:none
}
#comments.diary .comment .comment-respond .comment-form {
    overflow:hidden;
    border-radius:10px;
    background-color:#fff;
    border:none;
    margin-top:10px
}
#comments.diary .comment .comment-respond .comment-form textarea {
    height:260px
}
#comments.diary .comment .comment-list .comment-respond .comment-form textarea {
    height:100px
}
#comments.diary .comment .comment-form .comment-form-tab {
    top:229px
}
#comments.diary .comment .comment-list .comment-form .comment-form-tab {
    top:69px
}
#comments.diary .comment .comment-content .comment-meta .comment-time {
    width:60px;
    height:60px;
    padding:0;
    border-radius:10px;
    position: unset;
    border:3px solid #fff;
    overflow:hidden;
    box-shadow:0 0 0 1px #fed466;
}
#comments.diary .comment .comment-content .comment-meta .comment-time::after {
    content:"";
    height:100vh;
    width:2px;
    background-color:#fed466;
    position:absolute;
    left:32px;
    top:67px
}
#comments.diary .comment .comment-content .comment-meta .comment-time p {
    width:100%;
    line-height:30px;
    text-align:center
}
#comments.diary .comment .comment-content .comment-meta .comment-time p:last-child {
    background:#fff0c9;
    color:#8e8b8b
}
#comments.diary .comment .comment-children .comment-content .comment-meta .comment-time {
    width: auto;
    height: auto;
    border-radius: 10px;
    padding: 2px 8px;
    border: none;
    overflow: hidden;
    box-shadow: none;
}
#comments.diary .comment .comment-children .comment-content .comment-meta .comment-time::after {
    display:none
}
#comments.diary .comment .comment-children .comment-content .comment-meta .comment-time p {
    width:auto;
    line-height:normal
}
#comments.diary .comment .comment-children .comment-content .comment-meta .comment-time p:last-child {
    background:0 0;
    color:#fff
}
#comments.diary .comment .comment-content .comment-text {
    margin-left:73px;
    border-radius:10px;
    background-color:#f7f7f7;
    padding:12px;
    float: unset;
}
#comments.diary .comment .comment-children .comment-content .comment-text {
    margin-left:0;
    box-shadow:none;
    padding:0;
    float: left;
    margin-bottom: 10px;
}
#comments.diary .page-navigator {
    border:none
}
#comments.diary .comment .comment-content {
    margin-left:0;
    max-width:100%;
    width:100%;
    position:relative;
    margin-bottom:-12px
}
#comments.diary .comment .comment-children .comment-content {
    margin-left:8px;
    max-width:calc(100% - 63px)
}
#comments.diary .comment .comment-list .comment-children {
    border-radius:10px;
    padding:15px;
    background-color:#f7f7f7;
    margin-left: 73px;
    margin-top: 10px;
}
</style>
