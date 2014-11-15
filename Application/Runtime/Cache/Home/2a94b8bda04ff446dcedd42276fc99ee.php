<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html xmlns:wb="http://open.weibo.com/wb">
<head>
	<script id="allmobilize" charset="utf-8" src="style/js/allmobilize.min.js"></script>
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="alternate" media="handheld"  />
	<!-- end 云适配 -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>拉勾网-最专业的互联网招聘平台</title>
	<meta property="qc:admins" content="23635710066417756375" />
	<meta content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网" name="description">
	<meta content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招" name="keywords">
	<meta name="baidu-site-verification" content="QIQ6KC1oZ6" />
	<script type="text/javascript">
		var ctx = "h";
		console.log(1);
	</script>
	<link rel="Shortcut Icon" href="h/images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/Public/HomeStyle/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/Public/HomeStyle/css/external.min.css"/>
	<link rel="stylesheet" type="text/css" href="/Public/HomeStyle/css/popup.css"/>
	<script src="/Public/HomeStyle/js/jquery.1.10.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/Public/HomeStyle/js/jquery.lib.min.js"></script>
	<script src="/Public/HomeStyle/js/ajaxfileupload.js" type="text/javascript"></script>
	<script type="text/javascript" src="/Public/HomeStyle/js/additional-methods.js"></script>
	<script type="text/javascript" src="/Public/HomeStyle/js/Chart.min.js"></script>
	<script type="text/javascript" src="/Public/HomeStyle/js/home.min.js"></script>
	<script type="text/javascript" src="/Public/HomeStyle/js/count.js"></script>
	<script type="text/javascript" src="/Public/HomeStyle/js/core.min.js"></script>
	<script type="text/javascript" src="/Public/HomeStyle/js/popup.min.js"></script>
	<script type="text/javascript">
		var youdao_conv_id = 271546; 
	</script> 
	<script type="text/javascript" src="/Public/HomeStyle/js/conv.js"></script>
	<style>
	.ui-autocomplete{width:488px;background:#fafafa !important;position: relative;z-index:10;border: 2px solid #91cebe;}
	.ui-autocomplete-category{font-size:16px;color:#999;width:50px;position: absolute;z-index:11; right: 0px;/*top: 6px; */text-align:center;border-top: 1px dashed #e5e5e5;padding:5px 0;}
	.ui-menu-item{ *width:439px;vertical-align: middle;position: relative;margin: 0px;margin-right: 50px !important;background:#fff;border-right: 1px dashed #ededed;}
	.ui-menu-item a{display:block;overflow:hidden;}
	</style>
	<script type="text/javascript" src="/Public/HomeStyle/js/search.min.js"></script>
</head>
<body>
	<div id="body">
		<!-- begin header -->
		<div id="header">
    <div class="wrapper">
        <a href="index.html" class="logo">
            <img src="/Public/HomeStyle/images/logo.png" width="229" height="43" alt="拉勾招聘-专注互联网招聘" />
        </a>
        <?php if (!$_COOKIE['state']) :?>
        <!-- 未登录头部 -->
        <ul class="reset" id="navheader">
            <li <?php if(index == 'index'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
            <li <?php if(index == 'company'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Home/Index/companylist');?>" >公司</a></li>
            <li <?php if(index == 'resume'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Resume/index');?>" rel="nofollow">我的简历</a></li>
            <li <?php if(index == 'job'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Home/CompanyJob/create');?>" rel="nofollow">发布职位</a></li>
        </ul>
        <ul class="loginTop">
            <li><a href="<?php echo U('User/login');?>" rel="nofollow">登录</a></li> 
            <li>|</li>
            <li><a href="<?php echo U('User/register');?>" rel="nofollow">注册</a></li>
        </ul>
        <?php endif ;?>

        <?php if ($_COOKIE['state'] == 1) :?>
        <!-- 个人用户头部 -->
         <ul class="reset" id="navheader">
            <li <?php if(index == 'index'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
            <li <?php if(index == 'company'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Home/Index/companylist');?>" >公司</a></li>
            <li <?php if(index == 'resume'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Resume/index');?>" rel="nofollow">我的简历</a></li>
        </ul>
        <dl class="collapsible_menu">
            <dt>
                <span><?php echo $_SESSION['user']['username']?>&nbsp;</span>
                <span class="red dn" id="noticeDot-0"></span>
                <i></i>
            </dt>
            <dd><a href="<?php echo U('CollectionJob/index');?>">我收藏的职位</a></dd>
            <dd class="btm"><a href="###">我的订阅</a></dd>
            <dd><a href="<?php echo U('Home/CompanyJob/create');?>">我要招人</a></dd>
            <dd><a href="###">帐号设置</a></dd>
            <dd class="logout"><a rel="nofollow" href="<?php echo U('User/logout');?>">退出</a></dd>
        </dl>
        <?php endif ;?>
        <?php if ($_COOKIE['state'] == 2) :?>
        <!-- 公司用户头部 -->
         <ul class="reset" id="navheader">
            <li <?php if(index == 'index'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
            <li <?php if(index == 'company'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Home/Index/companylist');?>" >公司</a></li>
            <li <?php if(index == 'handle'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Home/ResumeHandle/unhandle');?>" rel="nofollow">简历管理</a></li>
            <li <?php if(index == 'job'): ?>class="current"<?php endif; ?>><a href="<?php echo U('Home/CompanyJob/create');?>" rel="nofollow">发布职位</a></li>
        </ul>
        <dl class="collapsible_menu">
            <dt>
                <span><?php echo $_SESSION['user']['username']?>&nbsp;</span>
                <span class="red dn" id="noticeDot-0"></span>
                <i></i>
            </dt>
            <dd><a rel="nofollow" href="<?php echo U('Home/CompanyJob/positions');?>">我发布的职位</a></dd>
            <dd><a href="<?php echo U('Home/ResumeHandle/unhandle');?>">我收到的简历</a></dd>
            <dd class="btm"><a href="<?php echo U('Home/Company/index');?>">我公司的主页</a></dd>
            <dd><a href="<?php echo U('Home/Resume/index');?>">我要找工作</a></dd>
            <dd><a href="###">帐号设置</a></dd>
            <dd class="logout"><a rel="nofollow" href="<?php echo U('User/logout');?>">退出</a></dd>
        </dl>
        <?php endif ;?>
    </div>
</div>
		<!-- end header -->
		<div id="container">
			<!--左侧职位列表开始-->
			<div id="sidebar">
				<div class="mainNavs">
					<!--1 begin-->
					<?php if(is_array($cates)): foreach($cates as $key=>$vo): ?><div class="menu_box">
							<div class="menu_main">
								<h2><?php echo ($vo['name']); ?><span></span></h2>
									<?php if(is_array($vo['sub'])): foreach($vo['sub'] as $key=>$v): if(is_array($v['sub'])): foreach($v['sub'] as $key=>$o): endforeach; endif; endforeach; endif; ?>
							</div>
							<div class="menu_sub dn">
								<dl class="reset">
									<?php if(is_array($vo['sub'])): foreach($vo['sub'] as $key=>$v): if($v['pid'] == $vo['id']): ?><dt style="margin-bottom:10px">
												<a href="<?php echo U('Search/index',array('job'=>$v['name']));?>"><?php echo ($v['name']); ?></a>
											</dt><?php endif; ?>								
										<dd> 
										<?php if(is_array($v['sub'])): foreach($v['sub'] as $key=>$o): if($o['pid'] == $v['id']): ?><a href="<?php echo U('Search/index',array('job'=>$o['name']));?>"><?php echo ($o['name']); ?></a><?php endif; endforeach; endif; ?>
										</dd><?php endforeach; endif; ?>			
								</dl>
							</div>
						</div><?php endforeach; endif; ?>
					<!--1 end-->
				</div>
				<a class="subscribe" href="subscribe.html" target="_blank">订阅职位</a>
			</div>
			<!--左侧职位列表 结束-->
			<!--右侧内容栏包括搜索框 开始-->
			<div class="content">
				<!--搜索框 开始-->
				<div id="search_box">
					<form   action="<?php echo U('Search/index');?>" method="get">
						<ul id="searchType">
							<li data-searchtype="1" class="type_selected">职位</li>
						</ul>
						<div class="searchtype_arrow"></div>
						<input type="text" id="search_input" name = "kd"  tabindex="1" value=""  placeholder="请输入职位名称，如：产品经理"  />
						<input type="submit" id="search_button" value="搜索" />
					</form>
				</div>
				<!--搜索框 结束-->
				<!--热门搜索 开始-->
				<dl class="hotSearch">
				</dl>
				<!--热门搜索 结束-->
				<!--上部轮播 开始-->
				<div id="home_banner">
					<!--上部轮播 开始-->
					<ul class="banner_bg">
						<li  class="banner_bg_1 current" >
							<a href="h/subject/s_buyfundation.html?utm_source=DH__lagou&utm_medium=banner&utm_campaign=haomai" target="_blank"><img src="/Public/HomeStyle/images/d05a2cc6e6c94bdd80e074eb05e37ebd.jpg" width="612" height="160" alt="好买基金——来了就给100万" /></a>
						</li>
						<li  class="banner_bg_2" >
							<a href="h/subject/s_worldcup.html?utm_source=DH__lagou&utm_medium=home&utm_campaign=wc" target="_blank"><img src="/Public/HomeStyle/images/c9d8a0756d1442caa328adcf28a38857.jpg" width="612" height="160" alt="世界杯放假看球，老板我也要！" /></a>
						</li>
						<li  class="banner_bg_3" >
							<a href="h/subject/s_xiamen.html?utm_source=DH__lagou&utm_medium=home&utm_campaign=xiamen" target="_blank"><img src="/Public/HomeStyle/images/d03110162390422bb97cebc7fd2ab586.jpg" width="612" height="160" alt="出北京记——第一站厦门" /></a>
						</li>
					</ul>
					<!--上部轮播 结束-->
					<!--右侧竖条轮播 开始-->
					<div class="banner_control">
						<em></em> 
						<ul class="thumbs">
							<li  class="thumbs_1 current" >
								<i></i>
								<img src="/Public/HomeStyle/images/4469b1b83b1f46c7adec255c4b1e4802.jpg" width="113" height="42" />
							</li>
							<li  class="thumbs_2" >
								<i></i>
								<img src="/Public/HomeStyle/images/381b343557774270a508206b3a725f39.jpg" width="113" height="42" />
							</li>
							<li  class="thumbs_3" >
								<i></i>
								<img src="/Public/HomeStyle/images/354d445c5fd84f1990b91eb559677eb5.jpg" width="113" height="42" />
							</li>
						</ul>
					</div>
					<!--右侧竖条轮播 结束-->
				</div>
				<!--上部轮播结束-->
				<!--下部广告框 开始-->
				<ul id="da-thumbs" class="da-thumbs">
					<li >
						<a href="h/c/1650.html" target="_blank">
							<img src="/Public/HomeStyle/images/a254b11ecead45bda166afa8aaa9c8bc.jpg" width="113" height="113" alt="联想" />
							<div class="hot_info">
								<h2 title="联想">联想</h2>
								<em></em>
								<p title="世界因联想更美好">世界因联想更美好</p>
							</div>
						</a>
					</li>
					<li >
						<a href="h/c/9725.html" target="_blank">
							<img src="/Public/HomeStyle/images/c75654bc2ab141df8218983cfe5c89f9.jpg" width="113" height="113" alt="淘米" />
							<div class="hot_info">
								<h2 title="淘米">淘米</h2>
								<em></em>
								<p title="将心注入 追求极致">将心注入 追求极致</p>
							</div>
						</a>
					</li>
					<li >
						<a href="h/c/1914.html" target="_blank">
							<img src="/Public/HomeStyle/images/2bba2b71d0b0443eaea1774f7ee17c9f.png" width="113" height="113" alt="优酷土豆" />
							<div class="hot_info">
								<h2 title="优酷土豆">优酷土豆</h2>
								<em></em>
								<p title="专注于视频领域，是中国网络视频行业领军企业">
									专注于视频领域，是中国网络视频行业领军企业
								</p>
							</div>
						</a>
					</li>
					<li >
						<a href="h/c/6630.html" target="_blank">
							<img src="/Public/HomeStyle/images/f4822a445a8b495ebad81fcfad3e40e2.jpg" width="113" height="113" alt="思特沃克" />
							<div class="hot_info">
								<h2 title="思特沃克">思特沃克</h2>
								<em></em>
								<p title="一家全球信息技术服务公司">一家全球信息技术服务公司</p>
							</div>
						</a>
					</li>
					<li >
						<a href="h/c/2700.html" target="_blank">
							<img src="/Public/HomeStyle/images/5caf8f9631114bf990f87bb11360653e.png" width="113" height="113" alt="奇猫" />
							<div class="hot_info">
								<h2 title="奇猫">奇猫</h2>
								<em></em>
								<p title="专注于移动互联网、互联网产品研发">专注于移动互联网、互联网产品研发</p>
							</div>
						</a>
					</li>
					<li  class="last" >
						<a href="h/c/1335.html" target="_blank">
							<img src="/Public/HomeStyle/images/c0052c69ef4546c3b7d08366d0744974.jpg" width="113" height="113" alt="堆糖网" />
							<div class="hot_info">
								<h2 title="堆糖网">堆糖网</h2>
								<em></em>
								<p title="分享收集生活中的美好，遇见世界上的另外一个你">分享收集生活中的美好，遇见世界上的另外一个你</p>
							</div>
						</a>
					</li>
				</ul>
				<!--下部广告位 结束-->
				<ul class="reset hotabbing" id="check_position">
					<li class="current">热门职位</li>
					<li>最新职位</li>
				</ul>
				<!--职位详情框 开始-->
				<div id="hotList">
					<ul class="hot_pos reset">
						<!--白色背景热门职位详情 开始-->
						<?php if(is_array($hotjob)): foreach($hotjob as $key=>$vo): ?><li class="odd clearfix">
							<div class="hot_pos_l">
								<div class="mb10">
									<a href="<?php echo U('JobShow/index',array('jid'=>$vo['id']));?>" target="_blank"><?php echo ($vo["name"]); ?></a>&nbsp;
									<span class="c9">[<?php echo ($vo["city"]); ?>]</span>
								</div>
								<span><em class="c7">月薪： </em><?php echo ($vo["salary_low"]); ?>k-<?php echo ($vo["salary_high"]); ?>k</span>
								<span><em class="c7">经验：</em> <?php echo ($vo["work_year"]); ?></span>
								<span><em class="c7">最低学历： </em><?php echo ($vo["edu"]); ?></span>
								<br />
								<span><em class="c7">职位诱惑：</em><?php echo ($vo["welfare"]); ?></span>
								<br />
								<span>发布时间:<?php echo (date('Y年m月d日',$vo["modify_time"])); ?></span>
							</div>
							<div class="hot_pos_r">
								<div class="mb10 recompany">
									<a href="<?php echo U('Index/showCompany',array('id'=>$vo['company']['id']));?>" target="_blank"><?php echo ($vo["company"]["name"]); ?></a>
								</div>
								<span><em class="c7">领域：</em> <?php echo ($vo["company"]["trade"]); ?></span>
								<span><em class="c7">创始人：</em>陈桦</span>
								<br />
								<span><em class="c7">阶段：</em><?php echo ($vo["company"]["stage"]); ?></span>
								<span><em class="c7">规模：</em><?php echo ($vo["company"]["scale"]); ?></span>
								<ul class="companyTags reset">
									<li>移动互联网</li>
									<li>五险一金</li>
									<li>扁平管理</li>
								</ul>
							</div>
						</li><?php endforeach; endif; ?>
						<!--白色背景热门职位详情 结束-->
						<a href="#" class="btn fr" target="_blank">查看更多</a>
					</ul>
					<ul class="hot_pos reset dn">
						<!--最新职位详情 开始-->
						<?php if(is_array($newjob)): foreach($newjob as $key=>$vo): ?><li class="odd clearfix">
							<div class="hot_pos_l">
								<div class="mb10">
									<a href="<?php echo U('JobShow/index',array('jid'=>$vo['id']));?>" target="_blank"><?php echo ($vo["name"]); ?></a>&nbsp;
									<span class="c9">[<?php echo ($vo["city"]); ?>]</span>
								</div>
								<span><em class="c7">月薪： </em><?php echo ($vo["salary_low"]); ?>k-<?php echo ($vo["salary_high"]); ?>k</span>
								<span><em class="c7">经验：</em> <?php echo ($vo["work_year"]); ?></span>
								<span><em class="c7">最低学历： </em><?php echo ($vo["edu"]); ?></span>
								<br />
								<span><em class="c7">职位诱惑：</em><?php echo ($vo["welfare"]); ?></span>
								<br />
								<span>发布时间:<?php echo (date('Y年m月d日',$vo["modify_time"])); ?></span>
							</div>
							<div class="hot_pos_r">
								<div class="mb10 recompany">
									<a href="<?php echo U('Index/showCompany',array('id'=>$vo['company']['id']));?>" target="_blank"><?php echo ($vo["company"]["name"]); ?></a>
								</div>
								<span><em class="c7">领域：</em> <?php echo ($vo["company"]["trade"]); ?></span>
								<span><em class="c7">创始人：</em>陈桦</span>
								<br />
								<span><em class="c7">阶段：</em><?php echo ($vo["company"]["stage"]); ?></span>
								<span><em class="c7">规模：</em><?php echo ($vo["company"]["scale"]); ?></span>
								<ul class="companyTags reset">
									<li>移动互联网</li>
									<li>五险一金</li>
									<li>扁平管理</li>
								</ul>
							</div>
						</li><?php endforeach; endif; ?>
						<!--最新职位详情 结束-->
						<a href="#" class="btn fr" target="_blank">查看更多</a>
					</ul>
				</div>
				<!--职位详情框 结束-->
				<div class="clear"></div>
				<!--友情链接框 开始-->
				<div id="linkbox">
					<dl>
						<dt>友情链接</dt>
						<dd>
								<a href="http://www.zhuqu.com/" target="_blank">住趣家居网</a> <span>|</span>
								<a href="http://iwebad.com/" target="_blank">网络广告人社区</a>
								<a href="h/af/flink.html" target="_blank" class="more">更多</a>
						</dd>
					</dl>
				</div>
				<!--友情连接 结束-->
			</div>
			<!--右侧内容栏包括搜索框  结束-->
				<div class="clear"></div>
				<input type="hidden" id="resubmitToken" value="" />
				<a id="backtop" title="回到顶部" rel="nofollow"></a>
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
</body>
</html>
<script>
	//点击切换职位选择
	$('#check_position').children().click(function(){

	});
</script>