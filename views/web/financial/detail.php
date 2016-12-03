<?php
use app\components\Utils;
?>
<div class="bg1 detail">
    <p class="location con"><a href="/">千氏地产</a> > <a href="/web/financial/">千誉金融</a> ><?= $financial->title ?></p>
    <div class="con bf">
        <h2 class="tc s24 pt20"><?= $financial->title ?></h2>
        <p class="tc c6 mt10">千誉金融&nbsp;&nbsp;|&nbsp;&nbsp;<?= Utils::formatDateTime($financial->c_t,'Y-m-d H:i')?></p>
        <div class="article">
            <?php echo htmlspecialchars_decode(Utils::getValue($financial,'content')); ?>
        </div>
    </div>
</div>
<script>
    var menu = 'financial_menu';
</script>