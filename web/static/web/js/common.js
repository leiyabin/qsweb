// JavaScript Document
$(document).ready(function () {

//搜索
    var ser_span = $(".index-search p span");
    var ser_t = $(".search-text");
    var ser_c = $(".index-search-con");

    ser_c.first().show();

    ser_span.each(function (index) {
        $(this).click(function () {
            $(this).addClass("search-this").siblings("span").removeClass("search-this");
            ser_c.hide();
            ser_c.eq(index).show();
        });
    });

    ser_t.css("color", "#999");
    ser_t.focus(function () {
        if ($(this).val() == this.defaultValue) {
            $(this).val("");
            $(this).css("color", "#333");
        }
    }).blur(function () {
        if ($(this).val() == "") {
            $(this).val(this.defaultValue);
            $(this).css("color", "#999");
        }
    });

//select美化
    var s_title = $(".select_box span");
    var s_select = $(".select_box li");

    s_title.click(function (e) {
        $(this).next("ul").show();
        e.stopPropagation();
    });

    s_select.click(function () {
        var s_text = $(this).html();
        var s_title_2 = $(this).parent('ul').prev("span");
        s_title_2.html(s_text);
        $(this).parent('ul').hide();
    });

    $(document).click(function () {
        $(".select_box ul").hide();
    });

//底部不足一屏时固定底部
    var foot = $(".foot");
    var w_h = window.outerHeight;
    var b_h = $("body").outerHeight();
    if (b_h < w_h) {
        foot.css({"position": "fixed", "bottom": "0"});
    }

    //网站栏目的选中
    if (typeof(menu) == 'undefined') {
        honse_lon = 116.404032;
    }

});