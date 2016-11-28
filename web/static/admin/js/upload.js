/**
 * Created by lx on 2016/11/20.
 */
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
$(function () {
    $('.upload_file').click(function () {
        var file_name = $(this).attr('tag');
        ajaxFileUpload(file_name);
    });
});