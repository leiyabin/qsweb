<?php
/**
 * add.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Html;

?>

<script charset="utf-8" src="/static/admin/js/ajaxfileupload.js"></script>
<script charset="utf-8" src="/static/admin/js/upload.js"></script>
<script charset="utf-8" src="/static/admin/js/form.check.js"></script>
<script charset="utf-8" src="/static/admin/js/dropdown.js"></script>
<script charset="utf-8" src="/static/admin/js/checkbox.js"></script>
<script type="text/javascript" src="/datetime/jedate/jedate.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
<script type="text/javascript">
    $(function () {
        jeDate({
            dateCell: "#dateinfo",
            isinitVal: true,
            isTime: true //isClear:false,
        });
    })
    var honse_lat = '<?= $loupan->lat?>';
    var honse_lon = '<?= $loupan->lon?>';
</script>
<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
<div class="pageheader" style="height: 50px;padding-top: 10px">
    <h2><span style="font-style: normal">楼盘</span>
        <span style="font-style: normal">修改</span></h2>
</div>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<?php $this->endBlock(); ?>
<div class="panel panel-default">
    <input type="hidden" name="id" value="<?= $loupan->id ?>">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">名称
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="text" name="loupan_name" class="form-control" value="<?= $loupan->name ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">均价
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="number" name="average_price" style="width: 460px; display: inline"
                       class="form-control" value="<?= $loupan->average_price ?>">万元
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">项目地址
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="text" name="address" class="form-control" value="<?= $loupan->address ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">售楼处地址
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="text" name="sale_office_address" class="form-control"
                       value="<?= $loupan->sale_office_address ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">开盘时间
                <fond style="color: red">*</fond>
            </label>

            <div class="col-sm-6">
                <input type="text" readonly id="dateinfo" name="opening_time" class="form-control datainp"
                       value="<?= \app\components\Utils::formatDateTime($loupan->opening_time); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">区县/片区
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6 dropdown" style="float:left; width: 296px;">
                <button style="width: 230px;" class="btn btn-default dropdown-toggle" type="button"
                        tag="<?= $loupan->quxian_id; ?>"
                        id="dropdownMenu1"
                        data-toggle="dropdown">
                    请选择区县
                </button>
                <ul style="margin-left: 10px;" class="dropdown-menu" role="menu">
                    <?php foreach ($list as $item): ?>
                        <li class="li_on_click quxian" role="presentation" tag="<?= $item->id; ?>">
                            <a role="menuitem" tabindex="-1" href="#"><?= $item->value; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-sm-6 dropdown" style="float:left;  width: 296px; margin-left: -30px">
                <button style="width: 230px;" class="btn btn-default dropdown-toggle" type="button"
                        tag="<?= $loupan->area_id; ?>"
                        id="dropdownMenu2"
                        data-toggle="dropdown">
                    <?= $loupan->area_name; ?>
                </button>
                <ul style="margin-left: 10px;" class="dropdown-menu area-dropdown" role="menu">
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">物业类型
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6 dropdown">
                <button style="width: 200px;" class="btn btn-default dropdown-toggle" type="button"
                        tag="<?= $loupan->property_type_id; ?>"
                        id="dropdownMenu3"
                        data-toggle="dropdown">
                    <?= $loupan->property_type; ?>
                </button>
                <ul style="margin-left: 10px" class="dropdown-menu" role="menu">
                    <?php foreach (\app\consts\HouseConst::$property_type as $key => $name): ?>
                        <li class="li_on_click" role="presentation" tag="<?= $key ?>">
                            <a role="menuitem" tabindex="-1" href="#"><?= $name ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">售卖状态
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6 dropdown">
                <button style="width: 200px;" class="btn btn-default dropdown-toggle" type="button"
                        tag="<?= $loupan->sale_status; ?>" id="dropdownMenu4"  data-toggle="dropdown">
                    <?= $loupan->sale_status_name; ?>
                </button>
                <ul style="margin-left: 10px" class="dropdown-menu" role="menu">
                    <?php foreach (\app\consts\HouseConst::$sale_status as $key => $name): ?>
                        <li class="li_on_click" role="presentation" tag="<?= $key ?>">
                            <a role="menuitem" tabindex="-1" href="#"><?= $name ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">居室情况
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <?php foreach (\app\consts\HouseConst::$room_num as $key => $name): ?>
                    <label>
                        <input type="checkbox" value="<?= $key ?>"
                               name="jiju" <?php if (in_array($key, $loupan->jiju_arr)) echo 'checked' ?> ><?= $name ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">最小面积
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="number" name="min_square" class="form-control" style="width: 450px; display: inline"
                       value="<?= $loupan->min_square ?>">平方米
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">最大面积
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="number" name="max_square" class="form-control" style="width: 450px; display: inline"
                       value="<?= $loupan->max_square ?>">平方米
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">经纬度
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6" style="width:800px;">
                <div style=" margin:auto;width:800px;height:600px;border:2px solid gray; margin-bottom:20px;"
                     id="container"></div>
                <input style="float: left;width:200px" id="where" name="where" class="form-control" type="text"
                       placeholder="请输入地址">
                <input style="float: left;margin-left: 20px; display: inline" id="but" type="button"
                       class="btn btn-default" value="地图查找"/>
                <fond style="float:left;line-height:40px; margin:0 20px">经度</fond>
                <input style="float: left;width:150px" readonly id="lon" name="lon" maxlength="10"
                       class="form-control" type="text" value="<?= $loupan->lon ?>">
                <fond style="float:left;line-height:40px; margin:0 20px">维度</fond>
                <input style="float: left;width:150px" readonly id="lat" name="lat" type="text" maxlength="9"
                       class="form-control" value="<?= $loupan->lat ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">开发商
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="text" name="developers" class="form-control" value="<?= $loupan->developers ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">物业公司
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="text" name="property_company" class="form-control"
                       value="<?= $loupan->property_company ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">banner图
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6" style="width: 700px;">
                <label style="color: blue;display: block;">*请上传图片尺寸1200*336（或是长:宽=4:1）的图片</label>
                <input type="file" id="banner_img" name="banner_img" style="display:inline">
                <input type="button" tag="banner_img" value="上传" class="upload_file">
                <input type="hidden" name="banner_img_url" value="<?= $loupan->banner_img; ?>">
                <?php
                if (!empty($loupan->banner_img_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $loupan->banner_img_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">楼盘图片
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <label style="color: blue;display: block;">*请上传图片尺寸360*200（或是长:宽=9:5）的图片</label>
                <input type="file" id="loupan_img" name="loupan_img" style="display:inline">
                <input type="button" tag="loupan_img" value="上传" class="upload_file">
                <input type="hidden" name="loupan_img_url" value="<?= $loupan->img; ?>">
                <?php
                if (!empty($loupan->img_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $loupan->img_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">效果图1
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <label style="color: blue;display: block;">*请上传图片尺寸524*360（或是长:宽=3:2）的图片</label>
                <input type="file" id="img_1" name="img_1" style="display:inline">
                <input type="button" tag="img_1" value="上传" class="upload_file">
                <input type="hidden" name="img_1_url" value="<?= $loupan->img_1; ?>">
                <?php
                if (!empty($loupan->img_1_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $loupan->img_1_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">效果图2
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <label style="color: blue;display: block;">*请上传图片尺寸524*360（或是长:宽=3:2）的图片</label>
                <input type="file" id="img_2" name="img_2" style="display:inline">
                <input type="button" tag="img_2" value="上传" class="upload_file">
                <input type="hidden" name="img_2_url" value="<?= $loupan->img_2; ?>">
                <?php
                if (!empty($loupan->img_2_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $loupan->img_2_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">效果图3
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <label style="color: blue;display: block;">*请上传图片尺寸524*360（或是长:宽=3:2）的图片</label>
                <input type="file" id="img_3" name="img_3" style="display:inline">
                <input type="button" tag="img_3" value="上传" class="upload_file">
                <input type="hidden" name="img_3_url" value="<?= $loupan->img_3; ?>">
                <?php
                if (!empty($loupan->img_3_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $loupan->img_3_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">效果图4
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <label style="color: blue;display: block;">*请上传图片尺寸524*360（或是长:宽=3:2）的图片</label>
                <input type="file" id="img_4" name="img_4" style="display:inline">
                <input type="button" tag="img_4" value="上传" class="upload_file">
                <input type="hidden" name="img_4_url" value="<?= $loupan->img_4; ?>">
                <?php
                if (!empty($loupan->img_4_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $loupan->img_4_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">效果图5
            </label>
            <div class="col-sm-6">
                <label style="color: blue;display: block;">*请上传图片尺寸524*360（或是长:宽=3:2）的图片</label>
                <input type="file" id="img_5" name="img_5" style="display:inline">
                <input type="button" tag="img_5" value="上传" class="upload_file">
                <input type="hidden" name="img_5_url" value="<?= $loupan->img_5; ?>">
                <?php
                if (!empty($loupan->img_5_url)) {
                    echo '<a target="_blank" class="upload_res" href="' . $loupan->img_5_url . '">点击查看</a>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">产权年限
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <input type="number" name="right_time" class="form-control"
                       style="width: 480px; display: inline" value="<?= $loupan->right_time ?>">年
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">楼盘特色
                <fond style="color: red">*</fond>
            </label>
            <div class="col-sm-6">
                <?php foreach (\app\consts\HouseConst::$feature as $key => $name): ?>
                    <label>
                        <input type="checkbox"
                               value="<?= $key ?>" <?php if (in_array($key, $loupan->tag_arr)) echo 'checked' ?> <?= $name ?>
                               name="tag"><?= $name ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" style="width: 12%">备注
            </label>
            <div class="col-sm-6">
                <input type="text" name="remark" class="form-control" value="<?= $loupan->remark ?>">
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
<script>
    $(function () {
        $(".quxian").click(function () {
            var $class_id = $(this).attr('tag');
            //获取片区数据
            $.ajax({
                url: '/admin/area/getbyclassid',
                type: 'post',
                dataType: 'json',
                data: {
                    class_id: $class_id
                },
                success: function (res) {
                    if (res.status == 1) {
                        var $ul = $('.area-dropdown');
                        $ul.find('li').remove();
                        $ul.siblings('button').html('请选择片区').attr('tag', 0);
                        for (var j in res.data) {
                            $('<li class="li_on_click" onclick="li_on_click_fun($(this))" role="presentation" tag="' + res.data[j].id + '">' +
                                '<a role="menuitem" tabindex="-1" href="#">' + res.data[j].name + '</a></li>').appendTo($ul);
                        }
                    } else {
                        alert(res.msg);
                    }
                },
                error: function () {
                    alert('系统错误，请联系客服人员！');
                }
            })

        });
        $("#add_button").click(function () {
            var $name = $('input[name=loupan_name]').val().trim();
            var $average_price = $('input[name=average_price]').val().trim();
            var $address = $('input[name=address]').val().trim();
            var $sale_office_address = $('input[name=sale_office_address]').val().trim();
            var $opening_time = $('input[name=opening_time]').val().trim();
            var $area_id = $('#dropdownMenu2').attr('tag');
            var $property_type_id = $('#dropdownMenu3').attr('tag');
            var $sale_status = $('#dropdownMenu4').attr('tag');
            var $jiju = $('input:checkbox[name=jiju]:checked');
            $jiju = getCheckBoxStr($jiju);
            var $min_square = $('input[name=min_square]').val().trim();
            var $max_square = $('input[name=max_square]').val().trim();
            var $lon = $('input[name=lon]').val().trim();
            var $lat = $('input[name=lat]').val().trim();
            var $developers = $('input[name=developers]').val().trim();
            var $property_company = $('input[name=property_company]').val().trim();
            var $banner_img = $('input[name=banner_img_url]').val().trim();
            var $img = $('input[name=loupan_img_url]').val().trim();
            var $img_1 = $('input[name=img_1_url]').val().trim();
            var $img_2 = $('input[name=img_2_url]').val().trim();
            var $img_3 = $('input[name=img_3_url]').val().trim();
            var $img_4 = $('input[name=img_4_url]').val().trim();
            var $img_5 = $('input[name=img_5_url]').val().trim();
            var $right_time = $('input[name=right_time]').val().trim();
            var $tag = $('input:checkbox[name=tag]:checked');
            $tag = getCheckBoxStr($tag);
            var $remark = $('input[name=remark]').val().trim();
            var $id = $('input[name=id]').val().trim();
            if (!checkVal($name, '名称', true, 0, 30)) {
                return;
            }
            if (!checkVal($average_price, '均价', true)) {
                return;
            }
            if (!checkVal($address, '项目地址', true, 0, 50)) {
                return;
            }
            if (!checkVal($sale_office_address, '售楼处地址', true, 0, 50)) {
                return;
            }
            if (!checkVal($opening_time, '开盘时间', true)) {
                return;
            }
            if ($area_id == 0) {
                alert('请选择片区！');
                return;
            }
            if ($property_type_id == 0) {
                alert('请选择物业类型！');
                return;
            }
            if ($sale_status == 0) {
                alert('请选择售卖状态！');
                return;
            }
            if (!checkVal($jiju, '居室情况', true)) {
                return;
            }
            if ($min_square == 0) {
                alert('请填写最小面积！');
                return;
            }
            if ($max_square == 0) {
                alert('请填写最大面积！');
                return;
            }
            if ($lon == 0 || $lat == 0) {
                alert('请选择经纬度！');
                return;
            }
            if (!checkVal($developers, '开发商', true, 0, 50)) {
                return;
            }
            if (!checkVal($property_company, '物业公司', true, 0, 50)) {
                return;
            }
            if (!checkVal($banner_img, 'banner图', true)) {
                return;
            }
            if (!checkVal($img, '楼盘图片', true)) {
                return;
            }
            if (!checkVal($img_1, '效果图1', true)) {
                return;
            }
            if (!checkVal($img_2, '效果图2', true)) {
                return;
            }
            if (!checkVal($img_3, '效果图3', true)) {
                return;
            }
            if (!checkVal($img_4, '效果图4', true)) {
                return;
            }
            if ($right_time == 0) {
                alert('请填写产权年限！');
                return;
            }
            if (!checkVal($tag, '楼盘特色', true)) {
                return;
            }
            if (!checkVal($remark, '备注', false, 0, 15)) {
                return;
            }
            $.ajax({
                url: '/admin/loupan/edit',
                type: 'post',
                dataType: 'json',
                data: {
                    id: $id,
                    name: $name,
                    average_price: $average_price,
                    address: $address,
                    sale_office_address: $sale_office_address,
                    opening_time: $opening_time,
                    area_id: $area_id,
                    property_type_id: $property_type_id,
                    sale_status: $sale_status,
                    jiju: $jiju,
                    min_square: $min_square,
                    max_square: $max_square,
                    lon: $lon,
                    lat: $lat,
                    developers: $developers,
                    property_company: $property_company,
                    banner_img: $banner_img,
                    img: $img,
                    img_1: $img_1,
                    img_2: $img_2,
                    img_3: $img_3,
                    img_4: $img_4,
                    right_time: $right_time,
                    tag: $tag,
                    remark: $remark
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
<script type="text/javascript" src="/static/admin/js/map.js"></script>
