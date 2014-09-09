<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo ($seo["title"]); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="/Public/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="/Public/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<style>
	body {
		padding-top: 80px;
        padding-bottom: 40px;
	}
	</style>
</head>
<body>

	<!-- 公共头部 -->
	<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="<?php echo U('/index/hall');?>">逐浪大厅</a>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li class="active"><a href="/">首页</a></li>
        </ul>

	<?php if(!session('user')):?>		
        <form class="navbar-form pull-right" action="<?php echo U('login/doLogin');?>" method="post">
          <input class="span2" type="text" name="username" placeholder="用户名">
          <input class="span2" type="password" name="password" placeholder="密码">
          <button type="submit" class="btn">登录</button>
        </form>
      <?php else:?>
      <p class="navbar-text pull-right">
      	欢迎, <?php echo session('user.user_name');?> | 
		<a href="<?php echo U('user/center/index');?>" class="navbar-link">个人中心</a> | 
		<a href="<?php echo U('user/center/logout');?>" class="navbar-link">退出</a>
      </p>
      <?php endif;?>
      </div>
    </div>
  </div>
</div>

    <div class="container">
    	<div class="hero-unit">
    		<h2>逐浪网2014版控制平台</h2>
    	</div>
		<div class="row">
			<div class="span4">
				<h2>用户系统</h2>
				<p>简洁的用户管理系统</p>
				<p><a href="<?php echo U('user/center/index');?>" class="btn">进入</a></p>
			</div>
			<div class="span4">
				<h2>作者系统</h2>
				<p>高效的作者管理系统</p>
				<p><a href="###" class="btn">进入</a></p>
			</div>
			<div class="span4">
				<h2>书站系统</h2>
				<p>丰富的小说管理系统</p>
				<p><a href="###" class="btn">进入</a></p>
			</div>
		</div>


	    <hr>
	    
		<!-- 公共底部 -->
		<div class="footer">
	<p>copyright 空中网</p>	
</div>

    </div>


	<script src="/Public/js/jquery.min.js"></script>
	<script src="/Public/js/bootstrap.min.js"></script>
	<script src="/Public/js/zlang.js"></script>
	<script type="text/javascript">
		jQuery(function(){

			$.debug('首页');
		});
	</script>
</body>
</html>