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
            <span style="font-style: normal">添加用户</span></h2>
    </div>
<?php $this->endBlock(); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">用户名<fond style="color: red">*</fond></label>
                <div class="col-sm-6">
                    <input type="text" name="username" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">密码<fond style="color: red">*</fond></label>
                <div class="col-sm-6">
                    <input type="text" name="password" class="form-control" value="000000">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">姓名<fond style="color: red">*</fond></label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">邮箱<fond style="color: red">*</fond></label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">手机号<fond style="color: red">*</fond></label>
                <div class="col-sm-6">
                    <input type="text" name="phone" class="form-control">
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
                var $username = $('input[name=username]').val().trim();
                var $password = $('input[name=password]').val().trim();
                var $name = $('input[name=name]').val().trim();
                var $email = $('input[name=email]').val().trim();
                var $phone = $('input[name=phone]').val().trim();
                if (!checkVal($username, '用户名', true, 0, 20)) {
                    return;
                }
                if (!checkVal($password, '密码', true, 6)) {
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
                    url: '/admin/admin/add',
                    type: 'post',
                    dataType: 'json',
                    data: {username: $username, password: $password, email: $email, phone: $phone, name: $name},
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