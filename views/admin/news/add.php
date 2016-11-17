<?php
/**
 * add.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Html;

?>
    <script charset="utf-8" src="/editor/kindeditor.js"></script>
    <script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="/editor/plugins/code/prettify.js"></script>
    <script>
        KindEditor.ready(function (K) {
            var editor1 = K.create('textarea[name="news_content"]', {
                cssPath: '/editor/plugins/code/prettify.css',
                uploadJson: '/editor/php/upload_json.php',
                fileManagerJson: '/editor/php/file_manager_json.php',
                allowFileManager: true,
                afterCreate: function () {
                    var self = this;
                    K.ctrl(document, 13, function () {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                    K.ctrl(self.edit.doc, 13, function () {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                }
            });
            prettyPrint();
        });
    </script>

<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
    <div class="pageheader" style="height: 50px;padding-top: 10px">
        <h2><span style="font-style: normal">房产百科</span>
            <span style="font-style: normal">添加</span></h2>
    </div>
<?php $this->endBlock(); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <form id="form_1">
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 10%">分类
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6 dropdown">
                    <button style="width: 200px;" class="btn btn-default dropdown-toggle" type="button" tag="0"
                            id="dropdownMenu1"
                            data-toggle="dropdown">
                        请选择分类
                    </button>
                    <ul style="margin-left: 10px" class="dropdown-menu" role="menu">
                        <?php foreach ($list as $item): ?>
                            <li class="li_on_click" role="presentation" tag="<?= $item->id; ?>">
                                <a role="menuitem" tabindex="-1" href="#"><?= $item->value; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 10%">标题
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 10%">楼市热点</label>
                <div class="col-sm-6" style="width: 700px;">
                    <input type="checkbox" name="hot_mark">
                    <label style="color: red">*选中之后将展示在首页【楼市热点】栏目中，请上传图片尺寸408*228（或是长:宽=9:5）</label>
                    <input type="file" name="hot_img">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 10%">帮你买房</label>
                <div class="col-sm-6" style="width: 700px;">
                    <input type="checkbox" name="recommend_mark">
                    <label style="color: red">*选中之后将展示在首页【帮你买房】栏目中，请上传图片尺寸800*160（或是长:宽=5:1）</label>
                    <input type="file" name="recommend_img">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 10%">图片</label>
                <div class="col-sm-6">
                    <label style="color: blue">*请上传图片尺寸455X163（或是长:宽=5:2）的图片</label>
                    <input type="file" name="news_img">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 10%">内容
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                <textarea name="news_content"
                          style="width:800px;height:600px;visibility:hidden;"></textarea>
                </div>
            </div>
            </form>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <button id="add_button" class="btn btn-primary">提交</button>
                </div>
            </div>
        </div>
    </div>
<?php $this->beginBlock('footer');//尾部附加 ?>
    <script>
        $(function () {
            $(".li_on_click").click(function () {
                var class_id = $(this).attr('tag');
                var class_name = $(this).find('a').html();
                $('#dropdownMenu1').attr('tag', class_id).html(class_name);

            });
            $("#add_button").click(function () {
                var $class_id = $('#dropdownMenu1').attr('tag');
                var $title = $('input[name=title]').val().trim();
                var $hot_img = $('input[name=hot_img]').val().trim();
                var $recommend_img = $('input[name=recommend_img]').val().trim();
                var $news_img = $('input[name=news_img]').val().trim();
                var $news_content = $('textarea[name=news_content]').html();
                if ($class_id == 0) {
                    alert('请选择分类！');
                    return;
                }
                if (!checkVal($title, '标题', true, 0, 50)) {
                    return;
                }
                if ($('input[name=hot_mark]').prop("checked")) {
                    if (!checkVal($hot_img, '热点图片', true)) {
                        return;
                    }
                }
                if ($('input[name=recommend_mark]').prop("checked")) {
                    if (!checkVal($recommend_img, '帮你买房图片', true)) {
                        return;
                    }
                }
                if (!checkVal($news_content, '内容', true)) {
                    return;
                }
                $.ajax({
                    url: '/admin/news/add',
                    type: 'post',
                    dataType: 'json',
                    data: $('#form_1').serialize(),
                    success: function (res) {
                        if (res.status == 1) {
                            alert('添加成功!');
                        } else {
                            alert(res.msg);
                        }
                    },
                    error: function () {
                        alert('系统错误，请联系客服人员！');
                    }
                })
            });
        });
    </script>
<?php $this->endBlock(); ?>