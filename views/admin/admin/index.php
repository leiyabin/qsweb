<?php
/**
 * index.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Url;

?>

<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
<div class="pageheader" style="height: 50px;padding-top: 10px">
    <h2><span style="font-style: normal">系统用户管理</span>
        <span style="font-style: normal">用户列表</span></h2>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    //全选
    $("#selectAll").click(function () {
        $("input[name='ids[]']").prop('checked', $(this).prop('checked'));
    });
    function doDelete(ids) {
        if (!window.confirm('确定要删除id为[' + ids + ']的这些用户吗?')) {
            return false;
        }
        $.ajax({
            url: '/admin/admin/batchdel',
            dataType: 'json',
            data: {"ids": ids.join(',')},
            error: function (res) {
                alert('系统错误，请联系客服人员！');
            },
            success: function (res) {
                if (res.status == 1) {
                    alert('删除成功!');
                    location.reload(true);
                } else {
                    alert(res.msg);
                }
            }
        });
    }
    $(".fa-trash-o").click(function () {
        var ids = $(this).attr('tag');
        ids = [ids];
        doDelete(ids);
    });
    //批量删除
    $("#batchDel").click(function () {
        var ids = [];
        $("input[name='ids[]']:checked").each(function () {
            ids.push($(this).val());
        });
        doDelete(ids);
    });

</script>
<?php $this->endBlock(); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="toolbar">
            <a href="<?= Url::to(['add']); ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i>
                新增</a>
        </div>
        <h4>系统用户列表</h4>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>uid</th>
                <th>用户名</th>
                <th>姓名</th>
                <th>email</th>
                <th>电话</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $item): ?>
                <tr>
                    <th><input type="checkbox" name="ids[]" value="<?= $item->id; ?>"></th>
                    <th><?= $item->id; ?></th>
                    <th><?= $item->username; ?></th>
                    <th><?= $item->name; ?></th>
                    <th><?= $item->email; ?></th>
                    <th><?= $item->phone; ?></th>
                    <th><?= \app\components\Utils::formatDateTime($item->c_t); ?></th>
                    <th>
                    <td class="table-action">
                        <a href="<?= Url::to(['edit', 'id' => $item->id]); ?>"><i class="fa fa-pencil"></i></a>
                        <i class="fa fa-trash-o"  tag="<?=$item->id?>"></i>
                    </td>
                    </th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
        </div>
        <button class="btn btn-primary btn-sm" id="batchDel">批量删除</button>
    </div>
</div>
