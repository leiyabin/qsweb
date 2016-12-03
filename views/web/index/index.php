<?php
use app\components\Utils;
?>
<!-- content start -->
<div class="index-search-wrap">
    <div class="index-search">
        <p><span class="search-this">学区房</span><span>商铺</span><span>写字楼</span></p>
        <div class="index-search-con">
            <input type="text" placeholder="请输入学校名称" class="search-text"><input type="button" value="开始找房" class="search-btn">
        </div>
        <div class="index-search-con">
            <input type="text" placeholder="请输入商铺名称" class="search-text"><input type="button" value="开始找房" class="search-btn">
        </div>
        <div class="index-search-con">
            <input type="text" placeholder="请输入写字楼名称" class="search-text"><input type="button" value="开始找房" class="search-btn">
        </div>
    </div>
</div>
<div class="head">
    <div class="con hiden">
        <a href="/web/house/" class="head-1">
            <h2 class="s18">学区找房</h2>
            <p class="c6">助力您的孩子，跨入希望的起跑线</p>
        </a>
        <a href="/web/information/" class="head-2">
            <h2 class="s18">房产问答</h2>
            <p class="c6">买房版十万个为什么，专家来为您解惑</p>
        </a>
        <a href="/web/financial/" class="head-3">
            <h2 class="s18">千誉金融</h2>
            <p class="c6">年息6%，全程托管，资金更安全</p>
        </a>
    </div>
</div>
<div class="hot-wrap">
    <div class="con hiden">
        <div class="hot-list">
            <div class="title bg1"><h2>楼市热点</h2><span></span></div>
            <div class="hot-list-img">
                <a href="<?php if(empty(!$top_hot_news)) echo '/web/information/detail/?id='.$top_hot_news->id; else echo '#';?>">
                    <div class="hover-img"><img src="<?=Utils::getValue($top_hot_news,'hot_img_url','')?>"></div>
                    <p><?=Utils::getValue($top_hot_news,'title','')?></p>
                </a>
            </div>
                <ul>
                <?php foreach ($news_hot_list as $item): ?>
                <li><span><?=$item->class_name?></span><a href="/web/information/detail/?id=<?=$item->id?>"><?=$item->title?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="hot-img">
            <div class="title bg1"><h2>帮你买房</h2><span></span></div>
            <ul>
                <?php foreach ($news_help_list as $item): ?>
                <li>
                    <a href="/web/information/detail/?id=<?=$item->id?>">
                        <div class="hover-img"><img src="<?=$item->recommend_img_url?>"></div>
                        <p><?=$item->title?></p>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<div class="index-data">
    <h2 class="s24 tc">北京9月二手房市场行情</h2>
    <ul class="data">
        <li class="data-1">
            <b>4.8<font class="up"></font></b>
            <p>昨日新增客房比</p>
        </li>
        <li class="data-2">
            <b>55205<font class="down"></font></b>
            <p>二手房源全市均价(元/m²)</p>
        </li>
        <li class="data-3">
            <b>268<font class="up"></font></b>
            <p>昨日成交量（套）</p>
        </li>
        <li class="data-4">
            <b>59037<font class="down"></font></b>
            <p>二手房源挂牌均价(元/m²)</p>
        </li>
        <li class="data-5">
            <b>23607<font class="down"></font></b>
            <p>昨日房源带看量（次）</p>
        </li>
    </ul>
</div>
<div class="resource bg1">
    <div class="con hiden">
        <div class="title bg1"><h2>新房源</h2><span></span><a href="/web/loupan/">Read More</a></div>
        <div class="resource-new bgf fl">
            <a href="/web/loupan/" title="泰禾西府大院"><img src="static/web/photo/img-2.jpg" class="fl"></a>
            <h3 class="s18"><a href="">泰禾西府大院</a></h3>
            <p>均价：<font class="s18 orange">待定</font></p>
            <p>项目地址：西三环丽泽桥西北角</p>
            <p>最新开盘：2016年09月30日</p>
        </div>
        <div class="resource-new bgf fr">
            <a href="/web/loupan/" title="流星花园三区"><img src="static/web/photo/img-3.jpg" class="fl"></a>
            <h3 class="s18"><a href="">流星花园三区</a></h3>
            <p>均价：<font class="s18 orange">2000万/套</font></p>
            <p>项目地址：西育知路地铁站对面</p>
            <p>最新开盘：2016年09月30日</p>
        </div>
        <div class="title bg1 clear"><h2>二手房</h2><span></span><a href="/web/house/">Read More</a></div>
        <ul class="resource-list hiden">
            <li>
                <a href="/web/house/" title="兴都苑"><img src="static/web/photo/img-1.jpg"></a>
                <p class="s18"><b class="fl"><a href="">兴都苑</a></b><span class="orange fr">380万</span></p>
                <p class="c6"><span class="fl">3室2厅1卫 110 m²</span><span class="fr">3.5万/平</span></p>
            </li>
            <li>
                <a href="/web/house/" title=""><img src="static/web/photo/img-2.jpg"></a>
                <p class="s18"><b class="fl"><a href="">华芳园</a></b><span class="orange fr">450万</span></p>
                <p class="c6"><span class="fl">3室2厅1卫 110 m²</span><span class="fr">3.5万/平</span></p>
            </li>
            <li>
                <a href="/web/house/" title=""><img src="static/web/photo/img-3.jpg"></a>
                <p class="s18"><b class="fl"><a href="">朝阳公园西里北区</a></b><span class="orange fr">380万</span></p>
                <p class="c6"><span class="fl">3室2厅1卫 110 m²</span><span class="fr">3.5万/平</span></p>
            </li>
            <li>
                <a href="/web/house/" title=""><img src="static/web/photo/img-4.jpg"></a>
                <p class="s18"><b class="fl"><a href="">天赐良园二期</a></b><span class="orange fr">580万</span></p>
                <p class="c6"><span class="fl">3室2厅1卫 110 m²</span><span class="fr">3.5万/平</span></p>
            </li>
        </ul>
    </div>
</div>
<div class="foot-info bgf tc">
	<span>
    	<img src="static/web/images/foot-1.png">
        <p class="s18">真实价格 真实房源</p>
        <p class="c6">千氏承诺，假一赔百</p>
    </span>
    <span>
    	<img src="static/web/images/foot-2.png">
        <p class="s18">海量房源 覆盖全城</p>
        <p class="c6">房源信息覆盖广</p>
    </span>
    <span>
    	<img src="static/web/images/foot-3.png">
        <p class="s18">服务品质 欢迎监督</p>
        <p class="c6">客户投诉，单单公示</p>
    </span>
    <span>
    	<img src="static/web/images/foot-4.png">
        <p class="s18">安心承诺 保驾护航</p>
        <p class="c6">亿元保障赔付</p>
    </span>
</div>
<!-- content end -->
<script>
    var menu = 'index_menu';
    $(function () {
        $('.search-btn').click(function () {
            location.href='/web/house';
        })
    })
</script>