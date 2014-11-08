<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>开通招聘服务-拉勾网-最专业的互联网招聘平台</title>
        <meta name="description" content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网">
        <meta name="keywords" content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招">
        <link href="h/images/favicon.ico" rel="Shortcut Icon">
        <link href="/Public/HomeStyle/css/style.css" type="text/css" rel="stylesheet">
        <link href="/Public/HomeStyle/css/external.min.css" type="text/css" rel="stylesheet">
        <link href="/Public/HomeStyle/css/popup.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/Public/HomeStyle/js/jquery.1.10.1.min.js"></script>
        <script src="/Public/HomeStyle/js/jquery.lib.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="/Public/HomeStyle/js/ajaxfileupload.js"></script>
        <script src="/Public/HomeStyle/js/additional-methods.js" type="text/javascript"></script>
        <!--[if lte IE 8]>
            <script type="text/javascript" src="/Public/HomeStyle/js/excanvas.js">
            </script>
        <![endif]-->
    </head>
    
    <body>
        <div id="body">
             <div id="header">
    <div class="wrapper">
        <a class="logo" href="index.html">
            <img width="229" height="43" alt="拉勾招聘-专注互联网招聘" src="/Public/homestyle/images/logo.png">
        </a>
        <ul id="navheader" class="reset">
            <li>
                <a href="index.html">
                    首页
                </a>
            </li>
            <li <?php if(company == 'company'): ?>class="current"<?php endif; ?>>
                <a href="<?php echo U('Home/Company/index');?>">
                    公司
                </a>
            </li>
            <li>
                <a target="_blank" href="">
                    论坛
                </a>
            </li>
            <li>
                <a rel="nofollow" href="">
                    简历管理
                </a>
            </li>
            <li>
                <a rel="nofollow" href="create.html">
                    发布职位
                </a>
            </li>
        </ul>
        <dl class="collapsible_menu">
            <dt>
                <span>
                    aaaaa&nbsp;
                </span>
                <span class="red dn" id="noticeDot-1">
                </span>
                <i>
                </i>
            </dt>
            <dd>
                <a href="positions.html">
                    我发布的职位
                </a>
            </dd>
            <dd>
                <a href="positions.html">
                    我收到的简历
                </a>
            </dd>
            <dd class="btm">
                <a href="myhome.html">
                    我的公司主页
                </a>
            </dd>
            <dd>
                <a href="jianli.html">
                    我要找工作
                </a>
            </dd>
            <dd>
                <a href="accountBind.html">
                    帐号设置
                </a>
            </dd>
            <dd class="logout">
                <a rel="nofollow" href="login.html">
                    退出
                </a>
            </dd>
        </dl>

    </div>
</div>
            <!-- end #header -->
            <div id="container">
                <div class="content_mid">
                    <!--验证邮箱-->
                    <dl class="c_section c_section_service">
                        <dt>
                            <h2>
                                <em></em>
                                开通招聘服务
                            </h2>
                        </dt>
                        <dd>
                            <div class="os_step_3">
                            </div>
                            <div class="open_service_success">
                                <h3>
                                    验证邮件已发送至：<?php echo ($data["email"]); ?>
                                </h3>
                                <h4>
                                    请点击邮件内的链接完成确认，确认后即可发布职位登录邮箱点击邮件内的链接，验证后即可发布职位
                                </h4>
                                <!-- <div class="emailus">
                                我们已将主题为“开通招聘服务信息确认”邮件发送至邮箱：<a class="f18"></a> <br />
                                请点击邮件内的链接完成确认，确认后即可发布职位
                                </div> -->
                            </div>
                            <div class="open_service_success_btm">
                                <h5>
                                    没有收到确认邮件，怎么办？
                                </h5>
                                <div class="contacttip">
                                    1.邮箱地址填写错误？
                                    <a href="<?php echo U('Home/companyReg/step', array('update'=>1));?>">
                                        重新填写邮箱地址
                                    </a>
                                    <br>
                                    2.看看是否在邮箱的垃圾邮件、广告邮件目录里
                                    <br>
                                    3.稍等几分钟，若还未收到验证邮件，
                                    <a id="resendOpenService" href="javascript:void(0)">
                                        重新发送验证邮件
                                    </a>
                                    <br>
                                    4.还未收到验证邮件，请联系我们，邮箱：vivi@lagou.com 电话：010-57286997
                                </div>
                                <!-- <span id="tip" style="display:none; float:right; margin:-60px 0 0
                                -20px;">验证邮件发送成功！</span> -->
                            </div>
                        </dd>
                    </dl>
                    <div class="clear">
                    </div>
                    <input type="hidden" value="de66a3b79bed40df9c0c2a470d356435" id="resubmitToken">
                    <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;">
                    </a>
                </div>
                <!-- end #container -->
            </div>
            <!-- end #body -->
            <div id="footer">
    <div class="wrapper">
        <a rel="nofollow" target="_blank" href="about.html">
            联系我们
        </a>
        <a target="_blank" href="http://www.lagou.com/af/zhaopin.html">
            互联网公司导航
        </a>
        <a rel="nofollow" target="_blank" href="http://e.weibo.com/lagou720">
            拉勾微博
        </a>
        <a rel="nofollow" href="javascript:void(0)" class="footer_qr">
            拉勾微信
            <i>
            </i>
        </a>
        <div class="copyright">
            &copy;2013-2014 Lagou
            <a href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action"
            target="_blank">
                京ICP备14023790号-2
            </a>
        </div>
    </div>
</div>
            <!-- -->
        </div>
        <script type="text/javascript">
            jQuery(function($){

                $('#resendOpenService').click(function(){
                    $.ajax({
                        url : '<?php echo U('Home/CompanyReg/sendMail');?>',
                        type : 'post',
                        data : 'email=<?php echo ($data["email"]); ?>',
                        success : function(data)
                        {
                            alert(data.msg);
                        }
                    });
                });
            });
        </script>
    </body>
</html>