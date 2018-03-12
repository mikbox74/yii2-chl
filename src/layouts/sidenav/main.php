<?php
/* @var $this mikbox74\Chaldene\ChaldeneView */
$this->beginContent('@vendor/mikbox74/yii2-chl/src/layouts/main.php');
?>
<div class="app-wrap<?=($this->boxed ? ' container' : '')?>">
    <div class="app-container">
        <aside class="app-side">
            <header class="side-heading">
                <?php if ($this->countWidgetsIn('mainmenu')) { ?>
                <div class="clearfix visible-xs b-b b-wet-asphalt m-b-10">
                    <a class="b-a b-wet-asphalt visible-xs p-a-10 m-a-10 pull-right text-clouds" href="#" data-side="collapse">
                      <i class="fa fa-fw fa-bars"></i>
                    </a>
                </div>
                <?php } ?>
                <?= $this->renderBlock('app-logo') ?>
            </header>
            <div class="side-content">
                <?php if ($this->countWidgetsIn('side-heading')) { ?>
                <div class="user-panel">
                    <?= $this->renderBlock('side-heading') ?>
                </div>
                <?php } ?>
                <?php if ($this->countWidgetsIn('mainmenu')) { ?>
                <div class="side-nav">
                    <?= $this->renderBlock('mainmenu') ?>
                </div>
                <?php } ?>
            </div>
            <?php if ($this->countWidgetsIn('side-footer')) { ?>
            <footer class="side-footer">
                <?= $this->renderBlock('side-footer') ?>
            </footer>
            <?php } ?>
        </aside>

        <div class="side-visible-line hidden-xs" data-side="collapse">
            <i class="fa <?= (!$this->rtl) ? 'fa-caret-left' : 'fa-caret-right'?>"></i>
        </div>
        <div class="app-main">

            <header class="main-heading">
                <nav class="navbar navbar-default navbar-static-top shadow-2dp">
                    <div class="navbar-header">
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
</div>
<?php $this->endContent(); ?>