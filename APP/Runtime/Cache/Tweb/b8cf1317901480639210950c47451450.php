<?php if (!defined('THINK_PATH')) exit();?><style>
    .TableBox{ padding-bottom:2em; }
    .pageTitle{ line-height:2em; color:#1ea78d; font-size:1.25em; margin-top:2em; }
    .form-group{ margin-top:1em; }
    .iptBtn{ background: #0eb493;  color: #fff;}
    .iptBtn:hover, .iptBtn:visited, .iptBtn:active{color:#fff; text-decoration: none;}
    .table { margin-bottom: 0; }
    .table>tbody>tr>td{ line-height: 2em; }
    .table>tbody>tr>td>a:visited { color: #fff; }

    .extract{
        padding: .5em 1em;
        border: 1px solid #0eb493;
        border-bottom-right-radius: 6px;
        border-top-right-radius: 6px;
    }
    .mt20{
        margin-top:20px;
    }
</style>

<section class="container">
    <div class="TableBox">
        <div class="familyTree">
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr class="row">
                            <td>订单号</td>
                            <td>提现金额</td>
                            <td>开户行</td>
                            <td>银行卡号</td>
                            <td>提现状态</td>
                            <td>提现时间</td>
                            <td>备注</td>
                        </tr>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="row">
                                <td><?php echo ($vo["order_sn"]); ?></td>
                                <td><?php echo ($vo["amount"]); ?></td>
                                <td><?php echo ($vo["bank_account"]); ?> </td>
                                <td><?php echo ($vo["card_number"]); ?> </td>
                                <td><?php echo (getPlayState($vo["state"])); ?> </td>
                                <td><?php echo ($vo["addtime"]); ?> </td>
                                <td><?php echo ($vo["remark"]); ?> </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
                <div class="am-cf page">
                    <?php echo ($page); ?>
                </div>
            </div>
</section>