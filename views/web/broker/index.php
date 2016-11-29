<div class="bg1 inner-search">
    <input type="text" placeholder="请输入经纪人姓名" value="<?= $name?>" class="search-text"><input type="button" value="搜索" class="search-btn">
</div>
<div class="bg1">
    <div class="con">
        <h2 class="list-title s18 n">共有 <font class="orange">12345</font> 名经纪人</h2>
        <ul class="agent">
            <?php foreach ($broker_list as $item): ?>
                <li>
                    <div class="agent-img fl">
                        <img src="/static/web/photo/agent-1.png" class="fl">
                        <h3 class="s18 mt15"><?= $item->name; ?></h3>
                        <p class="mt20">职位：<?= $item->position_name; ?></p>
                    </div>
                    <div class="agent-good fl tr">
                        <strong class="orange s30 mt10 db"><?= $item->code; ?>%</strong>
                        <p class="mt10">好评率</p>
                    </div>
                    <div class="agent-phone fl tr">
                        <b class="s24 mt10 db"><?= $item->phone; ?></b>
                        <p class="mt10">联系电话</p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="page">
            <a href="/web/broker/index?page=1" title="上一页" class="page-prev">上一页</a>
            <a href="/web/broker/index?page=2" title="下一页" class="page-next">下一页</a>
        </div>
    </div>
</div>
<script>
    var menu = 'broker_menu';
</script>