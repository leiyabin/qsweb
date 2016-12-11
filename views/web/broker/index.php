<?php
use app\consts\HouseConst;

?>
<script charset="utf-8" src="/static/web/js/checkbox.js"></script>
<div class="bg1 inner-search">
    <input type="text" placeholder="请输入经纪人姓名" value="<?= $name ?>" name="broker_name" class="search-text">
    <input type="button" value="搜索" class="search-btn">
</div>
<div class="con filter">
    <form id="filter_form">
        <input type="hidden" name="broker_type" value="<?= implode(',', $broker_type) ?>">
    </form>
    <div class="filter-1 bb">
        <b class="fl">筛选：</b>
        <div class="fl filter-radio">
            <?php foreach (HouseConst::$broker_type as $key => $val): ?>
                <span>
                    <input value="<?= $key ?>"
                        <?php
                        if (in_array($key, $broker_type)) {
                            echo 'checked';
                        }
                        ?>
                           type="checkbox" id="broker_type_<?= $key ?>" name="broker_type">
                    <label for="broker_type_<?= $key ?>"></label><em><?= $val['name'] ?></em></span>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="bg1">
    <div class="con">
        <h2 class="list-title s18 n">共有 <font class="orange"><?= $total ?></font> 名经纪人</h2>
        <ul class="agent">
            <?php foreach ($broker_list as $item): ?>
                <li style="height: 140px;">
                    <div class="agent-img fl">
                        <img src="<?= $item->img_url ?>" class="fl">
                        <h3 class="s18 mt15"><?= $item->name; ?></h3>
                        <p class="mt20">职位：<?= $item->position_name; ?></p>
                        <p class="list-mark s12" style="margin-top: 18px; width: 800px;">
                            <?php foreach ($item->tag as $tag): ?>
                                <span class="<?= $tag['color'] ?>"
                                      style="border-radius:0px;padding: 0 10px;line-height:24px;">
                                    <?= $tag['name'] ?></span>
                            <?php endforeach; ?>
                        </p>
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
        <?php
        if (!empty($pages)) {
            echo '
        <div class="page" >
            <a href = "/web/broker/?page=' . $pages['pre'] . '" title = "上一页" class="page-prev" > 上一页</a >
            <a href = "/web/broker/?page=' . $pages['next'] . '" title = "下一页" class="page-next" > 下一页</a >
        </div > ';
        } ?>
    </div>
</div>
<script>
    var menu = 'broker_menu';
    $(".search-btn").click(function () {
        var value = $(".search-text").val().trim();
        if (value != '') {
            getList();
        }
    });
    var filter_form = $('#filter_form');
    $('.filter-radio').click(function () {
        var broker_type_checkbox = $(this).find('input:checkbox[name=broker_type]:checked');
        var tag = getCheckBoxStr(broker_type_checkbox);
        filter_form.find('input[name=broker_type]').val(tag);
        getList();
    });
    function getList() {
        $params = getParams();
        location.href = '/web/broker/?' + $params;
    }
    function getParams() {
        $broker_name = $('input[name=broker_name]').val().trim();
        $params = filter_form.serialize() + '&name=' + $broker_name;
        return $params;
    }
    $page_prev = $('.page-prev');
    $page_prev.attr('href', $page_prev.attr('href') + '&' + getParams());
    $page_next = $('.page-next');
    $page_next.attr('href', $page_next.attr('href') + '&' + getParams());
</script>