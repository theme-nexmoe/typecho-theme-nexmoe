<div class="nexmoe-widget-wrap">
    <h3 class="nexmoe-widget-title">文章归档</h3>
    <div class="nexmoe-widget">
        <ul class="category-list">
            <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 m 月')->parse('<li class="category-list-item"><a class="category-list-link mdui-ripple" href="{permalink}">{date}<span class="category-list-count">{count}</span></a></li>'); ?>
        </ul>
    </div>
</div>