<?php

/* @var $widget mikbox74\Chaldene\Widgets\SearchForm */

?>
<form action="<?=$widget->action?>" class="<?=$widget->cssClass?>">
    <div class="icon-after-input">
      <input type="text"
             value="<?=$value?>"
             class="form-control"
             name="<?=$widget->fieldName?>"
             placeholder="<?=$widget->placeholder?>">
      <div class="icon">
        <a href="#">
          <i class="fa fa-fw fa-search"></i>
        </a>
      </div>
    </div>
</form>

