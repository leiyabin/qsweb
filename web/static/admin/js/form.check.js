/**
 * Created by lx on 2016/11/20.
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