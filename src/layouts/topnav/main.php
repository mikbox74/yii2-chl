<?php $this->beginContent('@vendor/mikbox74/yii2-chl/src/layouts/main.php'); ?>
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
                    <a class="visible-xs b-r"
                       href="#top-nav-list"
                       data-toggle="collapse" aria-expanded="false">
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
                <div class="m-l-a">
                    <?= $this->renderBlock('app-nav') ?>
                </div>
                <?php } ?>
            </div>
        </nav>
    </header>
    <div class="app-container">
        <div class="app-main">
            <?php if ($this->countWidgetsIn('mainmenu')) { ?>
            <div class="main-heading">
                <nav class="top-nav shadow-2dp navbar-collapse collapse" id="top-nav-list">
                    <?= $this->renderBlock('mainmenu') ?>
                </nav>
            </div>
            <?php } ?>
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
                    <?=$content?>
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
<?php $this->endContent(); ?>


