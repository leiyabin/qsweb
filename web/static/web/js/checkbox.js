/**
 * Created by lx on 2016/11/26.
 */
function getCheckBoxStr($obj) {
    var arr = [];
    $obj.each(function (i) {
        arr.push($(this).val());
    });
    var str = arr.join(',');
    return str;
}