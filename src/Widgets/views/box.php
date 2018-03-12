<div class="box <?=$classBox?>">
    <header class="<?=$classHeader?>">
        <h4><?=$header?></h4>
        <!-- begin box-tools -->
        <div class="box-tools">
          <?php if (!empty($tools['collapse'])) { ?>
          <a class="fa fa-fw fa-window-minimize" href="#" data-box="collapse"></a>
          <?php } ?>

          <?php if (!empty($tools['box'])) { ?>
          <a class="fa fa-fw fa-window-maximize" href="#" data-fullscreen="box"></a>
          <?php } ?>

          <?php if (!empty($tools['refresh'])) { ?>
          <a class="fa fa-fw fa-refresh" href="#" data-box="refresh"></a>
          <?php } ?>

          <?php if (!empty($tools['close'])) { ?>
          <a class="fa fa-fw fa-window-close" href="#" data-box="close"></a>
          <?php } ?>
        </div>
        <!-- END: box-tools -->
    </header>
    <div class="box-body collapse in <?=$classBody?>">
        <?=$body?>
    </div>
    <?php if (!empty($footer)) { ?>
    <footer class="<?=$classFooter?>">
        <?=$footer?>
    </footer>
    <?php } ?>
</div>

