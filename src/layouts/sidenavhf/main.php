<?php
/* @var $this mikbox74\Chaldene\ChaldeneView */
$this->beginContent('@vendor/mikbox74/yii2-chl/src/layouts/main.php');
?>
<div class="app-wrap<?=($this->boxed ? ' container' : '')?>">
    <header class="app-heading shadow-2dp">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <?php if ($this->countWidgetsIn('app-logo')) { ?>
                <div class="navbar-header-left b-r">
                    <?= $this->renderBlock('app-logo') ?>
                </div>
                <?php } ?>
                <nav class="nav navbar-header-nav">
                    <?php if ($this->countWidgetsIn('mainmenu')) { ?>
                    <a class="visible-xs b-r" href="#" data-side="collapse">
                        <i class="fa fa-fw fa-bars"></i>
                    </a>
                    <a class="hidden-xs b-r" href="#" data-side="mini">
                        <i class="fa fa-fw fa-bars"></i>
                    </a>
                    <?php } ?>
                    <?php if ($this->countWidgetsIn('app-search')) { ?>
                    <div class="navbar-form hidden-xs b-r">
                        <?= $this->renderBlock('app-search') ?>
                    </div>
                    <?php } ?>
                </nav>
                <?php if ($this->countWidgetsIn('app-nav')) { ?>
                <ul class="nav navbar-header-nav m-l-a">
                    <?php if ($this->countWidgetsIn('mobile-search')) { ?>
                    <li class="visible-xs b-l">
                        <a href="#top-search" data-toggle="canvas">
                          <i class="fa fa-fw fa-search"></i>
                        </a>
                    </li>
                    <?php } ?>
                    <?= $this->renderBlock('app-nav') ?>
                </ul>
                <?php } ?>
            </div>
        </nav>
    </header>
    <div class="app-container">
        <aside class="app-side">
            <?php if ($this->countWidgetsIn('side-heading')) { ?>
            <header class="side-heading user-panel">
                <?= $this->renderBlock('side-heading') ?>
            </header>
            <?php } ?>
            <?php if ($this->countWidgetsIn('mainmenu')) { ?>
            <div class="side-content side-nav">
                <?= $this->renderBlock('mainmenu') ?>
            </div>
            <?php } ?>
            <?php if ($this->countWidgetsIn('side-footer')) { ?>
            <footer class="side-footer">
                <?= $this->renderBlock('side-footer') ?>
            </footer>
            <?php } ?>
        </aside>

        <div class="side-visible-line hidden-xs" data-side="collapse">
            <i class="fa fa-caret-left"></i>
        </div>
        <div class="app-main">
            <div class="main-heading">
                <div class="dashhead bg-white">
                    <div class="dashhead-titles">
                        <?php if ($this->countWidgetsIn('dashhead-subtitle')) { ?>
                        <h6 class="dashhead-subtitle">
                            <?= $this->renderBlock('dashhead-subtitle') ?>
                        </h6>
                        <?php } ?>
                        <?php if ($this->showTitle) { ?>
                        <h3 class="dashhead-title">
                            <?= \yii\helpers\Html::encode($this->title) ?>
                        </h3>
                        <?php } ?>
                    </div>
                    <?php if ($this->countWidgetsIn('dashhead-toolbar')) { ?>
                    <div class="dashhead-toolbar">
                        <?= $this->renderBlock('dashhead-toolbar') ?>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="main-content bg-clouds">
                <div class="container-fluid p-t-15">
                    <?= \mikbox74\Chaldene\Widgets\Message::widget() ?>
                    <?= $this->renderBlock('before-content') ?>
                    <div class="box b-a">
                        <div class="box-body">
                        <?=$content?>
                        </div>
                    </div>
                    <?= $this->renderBlock('after-content') ?>
                </div>
            </div>
            <?php if ($this->countWidgetsIn('main-footer')) { ?>
            <footer class="main-footer bg-white p-a-5">
                <?= $this->renderBlock('main-footer') ?>
            </footer>
            <?php } ?>
        </div>
    </div>
    <?php if ($this->countWidgetsIn('app-footer')) { ?>
    <footer class="app-footer p-t-10 text-white">
        <div class="container-fluid">
            <?= $this->renderBlock('app-footer') ?>
        </div>
    </footer>
    <?php } ?>
    <?php if ($this->countWidgetsIn('mobile-search')) { ?>
    <div class="canvas searchblock bg-wet-asphalt is-fixed" id="top-search">
        <?= $this->renderBlock('mobile-search') ?>
    </div>
    <?php } ?>
</div>
<?php $this->endContent(); ?>