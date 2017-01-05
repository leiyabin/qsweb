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
});