<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="viewport" content="width=1200">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $this->title?></title>
        <link rel="stylesheet" href="/static/web/css/common.css">
        <script src="/static/web/js/jquery-1.12.1.min.js"></script>
        <script src="/static/web/js/common.js"></script>
        <!--[if lte IE 8]>
        <link rel="stylesheet" href="/static/web/css/ie8.css">
        <![endif]-->
    </head>

    <body>
    <!-- header start -->
    <div class="top con hiden">
        <a href="/"><img src="/static/web/images/logo.png" class="logo"></a>
        <ul class="nav">
            <li class="nav-current"><a href="/">首页</a></li>
            <li><a href="/web/house/index/">二手房</a></li>
            <li><a href="/web/loupan/index/">新房</a></li>
            <li><a href="/web/oversea/index/">海外</a></li>
            <li><a href="/web/information/index/">热点</a></li>
            <li><a href="/web/broker/index/">经纪人</a></li>
            <li><a href="/web/tools/index/">工具</a></li>
            <li><a href="/web/financial/index/">金融</a></li>
        </ul>
    </div>
    <!-- header end -->
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    <div class="foot">北京千氏房地产经纪有限公司 | 网络经营许可证 京ICP备11024601号-12 | © Copyright©2010-2016 千氏网版权所有</div>
    </body>
    </html>
<?php $this->endPage() ?>