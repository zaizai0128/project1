<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo ($seo["title"]); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="/Public/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="/Public/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<style>
		body{padding-top:80px;}
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
    		
    	<div class="row">
    		<div class="span3">
    			<div class="sidebar-nav">
	<ul class="nav nav-list">
		<li class="nav-header">快捷操作</li>
		<li <?php if(ext == 'ext'): ?>class="active"<?php endif; ?>><a href="<?php echo U('/user/center/index');?>">补充信息</a></li>
		<li <?php if(ext == 'true_info'): ?>class="active"<?php endif; ?>><a href="<?php echo U('/user/center/trueInfo');?>">补充真实信息</a></li>
		<li <?php if(ext == 'apply'): ?>class="active"<?php endif; ?>><a href="<?php echo U('/user/center/apply');?>">申请成为作者</a></li>
		<li <?php if(ext == 'bank'): ?>class="active"<?php endif; ?>><a href="<?php echo U('/user/center/bank');?>">填写银行信息</a></li>
		<li <?php if(ext == 'vip'): ?>class="active"<?php endif; ?>><a href="<?php echo U('/user/center/vip');?>">升级为VIP</a></li>
	</ul>
</div>
    		</div>
    		<div class="span9">
    			
          <h3>完善个人信息</h3>
          <form action="<?php echo U('user/center/doAddExt');?>" class="form-horizontal" method="post">

            <div class="control-group">
              <label for="inputEmail" class="control-label">邮箱</label>
              <div class="controls">
                <input type="text" name="user_email" placeholder="邮箱" id="inputEmail" value="<?php echo ($info["user_email"]); ?>"/>
              </div>
            </div>

            <div class="control-group">
              <label for="inputQQ" class="control-label">QQ</label>
              <div class="controls">
                <input type="text" id="inputQQ" name="user_qq" placeholder="qq" value="<?php echo ($info["user_qq"]); ?>" />
              </div>
            </div>

            <div class="control-group">
              <label for="inputMobile" class="control-label">手机号码</label>  
              <div class="controls">
                <input type="text" name="user_mobile" placeholder="手机号码" id="inputMobile" value="<?php echo ($info["user_mobile"]); ?>" />
              </div>
            </div>
            
            <input type="hidden" name="user_id" value="<?php echo session('user.user_id');?>" />
            <button class="btn btn-danger">提交</button>
          </form>

    		</div>
    	</div>
	   
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

			$.debug("个人中心");
		});
	</script>
</body>
</html>