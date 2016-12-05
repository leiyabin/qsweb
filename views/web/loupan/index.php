<?php
use app\consts\HouseConst;
use app\components\Utils;

?>
<div class="bg1 inner-search">
    <input type="text" placeholder="请输入楼盘名" name="loupan_name" class="search-text" value="<?= $loupan_name ?>">
    <input type="button" value="开始找房" class="search-btn">
</div>
<div class="con filter">
    <form id="filter_form">
        <input type="hidden" name="quxian_id" value="<?= $quxian_id ?>">
        <input type="hidden" name="area_id" value="<?= $area_id ?>">
        <input type="hidden" name="price_interval" value="<?= implode(',', $price_interval) ?>">
        <input type="hidden" name="property_type_id" value="<?= $property_type_id ?>">
        <input type="hidden" name="sale_status" value="<?= $sale_status ?>">
    </form>
    <div class="filter-1">
        <b class="fl">区域：</b>
        <div class="fl filter-area">
            <?php foreach ($quxian_list as $item): ?>
                <a href="javascript:return false"
                    <?php if ($quxian_id == $item->id) echo 'class="orange"'; ?>
                   tag="<?= $item->id ?>"><?= $item->value ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="filter-2 bb bt">
        <div class="area">
            <?php foreach ($area_list as $val): ?>
                <a href="javascript:return false"
                    <?php if ($area_id == $val->id) echo 'class="orange"'; ?>
                   tag="<?= $val->id ?>"><?= $val->name ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="filter-1 bb">
        <b class="fl">售价：</b>
        <div class="fl filter-radio sale_price">
            <?php foreach (HouseConst::$price_interval as $key => $val): ?>
                <span>
                    <input value="<?= $key ?>" type="checkbox" id="price_interval_<?= $key ?>"
                        <?php
                        if (in_array($key, $price_interval)) {
                            echo 'checked';
                        }
                        ?>
                           name="price_interval">
                    <label for="price_interval_<?= $key ?>"></label><em><?= $val ?></em></span>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="filter-1 property_type">
        <b class="fl">类型：</b>
        <?php foreach (HouseConst::$property_type as $key => $val): ?>
            <a href="javascript:return false"
                <?php if ($property_type_id == $key) echo 'class="orange"'; ?>
               tag="<?= $key ?>"><?= $val ?></a>
        <?php endforeach; ?>
    </div>
    <div class="filter-1 sale_status">
        <b class="fl">状态：</b>
        <?php foreach (HouseConst::$sale_status as $key => $val): ?>
            <a href="javascript:return false"
                <?php if ($sale_status == $key) echo 'class="orange"'; ?>
               tag="<?= $key ?>"><?= $val ?></a>
        <?php endforeach; ?>
    </div>
</div>
<div class="bg1">
    <div class="con">
        <h2 class="list-title s18 n">共找到 <font class="orange"><?= $total ?></font> 套北京新房源</h2>
        <ul class="house-list">
            <?php foreach ($loupan_list as $item): ?>
                <li>
                    <a href="/web/loupan/detail?id=<?= $item->id ?>" title="<?= $item->name ?>"><img
                            src="<?= $item->img_url ?>"></a>
                    <div class="list-info fl">
                        <h3 class="s18"><a href="/web/loupan/detail?id=<?= $item->id ?>"><?= $item->name ?></a></h3>
                        <p><?= $item->address ?></p>
                        <p><?= $item->jiju ?> - <?= $item->min_square ?>～<?= $item->max_square ?>平米</p>
                        <p><?= $item->sale_status_name ?> / <?= $item->property_type ?></p>
                        <p class="list-mark s12">
                            <?php foreach ($item->tag as $tag): ?>
                                <span class="<?= $tag['color'] ?>"><?= $tag['name'] ?></span>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    <div class="list-price fr">
                        <span class="orange"><b><?= $item->average_price ?></b>元/平</span>
                        <p>均价</p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        if (!empty($pages)) {
            echo '
        <div class="page" >
            <a href = "/web/loupan/?page=' . $pages['pre'] . '" title = "上一页" class="page-prev" > 上一页</a >
            <a href = "/web/loupan/?page=' . $pages['next'] . '" title = "下一页" class="page-next" > 下一页</a >
        </div > ';
        } ?>
    </div>
</div>
<div class="con recommend">
    <div class="title bgf"><h2>推荐楼盘</h2><span></span></div>
    <ul class="resource-list hiden">
        <?php foreach ($recommend_list as $item): ?>
            <li>
                <a href="/web/loupan/detail/?id=<?=$item->id?>" title="<?=$item->name?>"><img src="<?=$item->img_url?>"></a>
                <p class="s18"><b class="fl"><a href="/web/loupan/detail/?id=<?=$item->id?>"><?= Utils::subStr($item->name, 10) ?></a></b><span class="orange fr"><?=$item->average_price?>万/套</span></p>
                <p class="c6"><span class="fl"><?=$item->min_square?>㎡-<?=$item->max_square?>㎡</span></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<script charset="utf-8" src="/static/web/js/checkbox.js"></script>
<script>
    var menu = 'loupan_menu';
    $(function () {
        var filter_form = $('#filter_form');
        $('.filter-area').find('a').click(function () {
            var quxian_id = $(this).attr('tag');
            filter_form.find('input[name=quxian_id]').val(quxian_id);
            getList();
        });
        $('.area').find('a').click(function () {
            var area_id = $(this).attr('tag');
            filter_form.find('input[name=area_id]').val(area_id);
            getList();
        });
        $('.sale_price').click(function () {
            var price_interval_checkbox = $(this).find('input:checkbox[name=price_interval]:checked');
            var tag = getCheckBoxStr(price_interval_checkbox);
            filter_form.find('input[name=price_interval]').val(tag);
            getList();
        });
        $('.property_type').find('a').click(function () {
            var property_type_id = $(this).attr('tag');
            filter_form.find('input[name=property_type_id]').val(property_type_id);
            getList();
        });
        $('.sale_status').find('a').click(function () {
            var sale_status = $(this).attr('tag');
            filter_form.find('input[name=sale_status]').val(sale_status);
            getList();
        });

        $('.search-btn').click(function () {
            getList();
        });
        function getParams() {
            $loupan_name = $('input[name=loupan_name]').val().trim();
            $params = filter_form.serialize() + '&loupan_name=' + $loupan_name;
            return $params;
        }

        function getList() {
            $params = getParams();
            location.href = '/web/loupan/?' + $params;
        }
        var prev_href = $('.page-prev').attr('href');
        $('.page-prev').attr('href', prev_href + '&' + getParams());
        var next_href = $('.page-next').attr('href');
        $('.page-next').attr('href', next_href + '&' + getParams());
    });
</script>