<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>发布新职位-招聘服务-拉勾网-最专业的互联网招聘平台 </title>
        <meta name="description" content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网">
        <meta name="keywords" content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招">
        <link href="/favicon.ico" rel="Shortcut Icon">
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
        <link rel="stylesheet" href="/Public/HomeStyle/css/ui.css">
        <link rel="stylesheet" href="/Public/HomeStyle/css/window.css">
    </head>
    
    <body>
        <div id="body">
            <div id="header">
    <div class="wrapper">
        <a href="index.html" class="logo">
            <img src="/Public/HomeStyle/images/logo.png" width="229" height="43" alt="拉勾招聘-专注互联网招聘" />
        </a>
        <ul class="reset" id="navheader">
            <li class="current"><a href="index.html">首页</a></li>
            <li ><a href="companylist.html" >公司</a></li>
            <li ><a href="h/toForum.html" target="_blank">论坛</a></li>
            <li ><a href="jianli.html" rel="nofollow">我的简历</a></li>
            <li ><a href="create.html" rel="nofollow">发布职位</a></li>
        </ul>
        <ul class="loginTop <?php echo ($data['loginTop_value']); ?>">
            <li><a href="<?php echo U('User/login');?>" rel="nofollow">登录</a></li> 
            <li>|</li>
            <li><a href="<?php echo U('User/register');?>" rel="nofollow">注册</a></li>
        </ul>
        <dl class="collapsible_menu <?php echo ($data['collapsible_menu_value']); ?>">
            <dt>
                <span><?php echo ($data['username']); ?>&nbsp;</span>
                <span class="red dn" id="noticeDot-0"></span>
                <i></i>
            </dt>
            <dd><a rel="nofollow" href="<?php echo U('Resume/index');?>">我的简历</a></dd>
            <dd><a href="<?php echo U('CollectionJob/index');?>">我收藏的职位</a></dd>
            <dd class="btm"><a href="subscribe.html">我的订阅</a></dd>
            <dd><a href="<?php echo U('Company/index');?>">我要招人</a></dd>
            <dd><a href="accountBind.html">帐号设置</a></dd>
            <dd class="logout"><a rel="nofollow" href="<?php echo U('User/logout');?>">退出</a></dd>
        </dl>
    </div>
