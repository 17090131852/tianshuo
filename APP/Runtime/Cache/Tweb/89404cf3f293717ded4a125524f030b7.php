<?php if (!defined('THINK_PATH')) exit();?><style>
    .iptTxt{ border:1px solid #ddd; text-indent:.5em; height:30px; }
    .iptBtn{ width:95%; height:36px; color:#fff; font-size:1.125em; margin-left:5%; background:#0eb493; border:1px solid #0eb493; }
    form{ padding-bottom:1.5em; }
    form ul li{ margin-top:1em; }
    form ul li img{ float:right; }
    form ul li .iptTxt{ width:100%; }
    .styled-select { width: 97%; height:30px; margin-left:3%; overflow: hidden; background: url(/Public/Images/Tweb/arrowDown.png) no-repeat right #fff; border-right:1px solid #ddd;}
    .styled-select select { background: transparent; width: 106%; padding: 5px; font-size: 16px; border: 1px solid #ddd; height: 40px;-webkit-appearance: none; /*for chrome*/ }

    @media screen and (min-width: 768px) {
        .loginForm{ width:360px; float:right; margin:60px 160px 0 0;}
    }
    @media screen and (max-width: 414px) {
        .login{ background:#fff; margin-top:2em;}
    }
</style>
<section class="clearfix">
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
</section>