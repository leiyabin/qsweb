<?php
/**
 * add.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
    <script charset="utf-8" src="/static/admin/js/form.check.js"></script>
    <script charset="utf-8" src="/static/admin/js/dropdown.js"></script>
<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
    <div class="pageheader" style="height: 50px;padding-top: 10px">
        <h2><span style="font-style: normal">片区管理</span>
            <span style="font-style: normal">添加</span></h2>
    </div>
<?php $this->endBlock(); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 10%">区县
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6 dropdown">
                    <button style="width: 200px;" class="btn btn-default dropdown-toggle" type="button" tag="0"
                            id="dropdownMenu1"
                            data-toggle="dropdown">
                        请选择区县
                    </button>
                    <ul style="margin-left: 10px" class="dropdown-menu" role="menu">
                        <?php foreach ($list as $item): ?>
                            <li class="li_on_click" role="presentation" tag="<?= $item->id; ?>">
                                <a role="menuitem" tabindex="-1" href="#"><?= $item->value; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <fond style="color: red">注意：【配置管理】中添加区县</fond>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" style="width: 10%">名称
                    <fond style="color: red">*</fond>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="area_name" class="form-control">
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
                    var $class_id = $('#dropdownMenu1').attr('tag');
                    var $name = $('input[name=area_name]').val().trim();
                    if ($class_id == 0) {
                        alert('请选择区县！');
                        return;
                    }
                    if (!checkVal($name, '名称', true, 0, 50)) {
                        return;
                    }
                    $.ajax({
                        url: '/admin/area/add',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            class_id: $class_id,
                            name: $name
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