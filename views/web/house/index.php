<?php
use app\consts\HouseConst;
use app\components\Utils;
?>
<div class="bg1 inner-search">
    <input type="text" placeholder="请输入房屋地址" value="<?= $address ?>" name="search-text" class="search-text">
    <input type="button" value="开始找房" class="search-btn">
</div>
<div class="con filter">
    <form id="filter_form">
        <input type="hidden" name="quxian_id" value="<?= $quxian_id ?>">
        <input type="hidden" name="area_id" value="<?= $area_id ?>">
        <input type="hidden" name="price_interval" value="<?= implode(',', $price_interval) ?>">
        <input type="hidden" name="area_interval" value="<?= implode(',', $area_interval) ?>">
        <input type="hidden" name="order_by" value="<?= $order_by ?>">
        <input type="hidden" name="address" value="<?= $address ?>">
        <input type="hidden" name="rs" value="<?= $rs ?>">
        <input type="hidden" name="property_type_id" value="<?= $property_type_id ?>">
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
    <div class="filter-2 bb bt area">
        <div>
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
    <div class="filter-1">
        <b class="fl">面积：</b>
        <div class="fl filter-radio place_area">
            <?php foreach (HouseConst::$area_interval as $key => $val): ?>
                <span>
                    <input value="<?= $key ?>" type="checkbox" id="area_interval_<?= $key ?>"
                        <?php
                        if (in_array($key, $area_interval)) {
                            echo 'checked';
                        }
                        ?>
                           name="area_interval">
                    <label for="area_interval_<?= $key ?>"></label><em><?= $val ?></em></span>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="bg1 bt">
    <div class="con">
        <div class="list-sort pt20">
            <a href="javascript:return false" order_by="">默认排序</a>
            <a href="javascript:return false" order_by="c_t">最新发布</a>
            <a href="javascript:return false" order_by="total_price">房屋总价</a>
            <a href="javascript:return false" order_by="unit_price">房屋单价</a>
            <a href="javascript:return false" order_by="build_area">房屋面积</a>
        </div>
        <h2 class="list-title s18 n">共找到 <font class="orange"><?= $total ?></font> 套北京二手房</h2>
        <ul class="house-list">
            <?php foreach ($house_list as $item): ?>
                <li>
                    <a href="/web/house/detail/?id=<?= $item->id ?>" title="<?= $item->address ?>，<?= $item->jishi ?>室
<?= $item->jitin ?>厅，<?= $item->total_price ?>万"><img src="<?= $item->house_img ?>"></a>
                    <div class="list-info fl">
                        <h3 class="s18"><a href="/web/house/detail/?id=<?= $item->id ?>"><?= $item->address ?>
                                ，<?= $item->jishi ?>室
                                <?= $item->jitin ?>厅，<?= $item->total_price ?>万</a></h3>
                        <p><?= $item->area_name ?> | <?= $item->jishi ?>室<?= $item->jitin ?>厅 | <?= $item->build_area ?>
                            平米 |
                            <?= $item->face ?> | <?= $item->decoration_name ?></p>
                        <p>位于<?= $item->in_floor ?>层（共<?= $item->total_floor ?>层）
                            <?php if (!empty($item->house_age)) echo $item->house_age ?> - <?= $item->quxian_name ?></p>
                        <p><?= $item->floor_unit ?></p>
                        <p class="list-mark s12">
                            <?php if (!empty($item->house_facility)) echo '<span class="orange"><?=$item->house_facility?></span>'; ?>
                            <?php if (!empty($item->house_description)) echo '<span class="yellow"><?=$item->house_description?></span>'; ?>
                        </p>
                        <p class="list-mark s12">
                            <?php foreach ($item->tag as $tag): ?>
                                <span class="<?= $tag['color'] ?>"><?= $tag['name'] ?></span>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    <div class="list-price fr">
                        <span class="orange"><b><?= $item->total_price ?></b>万</span>
                        <p>单价<?= $item->unit_price ?>元/平米</p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        if (!empty($pages)) {
            echo '
        <div class="page" >
            <a href = "/web/house/?page=' . $pages['pre'] . '" title = "上一页" class="page-prev" > 上一页</a >
            <a href = "/web/house/?page=' . $pages['next'] . '" title = "下一页" class="page-next" > 下一页</a >
        </div > ';
        } ?>
    </div>
</div>
<div class="con recommend">
    <div class="title bgf"><h2>推荐房源</h2><span></span></div>
    <ul class="resource-list hiden">
        <?php foreach ($recommend_list as $item): ?>
            <li>
                <a href="/web/house/detail/?id=<?=$item->id?>" title=""><img src="<?=$item->house_img?>"></a>
                <p class="s18"><b class="fl"><a href="/web/house/detail/?id=<?=$item->id?>"><?=Utils::subStr($item->address,11)?></a></b><span class="orange fr"><?=$item->total_price?>万</span></p>
                <p class="c6"><span class="fl"><?=$item->jishi?>室<?=$item->jitin?>厅<?=$item->jiwei?>卫 <?=$item->build_area?> m²</span><span class="fr"><?=round($item->unit_price/10000,1)?>万/平</span></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script charset="utf-8" src="/static/web/js/checkbox.js"></script>
<script>
    var menu = 'house_menu';
    $(function () {
        $a_list = $('.list-sort').find('a');
        $a_list.click(function () {
            $(this).siblings().removeClass('sort-this');
            $(this).addClass('sort-this');
            var order_by = $(this).attr('order_by');
            filter_form.find('input[name=order_by]').val(order_by);
            getList();

        });
        $a_list.each(function () {
            if($(this).attr('order_by') == '<?=$order_by?>'){
                $(this).addClass('sort-this');
                return false;
            }
        });
        var filter_form = $('#filter_form');
        $('.filter-area').find('a').click(function () {
            var quxian_id = $(this).attr('tag');
            filter_form.find('input[name=quxian_id]').val(quxian_id);
            getList();
        });
        function getParams() {
            $address = $('input[name=search-text]').val().trim();
            filter_form.find('input[name=address]').val($address);
            $params = filter_form.serialize() ;
            return $params;
        }

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
        $('.place_area').click(function () {
            var area_interval_checkbox = $(this).find('input:checkbox[name=area_interval]:checked');
            var tag = getCheckBoxStr(area_interval_checkbox);
            filter_form.find('input[name=area_interval]').val(tag);
            getList();
        });
        function getList() {
            $params = getParams();
            location.href = '/web/house/?' + $params;
        }
        $('.search-btn').click(function () {
            getList();
        });
        var prev_href = $('.page-prev').attr('href');
        $('.page-prev').attr('href', prev_href + '&' + getParams());
        var next_href = $('.page-next').attr('href');
        $('.page-next').attr('href', next_href + '&' + getParams());
    })
</script>