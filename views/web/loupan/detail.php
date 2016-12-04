<script src="/static/web/js/jquery-1.8.2.min.js"></script>
<script  src="/static/web/js/jquery.fancybox.js"></script>
<script>
    $(document).ready(function() {
        $('.house-type a').fancybox();
        $('.photo-show').fancybox();
    });
</script>
<div class="bg1 detail">
    <div class="con">
        <p class="location"><a href="/">千氏地产</a> > <a href="/web/loupan/">新房</a> > <a href="#"><?=$loupan->name?></a>  </p>
        <div class="new-banner hiden">
            <div class="new-info fl tc">
                <h2 class="cf s24"><?=$loupan->name?></h2>
                <p class="list-mark s12">
                    <?php foreach ($loupan->tag as $tag): ?>
                        <span class="<?= $tag['color'] ?>"><?= $tag['name'] ?></span>
                    <?php endforeach; ?>
                </p>
                <p>均价：<b class="s18"><?=$loupan->average_price?></b>元/平</p>
                <strong class="orange s30">010-5794236</strong>
                <p>咨询电话</p>
            </div>
        </div>
        <h2 class="detail-title2">户型介绍</h2>
        <ul class="house-type">
            <li>
                <img src="/static/web/photo/new-img.jpg" class="fl">
                <div class="fl">
                    <p><b class="s18">4室2厅3卫 153.00</b> ㎡（南,北朝向）</p>
                    <p>户型解读：布局流畅，通风采光一流，宣扬健康理念</p>
                    <p class="list-mark s12"><span class="orange">厨卫不对门</span><span class="green">户型方正</span><span class="blue">南北通透</span></p>
                </div>
                <a href="#type-1" data-fancybox-group="gallery" class="fr">查看</a>
            </li>
            <li>
                <img src="/static/web/photo/new-img.jpg" class="fl">
                <div class="fl">
                    <p><b class="s18">4室2厅3卫 153.00</b> ㎡（南,北朝向）</p>
                    <p>户型解读：布局流畅，通风采光一流，宣扬健康理念</p>
                    <p class="list-mark s12"><span class="orange">厨卫不对门</span><span class="green">户型方正</span><span class="blue">南北通透</span></p>
                </div>
                <a href="#type-2" data-fancybox-group="gallery" class="fr">查看</a>
            </li>
            <li>
                <img src="/static/web/photo/new-img.jpg" class="fl">
                <div class="fl">
                    <p><b class="s18">4室2厅3卫 153.00</b> ㎡（南,北朝向）</p>
                    <p>户型解读：布局流畅，通风采光一流，宣扬健康理念</p>
                    <p class="list-mark s12"><span class="orange">厨卫不对门</span><span class="green">户型方正</span><span class="blue">南北通透</span></p>
                </div>
                <a href="#type-3" data-fancybox-group="gallery" class="fr">查看</a>
            </li>
        </ul>

        <!--户型弹出内容start-->
        <ul class="type-detail-ul">
            <li id="type-1" class="type-detail">
                <div class="fl bf"><img src="/static/web/photo/type-img.jpg"></div>
                <div class="fr bg1">
                    <h3 class="s18">万柳书院</h3>
                    <p class="list-mark s12"><span class="orange">厨卫不对门</span><span class="green">户型方正</span><span class="blue">南北通透</span></p>
                    <table>
                        <tr>
                            <td>房屋朝向： 南,北 </td>
                            <td>居室： 3室2厅3卫</td>
                        </tr>
                        <tr>
                            <td>装修标准： 精装修</td>
                            <td>建筑面积： 169㎡</td>
                        </tr>
                        <tr>
                            <td>建筑面积： 169㎡ </td>
                        </tr>
                        <tr>
                            <td>户型解读： 暂无</td>
                        </tr>
                    </table>
                    <p class="tc mt20">联系电话</p>
                    <p class="b tc orange s30 mt10">010-5967832</p>
                </div>
            </li>
            <li id="type-2" class="type-detail">
                <div class="fl bf"><img src="/static/web/photo/sea-img-1.jpg"></div>
                <div class="fr bg1">
                    <h3 class="s18">2万柳书院</h3>
                    <p class="list-mark s12"><span class="orange">厨卫不对门</span><span class="green">户型方正</span><span class="blue">南北通透</span></p>
                    <table>
                        <tr>
                            <td>房屋朝向： 南,北 </td>
                            <td>居室： 3室2厅3卫</td>
                        </tr>
                        <tr>
                            <td>装修标准： 精装修</td>
                            <td>建筑面积： 169㎡</td>
                        </tr>
                        <tr>
                            <td>建筑面积： 169㎡ </td>
                        </tr>
                        <tr>
                            <td>户型解读： 暂无</td>
                        </tr>
                    </table>
                    <p class="tc mt20">联系电话</p>
                    <p class="b tc orange s30 mt10">010-5967832</p>
                </div>
            </li>
            <li id="type-3" class="type-detail">
                <div class="fl bf"><img src="/static/web/photo/sea-img-2.jpg"></div>
                <div class="fr bg1">
                    <h3 class="s18">3万柳书院</h3>
                    <p class="list-mark s12"><span class="orange">厨卫不对门</span><span class="green">户型方正</span><span class="blue">南北通透</span></p>
                    <table>
                        <tr>
                            <td>房屋朝向： 南,北 </td>
                            <td>居室： 3室2厅3卫</td>
                        </tr>
                        <tr>
                            <td>装修标准： 精装修</td>
                            <td>建筑面积： 169㎡</td>
                        </tr>
                        <tr>
                            <td>建筑面积： 169㎡ </td>
                        </tr>
                        <tr>
                            <td>户型解读： 暂无</td>
                        </tr>
                    </table>
                    <p class="tc mt20">联系电话</p>
                    <p class="b tc orange s30 mt10">010-5967832</p>
                </div>
            </li>
        </ul>
        <!--户型弹出内容end-->

        <h2 class="detail-title2">楼盘相册</h2>
        <ul class="house-photo mt20 hiden bd pb20">
            <li>
                <a class="photo-show" href="/static/web/photo/big-1.jpg" data-fancybox-group="gallery"><img src="/static/web/photo/img-1.jpg"></a>
                <p class="tc">效果图（1）</p>
            </li>
            <li>
                <a class="photo-show" href="/static/web/photo/big-2.jpg" data-fancybox-group="gallery"><img src="/static/web/photo/img-2.jpg"></a>
                <p class="tc">效果图（2）</p>
            </li>
            <li>
                <a class="photo-show" href="/static/web/photo/big-1.jpg" data-fancybox-group="gallery"><img src="/static/web/photo/img-3.jpg"></a>
                <p class="tc">效果图（3）</p>
            </li>
            <li>
                <a class="photo-show" href="/static/web/photo/big-3.jpg" data-fancybox-group="gallery"><img src="/static/web/photo/img-4.jpg"></a>
                <p class="tc">效果图（4）</p>
            </li>
        </ul>
        <div class="around bd">
            <h2 class="detail-title2">周边配套</h2>
            <p class="around-nav"><a href="#a" class="around-nav-t">公交</a><a href="#b">地铁</a><a href="">教育设施</a><a href="">医院</a><a href="">银行</a><a href="">休闲娱乐</a><a href="">购物</a><a href="">餐饮</a><a href="">运动健身</a></p>
            <div class="around-box" id="a">
                <!--地图--><div class="around-map"><img src="/static/web/photo/map.jpg"></div>
                <div class="around-con">
                    <h3 class="s18 n cf tc">公 交</h3>
                    <ul class="s12">
                        <li class="around-1">
                            <h4 class="n blue">花园公交站</h4>
                            <p>地址：北京市朝阳区东坝中路</p>
                            <p>公交：<font class="blue">433路，533路，1路，2路，3路，4路，5路</font></p>
                        </li>
                        <li class="around-2">
                            <h4 class="n blue">花园公交站</h4>
                            <p>地址：北京市朝阳区东坝中路</p>
                            <p>公交：<font class="blue">433路，533路，1路，2路，3路，4路，5路</font></p>
                        </li>
                    </ul>
                </div>
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
                        <p class="mt5">111111111</p>
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
                    <td><span>项目地址：</span>新城白马路与通顺路交汇处向北1公里路西</td>
                </tr>
                <tr>
                    <td><span>售楼处地址：</span>顺义新城白马路与通顺路交汇处向北1公里路西（接待时间 9:30 - 16:00）</td>
                </tr>
                <tr>
                    <td><span>开发商：</span>北京中铁润丰房地产开发有限公司</td>
                </tr>
                <tr>
                    <td><span>物业公司：</span>开元国际物业管理公司</td>
                </tr>
                <tr>
                    <td><span>最新开盘：</span>2016年03月24日</td>
                </tr>
                <tr>
                    <td><span>物业公司：</span>开元国际物业管理公司</td>
                    <td><span>物业类型：</span>普通住宅</td>
                </tr>
                <tr>
                    <td><span>最早交房：</span>待定</td>
                    <td><span>容积率：</span>1.60</td>
                </tr>
                <tr>
                    <td><span>产权年限：</span>70年</td>
                    <td><span>绿化率：</span>33%</td>
                </tr>
                <tr>
                    <td><span>规划户数：</span>1310</td>
                    <td><span>物业费用：</span>2.8元/m²/月</td>
                </tr>
                <tr>
                    <td><span>车位情况：</span>地上车位数495；地下车位数1100</td>
                    <td><span>供暖方式：</span>集中供暖</td>
                </tr>
                <tr>
                    <td><span>装修状况：</span>精装修</td>
                    <td><span>水电燃气：</span>民水 民电</td>
                </tr>
                <tr>
                    <td><span>建筑类型：</span>板楼</td>
                    <td><span>嫌恶设施：</span>暂无</td>
                </tr>
                <tr>
                    <td><span>占地面积：</span>精装修</td>
                    <td><span>水电燃气：</span>民水 民电</td>
                </tr>
                <tr>
                    <td><span>建筑类型：</span>101,646㎡</td>
                    <td><span>建筑面积：</span>232,633㎡</td>
                </tr>
            </table>
        </div>
        <div class="calculator bd pb30">
            <h2 class="detail-title2"><span>房贷计算器</span></h2>
            <div class="calculator-con hiden">
                <form class="fl">
                    <div>
                        <span class="c6 cal-label">选择户型：</span>
                        <div class="select_box">
                            <span>4室2厅3卫 153.00平</span>
                            <ul>
                                <li>4室2厅3卫 153.00平</li>
                                <li>4室2厅3卫</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">估算总价：</span>
                        <div class="cal-text"><input type="text" placeholder="请输入房屋面积">平方米</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">首付成数：</span>
                        <div class="select_box">
                            <span>7成</span>
                            <ul>
                                <li>7成</li>
                                <li>5成</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款类别：</span>
                        <div class="select_box">
                            <span>公积金贷款</span>
                            <ul>
                                <li>公积金贷款</li>
                                <li>商业贷款</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款时间：</span>
                        <div class="select_box">
                            <span>30年（360期）</span>
                            <ul>
                                <li>30年（360期）</li>
                                <li>20年</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">买房家庭首套：</span>
                        <i>
                            <input type="radio" name="way" checked id="way1">
                            <label for="way1"></label><font>等额本息</font>
                        </i>
                        <i>
                            <input type="radio" name="way" id="way2">
                            <label for="way2"></label><font>等额本金</font>
                        </i>
                    </div>
                    <input type="button" value="开始计算" class="calculator-btn s16 cf">
                </form>
                <div class="calculator-result2 fr">
                    <h3 class="s18 tc cf">您的账单</h3>
                    <table class="c6">
                        <tr>
                            <td>均价</td>
                            <td class="tr">42000元／平米</td>
                        </tr>
                        <tr>
                            <td>估算总价</td>
                            <td class="tr">约500万</td>
                        </tr>
                        <tr>
                            <td>首付</td>
                            <td class="tr">350万 7成</td>
                        </tr>
                        <tr>
                            <td>贷款金额</td>
                            <td class="tr">150万</td>
                        </tr>
                        <tr>
                            <td>偿还利息</td>
                            <td class="tr">85万</td>
                        </tr>
                        <tr>
                            <td>每月还款</td>
                            <td class="tr"><strong class="s18">6528</strong> 万</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <h2 class="detail-title2">推荐楼盘</h2>
        <ul class="resource-list hiden">
            <?php foreach ($recommend_list as $item): ?>
            <li>
                <a href="/web/loupan/detail?id=<?=$item->id?>" title="<?=$item->name?>"><img src="<?=$item->img_url?>"></a>
                <p class="s18"><b class="fl"><a href=""><?=$item->name?></a></b><span class="orange fr">><?=$item->average_price?>万/套</span></p>
                <p class="c6"><span class="fl">><?=$item->min_square?>㎡-><?=$item->max_square?>㎡</span></p>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>