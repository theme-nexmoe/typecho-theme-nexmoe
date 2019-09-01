<div id="nexmoe-background">
    <div class="nexmoe-bg" style="background-image: url(<?php echo $this->options->background ?>)"></div>
    <div class="mdui-appbar mdui-shadow-0">
        <div class="mdui-toolbar">
            <a mdui-drawer="{target: '#drawer', swipe: true}" title="menu" class="mdui-btn mdui-btn-icon"> <i class="mdui-icon material-icons">menu</i>
            </a>
            <div class="mdui-toolbar-spacer"></div>
            <a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>" class="mdui-btn mdui-btn-icon">
                <img src="<?php $this->options->logoUrl();?>">
            </a>
        </div>
    </div>
</div>