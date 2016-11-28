<?php
/**
 * add.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Html;

?>
<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/editor/plugins/code/prettify.js"></script>
<script charset="utf-8" src="/static/admin/js/editor.js"></script>
<script charset="utf-8" src="/static/admin/js/ajaxfileupload.js"></script>
<script charset="utf-8" src="/static/admin/js/upload.js"></script>
<script charset="utf-8" src="/static/admin/js/dropdown.js"></script>
<script charset="utf-8" src="/static/admin/js/form.check.js"></script>
<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
<div class="pageheader" style="height: 50px;padding-top: 10px">
    <h2><span style="font-style: normal">房产百科</span>
        <span style="font-style: normal">修改</span></h2>
</div>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    $(function () {
        var class_id = $('#dropdownMenu1').attr('tag');
        var lis = $('.li_on_click');
        var hot_mark = '<?php echo $news->hot; ?>';
        if (hot_mark == 1) {
            $('input[name=hot_mark]').prop('checked', true);
        }
        var recommend_mark = '<?php echo $news->recommend; ?>';
        if (recommend_mark == 1) {
            $('input[name=recommend_mark]').prop('checked', true);
        }
        $("#add_button").click(function () {
            var $class_id = $('#dropdownMenu1').attr('tag');
            var $title = $('input[name=title]').val().trim();
            var $hot_img = $('input[name=hot_img_url]').val().trim();
            var $img = $('input[name=news_img_url]').val().trim();
            var $recommend_img = $('input[name=recommend_img_url]').val().trim();
            var $news_content = editor.html().trim();
            var $id = $('input[name=id]').val().trim();
            if ($class_id == 0) {
                alert('请选择分类！');
                return;
            }
            if (!checkVal($title, '标题', true, 0, 50)) {
                return;
            }
            if ($('input[name=hot_mark]').prop("checked")) {
                if (!checkVal($hot_img, '热点图片', true)) {
                    return;
                }
            }
            if ($('input[name=recommend_mark]').prop("checked")) {
                if (!checkVal($recommend_img, '帮你买房图片', true)) {
                    return;
                }
            }
            if (!checkVal($news_content, '内容', true)) {
                return;
            }
            $.ajax({
                url: '/admin/news/edit',
                type: 'post',
                dataType: 'json',
                data: {
                    class_id: $class_id,
                    title: $title,
                    hot_img: $hot_img,
                    recommend_img: $recommend_img,
                    img: $img,
                    id: $id,
                    news_content: $news_content
                },
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
    <input type="hidden" name="id" value="<?= $news->id ?>">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 10%">分类
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6 dropdown">
                <button style="width: 200px;" class="btn btn-default dropdown-toggle" type="button"
                        tag="<?= $news->class_id; ?>"
                        id="dropdownMenu1"
                        data-toggle="dropdown">
                    请选择分类
                </button>
                <ul style="margin-left: 10px" class="dropdown-menu" role="menu">
                    <?php foreach ($list as $item): ?>
                        <li class="li_on_click" role="presentation" tag="<?= $item->id; ?>">
                            <a role="menuitem" tabindex="-1" href="#"><?= $item->value; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 10%">标题
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="text" name="title" class="form-control" value="<?= $news->title; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 10%">楼市热点</label>
            <div class="col-sm-6" style="width: 700px;">
                <input type="checkbox" name="hot_mark">
                <label style="color: red">*选中之后将展示在首页【楼市热点】栏目中，请上传图片尺寸408*228（或是长:宽=9:5）</label>
                <input type="file" id="hot_img" name="hot_img" style="display:inline">
                <input type="button" tag="hot_img" value="上传" class="upload_file">
                <input type="hidden" name="hot_img_url" value="<?= $news->hot_img; ?>">
                <?php
                if (!empty($news->hot_img_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $news->hot_img_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width:10%">帮你买房</label>
            <div class="col-sm-6" style="width: 700px;">
                <input type="checkbox" name="recommend_mark">
                <label style="color: red">*选中之后将展示在首页【帮你买房】栏目中，请上传图片尺寸800*160（或是长:宽=5:1）</label>
                <input type="file" id="recommend_img" name="recommend_img" style="display:inline">
                <input type="button" tag="recommend_img" value="上传" class="upload_file">
                <input type="hidden" name="recommend_img_url" value=" <?= $news->recommend_img; ?>">
                <?php
                if (!empty($news->recommend_img_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $news->recommend_img_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 10%">图片</label>
            <div class="col-sm-6">
                <label style="color: blue;display: block;">*请上传图片尺寸455X163（或是长:宽=5:2）的图片</label>
                <input type="file" id="news_img" name="news_img" style="display:inline">
                <input type="button" tag="news_img" value="上传" class="upload_file">
                <input type="hidden" name="news_img_url" value="<?= $news->img; ?>">
                <?php
                if (!empty($news->img_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $news->img_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 10%">内容
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <textarea name="news_content"
                          style="width:800px;height:600px;visibility:hidden;"><?php echo $news->content; ?></textarea>
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