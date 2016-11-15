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
        <h2><span style="font-style: normal">房产百科</span>
            <span style="font-style: normal">添加</span></h2>
    </div>
<?php $this->endBlock(); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">分类</label>
                <div class="col-sm-6 dropdown">
                    <button style="width: 200px;" class="btn btn-default dropdown-toggle" type="button" tag="0"
                            id="dropdownMenu1"
                            data-toggle="dropdown">
                        请选择分类
                    </button>
                    <ul style="margin-left: 10px" class="dropdown-menu" role="menu">
                        <?php foreach ($list as $item): ?>
                            <li class="li_on_click" role="presentation" tag="<?= $item->id; ?>">
                                <a role="menuitem" tabindex="-1"  href="#"><?= $item->value; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">标题</label>
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
            $(".li_on_click").click(function () {
                var class_id = $(this).attr('tag');
                var class_name = $(this).find('a').html();
                $('#dropdownMenu1').attr('tag', class_id).html(class_name);

            });
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
                    url: '/admin/news/add',
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