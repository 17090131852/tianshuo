<?php if (!defined('THINK_PATH')) exit();?>
    <div class="login">
        <div class="container loginForm">
            <form action="<?php echo U('Wxq/add1');?>" method="post">
                <ul class="row">
                    <li class="col-lg-12 col-xs-12">
                        <span class="col-lg-4 col-xs-4">昵称：</span>
                        <span class="col-lg-8 col-xs-8"><input class="iptTxt rds5" type="text" name="name" /></span>
                    </li>
                    <li class="col-lg-12 col-xs-12">
                        <span class="col-lg-4 col-xs-4">手机号：</span>
                        <span class="col-lg-8 col-xs-8"><input class="iptTxt rds5" type="text" name="tel" placeholder="手机号" /></span>
                    </li>
                    <li class="col-lg-12 col-xs-12">
                        <input class="iptBtn rds5" type="submit" value="注册" />
                        <input name="acount_sta" type="hidden" value="1" />
                    </li>
                </ul>
            </form>
        </div>
    </div>