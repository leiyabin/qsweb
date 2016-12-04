<?php
use app\consts\HouseConst;

?>
<div class="bg1 inner-search">
    <input type="text" placeholder="请输入楼盘名称" class="search-text"><input type="button" value="开始找房" class="search-btn">
</div>
<div class="con filter">
    <form id="filter_form">
        <input type="hidden" name="quxian_id" value="<?= $quxian_id ?>">
        <input type="hidden" name="area_id" value="<?= $area_id ?>">
        <input type="hidden" name="price_interval" value="<?= implode(',', $price_interval) ?>">
        <input type="hidden" name="area_interval" value="<?= implode(',', $area_interval) ?>">
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
            <?php foreach ($area_list as $key => $val): ?>
                <a href="javascript:return false"
                    <?php if ($area_id == $key) echo 'class="orange"'; ?>
                   tag="<?= $key ?>"><?= $val->name ?></a>
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
            <a href="javascript:return false" class="sort-this">默认排序</a>
            <a href="javascript:return false">最新发布</a>
            <a href="javascript:return false">房屋总价</a>
            <a href="javascript:return false">房屋单价</a>
            <a href="javascript:return false">房屋面积</a>
            <a href="javascript:return false">最近热门</a>
            <a href="javascript:return false">地铁距离近</a>
        </div>
        <h2 class="list-title s18 n">共找到 <font class="orange">32461</font> 套北京二手房</h2>
        <ul class="house-list">
            <li>
                <a href="/web/house/detail/" title="新城经典东向大三"><img src="/static/web/photo/img-1.jpg"></a>
                <div class="list-info fl">
                    <h3 class="s18"><a href="/web/house/detail/">新城经典东向大三居，高层观景 视野棒，满五唯一</a></h3>
                    <p>望京新城 | 3室2厅 | 142.93平米 | 东南 | 精装 | 有电梯</p>
                    <p>高楼层(共25层) 2000年建板塔结合 - 望京</p>
                    <p>98人关注 / 共27次带看 / 14天以前发布</p>
                    <p class="list-mark s12"><span class="orange">白家庄小学望京校区</span><span
                            class="yellow">距离15号线望京站517米</span><span class="green">满五唯一</span><span
                            class="blue">随时看房</span>
                    </p>
                </div>
                <div class="list-price fr">
                    <span class="orange"><b>865</b>万</span>
                    <p>单价60520元/平米</p>
                </div>
            </li>
            <li>
                <a href="/web/house/detail/" title=""><img src="/static/web/photo/img-2.jpg"></a>
                <div class="list-info fl">
                    <h3 class="s18"><a href="/web/house/detail/">稀缺南北通透复式三居室 业主靠谱 看房方便</a></h3>
                    <p>望京新城 | 3室2厅 | 142.93平米 | 东南 | 精装 | 有电梯</p>
                    <p>高楼层(共25层) 2000年建板塔结合 - 望京</p>
                    <p>98人关注 / 共27次带看 / 14天以前发布</p>
                    <p class="list-mark s12"><span class="yellow">距离15号线望京站517米</span><span
                            class="green">满五唯一</span><span class="blue">随时看房</span></p>
                </div>
                <div class="list-price fr">
                    <span class="orange"><b>265</b>万</span>
                    <p>单价6520元/平米</p>
                </div>
            </li>
            <li>
                <a href="/web/house/detail/" title=""><img src="/static/web/photo/img-3.jpg"></a>
                <div class="list-info fl">
                    <h3 class="s18"><a href="/web/house/detail/">新城经典东向大三居，高层观景 视野棒，满五唯一</a></h3>
                    <p>望京新城 | 3室2厅 | 142.93平米 | 东南 | 精装 | 有电梯</p>
                    <p>高楼层(共25层) 2000年建板塔结合 - 望京</p>
                    <p>98人关注 / 共27次带看 / 14天以前发布</p>
                    <p class="list-mark s12"><span class="orange">白家庄小学望京校区</span><span
                            class="green">满五唯一</span><span class="blue">随时看房</span></p>
                </div>
                <div class="list-price fr">
                    <span class="orange"><b>865</b>万</span>
                    <p>单价60520元/平米</p>
                </div>
            </li>
            <li>
                <a href="/web/house/detail/" title=""><img src="/static/web/photo/img-4.jpg"></a>
                <div class="list-info fl">
                    <h3 class="s18"><a href="/web/house/detail/">稀缺南北通透复式三居室 业主靠谱 看房方便</a></h3>
                    <p>望京新城 | 3室2厅 | 142.93平米 | 东南 | 精装 | 有电梯</p>
                    <p>高楼层(共25层) 2000年建板塔结合 - 望京</p>
                    <p>98人关注 / 共27次带看 / 14天以前发布</p>
                    <p class="list-mark s12"><span class="yellow">距离15号线望京站517米</span><span
                            class="green">满五唯一</span></p>
                </div>
                <div class="list-price fr">
                    <span class="orange"><b>265</b>万</span>
                    <p>单价6520元/平米</p>
                </div>
            </li>
            <li>
                <a href="/web/house/detail/" title=""><img src="/static/web/photo/img-5.jpg"></a>
                <div class="list-info fl">
                    <h3 class="s18"><a href="/web/house/detail/">新城经典东向大三居，高层观景</a></h3>
                    <p>望京新城 | 3室2厅 | 142.93平米 | 东南 | 精装 | 有电梯</p>
                    <p>高楼层(共25层) 2000年建板塔结合 - 望京</p>
                    <p>98人关注 / 共27次带看 / 14天以前发布</p>
                    <p class="list-mark s12"><span class="orange">白家庄小学望京校区</span><span
                            class="yellow">距离5号线望京站17米</span><span class="blue">随时看房</span></p>
                </div>
                <div class="list-price fr">
                    <span class="orange"><b>123865</b>万</span>
                    <p>单价12160520元/平米</p>
                </div>
            </li>
        </ul>
        <div class="page"><a href="" title="上一页" class="page-prev">上一页</a><a href="" title="下一页"
                                                                             class="page-next">下一页</a>
        </div>
    </div>
