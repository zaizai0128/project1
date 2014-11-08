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
                            <div class="os_step_1"></div>
                            <form class="corp_form" id="bindForm" action="<?php echo U('CompanyReg/step1');?>" method="post" onsubmit="return $.sub(this);">
                                <input type="hidden" value="" id="resubmitToken">
                                <h3>
                                    <em class="redstar"> * </em>
                                    联系电话
                                    <span>
                                        （请填写真实有效的电话号码，方便系统校验使用）
                                    </span>
                                </h3>
                                <input type="text" name="tel" value="<?php echo ($arr["tel"]); ?>" placeholder="请输入你的手机号码或座机号码" maxlength="49"
                                name="tel" id="tel">
                                <span id="beError_one" style="display:none;" class="error"></span>
                                <h3>
                                    <em class="redstar"> * </em>
                                    接收简历邮箱
                                    <span>
                                        （该邮箱为公司邮箱，审核通过后不可更改）
                                    </span>
                                </h3>
                                <input type="text" name="email" value="<?php echo ($arr["email"]); ?>" placeholder="请输入你的公司邮箱作为接收简历邮箱" name="email" id="email">
                                <span id="beError_two" style="display:none;" class="error"></span>
                                <input type="submit" value="下一步" id="bindSubmit">
                            </form>
                            <div class="contactus">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">常见问题：</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">问：</td>
                                            <td>填写个人邮箱可以么？</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">答：</td>
                                            <td>
                                                不可以。为了保证每个职位的真实性，拉勾网严格要求招聘方必须提供公司邮箱。（公司邮箱是指以你的公司网址为后缀的免费公司邮箱，例如拉勾网的公司邮箱后缀是@lagou.com）即使是初创公司也必须提供公司邮箱才允许开通招聘。
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">问：</td>
                                            <td>公司没有公司邮箱怎么办？</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">答：</td>
                                            <td>
                                                拉勾网推荐使用免费、稳定的腾讯企业邮箱（网址：
                                                <a href="http://exmail.qq.com">
                                                    http://exmail.qq.com
                                                </a>
                                                ），根据邮箱申请指南进行操作，很快就可以拥有以你的公司网址为后缀的免费公司邮箱。
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <br>
                                                如有其它问题，请发送问题到
                                                <a href="mailto:vivi@lagou.com">
                                                    vivi@lagou.com
                                                </a>
                                                ，我们会尽快为你解决。
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="clear"></div>
                <input type="hidden" value="" id="resubmitToken">
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
                                    window.location.href=data.url;
                               } else {
                                    if (data.code == -3) {
                                        $('#beError_one').css('display', 'block').html(data.msg1);
                                        $('#beError_two').css('display', 'block').html(data.msg2);
                                    } else if (data.code == -1) {
                                        $('#beError_one').css('display', 'block').html(data.msg);
                                    } else if (data.code == -2) {
                                        $('#beError_two').css('display', 'block').html(data.msg);
                                    } else {
                                        alert(data.msg);
                                        location.reload();
                                    }
                                   
                                    
                               }
                            }
                        })
                        return false;
                    }
                })

                $('input[name=tel]').blur(function() {
                    var tel = $(this).val();
                    var pattern=/(^[0-9]{3,4}\-[0-9]{7,8}$)|(^[0-9]{7,8}$)|(^[0-9]{3,4}\-[0-9]{7,8}\-[0-9]{3,5}$)|(^[0-9]{7,8}\-[0-9]{3,5}$)|(^\([0-9]{3,4}\)[0-9]{7,8}$)|(^\([0-9]{3,4}\)[0-9]{7,8}\-[0-9]{3,5}$)|(^0{0,1}[13|15|18|14]{2}[0-9]{9}$)/;
                    var result = pattern.test(tel);
                    if (result) {
                        $('#beError_one').css('display', 'none').html('');
                    } else {
                        $('#beError_one').css('display', 'block').html("请输入正确的手机号或座机号，座机格式如010-62555255或010-6255255-分机号，多个电话用英文逗号隔开");
                    }
                })
                $('input[name=email]').blur(function() {
                    var email = $(this).val();
                    var reg = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;
                    var res = reg.test(email);
                    if (res) {
                        $('#beError_two').css('display', 'none').html('');
                    } else {
                    $('#beError_two').css('display', 'block').html('请输入有效的邮件地址，最多2个，并用英文;隔开');
                    }
                })

                $('input[name=tel]').focus(function() {
                    $('#beError_one').css('display', 'none').html('');
                })
                $('input[name=email]').focus(function() {
                    $('#beError_two').css('display', 'none').html('');
                })

                
            })
        </script>
    </body>
</html>