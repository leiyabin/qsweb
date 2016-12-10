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
                <li>
                    小区名称：<?= $house->property_company ?> <?= Utils::getValue($house->house_attach, 'community_name'); ?></li>
                <li>
                    所在区域：<?= $house->quxian_name ?> <?= $house->area_name ?> </li>
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
                            <td>房屋设施：<?= $house->house_facility ?></td>
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
                            <td>
                                挂牌时间：<?php if (!empty($house->house_attach->sale_time)) echo Utils::formatDateTime($house->house_attach->sale_time, 'Y-m-d') ?></td>
                            <td>
                                上次交易：<?php if (!empty($house->house_attach->last_sale_time)) echo Utils::formatDateTime($house->house_attach->last_sale_time, 'Y-m-d') ?></td>
                            <td>
                                房本年限：<?php if (!empty($house->house_attach->deed_year_name)) echo $house->house_attach->deed_year_name; ?></td>
                        </tr>
                        <tr>
                            <td>
                                是否唯一：<?php if (!empty($house->house_attach->deed_year_name)) echo '唯一'; else '不唯一'; ?></td>
                            <td>
                                抵押信息：<?php if (!empty($house->house_attach->mortgage_info)) echo $house->house_attach->mortgage_info; ?></td>
                            <td>
                                产权所属：<?php if (!empty($house->house_attach->right_info)) echo $house->house_attach->right_info; ?></td>
                        </tr>
                    </table>
                </dd>
            </dl>
            <h2 class="detail-title2">房源特色</h2>
            <dl class="hiden">
                <dt class="c6">房源标签</dt>
                <dd>
                    <p class="list-mark s12">
                        <?php foreach ($house->tag as $tag): ?>
                            <span class="<?= $tag['color'] ?>"><?= $tag['name'] ?></span>
                        <?php endforeach; ?>
                    </p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">户型介绍</dt>
                <dd>
                    <p><?php if (!empty($house->house_attach->door_model_introduction)) echo $house->house_attach->door_model_introduction; ?></p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">税费解析</dt>
                <dd>
                    <p><?php if (!empty($house->house_attach->tax_explain)) echo $house->house_attach->tax_explain; ?></p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">小区介绍</dt>
                <dd>
                    <p><?php if (!empty($house->house_attach->community_introduction)) echo $house->house_attach->community_introduction; ?></p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">教育配套</dt>
                <dd>
                    <p><?php if (!empty($house->house_attach->school_info)) echo $house->house_attach->school_info; ?></p>
                </dd>
            </dl>
            <dl class="hiden">
                <dt class="c6">交通出行</dt>
                <dd>
                    <p><?php if (!empty($house->house_attach->traffic_info)) echo $house->house_attach->traffic_info; ?></p>
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
        <div class="calculator bd pb30">
            <h2 class="detail-title2" id="calculator_tab">
                <a href="javascript:void(0);" class="orange" id="tax">税费计算器</a>
                <a href="javascript:void(0);" id="loan">房贷计算器</a>
            </h2>
            <div class="calculator-con hiden" >
                <form class="fl" id="tax_form">
                    <div>
                        <span class="c6 cal-label">住宅类型：</span>
                        <div class="select_box">
                            <span>普通住宅</span>
                            <ul>
                                <li>普通住宅</li>
                                <li>非普通住宅</li>
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
                                <li>不满两年</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">买房家庭首套：</span>
                        <div class="select_box">
                            <span>首套</span>
                            <ul>
                                <li>首套</li>
                                <li>二套</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">计征方式：</span>
                        <div class="select_box">
                            <span>总价</span>
                            <ul>
                                <li>总价</li>
                                <li>差价</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">房屋面积：</span>
                        <div class="cal-text"><input type="number" value="<?= $house->build_area ?>"
                                                     placeholder="请输入房屋面积">平方米
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">房屋总价：</span>
                        <div class="cal-text"><input type="number" value="<?= $house->total_price ?>"
                                                     placeholder="请输入房屋价格">万元
                        </div>
                    </div>
                    <input type="button" value="开始计算" class="calculator-btn s16 cf">
                </form>
                <form class="fl" id="loan_form" style="display: none;margin-bottom: 30px;">
                    <div>
                        <span class="c6 cal-label">贷款类型：</span>
                        <div class="select_box">
                            <span>商贷</span>
                            <ul>
                                <li>商贷</li>
                                <li>公积金</li>
                                <li>组合贷款</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款金额：</span>
                        <div class="select_box" id="loan_select">
                            <span>2成</span>
                            <ul>
                                <li tag ='2'>2成</li>
                                <li tag ='3'>3成</li>
                                <li tag ='4'>4成</li>
                                <li tag ='5'>5成</li>
                                <li tag ='6'>6成</li>
                                <li tag ='7'>7成</li>
                                <li tag ='8'>8成</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label"></span>
                        <div class="cal-text">
                            <input type="number" id= 'loan_money' value="<?=0.2*$house->total_price?>">万元
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款期限：</span>
                        <div class="select_box">
                            <span>30年</span>
                            <ul>
                                <li>30年</li>
                                <li>25年</li>
                                <li>20年</li>
                                <li>15年</li>
                                <li>10年</li>
                                <li>5年</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">商贷年利率：</span>
                        <div class="select_box">
                            <span>1.05倍</span>
                            <ul>
                                <li>1.05倍</li>
                                <li>1.1倍</li>
                                <li>1.2倍</li>
                                <li>1.3倍</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label"></span>
                        <div class="cal-text"><input type="number" value="">%
                        </div>
                    </div>
                    <input type="button" value="开始计算" class="calculator-btn s16 cf">
                </form>
                <div class="calculator-result fr" id="tax_result">
                    <p class="s18">合计：<strong class="s24">259500</strong> 元</p>
                    <p class="s16">契&nbsp;&nbsp;&nbsp;税： 259500 元</p>
                    <p class="s16">营业税： 免征</p>
                    <p class="s16">个&nbsp;&nbsp;&nbsp;税： 免征</p>
                    <br/>
                    <p class="s16" style="color: grey;font-size: small">税费，房贷信息仅供参考，具体金额请以实际发生为准。</p>
                </div>
                <div class="calculator-result fr" id="loan_result" style="display: none">
                    <p  class="s18">等额本息还款</p>
                    <p  class="s16">月&nbsp;&nbsp;&nbsp;供： 259500 元</p>
                    <p  class="s16">还款月数： 300月</p>
                    <p  class="s16">总利息： 2434元</p>
                    <p  class="s16">本息合计： 123345677元</p>
                    <br/>
                    <br/>
                    <p class="s16" style="color: grey;font-size: small">税费，房贷信息仅供参考，具体金额请以实际发生为准。</p>
                </div>
            </div>
        </div>
        <div class="house-area hiden bd pb30">
            <h2 class="detail-title2"><?php if (!empty($house->house_attach->community_name)) echo $house->house_attach->community_name; ?>
                简介</h2>
            <ul class="fl">
                <li>
                    小区均价：<?php if (!empty($house->house_attach->community_average_price)) echo $house->house_attach->community_average_price; ?>
                    元/m²
                </li>
                <li>建筑年代：<?php if (!empty($house->house_attach->build_year)) echo $house->house_attach->build_year; ?>
                    年
                </li>
                <li>
                    建筑类型：<?php if (!empty($house->house_attach->build_type_name)) echo $house->house_attach->build_type_name; ?></li>
                <li>
                    楼栋总数：<?php if (!empty($house->house_attach->total_building)) echo $house->house_attach->total_building; ?>
                    栋
                </li>
                <li>
                    户型总数：<?php if (!empty($house->house_attach->total_door_model)) echo $house->house_attach->total_door_model; ?>
                    个
                </li>
            </ul>
            <img src="/static/web/photo/img-2.jpg" class="fl">
        </div>
        <h2 class="detail-title2">为您推荐</h2>
        <ul class="resource-list hiden">
            <?php foreach ($recommend_list as $item): ?>
                <li>
                    <a href="/web/house/detail/?id=<?= $item->id ?>" title=""><img src="<?= $item->house_img ?>"></a>
                    <p class="s18"><b class="fl"><a
                                href="/web/house/detail/?id=<?= $item->id ?>"><?= Utils::subStr($item->address, 11) ?></a></b><span
                            class="orange fr"><?= $item->total_price ?>万</span></p>
                    <p class="c6"><span class="fl"><?= $item->jishi ?>室<?= $item->jitin ?>厅<?= $item->jiwei ?>
                            卫 <?= $item->build_area ?> m²</span><span
                            class="fr"><?= round($item->unit_price / 10000, 1) ?>万/平</span></p>
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
            map.centerAndZoom(new BMap.Point('<?= $house->lon?>', '<?=$house->lat ?>'), 16);
            var local = new BMap.LocalSearch(map, {
                renderOptions: {map: map}
            });
            local.searchInBounds($name, map.getBounds());
        }

        $('#calculator_tab').find('a').click(function () {
            $(this).addClass('orange');
            $(this).siblings('a').removeClass('orange');
            var form_id =  $(this).attr('id')+'_form';
            var res_id = $(this).attr('id')+'_result';
            $form = $('#' + form_id);
            $result = $('#' + res_id);
            $form.show();$result.show();
            $form.siblings('form').hide();
            $result.siblings('div').hide();
        })
        $('#loan_select').find('li').click(function () {
            $('#loan_money').val(parseInt($(this).attr('tag'))*<?=$house->total_price?>/10)
        })
    })

</script>
<script src="/static/web/js/picture.js"></script>