</div>
<div class="con recommend">
    <div class="title bgf"><h2>推荐房源</h2><span></span></div>
    <ul class="resource-list hiden">
        <li>
            <a href="/web/loupan/detail/" title="兴都苑"><img src="/static/web/photo/img-1.jpg"></a>
            <p class="s18"><b class="fl"><a href="">兴都苑</a></b><span class="orange fr">380万</span></p>
            <p class="c6"><span class="fl">3室2厅1卫 110 m²</span><span class="fr">3.5万/平</span></p>
        </li>
        <li>
            <a href="/web/loupan/detail/" title=""><img src="/static/web/photo/img-2.jpg"></a>
            <p class="s18"><b class="fl"><a href="">华芳园</a></b><span class="orange fr">450万</span></p>
            <p class="c6"><span class="fl">3室2厅1卫 110 m²</span><span class="fr">3.5万/平</span></p>
        </li>
        <li>
            <a href="/web/loupan/detail/" title=""><img src="/static/web/photo/img-3.jpg"></a>
            <p class="s18"><b class="fl"><a href="">朝阳公园西里北区</a></b><span class="orange fr">380万</span></p>
            <p class="c6"><span class="fl">3室2厅1卫 110 m²</span><span class="fr">3.5万/平</span></p>
        </li>
        <li>
            <a href="/web/loupan/detail/" title=""><img src="/static/web/photo/img-4.jpg"></a>
            <p class="s18"><b class="fl"><a href="">天赐良园二期</a></b><span class="orange fr">580万</span></p>
            <p class="c6"><span class="fl">3室2厅1卫 110 m²</span><span class="fr">3.5万/平</span></p>
        </li>
    </ul>
</div>

<script charset="utf-8" src="/static/web/js/checkbox.js"></script>
<script>
    var menu = 'house_menu';
    $(function () {
        $('.list-sort').find('a').click(function () {
            $(this).siblings().removeClass('sort-this');
            $(this).addClass('sort-this');
        });
        var filter_form = $('#filter_form');
        $('.filter-area').find('a').click(function () {
            var quxian_id = $(this).attr('tag');
            filter_form.find('input[name=quxian_id]').val(quxian_id);
            getList();
        });
        function getParams() {
//            $loupan_name = $('input[name=loupan_name]').val().trim();
//            $params = filter_form.serialize() + '&loupan_name=' + $loupan_name;
            return filter_form.serialize();
        }

        $('.area').find('a').click(function () {
            var area_id = $(this).attr('tag');
            filter_form.find('input[name=area_id]').val(area_id);
            getList();
        });
        $('.sale_price').click(function () {
            var price_interval_checkbox = $(this).find('input:checkbox[name=price_interval]:checked');
            var tag = getCheckBoxStr(price_interval_checkbox);
            console.log(tag);
            filter_form.find('input[name=price_interval]').val(tag);
            getList();
        });
        $('.place_area').click(function () {
            var area_interval_checkbox = $(this).find('input:checkbox[name=area_interval]:checked');
            var tag = getCheckBoxStr(area_interval_checkbox);
            console.log(tag);
            filter_form.find('input[name=area_interval]').val(tag);
            getList();
        });
        function getList() {
            $params = getParams();
            location.href = '/web/house/?' + $params;
        }
    })
</script>