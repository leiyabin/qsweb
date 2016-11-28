/**
 * Created by lx on 2016/11/20.
 */
function li_on_click_fun($obj) {
    var class_id = $obj.attr('tag');
    var class_name = $obj.find('a').html();
    $obj.parent().siblings('button').attr('tag', class_id).html(class_name);
}
$(function () {
    $(".li_on_click").click(function () {
        li_on_click_fun($(this));
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

});
