<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html xmlns:wb="http://open.weibo.com/wb">
    
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>
            公司介绍-招聘服务-拉勾网-最专业的互联网招聘平台
        </title>
        <meta content="23635710066417756375" property="qc:admins">
        <meta name="description" content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网">
        <meta name="keywords" content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招">
        <link href="/Public/HomeStyle/css/style.css" type="text/css" rel="stylesheet">
        <link href="/Public/HomeStyle/css/external.min.css" type="text/css" rel="stylesheet">
        <link href="/Public/HomeStyle/css/popup.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/Public/HomeStyle/js/jquery.1.10.1.min.js"></script>
        <script src="/Public/HomeStyle/js/jquery.lib.min.js" type="text/javascript"></script>
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
            <li class="current">
                <a href="companylist.html">
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
                    <dl class="c_section c_section_mid">
                        <dt>
                            <h2>
                                <em></em>
                                填写公司信息
                            </h2>
                            <a class="c_addjob" href="create.html">
                                <i></i>
                                发布新职位
                            </a>
                        </dt>
                        <dd>
                            <div class="c_text">
                                背景深、规模大、发展快、氛围好…用优势吸引求职者吧！
                            </div>
                            <img width="668" height="56" class="c_steps" alt="第五步" src="/Public/HomeStyle/images/step5.png">
                            <!-- action="http://www.lagou.com/c/saveProfile.json" -->
                            <form method="post" action="<?php echo U('Home/CompanyReg/step8');?>" id="infoForm" onsubmit="return $.sub(this);">
                                <h3>
                                    公司介绍
                                </h3>
                                <textarea placeholder="请分段详细描述公司简介、企业文化等" name="desc" id="companyProfile"></textarea>
                                <div class="word_count">
                                    你还可以输入
                                    <span>
                                        1000
                                    </span>
                                    字
                                </div>
                                <div class="clear"></div>
                                <input type="submit" id="step5Submit" value="保存，完成" class="btn_big fr">
                            </form>
                        </dd>
                    </dl>
                </div>
                <div class="clear"></div>
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
        <script src="/Public/HomeStyle/js/core.min.js" type="text/javascript"></script>
        <script src="/Public/HomeStyle/js/step5.min.js" type="text/javascript"></script>
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
                                window.location.href = data.url;
                            }
                        });
                        return false;
                    }
                })
            })
        </script>
    </body>

</html>