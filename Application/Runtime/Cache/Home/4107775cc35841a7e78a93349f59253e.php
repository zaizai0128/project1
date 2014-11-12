<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
    <head>
        <script src="/Public/HomeStyle/js/allmobilize.min.js" charset="utf-8" id="allmobilize">
        </script>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title><?php echo ($company["name"]); ?>-拉勾网-最专业的互联网招聘平台</title>
        <meta name="description" content="<?php echo ($company["name"]); ?> <?php echo ($company["name"]); ?> <?php echo ($company["city"]); ?> <?php echo ($company["trade"]); ?> <?php echo ($company["stage"]); ?> <?php echo ($company["scale"]); ?> <?php echo ($company["one_desc"]); ?>">
        <meta name="keywords" content="<?php echo ($company["name"]); ?> <?php echo ($company["name"]); ?> <?php echo ($company["city"]); ?> <?php echo ($company["trade"]); ?> <?php echo ($company["stage"]); ?> <?php echo ($company["scale"]); ?> <?php echo ($company["one_desc"]); ?>">
        <!-- <div class="web_root" style="display:none">http://www.lagou.com</div> -->
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
        <a href="index.html" class="logo">
            <img src="/Public/HomeStyle/images/logo.png" width="229" height="43" alt="拉勾招聘-专注互联网招聘" />
        </a>
        <ul class="reset" id="navheader">
            <li class="current"><a href="index.html">首页</a></li>
            <li ><a href="<?php echo U('Home/Company/companylist');?>" >公司</a></li>
            <li ><a href="h/toForum.html" target="_blank">论坛</a></li>
            <li ><a href="<?php echo U('Resume/index');?>" rel="nofollow">我的简历</a></li>
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
            <!-- end #header -->
            <div id="container">
                <div class="clearfix">
                    <div class="content_l">
                        <div class="c_detail">
                            <div style="background-color:#fff;" class="c_logo">
                                <a title="上传公司LOGO" id="logoShow" >
                                    <img class="logo_success" width="190" height="190" alt="公司logo" src="<?php echo ($company["logo"]); ?>">
                                    <span>
                                        更换公司图片
                                        <br>
                                        190px*190px 小于5M
                                    </span>
                                    <input type="file" title="支持jpg、jpeg、gif、png格式，文件小于5M" onchange="uploadFile('<?php echo U('Home/CompanyInfo/image');?>', 'imageCom','logo_success');" name="image_com" id="imageCom">
                                </a>
                            </div>
                            <div class="c_box companyName">
                                <h2 title="<?php echo ($company["name"]); ?>">
                                    <?php echo ($company["name"]); ?>
                                </h2>
                                <?php if($company['state'] == 1): ?><em class="valid"></em>
                                    <span class="va dn">
                                        拉勾认证企业
                                    </span>
                                    <a target="_blank" class="applyC" href="javascript:;">
                                        已认证
                                    </a>
                                <?php else: ?>
                                    <em class="unvalid"></em>
                                    <span class="va dn">
                                        拉勾未认证企业
                                    </span>
                                    <a target="_blank" class="applyC" href="javascript:;">
                                        申请认证
                                    </a><?php endif; ?>
                                <div class="clear"></div>
                                <h1 title="<?php echo ($company["name"]); ?>" class="fullname">
                                    <?php echo ($company["name"]); ?>
                                </h1>
                                <form action="<?php echo U('Home/CompanyInfo/info');?>" method="post" onsubmit="return $.sub(this);" class="clear editDetail dn" id="editDetailForm">
                                    <input type="text" placeholder="请输入公司简称" maxlength="15" value="<?php echo ($company["name"]); ?>" name="name" id="companyShortName">
                                    <input type="text" placeholder="一句话描述公司优势，核心价值，限50字" maxlength="50" value="<?php echo ($company["one_desc"]); ?>" name="one_desc" id="companyFeatures">
                                    <input type="submit" value="保存" id="saveDetail" class="btn_small">
                                    <a id="cancelDetail" class="btn_cancel_s">
                                        取消
                                    </a>
                                </form>
                                <div class="clear oneword">
                                    <img width="17" height="15" src="/Public/HomeStyle/images/quote_l.png">
                                    &nbsp;
                                    <span>
                                        <?php echo ($company["one_desc"]); ?>
                                    </span>
                                    &nbsp;
                                    <img width="17" height="15" src="/Public/HomeStyle/images/quote_r.png">
                                </div>
                                <h3 class="dn">
                                    已选择标签
                                </h3>
                                <ul style="overflow:auto" id="hasLabels" class="reset clearfix">
                                    <?php if(is_array($tag)): foreach($tag as $key=>$val): ?><li><span><?php echo ($val["name"]); ?></span></li><?php endforeach; endif; ?>
                                    <li class="link">
                                        编辑
                                    </li>
                                </ul>
                                <div class="dn" id="addLabels">
                                    <a id="changeLabels" class="change" href="javascript:void(0)" data-show="1">
                                        换一换
                                    </a>
                                    <input type="hidden" value="1" id="labelPageNo">
                                    <input type="submit" value="贴上" class="fr" id="add_label">
                                    <input type="text" placeholder="添加自定义标签" name="label" id="label" class="label_form fr">
                                    <div class="clear"></div>
                                    <ul class="reset clearfix tag_content">
                                        <?php if(is_array($allTag1)): foreach($allTag1 as $key=>$tagVal1): ?><li><?php echo ($tagVal1["name"]); ?></li><?php endforeach; endif; ?>
                                    </ul>
                                    <ul class="reset clearfix tag_content dn">
                                        <?php if(is_array($allTag2)): foreach($allTag2 as $key=>$tagVal2): ?><li><?php echo ($tagVal2["name"]); ?></li><?php endforeach; endif; ?>
                                    </ul>
                                    <a id="saveLabels" class="btn_small" href="javascript:void(0)">
                                        保存
                                    </a>
                                    <a id="cancelLabels" class="btn_cancel_s" href="javascript:void(0)">
                                        取消
                                    </a>
                                </div>
                            </div>
                            <a title="编辑基本信息" class="c_edit" id="editCompanyDetail" href="javascript:void(0);"></a>
                            <div class="clear"></div>
                        </div>
                        <div class="c_breakline"></div>
                        <div id="Product">
                            <?php if(empty($product)): ?><div class="product_wrap no_product">
                                <!--无产品 -->
                                <dl class="c_section">
                                    <dt>
                                        <h2>
                                            <em></em>
                                            公司产品
                                        </h2>
                                    </dt>
                                    <dd>
                                        <div class="addnew">
                                            酒香不怕巷子深已经过时啦！
                                            <br>
                                            把自己优秀的产品展示出来吸引人才围观吧！
                                            <br>
                                            <a class="product_edit " href="javascript:void(0)">
                                                +添加公司产品
                                            </a>
                                            <span style="display:none"><?php echo U('Home/CompanyProduct/image');?></span>
                                        </div>
                                    </dd>
                                </dl>
                                <!-- 编辑产品 -->
                                <dl id="newProduct" class="newProduct dn">
                                    <dt>
                                        <h2>
                                            <em></em>
                                            公司产品
                                        </h2>
                                    </dt>
                                    <dd>
                                        <form method="post" class="productForm" onsubmit="return $.sub(this);" action="<?php echo U('Home/CompanyProduct/active');?>">
                                            <div class="new_product">
                                                <div class="product_upload dn productNo">
                                                    <div>
                                                        <span>
                                                            上传产品图片
                                                        </span>
                                                        <br>
                                                        尺寸：380*220px 大小：小于5M
                                                    </div>
                                                </div>
                                                <div class="product_upload productShow">
                                                    <img width="380" height="220" src="/Public/HomeStyle/images/product_default.png">
                                                    <span>
                                                        更换产品图片
                                                        <br>
                                                        380*220px 小于5M
                                                    </span>
                                                </div>
                                                <input type="file" title="支持jpg、jpeg、gif、png格式，文件小于5M" id="myfiles0">
                                                <input type="hidden" value="" name="image" class="type">
                                            </div>
                                            <div class="cp_intro">
                                                <input type="text" placeholder="请输入产品名称" value="" name="name">
                                                <input type="text" placeholder="请输入产品网址" value=""
                                                name="link">
                                                <textarea placeholder="请简短描述该产品定位、产品特色、用户群体等" maxlength="500" value=""
                                                class="s_textarea" name="desc"></textarea>
                                                <div class="word_count fr">
                                                    你还可以输入
                                                    <span>
                                                        500
                                                    </span>
                                                    字
                                                </div>
                                                <div class="clear">
                                                </div>
                                                <input type="submit" value="保存" class="btn_small">
                                                <a class="btn_cancel_s product_delete" href="javascript:void(0)" onclick="$.del('<?php echo U('Home/CompanyProduct/delete', array('id'=>1));?>', this);">
                                                    删除
                                                </a>
                                                <input type="hidden" value="11867" class="product_id">
                                            </div>
                                        </form>
                                    </dd>
                                </dl>
                                <!--有产品-->
                                <dl class="c_product dn">
                                    <dt>
                                        <h2>
                                            <em></em>
                                            公司产品
                                        </h2>
                                    </dt>
                                    <dd>
                                        <img width="380" height="220" alt="<?php echo ($proVal["name"]); ?>" src="<?php echo ($proVal["image"]); ?>">
                                        <div class="cp_intro">
                                            <h3>
                                                <a target="_blank" href="<?php echo ($proVal["link"]); ?>" class="proName">
                                                    <?php echo ($proVal["name"]); ?>
                                                </a>
                                            </h3>
                                            <div class="scroll-pane" style="overflow: hidden; padding: 0px; width: 260px;">
                                                <div class="jspContainer" style="width: 260px; height: 140px;">
                                                    <div class="jspPane" style="padding: 0px; top: 0px; width: 260px;">
                                                        <div class="proDesc">
                                                            <?php echo ($proVal["desc"]); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a title="编辑公司产品" class="c_edit product_edit" href="javascript:void(0)">
                                        </a>
                                        <span style="display:none"><?php echo U('Home/CompanyProduct/image');?></span>
                                        <a title="新增公司产品" class="c_add product_add" href="javascript:void(0)">
                                        </a>
                                    </dd>
                                </dl>
                            </div>
                            <?php else: ?>
                            <?php if(is_array($product)): foreach($product as $key=>$proVal): ?><div class="product_wrap hasProduct">
                                <!--无产品 -->
                                <dl class="c_section dn">
                                    <dt>
                                        <h2>
                                            <em></em>
                                            公司产品
                                        </h2>
                                    </dt>
                                    <dd>
                                        <div class="addnew">
                                            酒香不怕巷子深已经过时啦！
                                            <br>
                                            把自己优秀的产品展示出来吸引人才围观吧！
                                            <br>
                                            <a class="product_edit" href="javascript:void(0)">
                                                +添加公司产品
                                            </a>
                                            <span style="display:none"><?php echo U('Home/CompanyProduct/image');?></span>
                                        </div>
                                    </dd>
                                </dl>
                                <!--产品编辑-->
                                <dl id="newProduct" class="newProduct dn">
                                    <dt>
                                        <h2>
                                            <em></em>
                                            公司产品
                                        </h2>
                                    </dt>
                                    <dd>
                                        <form method="post" action="<?php echo U('Home/CompanyProduct/active');?>" onsubmit="return $.sub(this);" class="productForm" name="productForm">
                                            <input type="hidden" name="id" value="<?php echo ($proVal["id"]); ?>"/>
                                            <div class="new_product">
                                                <div class="product_upload dn productNo">
                                                    <div>
                                                        <span>
                                                            上传产品图片
                                                        </span>
                                                        <br>
                                                        尺寸：380*220px 大小：小于5M
                                                    </div>
                                                </div>
                                                <div class="product_upload productShow">
                                                    <img width="380" height="220" src="<?php echo ($proVal["image"]); ?>">
                                                    <span>
                                                        更换产品图片
                                                        <br>
                                                        380*220px 小于5M
                                                    </span>
                                                </div>
                                                <input type="file" title="支持jpg、jpeg、gif、png格式，文件小于5M" name="myfiles" id="myfiles0">
                                                <input type="hidden" value="<?php echo ($proVal["image"]); ?>" name="image" class="type">
                                            </div>
                                            <div class="cp_intro">
                                                <input type="text" placeholder="请输入产品名称" value="<?php echo ($proVal["name"]); ?>" name="name">
                                                <input type="text" placeholder="请输入产品网址" value="<?php echo ($proVal["link"]); ?>" name="link">
                                                <textarea placeholder="请简短描述该产品定位、产品特色、用户群体等" maxlength="500" value="<?php echo ($proVal["desc"]); ?>"
                                                class="s_textarea" name="desc"><?php echo ($proVal["desc"]); ?></textarea>
                                                <div class="word_count fr">
                                                    你还可以输入
                                                    <span>
                                                        500
                                                    </span>
                                                    字
                                                </div>
                                                <div class="clear"></div>
                                                <input type="submit" value="保存" class="btn_small">
                                                <a class="btn_cancel_s product_delete" href="javascript:void(0)">
                                                    删除
                                                </a>
                                            </div>
                                        </form>
                                    </dd>
                                </dl>
                                <!--有产品-->
                                <dl class="c_product">
                                    <dt>
                                        <h2>
                                            <em></em>
                                            公司产品
                                        </h2>
                                    </dt>
                                    <dd>
                                        <img width="380" height="220" alt="<?php echo ($proVal["name"]); ?>" src="<?php echo ($proVal["image"]); ?>">
                                        <div class="cp_intro">
                                            <h3>
                                                <a target="_blank" href="<?php echo ($proVal["link"]); ?>" class="proName">
                                                    <?php echo ($proVal["name"]); ?>
                                                </a>
                                            </h3>
                                            <div class="scroll-pane" style="overflow: hidden; padding: 0px; width: 260px;">
                                                <div class="jspContainer" style="width: 260px; height: 140px;">
                                                    <div class="jspPane" style="padding: 0px; top: 0px; width: 260px;">
                                                        <div class="proDesc">
                                                            <?php echo ($proVal["desc"]); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a title="编辑公司产品" class="c_edit product_edit" href="javascript:void(0)">
                                        </a>
                                        <span style="display:none"><?php echo U('Home/CompanyProduct/image');?></span>
                                        <a title="新增公司产品" class="c_add product_add" href="javascript:void(0)">
                                        </a>
                                    </dd>
                                </dl>
                            </div><?php endforeach; endif; endif; ?>
                        </div>
                        <!-- end #Product -->
                        <div id="Profile">
                            <?php if(empty($company["desc"])): ?><div class="profile_wrap">
                                <!--无介绍 -->
                                <dl class="c_section desc_section">
                                    <dt>
                                        <h2>
                                            <em></em>
                                            公司介绍
                                        </h2>
                                    </dt>
                                    <dd>
                                        <div class="addnew">
                                            详细公司的发展历程、让求职者更加了解你!
                                            <br>
                                            <a id="addIntro" href="javascript:void(0)">
                                                +添加公司介绍
                                            </a>
                                        </div>
                                    </dd>
                                </dl>
                                <!--编辑介绍-->
                                <dl class="c_section newIntro dn">
                                    <dt>
                                        <h2>
                                            <em></em>
                                            公司介绍
                                        </h2>
                                    </dt>
                                    <dd>
                                        <form id="companyDesForm" action="<?php echo U('Home/CompanyInfo/desc');?>" method="post" onsubmit="return $.sub(this);">
                                            <textarea placeholder="请分段详细描述公司简介、企业文化等" name="desc" id="companyProfile"></textarea>
                                            <div class="word_count fr">
                                                你还可以输入
                                                <span>
                                                    1000
                                                </span>
                                                字
                                            </div>
                                            <div class="clear"></div>
                                            <input type="submit" value="保存" id="submitProfile" class="btn_small">
                                            <a id="delProfile" class="btn_cancel_s delProfile" href="javascript:void(0)">
                                                取消
                                            </a>
                                        </form>
                                    </dd>
                                </dl>
                                <!-- 显示介绍 -->
                                <dl class="c_section hasdesc dn">
                                    <dt>
                                        <h2>
                                            <em></em>
                                            公司介绍
                                        </h2>
                                    </dt>
                                    <dd>
                                        <div class="c_intro">
                                            <?php echo ($company["desc"]); ?>
                                        </div>
                                        <a title="编辑公司介绍" id="editIntro" class="c_edit" href="javascript:void(0)"></a>
                                    </dd>
                                </dl>
                            </div>
                            <?php else: ?>
                                <div class="profile_wrap">   
                                    <!--编辑介绍-->
                                    <dl class="c_section newIntro dn">
                                        <dt>
                                            <h2>
                                                <em>
                                                </em>
                                                公司介绍
                                            </h2>
                                        </dt>
                                        <dd>
                                            <form id="companyDesForm" action="<?php echo U('Home/CompanyInfo/desc');?>" method="post" onsubmit="return $.sub(this);">
                                                <textarea placeholder="请分段详细描述公司简介、企业文化等" name="desc" id="companyProfile"><?php echo ($company["desc"]); ?></textarea>
                                                <div class="word_count fr">
                                                    你还可以输入
                                                    <span>
                                                        1000
                                                    </span>
                                                    字
                                                </div>
                                                <div class="clear"></div>
                                                <input type="submit" value="保存" id="submitProfile" class="btn_small">
                                                <a id="delProfile" class="btn_cancel_s delProfile" href="javascript:void(0)">
                                                    取消
                                                </a>
                                            </form>
                                        </dd>
                                    </dl>
                                    <!--有介绍-->
                                    <dl class="c_section hasdesc">
                                        <dt>
                                            <h2>
                                                <em></em>
                                                公司介绍
                                            </h2>
                                        </dt>
                                        <dd>
                                            <div class="c_intro">
                                                <?php echo ($company["desc"]); ?>
                                            </div>
                                            <a title="编辑公司介绍" id="editIntro" class="c_edit" href="javascript:void(0)"></a>
                                        </dd>
                                    </dl>
                                </div><?php endif; ?>
                        </div>
                        <!-- end #Profile -->
                        <!--[if IE 7]>
                            <br />
                        <![endif]-->
                        <!--无招聘职位-->
                        <?php if(empty($job)): ?><dl id="noJobs" class="c_section">
                            <dt>
                                <h2>
                                    <em>
                                    </em>
                                    招聘职位
                                </h2>
                            </dt>
                            <dd>
                                <div class="addnew">
                                    发布需要的人才信息，让伯乐和千里马尽快相遇……
                                    <br>
                                    <a href="<?php echo U('Home/CompanyJob/create');?>">
                                        +添加招聘职位
                                    </a>
                                </div>
                            </dd>
                        </dl>
                        <?php else: ?>
                        <dl class="c_section">
                            <dt>
                                <h2>
                                    <em></em>
                                    招聘职位
                                </h2>
                                <span class="jobsTotal">
                                    该公司共有
                                    <i>
                                        <?php echo ($jobnum); ?>
                                    </i>
                                    个职位正在招聘
                                </span>
                            </dt>
                            <dd>
                                <ul class="reset c_jobs" id="jobList">
                                    <?php if(is_array($job)): foreach($job as $key=>$jobVal): ?><li>
                                        <a href="<?php echo U('Home/CompanyJob/job', array('id'=>$jobVal['id']));?>" target="_blank">
                                            <h3>
                                                <span class="pos" title="<?php echo ($jobVal["name"]); ?>">
                                                    <?php echo ($jobVal["name"]); ?>
                                                </span>
                                                <span>
                                                    [<?php echo ($jobVal["city"]); ?>]
                                                </span>
                                            </h3>
                                            <span>
                                                <?php echo (date("y-m-d H:i:m",$jobVal["create_time"])); ?>
                                            </span>
                                            <div>
                                                <?php echo ($jobVal["nature"]); ?> / <?php echo ($jobVal["salary_high"]); ?>k-<?php echo ($jobVal["salary_low"]); ?>k / <?php echo ($jobVal["work_year"]); ?> / <?php echo ($jobVal["edu"]); ?>
                                            </div>
                                        </a>
                                    </li><?php endforeach; endif; ?>
                                </ul>
                            </dd>
                        </dl><?php endif; ?>
                        <input id="hasNextPage" name="hasNextPage" value="" type="hidden">
                        <input id="pageNo" name="pageNo" value="" type="hidden">
                        <input id="pageSize" name="pageSize" value="" type="hidden">
                        <div id="flag"></div>
                    </div>
                    <!-- end .content_l -->
                    <div class="content_r">
                        <div id="Tags">
                            <div id="c_tags_show" class="c_tags solveWrap">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td width="45">
                                                地点
                                            </td>
                                            <td class="companyCity">
                                                <?php echo ($company["city"]); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                领域
                                            </td>
                                            <!-- 支持多选 -->
                                            <td title="<?php echo ($company["trade"]); ?>" class="companyTrade">
                                                <?php echo ($company["trade"]); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                规模
                                            </td>
                                            <td class="companyScale">
                                                <?php echo ($company["scale"]); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                主页
                                            </td>
                                            <td>
                                                <a rel="nofollow" title="http://www.weimob.com" target="_blank" href="<?php echo ($company["web"]); ?>" class="companyWeb">
                                                   <?php echo ($company["web"]); ?>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a id="editTags" class="c_edit" href="javascript:void(0)">
                                </a>
                            </div>
                            <div id="c_tags_edit" class="c_tags editTags dn">
                                <form id="tagForms" action="<?php echo U('Home/CompanyInfo/info');?>" method="post" onsubmit="return $.sub(this);">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    地点
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="请输入地点" value="<?php echo ($company["city"]); ?>" name="city" id="city">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    领域
                                                </td>
                                                <!-- 支持多选 -->
                                                <td>
                                                    <input type="hidden" value="<?php echo ($company["trade"]); ?>" id="industryField" name="trade">
                                                    <input type="button" style="background:none;cursor:default;border:none !important;" disable="disable" value="<?php echo ($company["trade"]); ?>" id="select_ind" class="select_tags">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    规模
                                                </td>
                                                <td>
                                                    <input type="hidden" value="<?php echo ($company["scale"]); ?>" id="companySize" name="scale">
                                                    <input type="button" id="select_sca" class="select_tags" value="<?php echo ($company["scale"]); ?>">
                                                    <div class="selectBox dn" id="box_sca" style="display: none;">
                                                        <ul class="reset">
                                                            <?php foreach(C('company_scale') as $scaVal) : ?>
                                                            <li <?php if($company['scale'] == $scaVal): ?>class="current"<?php endif; ?>><?php echo ($scaVal); ?></li>
                                                            <?php endforeach ;?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    主页
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="请输入网址" value="<?php echo ($company["web"]); ?>" name="web"
                                                    id="companyUrl">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="submit" value="保存" id="submitFeatures" class="btn_small">
                                    <a id="cancelFeatures" class="btn_cancel_s" href="javascript:void(0)">
                                        取消
                                    </a>
                                    <div class="clear">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end #Tags -->
                        <dl class="c_section c_stages">
                            <dt>
                                <h2>
                                    <em></em>
                                    融资阶段
                                </h2>
                                <a title="编辑融资阶段" class="c_edit stage_edit" href="javascript:void(0)">
                                </a>
                            </dt>
                            <dd>
                                <ul class="reset stageshow">
                                    <li>
                                        目前阶段：
                                        <span class="c5">
                                            <?php echo ($company["stage"]); ?>
                                        </span>
                                    </li>
                                </ul>
                                <form class="dn" id="stageform" action="<?php echo U('Home/CompanyInfo/info');?>" method="post" onsubmit="return $.sub(this);">
                                    <div class="stageSelect">
                                        <label>
                                            目前阶段
                                        </label>
                                        <input type="hidden" value="<?php echo ($company["stage"]); ?>" id="financeStage" name="stage">
                                        <input type="button" value="<?php echo ($company["stage"]); ?>" id="select_fin" class="select_tags_short fl">
                                        <div class="selectBoxShort dn" id="box_fin" style="display: none;">
                                            <ul class="reset">
                                                <?php foreach (C('company_stage') as $staVal) :?>
                                                <li <?php if($company['stage'] == $staVal): ?>class="current"<?php endif; ?>><?php echo ($staVal); ?></li>
                                                <?php endforeach ;?>
                                            </ul>
                                        </div>
                                    </div>
                                    <input type="submit" value="保存" class="btn_small">
                                    <a id="cancelStages" class="btn_cancel_s" href="javascript:void(0)">
                                        取消
                                    </a>
                                    <div class="clear"></div>
                                </form>
                            </dd>
                        </dl>
                        <!-- end .c_stages -->
                        <div id="Member">
                            <!--有创始团队-->
                            <dl class="c_section c_member">
                                <dt>
                                    <h2>
                                        <em></em>
                                        创始团队
                                    </h2>
                                    <?php if(empty($team)): else: ?>
                                    <a title="添加创始人" class="c_add" href="javascript:void(0)">
                                    </a><?php endif; ?>
                                </dt>
                                <dd>
                                    <?php if(empty($team)): ?><div class="member_wrap noTeam">
                                        <!-- 无创始人 -->
                                        <div class="member_info addnew_right">
                                            展示公司的领导班子，
                                            <br>
                                            提升诱人指数！
                                            <br>
                                            <a class="member_edit" href="javascript:void(0)">
                                                +添加成员
                                            </a>
                                            <span style="display:none"><?php echo U('Home/CompanyTeam/image');?></span>
                                        </div>
                                        <!-- 编辑创始人 -->
                                        <div class="member_info newMember dn">
                                            <form class="memberForm" onsubmit="return $.sub(this);" action="<?php echo U('Home/CompanyTeam/add');?>" method="post">
                                                <input type="hidden" name="id" value="<?php echo ($teamVal["id"]); ?>">
                                                <div class="new_portrait">
                                                    <div class="portrait_upload dn portraitNo">
                                                        <span>
                                                            上传创始人头像
                                                        </span>
                                                    </div>
                                                    <div class="portraitShow">
                                                        <img width="120" height="120" src="<?php echo ($teamVal["image"]); ?>">
                                                        <span>
                                                            更换头像
                                                        </span>
                                                    </div>
                                                    <input type="file" value="" title="支持jpg、jpeg、gif、png格式，文件小于5M">
                                                    <input type="hidden" value="" name="image" class="type">
                                                    <em>
                                                        尺寸：120*120px
                                                        <br>
                                                        大小：小于5M
                                                    </em>
                                                </div>
                                                <input type="text" placeholder="请输入创始人姓名" value="<?php echo ($teamVal["name"]); ?>" name="name">
                                                <input type="text" placeholder="请输入创始人当前职位" value="<?php echo ($teamVal["position"]); ?>" name="position">
                                                <input type="text" placeholder="请输入创始人新浪微博地址" value="<?php echo ($teamVal["weibo"]); ?>" name="weibo">
                                                <textarea placeholder="请输入创始人个人简介" maxlength="500" class="s_textarea" name="desc"><?php echo ($teamVal["desc"]); ?></textarea>
                                                <div class="word_count fr">
                                                    你还可以输入
                                                    <span>
                                                        500
                                                    </span>
                                                    字
                                                </div>
                                                <div class="clear"></div>
                                                <input type="submit" value="保存" class="btn_small">
                                                <a class="btn_cancel_s member_delete" href="javascript:void(0)">
                                                    删除
                                                </a>
                                                <input type="hidden" value="11493" class="leader_id">
                                            </form>
                                        </div>
                                        <!-- 显示创始人 -->
                                        <div class="member_info dn">
                                            <a title="编辑创始人" class="c_edit member_edit" href="javascript:void(0)">
                                            </a>
                                            <span style="display:none"><?php echo U('Home/CompanyTeam/image');?></span>
                                            <span >
                                            <div class="m_portrait">
                                                <div></div>
                                                <img width="120" height="120" alt="<?php echo ($teamVal["name"]); ?>" src="<?php echo ($teamVal["image"]); ?>">
                                            </div>
                                            <div class="m_name">
                                                <?php echo ($teamVal["name"]); ?>
                                                <?php if(empty($teamVal["weibo"])): else: ?>
                                                <a target="_blank" class="weibo" href="<?php echo ($teamVal["weibo"]); ?>"></a><?php endif; ?>
                                            </div>
                                            <div class="m_position">
                                                <?php echo ($teamVal["position"]); ?>
                                            </div>
                                            <div class="m_intro">
                                                <?php echo ($teamVal["desc"]); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <?php if(is_array($team)): foreach($team as $key=>$teamVal): ?><div class="member_wrap hasTeam">
                                        <!-- 无创始人 -->
                                        <div class="member_info addnew_right dn">
                                            展示公司的领导班子，
                                            <br>
                                            提升诱人指数！
                                            <br>
                                            <a class="member_edit" href="javascript:void(0)">
                                                +添加成员
                                            </a>
                                            <span style="display:none"><?php echo U('Home/CompanyTeam/image');?></span>
                                        </div>
                                        <!-- 编辑创始人 -->
                                        <div class="member_info newMember dn">
                                            <form class="memberForm" onsubmit="return $.sub(this);" action="<?php echo U('Home/CompanyTeam/add');?>" method="post">
                                                <input type="hidden" name="id" value="<?php echo ($teamVal["id"]); ?>">
                                                <div class="new_portrait">
                                                    <div class="portrait_upload dn portraitNo">
                                                        <span>
                                                            上传创始人头像
                                                        </span>
                                                    </div>
                                                    <div class="portraitShow">
                                                        <img width="120" height="120" src="<?php echo ($teamVal["image"]); ?>">
                                                        <span>
                                                            更换头像
                                                        </span>
                                                    </div>
                                                    <input type="file" value="" title="支持jpg、jpeg、gif、png格式，文件小于5M">
                                                    <input type="hidden" value="" name="image" class="type">
                                                    <em>
                                                        尺寸：120*120px
                                                        <br>
                                                        大小：小于5M
                                                    </em>
                                                </div>
                                                <input type="text" placeholder="请输入创始人姓名" value="<?php echo ($teamVal["name"]); ?>" name="name">
                                                <input type="text" placeholder="请输入创始人当前职位" value="<?php echo ($teamVal["position"]); ?>" name="position">
                                                <input type="text" placeholder="请输入创始人新浪微博地址" value="<?php echo ($teamVal["weibo"]); ?>" name="weibo">
                                                <textarea placeholder="请输入创始人个人简介" maxlength="500" class="s_textarea" name="desc"><?php echo ($teamVal["desc"]); ?></textarea>
                                                <div class="word_count fr">
                                                    你还可以输入
                                                    <span>
                                                        500
                                                    </span>
                                                    字
                                                </div>
                                                <div class="clear"></div>
                                                <input type="submit" value="保存" class="btn_small">
                                                <a class="btn_cancel_s member_delete" href="javascript:void(0)">
                                                    删除
                                                </a>
                                                <input type="hidden" value="11493" class="leader_id">
                                            </form>
                                        </div>
                                        <!-- 显示创始人 -->
                                        <div class="member_info">
                                            <a title="编辑创始人" class="c_edit member_edit" href="javascript:void(0)">
                                            </a>
                                            <span style="display:none"><?php echo U('Home/CompanyTeam/image');?></span>
                                            <div class="m_portrait">
                                                <div></div>
                                                <img width="120" height="120" alt="<?php echo ($teamVal["name"]); ?>" src="<?php echo ($teamVal["image"]); ?>">
                                            </div>
                                            <div class="m_name">
                                                <?php echo ($teamVal["name"]); ?>
                                                <?php if(empty($teamVal["weibo"])): else: ?>
                                                <a target="_blank" class="weibo" href="<?php echo ($teamVal["weibo"]); ?>"></a><?php endif; ?>
                                            </div>
                                            <div class="m_position">
                                                <?php echo ($teamVal["position"]); ?>
                                            </div>
                                            <div class="m_intro">
                                                <?php echo ($teamVal["desc"]); ?>
                                            </div>
                                        </div>
                                    </div><?php endforeach; endif; endif; ?>
                                    <!-- end .member_wrap -->
                                </dd>
                            </dl>
                        </div>
                        <!-- end #Member -->
                    </div>
                </div>
                <script src="/Public/HomeStyle/js/company.min.js" type="text/javascript"></script>
                <div class="clear"></div>
                <a rel="nofollow" title="回到顶部" id="backtop" style="display: inline;"></a>
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
        <script src="/Public/HomeStyle/js/popup.min.js" type="text/javascript">
        </script>
        <script type="text/javascript">

            /**
             * @param string 上传地址
             * @param string file表单id
             * @param string 要修改的dom节点
             */
            function uploadFile(url, file_id, class_id) {
                var url = url;
                var file_id = file_id;
                var file_obj = $('#'+file_id);
                var class_obj = $('.'+class_id);
                var n = $('#'+file_id).next();
                console.log(file_obj.attr('name'));
                $.ajaxFileUpload({
                    url : url,
                    fileElementId : file_id,
                    secureuri: false,
                    dataType : 'json',
                    data : {fid:file_obj.attr('name'), id:file_obj.attr('id')},
                    type : 'post',
                    success : function(data) {
                        console.log(data);
                        n.val(data.url);
                        data.url = data.url + '?' + parseInt(Math.random()*10000);
                        class_obj.attr('src', data.url);
                    }
                })
            }

            jQuery(function($) {
                if ($('.hasProduct').length <= 0) {
                    $('.no_product').removeClass('dn');
                }

                if ($('.hasTeam').length <= 0) {
                    $('.noTeam').removeClass('dn');
                }

                $.extend({
                    sub : function(obj) {
                        obj = $(obj);
                        $.ajax({
                            url : obj.attr('action'),
                            type : 'post',
                            data : obj.serialize(),
                            success : function(data) {

                                if (data.code == 0) {
                                    $('.fullname').html(data.name);
                                    $('.fullname').attr('title', data.name);
                                    $('.oneword').children('span').html(data.one_desc);
                                    obj.parents('#c_tags_edit').addClass('dn');
                                    obj.parents('#c_tags_edit').prev().removeClass('dn');
                                    obj.parents('#c_tags_edit').prev().find('.companyCity').html(data.city);
                                    obj.parents('#c_tags_edit').prev().find('.companyTrade').html(data.trade);
                                    obj.parents('#c_tags_edit').prev().find('.companyTrade').attr('title', data.trade);
                                    obj.parents('#c_tags_edit').prev().find('.companyScale').html(data.scale);
                                    obj.parents('#c_tags_edit').prev().find('.companyWeb').html(data.web);
                                    obj.parents('#c_tags_edit').prev().find('.companyWeb').attr('title', data.web);
                                    obj.parents('#c_tags_edit').prev().find('.companyWeb').attr('href', data.web);
                                    obj.addClass('dn');
                                    obj.prev().removeClass('dn');
                                    obj.prev().find('.c5').html(data.stage);
                                } else if (data.code == 1) {
                                    obj.parents('dl').addClass('dn');
                                    obj.parents('dl').next().removeClass('dn');
                                    obj.parents('dl').next().find('img').attr('alt', data.name);
                                    obj.parents('dl').next().find('h3').children('a').attr('href', data.link).html(data.name);
                                    data.image = data.image + '?' + parseInt(Math.random()*10000);
                                    obj.parents('dl').next().find('img').attr('src', data.image);
                                    obj.parents('dl').next().find('.proDesc').html(data.desc);
                                } else if (data.code == 2) {
                                    obj.parents('dl').addClass('dn');
                                    obj.parents('dl').next().removeClass('dn');
                                    obj.parents('dl').next().find('.c_intro').html(data.desc);
                                } else if (data.code == -1) {
                                    obj.parents('dl').addClass('dn');
                                    obj.parents('dl').prev().removeClass('dn');
                                } else if (data.code == 3) {
                                    obj.parents('.member_info').addClass('dn');
                                    obj.parents('.member_info').next().removeClass('dn');
                                    obj.parents('.member_info').next().find('img').attr('alt', data.name);
                                    obj.parents('.member_info').next().find('img').attr('src', data.image);
                                    obj.parents('.member_info').next().find('.m_name').html(data.name);
                                    obj.parents('.member_info').next().find('.m_name').children('a').attr('href', data.weibo);
                                    obj.parents('.member_info').next().find('.m_position').html(data.position);
                                    obj.parents('.member_info').next().find('.m_intro').html(data.desc);
                                }
                            }
                        })
                        return false;
                    }
                })

                $('#saveDetail').click(function() {
                    $(this).parent().addClass('dn');
                })

                $('#saveLabels').click(function() {
                    var a=[];
                    $("#hasLabels").children().each(function(){
                        a.push($(this).children("span").text());
                    }),
                    $("#hasLabels li").each(function() {
                        $(this).find("i").remove()
                    }),
                    $("#addLabels").hide(),
                    $("#hasLabels").append('<li class="link">编辑</li>'),
                    $.ajax({
                        type:"POST",
                        data:{labels:a.join()},
                        url: "<?php echo U('Home/CompanyInfo/label');?>",
                        success : function(data) {
                        }
                    })
                })

                $('.product_delete').click(function() {
                    if (confirm('你确定删除此产品?')){
                        $.ajax({
                            url : "<?php echo U('Home/CompanyProduct/delete');?>",
                            data : $(this).parents('form').serialize(),
                            type : 'post',
                            sussecc : function(data) {
                            }
                        })
                        $(this).parents('.product_wrap').empty();
                    } else {
                        $(this).parents('dl').addClass('dn');
                        $(this).parents('dl').next().removeClass('dn');
                    }
                })

                $('#editIntro').click(function() {
                    $(this).parents('dl').addClass('dn');
                    $(this).parents('dl').prev().removeClass('dn');
                })

                $('#addIntro').click(function() {
                    $(this).parents('dl').addClass('dn');
                    $(this).parents('dl').next().removeClass('dn');
                })

                $('#delProfile').click(function() {
                    $(this).parents('dl').addClass('dn');
                    $(this).parents('dl').next().removeClass('dn');
                })

                $('.stage_edit').click(function() {
                    $(this).parents('dt').next().find('.stageshow').addClass('dn');
                    $(this).parents('dt').next().find('form').removeClass('dn');
                })

                $('#cancelStages').click(function() {
                    $(this).parents('form').addClass('dn');
                    $(this).parents('form').prev().removeClass('dn');
                })

                $('.member_delete').click(function() {
                    if (confirm('are you sur')){
                        $.ajax({
                            url : "<?php echo U('Home/CompanyTeam/delete');?>",
                            data : $(this).parents('form').serialize(),
                            type : 'post',
                            sussecc : function(data) {
                            }
                        })
                        $(this).parents('.member_wrap').empty();
                    } else {
                        $(this).parents('.member_info').addClass('dn');
                        $(this).parents('.member_info').next().removeClass('dn');
                    }
                })

            })
        </script>
    </body>

</html>