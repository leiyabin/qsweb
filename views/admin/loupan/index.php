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
    <h2><span style="font-style: normal">新房</span>
        <span style="font-style: normal">楼盘列表</span></h2>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
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
                                    tag="<?= $property_type_id ?>"
                                    id="dropdownMenu1"
                                    data-toggle="dropdown">
                                请选择物业类型
                            </button>
                            <ul style="margin-left: 10px;" class="dropdown-menu" role="menu">
                                <?php foreach ($property_type_list as $key => $item): ?>
                                    <li class="li_on_click" role="presentation" tag="<?= $key; ?>">
                                        <a role="menuitem" tabindex="-1" href="#"><?= $item; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <input style="margin-left: 32px" type="text" name="search" class="form-control"
                               value="<?= $name ?>"
                               placeholder="请输入楼盘名称">
                    </div>
                    <button type="submit" id="search_button" class="btn btn-default">搜索</button>
                </div>
            </div>
        </div>
        <h4>楼盘列表</h4>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>id</th>
                <th>名称</th>
                <th>物业类型</th>
                <th>片区</th>
                <th>地址</th>
                <th>户型</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($loupan_list as $item): ?>
                <tr>
                    <th><input type="checkbox" name="ids[]" value="<?= $item->id; ?>"></th>
                    <th><?= $item->id; ?></th>
                    <th><?= $item->name; ?></th>
                    <th><?= $item->property_type; ?></th>
                    <th><?= $item->area_name; ?></th>
                    <th><?= $item->address; ?></th>
                    <th><a href="/admin/doormodel/index/?loupan_id=<?= $item->id; ?>">【查看】</a></th>
                    <th><?= \app\components\Utils::formatDateTime($item->c_t); ?></th>
                    <th>
                        <a href="<?= Url::to(['edit', 'id' => $item->id]); ?>"><i class="fa fa-pencil"></i></a>
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
