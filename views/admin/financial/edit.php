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
<script charset="utf-8" src="/static/admin/js/ajaxfileupload.js"></script>
<script>
    var editor;
    KindEditor.ready(function (K) {
        editor = K.create('textarea[name="news_content"]', {
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
    <h2><span style="font-style: normal">千誉金融</span>
        <span style="font-style: normal">修改</span></h2>
</div>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    $(function () {
        $('.upload_file').click(function () {
            var file_name = $(this).attr('tag');
            ajaxFileUpload(file_name);
        });
        $("#add_button").click(function () {
            var $title = $('input[name=title]').val().trim();
            var $img = $('input[name=financial_img_url]').val().trim();
            var $content = editor.html().trim();
            var $id = $('input[name=id]').val();
            if (!checkVal($title, '标题', true, 0, 50)) {
                return;
            }
            if (!checkVal($img, '图片', true)) {
                return;
            }
            if (!checkVal($content, '内容', true)) {
                return;
            }
            $.ajax({
                url: '/admin/financial/edit',
                type: 'post',
                dataType: 'json',
                data: {
                    title: $title,
                    img: $img,
                    id: $id,
                    content: $content
                },
                success: function (res) {
                    if (res.status == 1) {
                        alert('修改成功!');
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
<div class="panel panel-default">
    <input type="hidden" name="id" value="<?= $financial->id ?>">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 10%">标题
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="text" name="title" class="form-control" value="<?= $financial->title; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 10%">图片</label>
            <div class="col-sm-6">
                <label style="color: red">*请上传图片尺寸400*220（或是长:宽=2:1）</label>
                <input type="file" id="financial_img" name="financial_img" style="display:inline">
                <input type="button" tag="financial_img" value="上传" class="upload_file">
                <input type="hidden" name="financial_img_url" value="<?= $financial->img; ?>">
                <?php
                if (!empty($financial->img_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $financial->img_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 10%">内容
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <textarea name="news_content"
                          style="width:800px;height:600px;visibility:hidden;"><?php echo $financial->content; ?></textarea>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <button id="add_button" class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
</div>