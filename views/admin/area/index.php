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
    <h2><span style="font-style: normal">片区管理</span>
        <span style="font-style: normal">片区列表</span></h2>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    //全选
    $("#selectAll").click(function () {
        $("input[name='ids[]']").prop('checked', $(this).prop('checked'));
    });
    function doDelete(ids) {
        if (!window.confirm('确定要删除id为[' + ids + ']的这些记录吗?')) {
            return false;
        }
        $.ajax({
            url: '/admin/area/batchdel',
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
    $(".li_on_click").click(function () {
        var class_id = $(this).attr('tag');
        var class_name = $(this).find('a').html();
        $('#dropdownMenu1').attr('tag', class_id).html(class_name);

    });
    $("#search_button").click(function () {
        var class_id = $('#dropdownMenu1').attr('tag');
        var value = $("input[name=search]").val().trim();
        if (class_id == 0 && value == '') {
            return;
        }
        var url = '/admin/area/index?';
        if (class_id != 0) {
            url += 'class_id=' + class_id + '&';
        }
        if (value != '') {
            url += 'name=' + value;
        }
        location.href = url;
    });
    var class_id = $('#dropdownMenu1').attr('tag');
    if (class_id != '') {
        $('.li_on_click').each(function () {
            if ($(this).attr('tag') == class_id) {
                $(this).click();
                return false;
            }
        })
    }

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
                                    tag="<?= $class_id ?>"
                                    id="dropdownMenu1"
                                    data-toggle="dropdown">
                                请选择区县
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
                               placeholder="请输入区县名称">
                    </div>
                    <button type="submit" id="search_button" class="btn btn-default">搜索</button>
                </div>
            </div>
        </div>
        <h4>片区列表</h4>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>uid</th>
                <th>区县</th>
                <th>名称</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($area_list as $item): ?>
                <tr>
                    <th><input type="checkbox" name="ids[]" value="<?= $item->id; ?>"></th>
                    <th><?= $item->id; ?></th>
                    <th><?= $item->class_name; ?></th>
                    <th><?= $item->name; ?></th>
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