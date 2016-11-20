<?php
use yii\helpers\Html;

?>
<script charset="utf-8" src="/static/admin/js/form.check.js"></script>
<?php $this->beginBlock('header');//头部附加 ?>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    $("#setpwd_button").click(function () {
        var $old_password = $('input[name=old_password]').val().trim();
        var $password = $('input[name=password]').val().trim();
        var $repeat_password = $('input[name=repeat_password]').val().trim();
        var $id = $('input[name=admin_id]').val().trim();
        if (!checkVal($old_password, '原密码', true, 6)) {
            return;
        }
        if (!checkVal($password, '新密码', true, 6)) {
            return;
        }
        if ($repeat_password != $password) {
            alert('两次密码不一样！');
            return;
        }
        $.ajax({
            url: '/admin/admin/setpwd',
            method: 'post',
            dataType: 'json',
            data: {id: $id, old_password: $old_password, password: $password, repeat_password: $repeat_password},
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
        });
        return false;
    })
</script>
<?php $this->endBlock(); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">修改密码</h4>

        <p>在这里可以修改你的登录密码</p>
    </div>
    <div class="panel-body panel-body-nopadding" style="margin-top: 20px;margin-left: 20px">
        <input type="hidden" name="admin_id" value="1">
        <div class="form-group">
            <label class="col-sm-3 control-label">原密码</label>

            <div class="col-sm-6">
                <input type="password" name="old_password" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">新密码</label>

            <div class="col-sm-6">
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">重复新密码</label>

            <div class="col-sm-6">
                <input type="password" name="repeat_password" class="form-control" required>
            </div>
        </div>

    </div>
    <!-- panel-body -->
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <button id="setpwd_button" class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
    <!-- panel-footer -->
</div><!-- panel -->