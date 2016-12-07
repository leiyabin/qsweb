<div class="bg1">
    <div class="sea-banner"></div>
    <div class="sea-info tc">
	<span>
    	<img src="/static/web/images/sea-1.png">
        <p class="mt10"><b class="s18">专业团队</b></p>
        <p class="c6 mt5">提供海外资产配置方案</p>
    </span>
        <span>
    	<img src="/static/web/images/sea-2.png">
        <p class="mt10"><b class="s18">一站服务</b></p>
        <p class="c6 mt5">复杂流程我们帮您解决</p>
    </span>
        <span>
    	<img src="/static/web/images/sea-3.png">
        <p class="mt10"><b class="s18">交易安心</b></p>
        <p class="c6 mt5">交易全程资金监管保安全</p>
    </span>
    </div>
    <div class="sea-map"></div>
    <div class="sea-case">
        <h2 class="tc s24 n mt30">富力公主湾项目案例</h2>
        <ul class="con hiden">
            <li>
                <div class="hover-img"><img src="/static/web/photo/sea-img-1.jpg"></div>
                <p class="s18 tc"><a href="">尽显国家战略红利</a></p>
            </li>
            <li>
                <div class="hover-img"><img src="/static/web/photo/sea-img-2.jpg"></div>
                <p class="s18 tc"><a href="">尽显新加坡繁华</a></p>
            </li>
            <li>
                <div class="hover-img"><img src="/static/web/photo/sea-img-3.jpg"></div>
                <p class="s18 tc"><a href="">尽显国家战略红利</a></p>
            </li>
            <li>
                <div class="hover-img"><img src="/static/web/photo/sea-img-1.jpg"></div>
                <p class="s18 tc"><a href="">尽显新加坡繁华</a></p>
            </li>
            <li>
                <div class="hover-img"><img src="/static/web/photo/sea-img-2.jpg"></div>
                <p class="s18 tc"><a href="">尽显国家战略红利</a></p>
            </li>
            <li>
                <div class="hover-img"><img src="/static/web/photo/sea-img-3.jpg"></div>
                <p class="s18 tc"><a href="">尽显新加坡繁华</a></p>
            </li>
        </ul>
        <a href="/web/oversea/more/" class="sea-more">+更多案例+</a>
    </div>
    <div class="sea-ask">
        <h2 class="tc s24 n">海外房产答疑</h2>
        <ul class="con hiden mt30">
            <?php foreach ($information_list as $item): ?>
            <li><a href="/web/information/detail/?id=<?=$item->id?>"><?=$item->title?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<script>
    var menu = 'oversea_menu';
</script>