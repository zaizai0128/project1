<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
    
    <head>
        <style type="text/css"></style>
        <meta content="no-siteapp" http-equiv="Cache-Control">
        <link media="handheld" rel="alternate">
        <!-- end 云适配 -->
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>开通招聘服务-拉勾网-最专业的互联网招聘平台</title>
        <meta content="23635710066417756375" property="qc:admins">
        <meta name="description" content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网">
        <meta name="keywords" content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招">
        <meta content="QIQ6KC1oZ6" name="baidu-site-verification">
        <link href="h/images/favicon.ico" rel="Shortcut Icon">
        <link href="/Public/HomeStyle/css/style.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/Public/HomeStyle/js/jquery.1.10.1.min.js"></script>
        <script src="/Public/HomeStyle/js/jquery.lib.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="/Public/HomeStyle/js/ajaxfileupload.js"></script>
        <script src="/Public/HomeStyle/js/additional-methods.js" type="text/javascript"></script>
        <!--[if lte IE 8]>
            <script type="text/javascript" src="/Public/HomeStyle/js/excanvas.js">
            </script>
        <![endif]-->
        <script src="/Public/HomeStyle/js/ajaxCross.json" charset="UTF-8"></script>
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
                <style>
                    .ui-autocomplete{max-height:160px;overflow-y:scroll;}
                </style>
                <div class="content_mid">
                    <!--form-->
                    <dl class="c_section c_section_service">
                        <dt>
                            <h2>
                                <em></em>
                                开通招聘服务
                            </h2>
                        </dt>
                        <dd>
                            <div class="os_step_2"></div>
                            <form class="corp_form" id="companyNameForm" action="<?php echo U('CompanyReg/step2');?>" method="post" onsubmit="return $.sub(this)">
                                <input type="hidden" value="" id="resubmitToken">
                                <h3>
                                    <em class="redstar"> * </em>
                                    公司全称
                                    <span class="explain">
                                        （请输入与公司营业执照一致的公司全称，审核通过后不可更改）
                                    </span>
                                </h3>
                                <input type="text" value="<?php echo ($info["name"]); ?>" name="name" placeholder="请输入与公司营业执照一致的公司全称" name="companyName" id="companyName" class="valid ui-autocomplete-input" autocomplete="off">
                                <span id="beError" style="display:none;" class="error"></span>
                                <input type="submit" value="提 交" id="bindSubmit">
                                <a class="goback" href="<?php echo U('CompanyReg/step', array('update'=>1));?>">
                                    返回修改邮箱地址
                                </a>
                            </form>
                            <div class="contactus">
                                如有问题，请致电：010-57286997或写信给：
                                <a href="mailto:vivi@lagou.com">
                                    vivi@lagou.com
                                </a>
                                ，我们会尽快为你解决。
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="clear"></div>
                <input type="hidden" value="3a9b3124ee0a4adca922f2c9756d1ac1" id="resubmitToken">
                <a rel="nofollow" title="回到顶部" id="backtop"></a>
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
        <script type="text/javascript">
            jQuery(function($) {
                $.extend({
                    sub : function(obj) {
                        var obj = $(obj);
                        $.ajax({
                            url : obj.attr('action'),
                            type : 'post',
                            data : obj.serialize(),
                            success : function(data) {

                                if (data.code > 0) {
                                    window.location.href = data.url;
                                } else {
                                    if (data.code == -1) {
                                        $('#beError').css('display', 'block').html(data.msg);
                                    } else {
                                        $('#beError').css('display', 'block').html(data.msg);
                                    }
                                }
                            }
                        })

                        return false;
                    }
                })
                $('#companyName').blur(function() {
                    var name = $(this).val();
                    var reg = /^([`~!@$^&':;,?~！……&；：。，、？=])/;
                    var res = reg.test(name);
                    if (res) {
                        $('#beError').css('display', 'none').html('');
                    } else {
                        $('$beError').css('display', 'block').html('请输入与公司营业执照一致的公司名称');
                    }
                })

                $('#companyName').focus(function() {
                    $('#beError').css('display', 'none').html('');
                })

            })
        </script>
    </body>

</html>