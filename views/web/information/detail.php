<?php
use app\components\Utils;
?>
<div class="bg1 detail">
    <p class="location con"><a href="/web/information/">千氏地产</a> > <a href="/web/information/?class_id=<?=$news->class_id?>"><?=$news->class_name?></a> > <?=$news->title?></p>
    <div class="con bf">
        <h2 class="tc s24 pt20"><?=$news->title?></h2>
        <p class="tc c6 mt10"><?=$news->class_name?>&nbsp;&nbsp;|&nbsp;&nbsp;<?=Utils::formatDateTime($news->c_t,'Y-m-d H:i')?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;来源：千氏地产</p>
        <div class="article">
            <?php echo htmlspecialchars_decode(Utils::getValue($news,'content')); ?>
        </div>
    </div>
</div>
<script>
    var menu = 'information_menu';
</script>