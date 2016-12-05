<?php
use app\components\Utils;

?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6Ao1oS2kNAz4Okb3ytyGGGobMMtCz2Ef"></script>
<div class="bg1 detail">
    <div class="con hiden">
        <p class="location bd"><a href="/">千氏地产</a> > <a href="/web/house/">二手房</a></p>
        <h2 class="s18 detail-title mt10"><?= $house->address ?> <?= $house->jishi ?>室
            <?= $house->jitin ?>厅 <?= $house->total_price ?>万</h2>
        <div class="fl detail-img">
            <div class="detail-photo">
                <img id="photo-box" src=" <?= Utils::getValue($house, 'img_1', ''); ?>">
            </div>

            <div class="detail-nav">
                <a class="photo-left" href="javascript:void(0);"><</a>
                <div class="detail-nav-box">
                    <ul class="photo-nav">
                        <?php if (!empty($house->img_1)) echo '<li id="tu_1"><a href="javascript:void(0);"><img src="' . $house->img_1 . '"></a></li>' ?>
                        <?php if (!empty($house->img_2)) echo '<li id="tu_2"><a href="javascript:void(0);"><img src="' . $house->img_2 . '"></a></li>' ?>
                        <?php if (!empty($house->img_3)) echo '<li id="tu_3"><a href="javascript:void(0);"><img src="' . $house->img_3 . '"></a></li>' ?>
                        <?php if (!empty($house->img_4)) echo '<li id="tu_4"><a href="javascript:void(0);"><img src="' . $house->img_4 . '"></a></li>' ?>
                        <?php if (!empty($house->img_5)) echo '<li id="tu_5"><a href="javascript:void(0);"><img src="' . $house->img_5 . '"></a></li>' ?>
                    </ul>
                </div>
                <a class="photo-right" href="javascript:void(0);">></a>
            </div>
        </div>

        <div class="fl detail-con">
            <div class="detail-price bd">
                <span class="orange"><b><?= $house->total_price ?></b>万</span>
                <span class="c6">单价<?= $house->unit_price ?>元/平米</span>
            </div>
            <table class="bd">
                <tr>
                    <td>
                        <b class="s24"><?= $house->jishi ?>室<?= $house->jitin ?>厅</b>
                        <p class="c6">位于<?= $house->in_floor ?>层/共<?= $house->total_floor ?>层</p>
                    </td>
                    <td>
                        <b class="s24"><?= $house->face ?></b>
                        <p class="c6">平层/<?= $house->decoration_name ?></p>
                    </td>
                    <td>
                        <b class="s24"><?= $house->build_area ?>平米</b>
                        <p class="c6"><?php if (!empty($house->house_age)) echo $house->house_age . '年建' ?></p>
                    </td>
                </tr>
            </table>
            <ul style="margin-top:40px">
                <li>小区名称：<?= $house->property_company ?></li>
                <li>所在区域：<?= $house->quxian_name ?> <?= $house->area_name ?></li>
                <li>具体地址：<?= $house->address ?></li>
                <li>看房时间：提前预约随时可看</li>
            </ul>
            <div class="detail-agent hiden" style="margin-top:20px">
                <img src="<?= $house->broker_img_url ?>" class="fl">
                <p class="mt10"><b class="s18"><?= $house->broker_name ?></b> <span class="c6"></span></p>
                <strong class="orange s30"><?= $house->broker_phone ?></strong>
            </div>
        </div>
        <div class="detail-info clear">
            <h2 class="detail-title2">基本信息</h2>
            <dl class="hiden">
                <dt class="c6">基本属性</dt>
                <dd>
                    <table>
                        <tr>
                            <td>房屋户型：<?= $house->jishi ?>室<?= $house->jitin ?>厅<?= $house->jiwei ?>卫</td>
                            <td>所在楼层：<?= $house->in_floor ?>层 (共<?= $house->total_floor ?>层)</td>
                            <td>建筑面积：<?= $house->build_area ?>㎡</td>
                        </tr>
                        <tr>
                            <td>装修情况：<?= $house->decoration_name ?></td>
                            <td>房屋朝向：<?= $house->face ?></td>
                            <td>建筑时间：<?php if (empty($house->house_age)) echo '未知'; else echo $house->house_age; ?></td>
                        </tr>
                        <tr>
                            <td>产权类型：<?= $house->right_type_name ?></td>
                            <td>房屋设置：<?= $house->house_facility ?></td>
                            <td>楼层单元：<?= $house->floor_unit ?></td>
                        </tr>
                    </table>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">交易属性</dt>
                <dd>
                    <table>
                        <tr>
                            <td>挂牌时间：2016-10-04</td>
                            <td>交易权属：商品房</td>
                            <td>上次交易：2003-12-15</td>
                        </tr>
                        <tr>
                            <td>房屋用途：普通住宅</td>
                            <td>房本年限：满五年</td>
                            <td>产权所属：非共有</td>
                        </tr>
                        <tr>
                            <td>是否唯一：唯一</td>
                            <td>住宅小区：类型商品房</td>
                            <td>抵押信息：无抵押</td>
                        </tr>
                        <tr>
                            <td>房本备件：已上传房本照片</td>
                        </tr>
                    </table>
                </dd>
            </dl>
            <h2 class="detail-title2">房源特色</h2>
            <dl class="hiden">
                <dt class="c6">房源标签</dt>
                <dd>
                    <p class="list-mark s12"><span class="orange">白家庄小学望京校区</span><span
                            class="yellow">距离15号线望京站517米</span><span class="green">满五唯一</span><span
                            class="blue">随时看房</span></p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">户型介绍</dt>
                <dd>
                    <p>此房位于望京新城410号楼，可直通地下车库，非常方便； 三室一厅一厨两卫户型，主卧带卫生间，整体东向，楼层比较高
                        没有任何遮挡，可远眺望京SOHO,视野很棒；户型进身短，采光面宽阳光充足，格局方正 居住非常舒服，适合一家三代人居住。</p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">税费解析</dt>
                <dd>
                    <p>此房满五年唯一，税费少，首套只有1.5%的契税和差额5.6%的增值税，很适合高贷款的客户。</p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">小区介绍</dt>
                <dd>
                    <p>望京新城位于整个望京最核心的位置，2000年左右建成，是第一批商品房示范点，建筑质量非常高，社区配套成熟，生活便利！</p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">教育配套</dt>
                <dd>
                    <p>望京新城幼儿园（公立，每月费用1200左右）、白家庄小学（朝阳区重点）和首师大附属中学；</p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">交通出行</dt>
                <dd>
                    <p>小区北门过马路就是地铁望京站（14、15号线）和南门不远处就是阜通站，双地铁小区；</p>
                </dd>
            </dl>
        </div>
        <div class="house-img hiden bd">
            <h2 class="detail-title2 mb15">房源照片</h2>
            <?php if (!empty($house->img_1)) echo '<img src="' . $house->img_1 . '">' ?>
            <?php if (!empty($house->img_2)) echo '<img src="' . $house->img_2 . '">' ?>
            <?php if (!empty($house->img_3)) echo '<img src="' . $house->img_3 . '">' ?>
            <?php if (!empty($house->img_4)) echo '<img src="' . $house->img_4 . '">' ?>
            <?php if (!empty($house->img_5)) echo '<img src="' . $house->img_5 . '">' ?>
        </div>
        <div class="around bd">
            <h2 class="detail-title2">周边配套</h2>
            <p class="around-nav">
                <a href="javascript:return false" class="around-nav-t">公交</a>
                <a href="javascript:return false">地铁</a>
                <a href="javascript:return false">教育</a>
                <a href="javascript:return false">医院</a>
                <a href="javascript:return false">银行</a>
                <a href="javascript:return false">休闲娱乐</a>
                <a href="javascript:return false">购物</a>
                <a href="javascript:return false">餐饮</a>
                <a href="javascript:return false">运动健身</a>
            </p>
            <div class="around-box" id="a">
            </div>
        </div>
        <div class="school">
            <h2 class="detail-title2">对口学校</h2>
            <h3 class="s18 n mt15">北京市朝阳区白家庄小学望京新城分校</h3>
            <div class="detail-info clear">
                <dl class="hiden">
                    <dt class="c6">交易属性</dt>
                    <dd>
                        <table>
                            <tr>
                                <td>办学性质：公立学校</td>
                                <td>名额规定：无限制</td>
                            </tr>
                            <tr>
                                <td>学区均价：43138元/平米 - 71178元/平米</td>
                                <td>学校地址：北京市朝阳区望京西园四区408号楼</td>
                            </tr>
                        </table>
                    </dd>
                </dl>
                <dl class="hiden">
                    <dt class="c6">直升</dt>
                    <dd>
                        <p>首都师范大学附属实验学校望京新城校区</p>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="calculator bd pb30">
            <h2 class="detail-title2"><a href="" class="orange">税费计算器</a><a href="">房贷计算器</a></h2>
            <div class="calculator-con hiden">
                <form class="fl">
                    <div>
                        <span class="c6 cal-label">住宅类型：</span>
                        <div class="select_box">
                            <span>普通住宅</span>
                            <ul>
                                <li>普通住宅</li>
                                <li>商业住宅</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">卖房家庭唯一：</span>
                        <div class="select_box">
                            <span>唯一住宅</span>
                            <ul>
                                <li>唯一住宅</li>
                                <li>不唯一</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">距上次交易：</span>
                        <div class="select_box">
                            <span>满五年</span>
                            <ul>
                                <li>满五年</li>
                                <li>满两年</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">买房家庭首套：</span>
                        <div class="select_box">
                            <span>首套</span>
                            <ul>
                                <li>首套</li>
                                <li>第二套</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">计征方式：</span>
                        <div class="select_box">
                            <span>总价</span>
                            <ul>
                                <li>总价</li>
                                <li>每月</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">房屋面积：</span>
                        <div class="cal-text"><input type="text" placeholder="请输入房屋面积">平方米</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">房屋总价：</span>
                        <div class="cal-text"><input type="text" placeholder="请输入房屋价格">万元</div>
                    </div>
                    <input type="button" value="开始计算" class="calculator-btn s16 cf">
                </form>
                <div class="calculator-result fr">
                    <p class="s18">合计：<strong class="s24">259500</strong> 元</p>
                    <p class="s16">契&nbsp;&nbsp;&nbsp;税： 259500 元</p>
                    <p class="s16">营业税： 免征</p>
                    <p class="s16">个&nbsp;&nbsp;&nbsp;税： 免征</p>
                </div>
            </div>
        </div>
        <div class="house-area hiden bd pb30">
            <h2 class="detail-title2">望京新城简介</h2>
            <ul class="fl">
                <li>小区均价：57618 元/m²</li>
                <li>建筑年代：1997年</li>
                <li>建筑类型：塔楼/板楼/塔板结合</li>
                <li>楼栋总数：25栋</li>
                <li>户型总数：82个</li>
            </ul>
            <img src="/static/web/photo/img-2.jpg" class="fl">
        </div>
        <h2 class="detail-title2">为您推荐</h2>
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
</div>
<script>
    var menu = 'house_menu';
    var selectKey = "1";
    <?php
    $pic_list = [];
    if (!empty($house->img_1)) {
        $pic_list[] = [
            'picPos' => 1,
            'bigPic' => $house->img_1
        ];
    }
    if (!empty($house->img_2)) {
        $pic_list[] = [
            'picPos' => 2,
            'bigPic' => $house->img_2
        ];
    }
    if (!empty($house->img_3)) {
        $pic_list[] = [
            'picPos' => 3,
            'bigPic' => $house->img_3
        ];
    }
    if (!empty($house->img_4)) {
        $pic_list[] = [
            'picPos' => 4,
            'bigPic' => $house->img_4
        ];
    }
    if (!empty($house->img_5)) {
        $pic_list[] = [
            'picPos' => 5,
            'bigPic' => $house->img_5
        ];
    }
    json_encode($pic_list);
    ?>
    var picList = eval(<?=json_encode($pic_list, JSON_UNESCAPED_UNICODE)?>);
</script>
<script type="text/javascript">
    $(function () {
        $('.around-nav').find('a').click(function () {
            $(this).addClass('around-nav-t');
            $(this).siblings('a').removeClass('around-nav-t');
            setMap($(this).html());
        });
        setMap('公交');
        function setMap($name) {
            var map = new BMap.Map("a");
            map.centerAndZoom(new BMap.Point('116.64276', '39.938604'), 16);
            var local = new BMap.LocalSearch(map, {
                renderOptions: {map: map}
            });
            local.searchInBounds($name, map.getBounds());
        }
    })

</script>
<script src="/static/web/js/picture.js"></script>