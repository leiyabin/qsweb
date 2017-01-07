<script src="/static/web/js/jquery-1.8.2.min.js"></script>
<script src="/static/web/js/jquery.fancybox.js"></script>
<script>
    $(document).ready(function () {
        $('.house-type a').fancybox();
        $('.photo-show').fancybox();
    });
</script>
<?php
use app\components\Utils;

?>
<div class="bg1 detail">
    <div class="con">
        <p class="location"><a href="/">千氏地产</a> > <a href="/web/loupan/">新房</a> > <a href="#"><?= $loupan->name ?></a>
        </p>
        <div class="new-banner hiden" style="background:url(<?= $loupan->banner_img_url ?>) no-repeat;">
            <div class="new-info fl tc">
                <h2 class="cf s24"><?= $loupan->name ?></h2>
                <p class="list-mark s12">
                    <?php foreach ($loupan->tag as $tag): ?>
                        <span class="<?= $tag['color'] ?>"><?= $tag['name'] ?></span>
                    <?php endforeach; ?>
                </p>
                <p>均价：<b class="s18"><?= $loupan->average_price ?></b>万元/平</p>
                <strong class="orange s30">010-52745670</strong>
                <p>咨询电话</p>
            </div>
        </div>
        <h2 class="detail-title2">户型介绍</h2>
        <ul class="house-type">
            <?php foreach ($loupan->door_model_list as $door_model): ?>
                <li>
                    <img src="<?= $door_model->img_url ?>" class="fl">
                    <div class="fl">
                        <p><b class="s18"><?= $door_model->shitinwei ?> <?= $door_model->build_area ?></b>
                            ㎡（<?= $door_model->face ?>）</p>
                        <p>户型解读：<?= $door_model->description ?></p>
                        <p class="list-mark s12">
                            <span class="orange"><?= $door_model->tag_1 ?></span>
                            <span class="green"><?= $door_model->tag_2 ?></span>
                            <span class="blue"><?= $door_model->tag_3 ?></span>
                        </p>
                    </div>
                    <a href="#type-<?= $door_model->id ?>" data-fancybox-group="gallery" class="fr">查看</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!--户型弹出内容start-->
        <ul class="type-detail-ul">
            <?php foreach ($loupan->door_model_list as $door_model): ?>
                <li id="type-<?= $door_model->id ?>" class="type-detail">
                    <div class="fl bf"><img src="<?= $door_model->img_url ?>"></div>
                    <div class="fr bg1">
                        <h3 class="s18"><?= $loupan->name ?></h3>
                        <p class="list-mark s12">
                            <span class="orange"><?= $door_model->tag_1 ?></span>
                            <span class="green"><?= $door_model->tag_2 ?></span>
                            <span class="blue"><?= $door_model->tag_3 ?></span>
                        </p>
                        <table>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td>房屋朝向： <?= $door_model->face ?></td>
                                <td>居室： <?= $door_model->shitinwei ?></td>
                            </tr>
                            <tr>
                                <td>装修标准： <?= $door_model->decoration_name ?></td>
                                <td>建筑面积： <?= $door_model->build_area ?>㎡</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                        <p class="tc mt20">联系电话</p>
                        <p class="b tc orange s30 mt10">010-5967832</p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <!--户型弹出内容end-->

        <h2 class="detail-title2">楼盘相册</h2>
        <ul class="house-photo mt20 hiden bd pb20">
            <li>
                <a class="photo-show" href="<?= $loupan->img_1_url ?>" data-fancybox-group="gallery"><img
                            src="<?= $loupan->img_1_url ?>"></a>
                <p class="tc">效果图（1）</p>
            </li>
            <li>
                <a class="photo-show" href="<?= $loupan->img_2_url ?>" data-fancybox-group="gallery"><img
                            src="<?= $loupan->img_2_url ?>"></a>
                <p class="tc">效果图（2）</p>
            </li>
            <li>
                <a class="photo-show" href="<?= $loupan->img_3_url ?>" data-fancybox-group="gallery"><img
                            src="<?= $loupan->img_3_url ?>"></a>
                <p class="tc">效果图（3）</p>
            </li>
            <li>
                <a class="photo-show" href="<?= $loupan->img_4_url ?>" data-fancybox-group="gallery"><img
                            src="<?= $loupan->img_4_url ?>"></a>
                <p class="tc">效果图（4）</p>
            </li>
        </ul>
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
        <div class="comment c6 bd">
            <h2 class="detail-title2 c3">用户点评</h2>
            <p class="c6 mt20">综合评分：3.9分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;高于87.5%同类新盘</p>
            <ul class="comment-star hiden">
                <li>周边配套：<span class="star"><span style="width:80%"></span></span>4.0分</li>
                <li>交通方便：<span class="star"><span style="width:50%"></span></span>2.5分</li>
                <li>绿化环境：<span class="star"><span style="width:100%"></span></span>5.0分</li>
            </ul>
            <ul class="comment-con mt15">
                <li>
                    <div class="comment-img fl tc">
                        <img src="/static/web/images/comment-1.png">
                        <p class="mt5">千氏房友</p>
                    </div>
                    <div class="comment-box fl">
                        <div class="comment-detail">
                            <span class="star"><span style="width:50%"></span></span>配套：5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;交通：4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;环境：3
                            <p class="mt10">环境不错，比周边楼盘好一点，价格太高了</p>
                            <i class="n">2016-10-18 09:38:55</i>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="comment-img fl tc">
                        <img src="/static/web/images/comment-1.png">
                        <p class="mt5">千氏房友</p>
                    </div>
                    <div class="comment-box fl">
                        <div class="comment-detail">
                            <span class="star"><span style="width:80%"></span></span>配套：5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;交通：4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;环境：4
                            <p class="mt10">环境不错，比周边楼盘好一点，价格太高了</p>
                            <i class="n">2016-10-18 09:38:55</i>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="comment-img fl tc">
                        <img src="/static/web/images/comment-1.png">
                        <p class="mt5">千氏房友</p>
                    </div>
                    <div class="comment-box fl">
                        <div class="comment-detail">
                            <span class="star"><span style="width:100%"></span></span>配套：5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;交通：5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;环境：5
                            <p class="mt10">环境不错，比周边楼盘好一点</p>
                            <i class="n">2016-10-18 09:38:55</i>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="building bd">
            <h2 class="detail-title2">楼盘详情</h2>
            <table class="c6">
                <tr>
                    <td><span>项目地址：</span><?= $loupan->address ?></td>
                </tr>
                <tr>
                    <td><span>售楼处地址：</span><?= $loupan->sale_office_address ?></td>
                </tr>
                <tr>
                    <td><span>开发商：</span><?= $loupan->developers ?></td>
                </tr>
                <tr>
                    <td><span>物业公司：</span><?= $loupan->property_company ?></td>
                </tr>
                <tr>
                    <td><span>最新开盘：</span><?= Utils::formatDateTime($loupan->opening_time, 'Y年m月d日') ?></td>
                </tr>
                <tr>
                    <td><span>物业类型：</span><?= $loupan->property_type ?></td>
                    <td><span>面积：</span><?= $loupan->min_square ?>~<?= $loupan->max_square ?>平米</td>
                </tr>
                <tr>
                    <td><span>产权年限：</span><?= $loupan->right_time ?>年</td>
                    <td><span>均价：</span><?= $loupan->average_price ?>万元</td>
                </tr>
                <tr>
                    <td><span>销售状态：</span><?= $loupan->sale_status_name ?></td>
                    <td><span>特色：</span>
                        <?php foreach ($loupan->tag as $tag): ?>
                            <?= $tag['name'] ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                </tr>
            </table>
        </div>
        <div class="calculator bd pb30">
            <h2 class="detail-title2"><span>房贷计算器</span></h2>
            <div class="calculator-con hiden">
                <form class="fl">
                    <div>
                        <span class="c6 cal-label">贷款类型：</span>
                        <div class="select_box">
                            <span>商业贷款</span>
                            <ul>
                                <li>商业贷款</li>
                                <li>公积金贷款</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款金额：</span>
                        <div class="cal-text"><input type="number" id="load_amount">万元</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款年限：</span>
                        <div class="cal-text"><input type="number" id="load_year">年</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款利率：</span>
                        <div class="cal-text"><input type="number" id="load_rate">%</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">还款方式：</span>
                        <i>
                            <input type="radio" name="way" checked id="way1" value="1">
                            <label for="way1"></label><font>等额本息</font>
                        </i>
                        <i>
                            <input type="radio" name="way" id="way2" value="2">
                            <label for="way2"></label><font>等额本金</font>
                        </i>
                    </div>
                    <input type="button" value="开始计算" id="jisuan" class="calculator-btn s16 cf">
                </form>
                <div class="calculator-result2 fr">
                    <h3 class="s18 tc cf">您的账单</h3>
                    <table class="c6">
                        <tr>
                            <td>月供</td>
                            <td class="tr"><span id="yuegong">--</span>元</td>
                        </tr>
                        <tr>
                            <td>还款月数</td>
                            <td class="tr"><span id="hkys">--</span>月</td>
                        </tr>
                        <tr>
                            <td>总利息</td>
                            <td class="tr"><span id="total_lx">--</span>元</td>
                        </tr>
                        <tr>
                            <td>本息合计</td>
                            <td class="tr"><span id="total_bj">--</span>元</td>
                        </tr>
                    </table>
                    <p class="s16" style="margin-top:50px;color: grey;font-size: small;padding-left:50px;">
                        注：税费，房贷信息仅供参考，具体金额请以实际发生为准。</p>
                </div>
            </div>
        </div>
        <h2 class="detail-title2">推荐楼盘</h2>
        <ul class="resource-list hiden">
            <?php foreach ($recommend_list as $item): ?>
                <li>
                    <a href="/web/loupan/detail?id=<?= $item->id ?>" title="<?= $item->name ?>"><img
                                src="<?= $item->img_url ?>"></a>
                    <p class="s18"><b class="fl"><a href=""><?= Utils::subStr($item->name, 10) ?></a></b><span
                                class="orange fr"><?= $item->average_price ?>万/套</span></p>
                    <p class="c6"><span class="fl"><?= $item->min_square ?>㎡~<?= $item->max_square ?>㎡</span></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6Ao1oS2kNAz4Okb3ytyGGGobMMtCz2Ef"></script>
