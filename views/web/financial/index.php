<div class="finance-banner"></div>
<div class="bg1">
    <ul class="con finance">
        <?php foreach ($financial_list as $item): ?>
        <li>
            <a href="/web/financial/detail/?id=<?= $item->id?>"><img src="<?= $item->img_url?>"></a>
            <div>
                <h3 class="s24"><a href="/web/financial/detail/?id=<?= $item->id?>"><?= $item->title?></a></h3>
                <p><?= $item->summary?>...</p>
                <a href="/web/financial/detail/?id=<?= $item->id?>" class="finance-more">了解更多</a>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php
    if(!empty($pages)){
        echo '
        <div class="page" >
            <a href = "/web/financial/?page='.$pages['pre'].'" title = "上一页" class="page-prev" > 上一页</a >
            <a href = "/web/financial/?page='.$pages['next'].'" title = "下一页" class="page-next" > 下一页</a >
        </div > ';
    } ?>
</div>
<script>
    var menu = 'financial_menu';
</script>