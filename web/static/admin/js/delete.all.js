/**
 * Created by lx on 2016/11/20.
 */
$(function () {
    $("#selectAll").click(function () {
        $("input[name='ids[]']").prop('checked', $(this).prop('checked'));
    });
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
});