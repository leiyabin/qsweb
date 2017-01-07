/**
 * Created by lyb on 2017/1/4.
 */
$(function () {
    $('#fs_jsq').click(function () {
        console.log('1');
        var zzmj = $('input[name=zzmj]').val();
        var fwzj = $('input[name=fwzj]').val();
        if (zzmj == 0 || fwzj == 0) {
            alert('请输入住宅面积和房屋总价！');
            return ;
        }
        var total_amount = (parseInt(zzmj) * parseInt(fwzj)).toFixed(2);
        var yin_hua_shui = (total_amount * 0.0005).toFixed(2);
        var gong_zheng_fei = (total_amount * 0.0003).toFixed(2);
        var qi_shui = (total_amount * 0.003).toFixed(2);
        var shou_xv_fei_1 = (total_amount * 0.0003).toFixed(2);
        var shou_xv_fei_2 = (total_amount * 0.0005).toFixed(2);
        $('#fs_total_amount').html(total_amount);
        $('#fs_yin_hua').html(yin_hua_shui);
        $('#fs_gong_zheng').html(gong_zheng_fei);
        $('#fs_qi_fee').html(qi_shui);
        $('#fs_shou_xv_1').html(shou_xv_fei_1);
        $('#fs_shou_xv_2').html(shou_xv_fei_2);
    });
    $('#fd_jsq').click(function () {
        var $load_rate = $('#load_rate').val().trim();
        var $load_year = $('#load_year').val().trim();
        var $load_amount = $('#load_amount').val().trim();
        if($load_rate == '' || $load_year == '' || $load_amount == ''){
            alert('请填写完整信息！');
            return;
        }
        var load_type = $(".select_box span").html();
        if (load_type == '公积金贷款' || load_type == '商业贷款') {
            var g = parseFloat($load_rate* 0.01);
            var d = parseInt($load_year);
            var e = d * 12;
            var f = 10000 * parseInt($load_amount);
            // 等额本息
            var x_yjhk = g * f / 12 + (g * f / 12) / (Math.pow((1 + g / 12), e) - 1);
            var x_hkze = x_yjhk * e;
            var x_zflx = x_hkze - f;
            // 等额本金
            var j_lxzc = 0;
            var x = 0;
            for (i = 1; i <= e; i++) {
                j_lxzc += (f - x) * g / 12;
                x += f / e;
            }
            var j_hkze = j_lxzc + f;
            //赋值
            $('#x_yuegong').html(x_yjhk.toFixed(2));
            $('#x_hkys').html(e);
            $('#x_total_lx').html(x_zflx.toFixed(2));
            $('#x_total_bj').html(x_hkze.toFixed(2));
            $('#j_hkys').html(e);
            $('#j_total_lx').html(j_lxzc.toFixed(2));
            $('#j_total_bj').html(j_hkze.toFixed(2));
        }
    })
});