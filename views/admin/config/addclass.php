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
            <span style="font-style: normal">添加分类</span></h2>
    </div>
<?php $this->endBlock(); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">分类</label>
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
                var $name = $('input[name=name]').val().trim();
                if (!checkVal($name, '分类', true, 0, 20)) {
                    return;
                }
                $.ajax({
                    url: '/admin/config/addclass',
                    type: 'post',
                    dataType: 'json',
                    data: {name: $name},
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