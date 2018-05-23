<?php
/* @var $this mikbox74\Chaldene\ChaldeneView */
$this->beginContent('@vendor/mikbox74/yii2-chl/src/layouts/main.php');
?>
<div class="app-auth">
    <div class="app-login">
        <div class="text-center box shadow-5 animated fadeInLeft b-r-4 p-a-20">
            <?= \mikbox74\Chaldene\Widgets\Message::widget() ?>
            <?=$content?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>
