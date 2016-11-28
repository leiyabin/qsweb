<?php
/**
 * index.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Url;

?>
<script charset="utf-8" src="/static/admin/js/delete.all.js"></script>
<script charset="utf-8" src="/static/admin/js/dropdown.js"></script>
<script>
    function doDelete(ids) {
        if (!window.confirm('确定要删除id为[' + ids + ']的这些记录吗?')) {
            return false;
        }
        $.ajax({
            url: '/admin/doormodel/batchdel',
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
    $(function () {
        $("#search_button").click(function () {
            var class_id = $('#dropdownMenu1').attr('tag');
            var value = $("input[name=search]").val().trim();
            if (class_id == 0 && value == '') {
                return;
            }
            var url = '/admin/loupan/index?';
            if (class_id != 0) {
                url += 'property_type_id=' + class_id + '&';
            }
            if (value != '') {
                url += 'name=' + value;
            }
            location.href = url;
        });
    })
</script>
<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
<div class="pageheader" style="height: 50px;padding-top: 10px">
    <h2><span style="font-style: normal">新房</span><span style="font-style: normal">楼盘</span>
        <span style="font-style: normal">户型列表</span></h2>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<?php $this->endBlock(); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="toolbar">
            <a href="<?= Url::to(['add']); ?>?loupan_id=<?= $loupan_id ?>" class="btn btn-primary btn-sm"><i
                    class="glyphicon glyphicon-plus"></i>
                新增</a>
        </div>
        <h4>【<?= $loupan_name ?>】户型列表</h4>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>id</th>
                <th>楼盘</th>
                <th>朝向</th>
                <th>室厅卫</th>
                <th>建筑面积(㎡)</th>
                <th>装修情况</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($door_model_list as $item): ?>
                <tr>
                    <th><input type="checkbox" name="ids[]" value="<?= $item->id; ?>"></th>
                    <th><?= $item->id; ?></th>
                    <th><?= $loupan_name; ?></th>
                    <th><?= $item->face; ?></th>
                    <th><?= $item->shitinwei; ?></th>
                    <th><?= $item->build_area; ?></th>
                    <th><?= $item->decoration_name; ?></th>
                    <th><?= \app\components\Utils::formatDateTime($item->c_t); ?></th>
                    <th>
                        <a href="<?= Url::to(['edit', 'id' => $item->id]); ?>"><i class="fa fa-pencil"></i></a>
                        <i class="fa fa-trash-o" style="margin-left: 10px;cursor: pointer" tag="<?= $item->id ?>"></i>
                    </th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <button class="btn btn-primary btn-sm" id="batchDel">批量删除</button>
    </div>
</div>
