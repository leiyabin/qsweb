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
        <span style="font-style: normal">修改分类</span></h2>
</div>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    $(function () {
        $("#edit_button").click(function () {
            var $name = $('input[name=name]').val().trim();
            if (!checkVal($name, '分类', true, 0, 20)) {
                return;
            }
            var $id = $('input[name=id]').val().trim();
            $.ajax({
                url: '/admin/config/editclass',
                type: 'post',
                dataType: 'json',
                data: {id: $id, name: $name},
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
    <input type="hidden" name="id" value="<?= $model->id; ?>">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-3 control-label">分类</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?= $model->name; ?>"
                       required>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <button class="btn btn-primary" id="edit_button">提交</button>
            </div>
        </div>
    </div>
</div>