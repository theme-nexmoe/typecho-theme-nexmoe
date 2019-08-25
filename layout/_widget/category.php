  <div class="nexmoe-widget-wrap">
    <h3 class="nexmoe-widget-title">文章分类</h3>
    <div class="nexmoe-widget">
        <ul class="category-list">
        <?php $this->widget('Widget_Metas_Category_List')->to($mates); ?>
        <?php while($mates->next()): ?>
            <li class="category-list-item">
                <a class="category-list-link mdui-ripple" href="<?php $mates->permalink(); ?>" title="<?php $mates->name(); ?>"><?php $mates->name(); ?></a>
            </li>
        <?php endwhile; ?>
        </ul>
    </div>
  </div>