</div>
            <div id="container">
                <div class="sidebar">
                    <a class="btn_create" href="create.html">
                        发布新职位
                    </a>
                    <dl class="company_center_aside">
                        <dt>
                            我收到的简历
                        </dt>
                        <dd>
                            <a href="">
                                待处理简历
                            </a>
                        </dd>
                        <dd>
                            <a href="canInterviewResumes.html">
                                待定简历
                            </a>
                        </dd>
                        <dd>
                            <a href="haveNoticeResumes.html">
                                已通知面试简历
                            </a>
                        </dd>
                        <dd>
                            <a href="haveRefuseResumes.html">
                                不合适简历
                            </a>
                        </dd>
                        <dd class="btm">
                            <a href="autoFilterResumes.html">
                                自动过滤简历
                            </a>
                        </dd>
                    </dl>
                    <dl class="company_center_aside">
                        <dt>
                            我发布的职位
                        </dt>
                        <dd>
                            <a href="positions.html">
                                有效职位
                            </a>
                        </dd>
                        <dd>
                            <a href="positions.html">
                                已下线职位
                            </a>
                        </dd>
                    </dl>
                    <div class="subscribe_side mt20">
                        <div class="f14">
                            想收到更多更好的简历？
                        </div>
                        <div class="f18 mb10">
                            就用拉勾招聘加速助手
                        </div>
                        <div>
                            咨询：
                            <a class="f16" href="mailto:jessica@lagou.com">
                                jessica@lagou.com
                            </a>
                        </div>
                        <div class="f18 ti2em">
                            010-57286512
                        </div>
                    </div>
                    <div class="subscribe_side mt20">
                        <div class="f14">
                            加入互联网HR交流群
                        </div>
                        <div class="f18 mb10">
                            跟同行聊聊
                        </div>
                        <div class="f24">
                            338167634
                        </div>
                    </div>
                </div>
                <div class="content">
                    <dl class="company_center_content">
                        <dt>
                            <h1>
                                <em></em>
                                发布新职位
                            </h1>
                        </dt>
                        <dd>
                            <form action="<?php echo U('Home/Company/doCreate');?>" method="post"
                            id="jobForm" name="jobForm" onsubmit="return $.sub(this);">
                                <table class="btm">
                                    <tbody>
                                        <tr>
                                            <td width="25">
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td width="85">职位类别</td>
                                            <td>
                                                <input type="hidden" id="positionType" value="" name="positionType">
                                                <input type="button" value="请选择职位类别" id="select_category" class="selectr selectr_380">
                                                <div class="dn" id="box_job" style="display:none">
                                                    <dl>
                                                        <dt>111111111</dt>
                                                        <dd>
                                                            <ul class="reset job_main">
                                                                <li>
                                                                    <span>222222222</span>
                                                                    <ul class="reset job_sub dn">
                                                                        <li>333333333</li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td>
                                                职位名称
                                            </td>
                                            <td>
                                                <input type="text" placeholder="请输入职位名称，如：产品经理" value="" name="name" id="positionName">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                所属部门
                                            </td>
                                            <td>
                                                <input type="text" placeholder="请输入所属部门" value="" name="branch" id="department">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="btm">
                                    <tbody>
                                        <tr>
                                            <td width="25">
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td width="85">
                                                工作性质
                                            </td>
                                            <td>
                                                <ul class="profile_radio clearfix reset">
                                                    <li>
                                                        全职
                                                        <em></em>
                                                        <input type="radio" name="nature" value="全职">
                                                    </li>
                                                    <li>
                                                        兼职
                                                        <em></em>
                                                        <input type="radio" name="nature" value="兼职">
                                                    </li>
                                                    <li>
                                                        实习
                                                        <em></em>
                                                        <input type="radio" name="nature" value="实习">
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td>月薪范围</td>
                                            <td>
                                                <div class="salary_range">
                                                    <div>
                                                        <input type="text" placeholder="最低月薪" value="" id="salaryMin" name="salary_low">
                                                        <span> k </span>
                                                    </div>
                                                    <div>
                                                        <input type="text" placeholder="最高月薪" value="" id="salaryMax" name="salary_high">
                                                        <span> k </span>
                                                    </div>
                                                    <span>只能输入整数，如：9</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td>工作城市</td>
                                            <td>
                                                <input type="text" placeholder="请输入工作城市，如：北京" value="上海" name="city"
                                                id="workAddress">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="btm">
                                    <tbody>
                                        <tr>
                                            <td width="25">
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td width="85">工作经验</td>
                                            <td>
                                                <input type="hidden" id="experience" value="" name="work_year">
                                                <input type="button" value="请选择工作经验" id="select_experience" class="selectr selectr_380">
                                                <div class="boxUpDown boxUpDown_380 dn" id="box_experience" style="display:none">
                                                    <ul>
                                                        <li>不限</li>
                                                        <li>应届毕业生</li>
                                                        <li>1年以下</li>
                                                        <li>1-3年</li>
                                                        <li>3-5年</li>
                                                        <li>5-10年</li>
                                                        <li>10年以上</li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td>学历要求</td>
                                            <td>
                                                <input type="hidden" id="education" value="" name="edu">
                                                <input type="button" value="请选择学历要求" id="select_education" class="selectr selectr_380">
                                                <div class="boxUpDown boxUpDown_380 dn" id="box_education" style="display:none">
                                                    <ul>
                                                        <li>不限</li>
                                                        <li>大专</li>
                                                        <li>本科</li>
                                                        <li>硕士</li>
                                                        <li>博士</li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="btm">
                                    <tbody>
                                        <tr>
                                            <td width="25">
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td width="85">
                                                职位诱惑
                                            </td>
                                            <td>
                                                <input type="text" placeholder="20字描述该职位的吸引力，如：福利待遇、发展前景等" value="" name="welfare" class="input_520" id="positionAdvantage">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td>职位描述</td>
                                            <td>
                                                <span class="c9 f14">
                                                    (建议分条描述工作职责等。请勿输入公司邮箱、联系电话及其他外链，否则将自动删除)
                                                </span>
                                                <textarea name="desc" id="positionDetail" class="tinymce"></textarea>
                                                <span role="application" aria-labelledby="positionDetail_voice" id="positionDetail_parent" class="mceEditor defaultSkin">
                                                    <span class="mceVoiceLabel" style="display:none" id="positionDetail_voice">
                                                        富文本域
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td>工作地址</td>
                                            <td>
                                                <input type="text" placeholder="请输入详细的工作地址" value="" name="address" class="input_520" id="positionAddress">
                                                <div class="work_place f14">
                                                    我们将在职位详情页以地图方式精准呈现给用户
                                                    <a id="mapPreview" href="javascript:;">
                                                        预览地图
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td width="25">
                                                <span class="redstar"> * </span>
                                            </td>
                                            <td colspan="2">
                                                接收简历邮箱：
                                                <span id="receiveEmailVal">
                                                    admin@admin.com
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="25"></td>
                                            <td colspan="2">
                                                <input type="submit" value="预览" id="jobPreview" class="btn_32">
                                                <input type="submit" value="发布" id="formSubmit" class="btn_32">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </dd>
                    </dl>
                </div>
                <script src="/Public/HomeStyle/js/jobs.min.js" type="text/javascript"></script>
                <div class="clear"></div>
                <a rel="nofollow" title="回到顶部" id="backtop" style="display:none"></a>
            </div>
        </div>
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
        <script src="/Public/HomeStyle/js/popup.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            jQuery(function($) {
                $.extend({
                    sub : function(obj) {
                        var obj = $(obj);
                        $.ajax({
                            url : obj.attr('action'),
                            type : 'post',
                            data : obj.serialize(),
                            datatype : 'json',
                            success : function(data) {
                                console.log(data);
                            }
                        })
                        return false;
                    }
                })
            })
        </script>
    </body>

</html>