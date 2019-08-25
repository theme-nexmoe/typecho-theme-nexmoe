<aside id="nexmoe-sidebar">
  <?php 
    $widget = explode(",",$this->options->widget);
    foreach($widget as $item){
        $this->need('layout/_widget/'.$item.'.php');
    }
  ?>
</aside>