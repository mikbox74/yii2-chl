<?php
/* @var $this mikbox74\Chaldene\ChaldeneView */
$this->beginContent('@vendor/mikbox74/yii2-chl/src/layouts/main.php');
$bundle = Yii::$app->assetManager->getBundle(\mikbox74\Chaldene\Assets\ChaldeneAsset::class);
$this->registerCss('
    .app {
      background-image: url("' . $bundle->baseUrl . '/img/bg.svg");
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
