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
    <h2><span style="font-style: normal">系统用户管理</span>
        <span style="font-style: normal">修改用户</span></h2>
</div>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    $(function () {
        $("#edit_button").click(function () {
            var $password = $('input[name=password]').val().trim();
            var $name = $('input[name=name]').val().trim();
            var $email = $('input[name=email]').val().trim();
            var $phone = $('input[name=phone]').val().trim();
            if (!checkVal($password, '密码', false, 6)) {
                return;
            }
            if (!checkVal($name, '姓名', true, 0, 20)) {
                return;
            }
            if (!checkType($email, 'email')) {
                return;
            }
            if (!checkType($phone, 'phone')) {
                return;
            }
            $.ajax({
                url: '/admin/admin/edit',
                type: 'post',
                dataType: 'json',
                data: {password: $password, email: $email, phone: $phone, name: $name},
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
            <label class="col-sm-3 control-label">用户名</label>
            <div class="col-sm-6">
                <input type="text" disabled class="form-control" name="username" value="<?= $model->username; ?>"
                       required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">密码</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="password" value="">
                <p class="help-block">留空则密码保持不变</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">姓名</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?= $model->name; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">邮箱</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?= $model->email; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">电话</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?= $model->phone; ?>">
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