/**
 * Created by lx on 2016/11/20.
 */
$(function () {
    $(".li_on_click").click(function () {
        var class_id = $(this).attr('tag');
        var class_name = $(this).find('a').html();
        $('#dropdownMenu1').attr('tag', class_id).html(class_name);

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