<script type="text/javascript">
    var menu = 'loupan_menu';
    $(function () {
        $('.around-nav').find('a').click(function () {
            $(this).addClass('around-nav-t');
            $(this).siblings('a').removeClass('around-nav-t');
            setMap($(this).html());
        });
        setMap('公交');
        function setMap($name) {
            var map = new BMap.Map("a");
            map.centerAndZoom(new BMap.Point('<?=$loupan->lon?>', '<?=$loupan->lat?>'), 16);
            var local = new BMap.LocalSearch(map, {
                renderOptions: {map: map}
            });
            local.searchInBounds($name, map.getBounds());
        }

        $('#jisuan').click(function () {
            var tag = $('input[name=way]:checked').val();
            var $load_rate = $('#load_rate').val().trim();
            var $load_year = $('#load_year').val().trim();
            var $load_amount = $('#load_amount').val().trim();
            if ($load_rate == '' || $load_year == '' || $load_amount == '') {
                alert('请填写完整信息！');
                return;
            }
            var load_type = $(".select_box span").html();
            if (load_type == '公积金贷款' || load_type == '商业贷款') {
                var g = parseFloat($load_rate * 0.01);
                var d = parseInt($load_year);
                var e = d * 12;
                var f = 10000 * parseInt($load_amount);
                // 等额本息
                var x_yjhk = g * f / 12 + (g * f / 12) / (Math.pow((1 + g / 12), e) - 1);
                var x_hkze = x_yjhk * e;
                var x_zflx = x_hkze - f;
                // 等额本金
                var j_lxzc = 0;
                var x = 0;
                for (i = 1; i <= e; i++) {
                    j_lxzc += (f - x) * g / 12;
                    x += f / e;
                }
                var j_hkze = j_lxzc + f;
                //赋值
                if (tag == 1) {
                    $('#yuegong').html(x_yjhk.toFixed(2));
                    $('#hkys').html(e);
                    $('#total_lx').html(x_zflx.toFixed(2));
                    $('#total_bj').html(x_hkze.toFixed(2));
                } else {
                    $('#yuegong').html('--');
                    $('#hkys').html(e);
                    $('#total_lx').html(j_lxzc.toFixed(2));
                    $('#total_bj').html(j_hkze.toFixed(2));
                }
            }

        })
    })

</script>