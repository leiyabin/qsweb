/**
 * Created by lx on 2016/11/6.
 */
function checkVal(val, name, required, minlenght, maxlength) {
    var res = true;
    if (required && val == '') {
        alert(name + '不能为空');
        res = false;
    }
    if (val != '' && minlenght !== undefined && val.length < minlenght) {
        alert(name + '长度不能小于' + minlenght);
        res = false;
    }
    if (val != '' && maxlength !== undefined && val.length > maxlength) {
        alert(name + '长度不能大于' + maxlength);
        res = false;
    }
    return res;
}

function checkType(val, type) {
    if (type == 'email') {
        var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
        if (!re.test(val)) {
            alert('邮件格式不正确');
            return false;
        }
    }
    if (type == 'phone') {
        var re = /^1\d{10}$/;
        if (!re.test(val)) {
            alert('手机格式不正确');
            return false;
        }
    }
    return true;
}

function ajaxFileUpload(file_name) {
    if ($('#' + file_name).val() != '') {
        $.ajaxFileUpload({
            url: '/admin/file/addimg', //用于文件上传的服务器端请求地址
            secureuri: false, //是否需要安全协议，一般设置为false
            fileElementId: file_name, //文件上传域的ID
            dataType: 'json', //返回值类型 一般设置为json
            success: function (res,status)  //服务器成功响应处理函数
            {
                res= res.match(/{\S*}/)[0];
                res = eval('(' + res + ')');
                var obj =  $("input[name=" + file_name + "_url]");
                if (res.status == 'undefined' || res.status == 0) {
                    alert(res.msg);
                    obj.siblings('.upload_res').remove();
                    obj.after('<label style="color: red" class="upload_res">上传失败</label>');
                } else {
                    obj.attr("value", res.data.file_name);
                    obj.siblings('.upload_res').remove();
                    obj.after(' <a target="_blank" class="upload_res" href="'+res.data.file_path+'">点击查看</a>');
                }
            },
            error:function (data) {
                alert('服务器出错！')
            }
        });
    } else {
        alert('请先选择文件！');
    }
}