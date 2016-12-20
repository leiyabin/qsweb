<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="北京二手房出售,北京二手房买卖,北京买二手房,北京二手房网,北京二手房,通州二手房出售,通州二手房买卖,通州买二手房,通州二手房网,通州二手房">
        <meta name="description" content="千氏地产网,买北京二手房就到千氏地产网,买通州二手房就到千氏地产网">
        <meta name="viewport" content="width=1200">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $this->title?></title>
        <link rel="stylesheet" href="/static/web/css/common.css">
        <script src="/static/web/js/jquery-1.12.1.min.js"></script>
        <script src="/static/web/js/common.js"></script>
        <!--[if lte IE 8]>
        <link rel="stylesheet" href="/static/web/css/ie8.css">
        <![endif]-->
        <link rel="stylesheet" href="/static/web/css/jquery.fancybox.css">
    </head>

    <body>
    <!-- header start -->
    <div class="top con hiden">
        <a href="/"><img src="/static/web/images/logo.png" class="logo"></a>
        <ul class="nav">
            <li id="index_menu"><a href="/">首页</a></li>
            <li id="house_menu"><a href="/web/house/">二手房</a></li>
            <li id="loupan_menu"><a href="/web/loupan/">新房</a></li>
            <li id="oversea_menu"><a href="/web/oversea/">海外</a></li>
            <li id="information_menu"><a href="/web/information/">百科</a></li>
            <li id="broker_menu"><a href="/web/broker/">经纪人</a></li>
            <li id="tool_menu"><a href="/web/tools/">工具</a></li>
            <li id="financial_menu"><a href="/web/financial/">金融</a></li>
        </ul>
    </div>
    <!-- header end -->
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    <div class="foot">千氏（北京）房地产经纪有限公司 | 网络经营许可证 京ICP备14049807号-5 | © Copyright©2016 千氏地产网版权所有</div>
    </body>
    </html>
<?php $this->endPage() ?>