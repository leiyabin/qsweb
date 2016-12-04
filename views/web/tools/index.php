<div class="bg1 tool">
    <div class="con">
        <div class="calculator">
            <div class="list-sort">
                <a href="javascript:return false" class="sort-this" id="tab_1">房贷计算器</a>
                <a href="javascript:return false" id="tab_2">北京二手房税费计算器</a>
                <a href="javascript:return false" id="tab_3">新房税费计算器</a>
            </div>
            <div id='tab_1_div' class="calculator-con hiden" style="display:block;">
                <form class="fl">
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
                        <span class="c6 cal-label">计算方式：</span>
                        <div class="select_box">
                            <span>按贷款总额</span>
                            <ul>
                                <li>按贷款总额</li>
                                <li>按房屋总价</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款总额：</span>
                        <div class="cal-text"><input type="number" placeholder="请输入大于0的数字">万元</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">商贷年利率：</span>
                        <div class="select_box">
                            <span>最新基准利率</span>
                            <ul>
                                <li>7折</li>
                                <li>7.5折</li>
                                <li>8折</li>
                                <li>8.5折</li>
                                <li>9折</li>
                                <li>最新基准利率</li>
                                <li>1.05倍</li>
                                <li>1.1倍</li>
                                <li>1.2倍</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label"></span>
                        <div class="cal-text"><input type="text">%</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">贷款期限：</span>
                        <div class="select_box">
                            <span>30年</span>
                            <ul>
                                <li>30年</li>
                                <li>25年</li>
                                <li>20年</li>
                                <li>15年</li>
                                <li>10年</li>
                                <li>5年</li>
                            </ul>
                        </div>
                    </div>
                    <input type="button" value="开始计算" class="calculator-btn s16 cf" style="margin-top: 152px;">
                </form>
                <div class="calculator-result2 fr">
                    <h3 class="n cf"><span>类型</span><span>等额本息还款</span><span>等额本金还款</span></h3>
                    <table>
                        <tr>
                            <td>月供</td>
                            <td><font class="orange">0</font> 元</td>
                            <td><font class="orange">0</font> 元</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right; padding-right: 76px">每月递减&nbsp;<font class="orange">1022</font> 元</td>
                        </tr>
                        <tr>
                            <td>还款月数</td>
                            <td><font class="orange">0</font> 元</td>
                            <td><font class="orange">0</font> 元</td>
                        </tr>
                        <tr>
                            <td>总利息</td>
                            <td><font class="orange">0</font> 元</td>
                            <td><font class="orange">0</font> 元</td>
                        </tr>
                        <tr>
                            <td>本息合计</td>
                            <td><font class="orange">0</font> 元</td>
                            <td><font class="orange">0</font> 元</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id='tab_2_div' class="calculator-con hiden" style="display:none;">
                <form class="fl">
                    <div>
                        <span class="c6 cal-label">房屋类型：</span>
                        <div class="select_box">
                            <span>商品房</span>
                            <ul>
                                <li>商品房</li>
                                <li>公房</li>
                                <li>一类经济适用房</li>
                                <li>二类经济适用房</li>
                                <li>商业用房</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">住宅类型：</span>
                        <div class="select_box">
                            <span>普通住宅</span>
                            <ul>
                                <li>普通住宅</li>
                                <li>非普通住宅</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">卖房家庭唯一：</span>
                        <div class="select_box">
                            <span>唯一</span>
                            <ul>
                                <li>唯一</li>
                                <li>不唯一</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">距上次交易：</span>
                        <div class="select_box">
                            <span>满五年</span>
                            <ul>
                                <li>满五年</li>
                                <li>满两年</li>
                                <li>不满两年</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">买房家庭首套：</span>
                        <div class="select_box">
                            <span>首套</span>
                            <ul>
                                <li>首套</li>
                                <li>二套房</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">房屋面积：</span>
                        <div class="cal-text"><input type="number" placeholder="请输入房屋面积">平米</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">房屋总价：</span>
                        <div class="cal-text"><input type="number" placeholder="请输入房屋价格">万元</div>
                    </div>
                    <input type="button" value="开始计算" class="calculator-btn s16 cf">
                </form>
                <div class="calculator-result2 fr">
                    <h3 class="n cf"><span>类型</span><span>税费详情</span><span>税费占比</span></h3>
                    <table>
                        <tr>
                            <td>税费合计</td>
                            <td><font class="orange">--</font></td>
                            <td><font class="orange">--</font></td>
                        </tr>
                        <tr>
                            <td>契税</td>
                            <td><font class="orange">--</font></td>
                            <td><font class="orange">--</font></td>
                        </tr>
                        <tr>
                            <td>增值税</td>
                            <td><font class="orange">--</font></td>
                            <td><font class="orange">--</font></td>
                        </tr>
                        <tr>
                            <td>个税</td>
                            <td><font class="orange">--</font></td>
                            <td><font class="orange">--</font></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id='tab_3_div' class="calculator-con hiden" style="display:none;">
                <form class="fl">
                    <div>
                        <span class="c6 cal-label">住宅类型：</span>
                        <div class="select_box">
                            <span>普通住宅</span>
                            <ul>
                                <li>普通住宅</li>
                                <li>非普通住宅</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="c6 cal-label">住宅面积：</span>
                        <div class="cal-text"><input type="number" placeholder="请输入住宅面积">平米</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">房屋总价：</span>
                        <div class="cal-text"><input type="number" placeholder="请输入房屋总价">万元</div>
                    </div>
                    <div>
                        <span class="c6 cal-label">是否为首套：</span>
                        <div class="select_box">
                            <span>首套</span>
                            <ul>
                                <li>首套</li>
                                <li>二套房</li>
                            </ul>
                        </div>
                    </div>
                    <input type="button" value="开始计算" class="calculator-btn s16 cf">
                </form>
                <div class="calculator-result2 fr">
                    <h3 class="n cf"><span style="width: 165px">类型</span><span style="width: 165px">税费详情</span></h3>
                    <table>
                        <tr>
                            <td style="width: 165px">税费合计</td>
                            <td><font class="orange">--</font></td>
                        </tr>
                        <tr>
                            <td>契税</td>
                            <td><font class="orange">--</font></td>
                        </tr>
                        <tr>
                            <td>交易手续费</td>
                            <td><font class="orange">--</font></td>
                        </tr>
                        <tr>
                            <td>维修基金</td>
                            <td><font class="orange">--</font></td>
                        </tr>
                        <tr>
                            <td>权属登记费</td>
                            <td><font class="orange">--</font></td>
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
            var div_id =$(this).attr('id')+'_div';
            var div =  $('#'+div_id);
            div.show();
            div.siblings('div .calculator-con').hide();
        })
    })
</script>