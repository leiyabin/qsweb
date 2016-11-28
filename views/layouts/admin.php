<?php
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>后台管理</title>
        <link href="<?= Url::to('/static/admin/css/style.default.css'); ?>" rel="stylesheet">
        <link href="<?= Url::to('/static/admin/css/custom.css'); ?>" rel="stylesheet">
        <link rel="stylesheet" href="/editor/themes/default/default.css"/>
        <link rel="stylesheet" href="/editor/plugins/code/prettify.css"/>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="<?=Url::to('/static/admin/js/html5shiv.js');?>"></script>
        <script src="<?=Url::to('/static/admin/js/respond.min.js');?>"></script>
        <![endif]-->
        <script src="<?= Url::to('/static/admin/js/jquery-1.10.2.min.js'); ?>"></script>
        <script src="<?= Url::to('/static/admin/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
        <script src="<?= Url::to('/static/admin/js/bootstrap.min.js'); ?>"></script>
        <script src="<?= Url::to('/static/admin/js/modernizr.min.js'); ?>"></script>
        <script src="<?= Url::to('/static/admin/js/jquery.sparkline.min.js'); ?>"></script>
        <script src="<?= Url::to('/static/admin/js/toggles.min.js'); ?>"></script>
        <script src="<?= Url::to('/static/admin/js/retina.min.js'); ?>"></script>
        <script src="<?= Url::to('/static/admin/js/jquery.cookies.js'); ?>"></script>
        <script src="<?= Url::to('/static/jquery-form/jquery.form.min.js'); ?>"></script>
        <script src="<?= Url::to('/static/admin/js/custom.js'); ?>"></script>
        <?php if (isset($this->blocks['header'])): ?>
            <?= $this->blocks['header'] ?>
        <?php endif; ?>
        <?php $this->head() ?>
    </head>

    <body style="overflow: visible;">
    <?php $this->beginBody() ?>

    <section>

        <div class="leftpanel">

            <div class="logopanel" style="text-align: center;height: 50px;line-height: 34px">
                <span style="font-size: medium">千氏地产网站管理后台</span>
            </div><!-- LOGO -->

            <div class="leftpanelinner">
                <h5 class="sidebartitle">导航</h5>
                <ul class="nav nav-pills nav-stacked nav-bracket" id="sidemenus">
                    <li><a href="<?= Url::toRoute('/admin/index'); ?>"><i class="fa fa-home"></i> <span>后台首页</span></a>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>系统用户</span></a>
                        <ul class="children">
                            <li><a href="<?= Url::to(['/admin/admin/index']); ?>"><i
                                        class="fa fa-caret-right"></i> 用户列表</a></li>
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>二手房</span></a>
                        <ul class="children">
                            <li><a href="/admin/house/index/"><i class="fa fa-caret-right"></i>二手房列表</a></li>
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>新房</span></a>
                        <ul class="children">
                            <li><a href="/admin/loupan/index/"><i class="fa fa-caret-right"></i>楼盘列表</a></li>
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>房产百科</span></a>
                        <ul class="children">
                            <li><a href="/admin/news/list/"><i class="fa fa-caret-right"></i>房产百科列表</a></li>
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>经纪人</span></a>
                        <ul class="children">
                            <li><a href="/admin/broker/index/"><i class="fa fa-caret-right"></i>经纪人列表</a></li>
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>千誉金融</span></a>
                        <ul class="children">
                            <li><a href="/admin/financial/index/"><i class="fa fa-caret-right"></i>主营业务</a></li>
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>海外</span></a>
                        <ul class="children">
                            <li><a href="/admin/oversea/index/"><i class="fa fa-caret-right"></i>案例</a></li>
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>配置信息设置</span></a>
                        <ul class="children">
                            <li><a href="/admin/config/class/"><i class="fa fa-caret-right"></i>分类列表</a></li>
                            <li><a href="/admin/config/info/"><i class="fa fa-caret-right"></i>配置列表</a></li>
                            <li><a href="/admin/area/index/"><i class="fa fa-caret-right"></i>片区管理</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- 左侧菜单 -->
        </div><!-- 左侧panel -->

        <div class="mainpanel">
            <div class="headerbar">
                <a class="menutoggle"><i class="fa fa-bars"></i></a>
                <div class="header-right">
                    <ul class="headermenu">
                        <li>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                        style="padding:14px 10px;">
                                    管理员
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-usermenu pull-right" style="min-width: 100px; ">
                                    <li style="width:100px"><a href="<?= Url::to(['admin/admin/setpwd']); ?>"><i
                                                class="glyphicon glyphicon-cog"></i>修改密码</a></li>
                                    <li style="width:100px"><a href="<?= Url::toRoute(['admin/auth/logout']); ?>"><i
                                                class="glyphicon glyphicon-log-out"></i> 注销</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div><!-- 头部右侧 -->

            </div><!-- 头部 -->

            <?php if (isset($this->blocks['breadcrumb'])): ?>
                <?= $this->blocks['breadcrumb'] ?>
            <?php endif; ?>

            <div class="contentpanel">
                <?= $content ?>
            </div>
        </div><!-- 主面板 -->
    </section>

    <script>
        //菜单状态管理
        function menuActive(pid) {
            var sessId = pid + '_sess_href';
            var sidebar = $(pid);
            if (sessionStorage[sessId]) {
                var anchor = sidebar.find("a[href='" + sessionStorage[sessId] + "']");
                anchor.parent().addClass('active');
                if (anchor.parent().parent().hasClass('nav') == false) {
                    anchor.parent().parent().css('display', 'block');
                    anchor.parent().parent().parent().addClass("active nav-active");
                }
            } else {
                sidebar.find("ul").eq(0).addClass('in');
            }
            //检测session
            sidebar.find("li a").click(function () {
                var href = $(this).attr('href');
                sessionStorage[sessId] = href;
            });
        }
        menuActive('#sidemenus');
    </script>
    <?php if (isset($this->blocks['footer'])): ?>
        <?= $this->blocks['footer'] ?>
    <?php endif; ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>