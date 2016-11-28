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
<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
<div class="pageheader" style="height: 50px;padding-top: 10px">
    <h2><span style="font-style: normal">经纪人</span>
        <span style="font-style: normal">经纪人列表</span></h2>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    function doDelete(ids) {
        if (!window.confirm('确定要删除id为[' + ids + ']的这些记录吗?')) {
            return false;
        }
        $.ajax({
            url: '/admin/broker/batchdel',
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
    $("#search_button").click(function () {
        var class_id = $('#dropdownMenu1').attr('tag');
        var value = $("input[name=search]").val().trim();
        if (class_id == 0 && value == '') {
            return;
        }
        var url = '/admin/broker/index?';
        if (class_id != 0) {
            url += 'position_id=' + class_id + '&';
        }
        if (value != '') {
            url += 'name=' + value;
        }
        location.href = url;
    });
</script>
<?php $this->endBlock(); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="toolbar">
            <a href="<?= Url::to(['add']); ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i>
                新增</a>
            <div style="display: inline-block;margin-left:15px;">
                <div class="form-inline">
                    <div class="form-group">
                        <div class="col-sm-6 dropdown">
                            <button style="width: 200px; height: 40px" class="btn btn-default dropdown-toggle"
                                    type="button"
                                    tag="<?= $position_id ?>"
                                    id="dropdownMenu1"
                                    data-toggle="dropdown">
                                请选择职位
                            </button>
                            <ul style="margin-left: 10px;" class="dropdown-menu" role="menu">
                                <?php foreach ($class_list as $item): ?>
                                    <li class="li_on_click" role="presentation" tag="<?= $item->id; ?>">
                                        <a role="menuitem" tabindex="-1" href="#"><?= $item->value; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <input style="margin-left: 32px" type="text" name="search" class="form-control"
                               value="<?= $name ?>"
                               placeholder="请输入经纪人姓名">
                    </div>
                    <button type="submit" id="search_button" class="btn btn-default">搜索</button>
                </div>
            </div>
        </div>
        <h4>经纪人列表</h4>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>id</th>
                <th>姓名</th>
                <th>职位</th>
                <th>联系方式</th>
                <th>好评</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($broker_list as $item): ?>
                <tr>
                    <th><input type="checkbox" name="ids[]" value="<?= $item->id; ?>"></th>
                    <th><?= $item->id; ?></th>
                    <th><?= $item->name; ?></th>
                    <th><?= $item->position_name; ?></th>
                    <th><?= $item->phone; ?></th>
                    <th><?= $item->code; ?>%</th>
                    <th><?= \app\components\Utils::formatDateTime($item->c_t); ?></th>
                    <th>
                        <a href="<?= Url::to(['edit', 'id' => $item->id]); ?>"><i class="fa fa-pencil"></i></a>
                        <i class="fa fa-trash-o" style="margin-left: 10px;cursor: pointer" tag="<?= $item->id ?>"></i>
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
