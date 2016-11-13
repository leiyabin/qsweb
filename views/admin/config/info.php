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
    <h2><span style="font-style: normal">配置信息设置</span>
        <span style="font-style: normal">配置列表</span></h2>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    //全选
    $("#selectAll").click(function () {
        $("input[name='ids[]']").prop('checked', $(this).prop('checked'));
    });
</script>
<?php $this->endBlock(); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="toolbar">
            <a href="<?= Url::to(['addinfo']); ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i>
                新增</a>
        </div>
        <h4>配置信息列表</h4>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>id</th>
                <th>分类</th>
                <th>配置</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $item): ?>
                <tr>
                    <th><input type="checkbox" name="ids[]" value="<?= $item->id; ?>"></th>
                    <th><?= $item->id; ?></th>
                    <th><?= $item->class_name; ?></th>
                    <th><?= $item->name; ?></th>
                    <th><?= \app\components\Utils::formatDateTime($item->c_t); ?></th>
                    <th>
                        <a href="<?= Url::to(['editinfo', 'id' => $item->id]); ?>"><i class="fa fa-pencil"></i></a>
                    </th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
        </div>
    </div>
</div>
