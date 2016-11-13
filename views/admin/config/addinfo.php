<?php
/**
 * add.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Html;

?>

<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
    <div class="pageheader" style="height: 50px;padding-top: 10px">
        <h2><span style="font-style: normal">配置信息设置</span>
            <span style="font-style: normal">添加配置</span></h2>
    </div>
<?php $this->endBlock(); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">分类</label>
                <div class="col-sm-6 dropdown">
                    <button style="width: 200px;" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                            data-toggle="dropdown">
                        Dropdown
                        <span class="caret"></span>
                    </button>
                    <ul style="margin-left: 10px" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">配置</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control">
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
                var $class_id = $('input[name=password]').val().trim();
                var $name = $('input[name=name]').val().trim();
                if (!checkVal($name, '配置', true, 0, 50)) {
                    return;
                }
                $.ajax({
                    url: '/admin/config/addinfo',
                    type: 'post',
                    dataType: 'json',
                    data: {name: $name, class_id: $class_id},
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