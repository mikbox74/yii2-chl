<?php

/* @var $this mikbox74\Chaldene\ChaldeneView */
/* @var $content string */

use yii\helpers\Html;
use mikbox74\Chaldene\Assets\ChaldeneAddonAsset;

ChaldeneAddonAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?= $this->getBodyClass() ?>">
    <?php $this->beginBody() ?>
    <div class="app">
        <?= $content ?>
    </div>
    <?php if ($this->countWidgetsIn('mobile-search')) { ?>
    <div class="canvas searchblock bg-wet-asphalt is-fixed" id="top-search">
        <a href="#top-search" data-toggle="canvas" class="canvas-toggler">
            <i class="fa fa-times"></i>
        </a>
        <?= $this->renderBlock('mobile-search') ?>
    </div>
    <?php } ?>
    <span class="fa fa-angle-up" id="totop" data-plugin="totop"></span>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
