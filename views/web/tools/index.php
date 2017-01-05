<div class="bg1 tool">
    <div class="con">
        <div class="calculator">
            <div class="list-sort">
                <a href="javascript:return false" class="sort-this" id="tab_1">房贷计算器</a>
                <a href="javascript:return false" id="tab_3">税费计算器</a>
            </div>
            <div id='tab_1_div' class="calculator-con hiden" style="display:block;">
                <form class="fl" style="margin-top: 20px;">
                    <div>
                        <span class="c6 cal-label">房贷类型：</span>
                        <div class="select_box">
                            <span>商业贷款</span>
                            <ul>
                                <li>商业贷款</li>
                                <li>公积金贷款</li>
                                <li>组合贷款</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款年限：</span>
                        <div class="cal-text"><input type="number" id="load_year" placeholder="请输入大于0的数字">年</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款金额</span>
                        <div class="cal-text"><input type="number" id="load_amount">万元</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款利率：</span>
                        <div class="cal-text"><input type="number" id="load_rate">%</div>
                    </div>
                    <input type="button" value="开始计算" class="calculator-btn s16 cf" id="fd_jsq">
                    <p class="s16" style="color: grey;font-size: small;margin-top: 30px;">
                        注：税费，房贷信息仅供参考，具体金额请以实际发生为准。</p>
                </form>
                <div class="calculator-result2 fr">
                    <h3 class="n cf"><span>类型</span><span>等额本息还款</span><span>等额本金还款</span></h3>
                    <table>
                        <tr>
                            <td>月供</td>
                            <td><font class="orange" id="x_yuegong">0</font> 元</td>
                            <td><font class="orange" >--</font> 元</td>
                        </tr>
                        <tr>
                            <td>还款月数</td>
                            <td><font class="orange" id="x_hkys">0</font> 月</td>
                            <td><font class="orange" id="j_hkys">0</font> 月</td>
                        </tr>
                        <tr>
                            <td>总利息</td>
                            <td><font class="orange" id="x_total_lx">0</font> 元</td>
                            <td><font class="orange" id="j_total_lx">0</font> 元</td>
                        </tr>
                        <tr>
                            <td>本息合计</td>
                            <td><font class="orange" id="x_total_bj">0</font> 元</td>
                            <td><font class="orange" id="j_total_bj">0</font> 元</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id='tab_3_div' class="calculator-con hiden" style="display:none;">
                <form class="fl" style="margin-top: 20px;">
                    <div>
                        <span class="c6 cal-label">住宅面积：</span>
                        <div class="cal-text"><input type="number" name="zzmj" placeholder="请输入住宅面积">平米</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">房屋单价：</span>
                        <div class="cal-text"><input type="number" name="fwzj" placeholder="请输入房屋单价">元/平米</div>
                    </div>
                    <input type="button" value="开始计算" class="calculator-btn s16 cf" id="fs_jsq">
                    <p class="s16" style="color: grey;font-size: small;margin-top: 30px;">
                        注：税费，房贷信息仅供参考，具体金额请以实际发生为准。</p>
                </form>
                <div class="calculator-result2 fr">
                    <h3 class="n cf"><span style="width: 165px">类型</span><span style="width: 165px">税费详情（元）</span></h3>
                    <table>
                        <tr>
                            <td style="width: 165px">房款总价</td>
                            <td><font class="orange" id="fs_total_amount">--</font></td>
                        </tr>
                        <tr>
                            <td>印花税</td>
                            <td><font class="orange" id="fs_yin_hua">--</font></td>
                        </tr>
                        <tr>
                            <td>公证费</td>
                            <td><font class="orange" id="fs_gong_zheng">--</font></td>
                        </tr>
                        <tr>
                            <td>契费</td>
                            <td><font class="orange" id="fs_qi_fee">--</font></td>
                        </tr>
                        <tr>
                            <td>委托办理产权手续费</td>
                            <td><font class="orange" id="fs_shou_xv_1">--</font></td>
                        </tr>
                        <tr>
                            <td>房屋买卖手续费</td>
                            <td><font class="orange" id="fs_shou_xv_2">--</font></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var menu = 'tool_menu';
    $(function () {
        $('.list-sort').find('a').click(function () {
            $(this).siblings().removeClass('sort-this');
            $(this).addClass('sort-this');
            var div_id = $(this).attr('id') + '_div';
            var div = $('#' + div_id);
            div.show();
            div.siblings('div .calculator-con').hide();
        });
        $('#fd_jsq').click(function () {
            var $load_rate = $('#load_rate').val().trim();
            var $load_year = $('#load_year').val().trim();
            var $load_amount = $('#load_amount').val().trim();
            if($load_rate == '' || $load_year == '' || $load_amount == ''){
                alert('请填写完整信息！');
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
    })
</script>
<script src="/static/web/js/calculator.js"></script>