<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>
            公司产品-招聘服务-拉勾网-最专业的互联网招聘平台
        </title>
        <meta name="description" content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网">
        <meta name="keywords" content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招">
        <meta content="QIQ6KC1oZ6" name="baidu-site-verification">
        <!-- <div class="web_root" style="display:none">http://www.lagou.com</div> -->
        <link href="/Public/HomeStyle/css/style.css" type="text/css" rel="stylesheet">
        <link href="/Public/HomeStyle/css/external.min.css" type="text/css" rel="stylesheet">
        <link href="/Public/HomeStyle/css/popup.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/Public/HomeStyle/js/jquery.1.10.1.min.js"></script>
        <script src="/Public/HomeStyle/js/jquery.lib.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="/Public/HomeStyle/js/ajaxfileupload.js"></script>
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
                                目标明确、前途光明的产品是吸引求职者的制胜法宝哦！
                            </div>
                            <img width="668" height="56" class="c_steps" alt="第四步" src="/Public/HomeStyle/images/step4.png">
                            <form method="post" action="<?php echo U('Home/CompanyReg/step7');?>" id="productForm" onsubmit="return $.sub(this);">
                                <div id="productDiv">
                                    <div class="formWrapper">
                                        <h3>
                                            产品海报
                                        </h3>
                                        <div class="new_product mt20">
                                            <div id="productNo0" class="product_upload">
                                                <div style="background-color: rgb(147, 183, 187);">
                                                    <span>
                                                        上传产品图片
                                                    </span>
                                                    <br>
                                                    尺寸：380*220px 大小：小于5M
                                                </div>
                                            </div>
                                            <div id="productShow0" class="product_upload dn productShow">
                                                <img width="380" height="220" src="">
                                                <span>
                                                    更换产品图片
                                                    <br>
                                                    380*220px 小于5M
                                                </span>
                                            </div>
                                            <input type="file" title="支持jpg、jpeg、gif、png格式，文件小于5M" onchange="uploadFile(this)" name="myfiles" id="myfiles0">
                                            <input type="hidden" value="" name="productInfos[0][image]" id="type0">
                                        </div>
                                        <span style="display:none;" id="myfiles0_error" class="error">
                                        </span>
                                        <h3>
                                            产品名称
                                        </h3>
                                        <input type="text" placeholder="请输入产品名称" name="productInfos[0][name]"
                                        id="name0">
                                        <h3>
                                            产品地址
                                        </h3>
                                        <input type="text" placeholder="请输入产品主页URL或产品下载地址" name="productInfos[0][link]" id="address0">
                                        <h3>
                                            产品简介
                                        </h3>
                                        <textarea placeholder="请简短描述该产品定位、产品特色、用户群体等" maxlength="1000" name="productInfos[0][desc]" id="description0"></textarea>
                                        <div class="word_count">
                                            你还可以输入
                                            <span>
                                                500
                                            </span>
                                            字
                                        </div>
                                    </div>
                                </div>
                	                <a id="addMember" class="add_member" href="javascript:void(0)">
                                    <i></i>
                                    继续添加公司产品
                                </a>
                                <div class="clear">
                                </div>
                                <input type="submit" value="保存，下一步" id="step4Submit" class="btn_big fr">
                                <a class="btn_cancel fr" href="<?php echo U('Home/CompanyReg/step8');?>">
                                    跳过
                                </a>
                            </form>
                        </dd>
                    </dl>
                </div>
                <script src="/Public/HomeStyle/js/step4.min.js" type="text/javascript"></script>
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
        <script src="/Public/HomeStyle/js/core.min.js" type="text/javascript">
        </script>
        <!-- -->
        <script type="text/javascript">
        	function uploadFile(obj) {
                var obj = $(obj);
                var hid = obj.next();
                var div = obj.prev();
                var img = div.children('img');
                $.ajaxFileUpload({
                    url : '<?php echo U('Home/Public/productUpload');?>',
                    secureuri: false,
                    fileElementId: obj.attr('id'),
                    dataType: 'json',
                    data : {w:obj.attr('id')},
                    success: function (data)  //服务器成功响应处理函数
                    {
                        if (data.code > 0) {
                            hid.val(data.msg);
                            div.removeClass('dn');
                            data.msg = data.msg + '?' + parseInt(Math.random()*1000);
                            img.attr('src', data.msg)
                        } else {
                            alert(data.msg);
                        }
                    },
                });
            }

            jQuery(function($) {
                $.extend({
                    sub : function(fo) {
                        var fo = $(fo);
                        $.ajax({
                            url : fo.attr('action'),
                            type : 'post',
                            data : fo.serialize(),
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