<?php
/**
 * add.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
    <script charset="utf-8" src="/static/admin/js/ajaxfileupload.js"></script>
    <script charset="utf-8" src="/static/admin/js/upload.js"></script>
    <script charset="utf-8" src="/static/admin/js/form.check.js"></script>
    <script charset="utf-8" src="/static/admin/js/dropdown.js"></script>
    <script charset="utf-8" src="/static/admin/js/checkbox.js"></script>
<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
    <div class="pageheader" style="height: 50px;padding-top: 10px">
        <h2><span style="font-style: normal">楼盘</span>
            <span style="font-style: normal">添加</span></h2>
    </div>
<?php $this->endBlock(); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <input type="hidden" name="loupan_id" value="<?= $loupan_id ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 12%">朝向
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="face" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 12%">室厅卫情况
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="shitinwei" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 12%">建筑面积
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <input type="number" name="build_area" class="form-control" style="width: 450px; display: inline">平方米
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 12%">户型图片
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <label style="color: blue;display: block;">*请上传图片尺寸400*400（或是长:宽=1:1）的图片</label>
                    <input type="file" id="doormodel_img" name="doormodel_img" style="display:inline">
                    <input type="button" tag="doormodel_img" value="上传" class="upload_file">
                    <input type="hidden" name="doormodel_img_url">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 12%">装修情况
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <?php foreach (\app\consts\HouseConst::$decoration as $key => $name): ?>
                        <label>
                            <input type="radio" value="<?= $key ?>" name="decoration"><?= $name ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 12%">标签1
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="tag_1" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 12%">标签2
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="tag_2" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 12%">标签3
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="tag_3" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 12%">描述
                </label>
                <div class="col-sm-6">
                    <input type="text" name="description" class="form-control">
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
<?php $this->beginBlock('footer');//尾部附加 ?>
    <script>
        $(function () {
            $("#add_button").click(function () {
                var $loupan_id = $('input[name=loupan_id]').val().trim();
                var $face = $('input[name=face]').val().trim();
                var $shitinwei = $('input[name=shitinwei]').val().trim();
                var $build_area = $('input[name=build_area]').val().trim();
                var $decoration = $('input[name=decoration]:checked').val();
                var $img = $('input[name=doormodel_img_url]').val().trim();
                var $tag_1 = $('input[name=tag_1]').val().trim();
                var $tag_2 = $('input[name=tag_2]').val().trim();
                var $tag_3 = $('input[name=tag_3]').val().trim();
                var $description = $('input[name=description]').val().trim();
                if (!checkVal($face, '朝向', true, 0, 10)) {
                    return;
                }
                if (!checkVal($shitinwei, '室厅卫情况', true, 0, 10)) {
                    return;
                }
                if ($build_area == 0) {
                    alert('请填写建筑面积！');
                    return;
                }
                if (!checkVal($img, '户型图片', true)) {
                    return;
                }
                if ($decoration == undefined) {
                    alert('请选择装修情况！');
                    return;
                }
                if (!checkVal($tag_1, '标签1', true, 0, 10)) {
                    return;
                }
                if (!checkVal($tag_2, '标签2', true, 0, 10)) {
                    return;
                }
                if (!checkVal($tag_3, '标签3', true, 0, 10)) {
                    return;
                }
                if (!checkVal($description, '描述', false, 0, 50)) {
                    return;
                }
                $.ajax({
                    url: '/admin/doormodel/add',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        loupan_id: $loupan_id,
                        face: $face,
                        shitinwei: $shitinwei,
                        build_area: $build_area,
                        decoration: $decoration,
                        img: $img,
                        tag_1: $tag_1,
                        tag_2: $tag_2,
                        tag_3: $tag_3,
                        description: $description
                    },
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