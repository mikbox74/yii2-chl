<?php
/* @var $this mikbox74\Chaldene\ChaldeneView */
use mikbox74\Chaldene\ChaldeneHelper;
$this->beginContent('@vendor/mikbox74/yii2-chl/src/layouts/main.php');
$this->registerCss('
    .app {
      background-image: url("' . ChaldeneHelper::getAssetUrl() . '/img/bg.svg");
      background-repeat: no-repeat;
      background-size: cover;
    }
');
?>
<div class="app-login">
    <div class="text-center box shadow-5 animated fadeInLeft b-r-4 p-a-20">
        <?=$content?>
    </div>
</div>
<?php $this->endContent(); ?>
