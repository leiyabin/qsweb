<?php
use app\components\Utils;
?>
<div class="bg1 detail">
    <p class="location con"><a href="/">千氏地产</a> > <a href="/web/oversea/">海外</a> > 更多案例</p>
    <div class="con bf">
        <h2 class="tc s24 pt20"><?= Utils::getValue($oversea,'title');?></h2>
        <div class="article">
            <?php echo htmlspecialchars_decode(Utils::getValue($oversea,'content')); ?>
        </div>
    </div>
</div>
<script>
    var menu = 'oversea_menu';
</script>