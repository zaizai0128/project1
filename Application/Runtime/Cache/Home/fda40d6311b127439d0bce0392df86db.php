<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html><head>
<meta content="no-siteapp" http-equiv="Cache-Control">
<link  media="handheld" rel="alternate">
<!-- end 云适配 -->
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>我的简历-拉勾网-最专业的互联网招聘平台</title>
<meta content="23635710066417756375" property="qc:admins">
<meta name="description" content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网">
<meta name="keywords" content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招">
<meta content="QIQ6KC1oZ6" name="baidu-site-verification">
<link href="h/images/favicon.ico" rel="Shortcut Icon">
<link href="/Public/HomeStyle/css/style.css" type="text/css" rel="stylesheet">
<link href="/Public/HomeStyle/css/external.min.css" type="text/css" rel="stylesheet">
<link href="/Public/HomeStyle/css/popup.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/Public/HomeStyle/js/jquery.1.10.1.min.js"></script>
<script src="/Public/HomeStyle/js/jquery.lib.min.js" type="text/javascript"></script>
<script src="/Public/HomeStyle/js/core.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/Public/HomeStyle/js/ajaxfileupload.js"></script>
</head>
<body>
<div id="body">
	<div id="header">
    	<div class="wrapper">
    		<a class="logo" href="h/">
    			<img width="229" height="43" alt="拉勾招聘-专注互联网招聘" src="/Public/HomeStyle/images/logo.png">
    		</a>
    		<ul id="navheader" class="reset">
    			<li><a href="index.html">首页</a></li>
    			<li><a href="companylist.html">公司</a></li>
    			<li><a target="_blank" href="h/toForum.html">论坛</a></li>
    			<li class="current"><a rel="nofollow" href="<?php echo U('Resume/index');?>">我的简历</a></li>
	    	</ul>
        	<dl class="collapsible_menu">
            	<dt>
           			<span><?php echo ($data['username']); ?>&nbsp;</span> 
            		<span class="red dn" id="noticeDot-0"></span>
            		<i></i>
            	</dt>
                    <dd><a rel="nofollow" href="<?php echo U('Resume/index');?>">我的简历</a></dd>
                	<dd><a href="collections.html">我收藏的职位</a></dd>
                	<dd class="btm"><a href="subscribe.html">我的订阅</a></dd>
                	<dd><a href="create.html">我要招人</a></dd>
                    <dd><a href="accountBind.html">帐号设置</a></dd>
                    <dd class="logout"><a rel="nofollow" href="<?php echo U('User/logout');?>">退出</a></dd>
            </dl>
            <div class="dn" id="noticeTip">
            	<span class="bot"></span>
				<span class="top"></span>
				<a target="_blank" href="delivery.html"><strong>0</strong>条新投递反馈</a>
				<a class="closeNT" href="javascript:;"></a>
            </div>
        </div>
    </div><!-- end #header -->
    <div id="container">
        
  		<div class="clearfix">
            <div class="content_l">
            	<div class="fl" id="resume_name">
	            	<div class="nameShow fl">
	            		<h1 title="jason的简历"> <?php echo ($data['username']); ?> </h1>
	            		<span class="rename">重命名</span> | <a target="_blank" href="<?php echo U('Resume/showResume');?>">预览</a>
            		</div>
            		<form class="fl dn" id="resumeNameForm">
            			<input type="text" value="<?php echo ($data['username']); ?>" name="resumeName" class="nameEdit c9">	
            			<input type="submit" value="保存"> | <a target="_blank" href="h/resume/preview.html">预览</a>
            		</form>
            	</div><!--end #resume_name-->
            	<div class="fr c5" id="lastChangedTime">最后一次更新：<span><?php echo ($data['time']); ?> </span></div><!--end #lastChangedTime-->
            	<div id="resumeScore">
            		<div class="score fl">
            			<canvas height="120" width="120" id="doughnutChartCanvas" style="width: 120px; height: 120px;"></canvas>
           				<div style="" class="scoreVal"><span>15</span>分</div>
            		</div>	
            		
            		<div class="which fl">
            			<div>工作经历最能体现自己的工作能力，且完善后才可投递简历哦！</div>
            										<!--<span rel="workExperience"><a>马上去完善</a></span>-->
					</div>
            	</div><!--end #resumeScore-->

            	<div class="profile_box" id="basicInfo">
            		<h2>基本信息</h2>
            		<span class="c_edit"></span>
            		<div class="basicShow">
            			<span><?php echo ($data['username']); ?> |  <?php echo ($data['sex']); ?> |    <?php echo ($data['education']); ?> |  <?php echo ($data['work_year']); ?><br>
            			            			<?php echo ($data['phone']); ?> | <?php echo ($data['email']); ?><br>
            			</span>
            			<div class="m_portrait">
	                    	<div></div>
	                    	<img id="show_image" width="120" height="120" alt="jason" src="/Uploads/User/image/<?php echo ($data['image']); ?>">
	                    </div>
            		</div><!--end .basicShow-->

            		<div class="basicEdit dn">
            			<form id="profileForm" action="<?php echo U('Resume/update_ajax');?>" method="post" onsubmit="return $.sub(this)">
							<!--<input type="hidden" name="uid" value="<?php echo (session('id')); ?>">-->
						  <table>
						    <tbody><tr>
						      <td valign="top">
						        <span class="redstar">*</span>
						      </td> 
						      <td>
						        <input type="hidden" placeholder=""  id='name' >
						        <input type="text" placeholder="姓名"  name="name" id="name" value="<?php echo ($data['username']); ?>">
						      </td>
						      <td valign="top"></td> 
						      <td>
						          <ul class="profile_radio clearfix reset">
						            <li class="current">
						           	  	 男<em></em>
						              	<input type="radio" checked="checked" name="gender" value="1"> 
						            </li>
						            <li>
						            	  女<em></em>
						              	<input type="radio" name="gender" value="0"> 
						            </li>
						          </ul>  
						      </td>
						    </tr>
						    <tr>
						      <td valign="top">
						        <span class="redstar">*</span>
						      </td> 
						      <td>
						      	<input type="hidden" id="topDegree" value="" name="topDegree">
						        <input type="button" value="" id="select_topDegree" class="profile_select_190 profile_select_normal">
								<div class="boxUpDown boxUpDown_190 dn" id="box_topDegree" style="display: none;">
						        	<ul>
					        			<li>大专</li>
					        			<li>本科</li>
					        			<li>硕士</li>
					        			<li>博士</li>
					        			<li>其他</li>
						        	</ul>
						        </div>  
						      </td>
						      <td valign="top">
						        <span class="redstar">*</span>
						      </td> 
						      <td>
						          <input type="hidden" id="workyear" value="" name="workyear">
						          <input type="button" value="" id="select_workyear" class="profile_select_190 profile_select_normal">
								  <div class="boxUpDown boxUpDown_190 dn" id="box_workyear" style="display: none;">
						          	 <ul>
					        			<li>应届毕业生</li>
					        			<li>1年</li>
					        			<li>2年</li>
					        			<li>3年</li>
					        			<li>4年</li>
					        			<li>5年</li>
					        			<li>6年</li>
					        			<li>7年</li>
					        			<li>8年</li>
					        			<li>9年</li>
					        			<li>10年</li>
					        			<li>10年以上</li>
						        	</ul>
						          </div>  
						      </td>
						    </tr>
						    <tr>
						      <td valign="top">
						        <span class="redstar">*</span>
						      </td> 
						      <td colspan="3">
						          <input type="hidden" placeholder="手机号码" value="" id="tel">
						          <input type="text" placeholder="手机号码" value="<?php echo ($data['phone']); ?>" name="tel" id="tel">
						      </td>
						   	</tr>
						   	<tr>
						      <td valign="top">
						        <span class="redstar">*</span>
						      </td> 
						      <td colspan="3">
						          <input type="hidden" placeholder="接收面试通知的邮箱" value="" id="email">
						          <input type="text" placeholder="接收面试通知的邮箱" value="<?php echo ($data['email']); ?>" name="email" id="email">
						      </td>
						    </tr>
						    <tr>
						      <td valign="top"> </td> 
						      <td colspan="3">
						          <input type="hidden" id="currentState" value="" name="currentState">
						          <input type="button" value="目前状态" id="select_currentState" class="profile_select_410 profile_select_normal">
								  <div class="boxUpDown boxUpDown_410 dn" id="box_currentState" style="display: none;">
						          	<ul>
					        			<li>我目前已离职，可快速到岗</li>
					        			<li>我目前正在职，正考虑换个新环境</li>
					        			<li>我暂时不想找工作</li>
					        			<li>我是应届毕业生</li>
		        					</ul>
						          </div>  
						      </td>
						    </tr>
						    <tr>
						      <td></td> 
						      <td colspan="3">
						          <input type="submit" value="保 存" class="btn_profile_save">
						          <a class="btn_profile_cancel" href="javascript:void(0);">取 消</a>
								 
						      </td>
						    </tr>
						  </tbody></table>
						</form><!--end #profileForm-->
						<div class="new_portrait">
						  <div class="portrait_upload" id="portraitNo">
						      <span>上传自己的头像</span>
						  </div>
						  <div class="portraitShow" id="portrait">
						    <img width="120" height="120" src="/Uploads/User/image/<?php echo ($data['image']); ?>">
						    <span>更换头像</span>
						  </div>
						  <input type="file" value="" title="支持jpg、jpeg、gif、png格式，文件小于5M" onchange="uploadFile();" name="headPic" id="headPic" class="myfiles">
							<!--<input type="hidden" id="headPicHidden" />-->
						  	<em>
						                  尺寸：120*120px <br>   
						                  大小：小于5M
						  	</em>
						  	<span style="display:none;" id="headPic_error" class="error"></span>
						</div><!--end .new_portrait-->
            		</div><!--end .basicEdit-->
            		<!--<input type="hidden" id="nameVal" value="jason">
            		<input type="hidden" id="genderVal" value="男">
            		<input type="hidden" id="topDegreeVal" value="大专">
            		<input type="hidden" id="workyearVal" value="3年">
            		<input type="hidden" id="currentStateVal" value="">
            		<input type="hidden" id="emailVal" value="jason@qq.com">
            		<input type="hidden" id="telVal" value="18644444444">
            		<input type="hidden" id="pageType" value="1"> -->
            	</div><!--end #basicInfo-->

            	<div class="profile_box" id="expectJob">
            		<h2>期望工作</h2>
            		            		<span class="c_edit"></span>
            		<div class="expectShow <?php echo ($data['hope_out']); ?>">
            		            			<span><?php echo ($data['hope_value']); ?></span>
            		</div><!--end .expectShow-->
            		<div class="expectEdit dn">
            			<form id="expectForm" onsubmit="return $.sub(this)" action="<?php echo U('Resume/hope_ajax');?>">
	            			<table>
	            				<tbody><tr>
	            					<td>
	            						<input type="hidden" id="expectCity" value="" name="expectCity">
							        	<input type="button" value="期望城市，如：北京" id="select_expectCity" class="profile_select_287 profile_select_normal">
										<div class="boxUpDown boxUpDown_596 dn" id="box_expectCity" style="display: none;">
								          		<dl>
								        			<dt>热门城市</dt>
								        			<dd>
								        				<span>北京</span>
								        				<span>上海</span>
								        				<span>广州</span>
								        				<span>深圳</span>
								        				<span>成都</span>
								        				<span>杭州</span>
									        		</dd>
								        	  	</dl>
								        		<dl>
								        			<dt>ABCDEF</dt>
								        			<dd>
								        				<span>北京</span>
								        				<span>长春</span>
								        				<span>成都</span>
								        				<span>重庆</span>
								        				<span>长沙</span>
								        				<span>常州</span>
								        				<span>东莞</span>
								        				<span>大连</span>
								        				<span>佛山</span>
								        				<span>福州</span>
									        		</dd>
								        	  	</dl>
								        		<dl>
								        			<dt>GHIJ</dt>
								        			<dd>
								        				<span>贵阳</span>
								        				<span>广州</span>
								        				<span>哈尔滨</span>
								        				<span>合肥</span>
								        				<span>海口</span>
								        				<span>杭州</span>
								        				<span>惠州</span>
								        				<span>金华</span>
								        				<span>济南</span>
								        				<span>嘉兴</span>
									        		</dd>
								        	  	</dl>
								        		<dl>
								        			<dt>KLMN</dt>
								        			<dd>
								        				<span>昆明</span>
								        				<span>廊坊</span>
								        				<span>宁波</span>
								        				<span>南昌</span>
								        				<span>南京</span>
								        				<span>南宁</span>
								        				<span>南通</span>
									        		</dd>
								        	  	</dl>
								        		<dl>
								        			<dt>OPQR</dt>
								        			<dd>
								        				<span>青岛</span>
								        				<span>泉州</span>
									        		</dd>
								        	  	</dl>
								        		<dl>
								        			<dt>STUV</dt>
								        			<dd>
								        				<span>上海</span>
								        				<span>石家庄</span>
								        				<span>绍兴</span>
								        				<span>沈阳</span>
								        				<span>深圳</span>
								        				<span>苏州</span>
								        				<span>天津</span>
								        				<span>太原</span>
								        				<span>台州</span>
									        		</dd>
								        	  	</dl>
								        		<dl>
								        			<dt>WXYZ</dt>
								        			<dd>
								        				<span>武汉</span>
								        				<span>无锡</span>
								        				<span>温州</span>
								        				<span>西安</span>
								        				<span>厦门</span>
								        				<span>烟台</span>
								        				<span>珠海</span>
								        				<span>中山</span>
								        				<span>郑州</span>
									        		</dd>
								        	  	</dl>
								    	</div>  
	            					</td>
	            					<td>
	            						<ul class="profile_radio clearfix reset" id='fo2_1'>
											<input type="hidden" name="type" value="">
											<li>全职</li>
								            <li>兼职</li>
								            <li>实习</li>
								        </ul> 
	            					</td>
	            				</tr>
	            				<tr>
	            					<td>
							        	<input type="text" placeholder="期望职位，如：产品经理" value="" name="expectPosition" id="expectPosition">
									</td>
	            					<td>
	            						<input type="hidden" id="expectSalary" value="" name="expectSalary">
	            						<input type="button" value="期望月薪" id="select_expectSalary" class="profile_select_287 profile_select_normal">
	            						<div class="boxUpDown boxUpDown_287 dn" id="box_expectSalary" style="display: none;">
								          	 <ul>
							        			<li>2k以下</li>
							        			<li>2k-5k</li>
							        			<li>5k-10k</li>
							        			<li>10k-15k</li>
							        			<li>15k-25k</li>
							        			<li>25k-50k</li>
							        			<li>50k以上</li>
								        	</ul>
								        </div>  
	            					</td>
	            				</tr>
	            				<tr>
	            					<td colspan="2">
										<input type="submit" id="fo2" value="保 存" class="btn_profile_save">
						          		<a class="btn_profile_cancel" href="javascript:;">取 消</a>
	            					</td>
	            				</tr>
	            			</tbody></table>
            			</form><!--end #expectForm-->
            		</div><!--end .expectEdit-->
            		<div class="expectAdd pAdd <?php echo ($data['hope_in']); ?>">
            		    填写准确的期望工作能大大提高求职成功率哦…<br>
						快来添加期望工作吧！
						<span>添加期望工作</span>
            		</div><!--end .expectAdd-->
            		
            		<!--<input type="hidden" id="expectJobVal" value="">
            		<input type="hidden" id="expectCityVal" value="">
            		<input type="hidden" id="typeVal" value="">
            		<input type="hidden" id="expectPositionVal" value="">
            		<input type="hidden" id="expectSalaryVal" value="">-->
            	</div><!--end #expectJob-->
            		
            	<div class="profile_box" id="workExperience">
            		<h2>工作经历  <span> （投递简历时必填）</span></h2>
            		        <span class="c_add"></span>
            		<div class="experienceShow" <?php echo ($data['history_work_first']); ?> >
            		    <form class="experienceForm borderBtm dn" action="<?php echo U('Resume/history_ajax');?>" method="post" onsubmit="return $.sub(this)">
	            			<table>
	            				<tbody><tr>
							      	<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							        	<input type="text" placeholder="公司名称" name="companyName" class="companyName">
							      	</td>
							      	<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							          	<input type="text" placeholder="职位名称，如：产品经理" name="positionName" class="positionName">
							      	</td>
							    </tr>
	            				<tr>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
		            					<div class="fl">
		            						<input type="hidden" class="companyYearStart" value="" name="companyYearStart">
								        	<input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_companyYearStart">
											<div class="box_companyYearStart boxUpDown boxUpDown_139 dn" style="display: none;">
									            <ul>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
									        	</ul>
									        </div>
										</div>
										<div class="fl">
									        <input type="hidden" class="companyMonthStart" value="" name="companyMonthStart">
								        	<input type="button" value="开始月份" class="profile_select_139 profile_select_normal select_companyMonthStart">
											<div style="display: none;" class="box_companyMonthStart boxUpDown boxUpDown_139 dn">
									            <ul>
									        		<li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
									        	</ul>
									        </div>
									    </div>
									    <div class="clear"></div>
	            					</td>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
		            					<div class="fl">
		            						<input type="hidden" class="companyYearEnd" value="" name="companyYearEnd">
								        	<input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_companyYearEnd">
											<div class="box_companyYearEnd  boxUpDown boxUpDown_139 dn" style="display: none;">
									            <ul>
									            	<li>至今</li>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
									        	</ul>
									        </div>
										</div>
										<div class="fl">
									        <input type="hidden" class="companyMonthEnd" value="" name="companyMonthEnd">
								        	<input type="button" value="结束月份" class="profile_select_139 profile_select_normal select_companyMonthEnd">
											<div style="display: none;" class="box_companyMonthEnd boxUpDown boxUpDown_139 dn">
									            <ul>
									        		<li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
									        	</ul>
									        </div>
								        </div>
								        <div class="clear"></div>
	            					</td>
	            				</tr>
	            				<tr>
	            					<td></td>
	            					<td colspan="3">
										<input type="submit" value="保 存" class="btn_profile_save">
						          		<a class="btn_profile_cancel" href="javascript:;">取 消</a>
	            					</td>
	            				</tr>
	            			</tbody></table>
	            			<input type="hidden" name="history_id" class="expId" value="">
            			</form><!--end .experienceForm-->
            			
            			<ul class="wlist clearfix ">
	            			<?php if(is_array($data['history_value'])): foreach($data['history_value'] as $key=>$vo): ?><li data-id="<?php echo ($vo["id"]); ?>">
            					<a href="<?php echo U('Resume/delhistory_ajax',array('id'=> $vo['id']));?>"><i class="sm_del dn"></i></a>
            					<i class="sm_edit dn"></i>
            					<span class="c9" data-startyear="2013" data-endyear="至今" data-startmonth="03" data-endmonth="至今"><?php echo ($vo["begin_yeartime"]); ?>.<?php echo ($vo["begin_monthtime"]); ?>-<?php echo ($vo["end_yeartime"]); ?>.<?php echo ($vo["end_monthtime"]); ?></span>
            					<div>
            						<img src="/Public/HomeStyle/images/logo_default.png" alt="苹果" height="56" width="56">
            						<h3><?php echo ($vo["job"]); ?></h3>
            						<h4><?php echo ($vo["company"]); ?></h4>
            					</div>
	            			</li><?php endforeach; endif; ?> 
            			</ul>
            		</div><!--end .experienceShow-->
            		<div class="experienceEdit <?php echo ($data['history_work_second']); ?>">
            			<form class="experienceForm" action="<?php echo U('Resume/history_ajax');?>" method="post" onsubmit="return $.sub(this)">
	            			<table>
	            				<tbody><tr>
							      	<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							        	<input type="text" placeholder="公司名称" name="companyName" class="companyName">
							      	</td>
							      	<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							          	<input type="text" placeholder="职位名称，如：产品经理" name="positionName" class="positionName">
							      	</td>
							    </tr>
	            				<tr>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
		            					<div class="fl">
		            						<input type="hidden" class="companyYearStart" value="" name="companyYearStart">
								        	<input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_companyYearStart">
											<div class="box_companyYearStart boxUpDown boxUpDown_139 dn" style="display: none;">
									            <ul>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
									        	</ul>
									        </div>
										</div>
										<div class="fl">
									        <input type="hidden" class="companyMonthStart" value="" name="companyMonthStart">
								        	<input type="button" value="开始月份" class="profile_select_139 profile_select_normal select_companyMonthStart">
											<div style="display: none;" class="box_companyMonthStart boxUpDown boxUpDown_139 dn">
									            <ul>
									        		<li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
									        	</ul>
									        </div>
									    </div>
									    <div class="clear"></div>
	            					</td>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
		            					<div class="fl">
		            						<input type="hidden" class="companyYearEnd" value="" name="companyYearEnd">
								        	<input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_companyYearEnd">
											<div class="box_companyYearEnd  boxUpDown boxUpDown_139 dn" style="display: none;">
									            <ul>
									            	<li>至今</li>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
									        	</ul>
									        </div>
										</div>
										<div class="fl">
									        <input type="hidden" class="companyMonthEnd" value="" name="companyMonthEnd">
								        	<input type="button" value="结束月份" class="profile_select_139 profile_select_normal select_companyMonthEnd">
											<div style="display: none;" class="box_companyMonthEnd boxUpDown boxUpDown_139 dn">
									            <ul>
									        		<li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
									        	</ul>
									        </div>
								        </div>
								        <div class="clear"></div>
	            					</td>
	            				</tr>
	            				<tr>
	            					<td></td>
	            					<td colspan="3">
										<input type="submit" value="保 存" class="btn_profile_save">
						          		<a class="btn_profile_cancel" href="javascript:;">取 消</a>
	            					</td>
	            				</tr>
	            			</tbody></table>
	            			<input type="hidden" class="expId" value="">
            			</form><!--end .experienceForm-->
            		</div><!--end .experienceEdit-->
            		
            		<div class="experienceAdd pAdd <?php echo ($data['history_work_third']); ?>">工作经历最能体现自己的工作能力，<br>且完善后才可投递简历哦！<span>添加工作经历</span>
            		</div><!--end .experienceAdd-->
            	</div><!--end #workExperience-->

            	<div class="profile_box" id="projectExperience">
            		<h2>项目经验</h2>
            		    <span class="c_add <?php echo ($data['project_second']); ?>"></span>
            		<div class="projectShow">
            		    <ul class="plist clearfix">
							<?php if(is_array($data['project_value'])): foreach($data['project_value'] as $key=>$vo): ?><li data-id="<?php echo ($vo['id']); ?>">
	            					<div class="projectList">
		            					<a href="<?php echo U('Resume/delproject_ajax',array('id'=> $vo['id']));?>"><i class="sm_del dn"></i></a>
		            					<i class="sm_edit dn"></i>
		            					<div class="f16 mb10 fixed_width" data-proname="<?php echo ($vo["name"]); ?>" data-posname="<?php echo ($vo["job"]); ?>" data-starty="<?php echo ($vo["begin_yeartime"]); ?>" data-startm="<?php echo ($vo["begin_monthtime"]); ?>" data-endy="<?php echo ($vo["end_yeartime"]); ?>" data-endm="<?php echo ($vo["end_monthtime"]); ?>"><?php echo ($vo["name"]); ?>，<?php echo ($vo["job"]); ?>
		            					<span class="c9">（<?php echo ($vo["begin_yeartime"]); ?>.<?php echo ($vo["begin_monthtime"]); ?>-<?php echo ($vo["end_yeartime"]); ?>.<?php echo ($vo["end_monthtime"]); ?>）</span>
		            				</div>
		            				<div class="dl1">
	            						<?php echo ($vo["description"]); ?>
	            					</div>
	        				    </li><?php endforeach; endif; ?>        		    	
            		    </ul>
            		</div><!--end .projectShow-->
            		<div class="projectEdit dn">
            			<form class="projectForm" action="<?php echo U('Resume/project_ajax');?>" method="post" onsubmit="return $.sub(this)">
	            			<table>
	            				<tbody><tr>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							        	<input type="text" placeholder="项目名称" name="projectName" class="projectName">
							      	</td>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							          	<input type="text" placeholder="担任职务，如：产品负责人" name="thePost" class="thePost">
							      	</td>
							    </tr>
	            				<tr>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
		            					<div class="fl">
		            						<input type="hidden" class="projectYearStart" value="" name="projectYearStart">
								        	<input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_projectYearStart">
											<div class="box_projectYearStart  boxUpDown boxUpDown_139 dn" style="display: none;">
									            <ul>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
										        </ul>
									        </div>
										</div>
										<div class="fl">
									        <input type="hidden" class="projectMonthStart" value="" name="projectMonthStart">
								        	<input type="button" value="开始月份" class="profile_select_139 profile_select_normal select_projectMonthStart">
											<div style="display: none;" class="box_projectMonthStart boxUpDown boxUpDown_139 dn">
									            <ul>
									        		<li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
									        	</ul>
									        </div>
								        </div>
								        <div class="clear"></div>
	            					</td>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
	            						<div class="fl">
		            						<input type="hidden" class="projectYearEnd" value="" name="projectYearEnd">
								        	<input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_projectYearEnd">
											<div class="box_projectYearEnd  boxUpDown boxUpDown_139 dn" style="display: none;">
									            <ul>
									            	<li>至今</li>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
									        	</ul>
									        </div>
										</div>
										<div class="fl">
									        <input type="hidden" class="projectMonthEnd" value="" name="projectMonthEnd">
								        	<input type="button" value="结束月份" class="profile_select_139 profile_select_normal select_projectMonthEnd">
											<div style="display: none;" class="box_projectMonthEnd boxUpDown boxUpDown_139 dn">
									            <ul>
									        		<li>01</li><li>02</li><li>03</li><li>04</li><li>05</li><li>06</li><li>07</li><li>08</li><li>09</li><li>10</li><li>11</li><li>12</li>
									        	</ul>
									        </div>
								        </div>
								        <div class="clear"></div>
	            					</td>
	            				</tr>
	            				<tr>
	            					<td valign="top"></td> 
									<td colspan="3">
										<textarea class="projectDescription s_textarea" name="projectDescription" placeholder="项目描述"></textarea>
										<div class="word_count">你还可以输入 <span>500</span> 字</div>
									</td>
	            				</tr>
	            				<!-- <tr>
									<td colspan="2">
										<textarea placeholder="职责描述" name="ResponsDescription" class="ResponsDescription s_textarea"></textarea>
										<div class="word_count">你还可以输入 <span>500</span> 字</div>
									</td>
	            				</tr> -->
	            				<tr>
	            					<td valign="top"></td> 
	            					<td colspan="3">
										<input type="submit" value="保 存" class="btn_profile_save">
						          		<a class="btn_profile_cancel" href="javascript:;">取 消</a>
	            					</td>
	            				</tr>
	            			</tbody></table>
			            	<input type="hidden" value="" name="project_id" class="projectId">
            			</form><!--end .projectForm-->
            		</div><!--end .projectEdit-->
            		            		<div class="projectAdd pAdd <?php echo ($data['project_third']); ?>">项目经验是用人单位衡量人才能力的重要指标哦！<br>来说说让你难忘的项目吧！<span>添加项目经验</span>
            		</div><!--end .projectAdd-->
            	</div><!--end #projectExperience-->

            	<div class="profile_box" id="educationalBackground">
            		<h2>教育背景<span>（投递简历时必填）</span></h2>
            							<span class="c_add <?php echo ($data['eduction_third']); ?>"></span>
            		<div class="educationalShow <?php echo ($data['eduction_first']); ?>">
            		    <form class="educationalForm borderBtm dn" action="<?php echo U('Resume/edu_ajax');?>" method="post" onsubmit="return $.sub(this)">
	            			<table>
	            				<tbody><tr>
							      	<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							        	<input type="text" placeholder="学校名称" name="schoolName" class="schoolName">
							      	</td>
							      	<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							      		<input type="hidden" class="degree" value="" name="degree">
							        	<input type="button" value="学历" class="profile_select_287 profile_select_normal select_degree">
										<div class="box_degree boxUpDown boxUpDown_287 dn" style="display: none;">
								            <ul>
							        			<li>大专</li>
							        			<li>本科</li>
							        			<li>硕士</li>
							        			<li>博士</li>
							        			<li>其他</li>
								        	</ul>
								        </div>
							        </td>
							    </tr>
	            				<tr>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
	            						<input type="text" placeholder="专业名称" name="professionalName" class="professionalName">
	            					</td>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
		            					<div class="fl">
		            						<input type="hidden" class="schoolYearStart" value="" name="schoolYearStart">
								        	<input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_schoolYearStart">
											<div class="box_schoolYearStart boxUpDown boxUpDown_139 dn" style="display: none;">
									            <ul>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
									        	</ul>
									        </div>
										</div>
										<div class="fl">
		            						<input type="hidden" class="schoolYearEnd" value="" name="schoolYearEnd">
								        	<input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_schoolYearEnd">
											<div style="display: none;" class="box_schoolYearEnd  boxUpDown boxUpDown_139 dn">
									            <ul>
								        			<li>2021</li>
								        			<li>2020</li>
								        			<li>2019</li>
								        			<li>2018</li>
								        			<li>2017</li>
								        			<li>2016</li>
								        			<li>2015</li>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
									        	</ul>
									        </div>
	            						</div>
	            						<div class="clear"></div>
	            					</td>
	            				</tr>
	            				<tr>
	            					<td></td>
	            					<td colspan="3">
										<input type="submit" value="保 存" class="btn_profile_save">
						          		<a class="btn_profile_cancel" href="javascript:;">取 消</a>
	            					</td>
	            				</tr>
	            			</tbody></table>
	            			<input type="hidden" name="edu_id" class="eduId" >
            			</form><!--end .educationalForm-->

            			<ul class="elist clearfix">
                            <?php if(is_array($data['eduction_value'])): foreach($data['eduction_value'] as $key=>$vo): ?><li data-id="<?php echo ($vo["id"]); ?>">
	                            <a href="<?php echo U('Resume/deledu_ajax',array('id'=> $vo['id']));?>"><i class="sm_del dn"></i></a>
	                            <i class="sm_edit dn"></i>
	                            <span class="c9" data-starty="<?php echo ($vo["begin_time"]); ?>" data-endy="<?php echo ($vo["end_time"]); ?>"><?php echo ($vo["begin_time"]); ?>-<?php echo ($vo["end_time"]); ?></span>
	                            <div>
	                                <h3 data-schname="<?php echo ($vo["school"]); ?>"><?php echo ($vo["school"]); ?></h3>
	                                <h4 data-proname="<?php echo ($vo["professional"]); ?>" data-degree="<?php echo ($vo["eduction"]); ?>"><?php echo ($vo["education"]); ?>，<?php echo ($vo["professional"]); ?></h4>
	                            </div>
	                            </li><?php endforeach; endif; ?>                                  				
            			</ul>
            		</div><!--end .educationalShow-->
            		<div class="educationalEdit dn">
            			<form class="educationalForm" action="<?php echo U('Resume/edu_ajax');?>" method="post" onsubmit="return $.sub(this)">
	            			<table>
	            				<tbody><tr>
							      	<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							        	<input type="text" placeholder="学校名称" name="schoolName" class="schoolName">
							      	</td>
							      	<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
							      	<td>
							      		<input type="hidden" class="degree" value="" name="degree">
							        	<input type="button" value="学历" class="profile_select_287 profile_select_normal select_degree">
										<div class="box_degree boxUpDown boxUpDown_287 dn" style="display: none;">
								            <ul>
							        			<li>大专</li>
							        			<li>本科</li>
							        			<li>硕士</li>
							        			<li>博士</li>
							        			<li>其他</li>
								        	</ul>
								        </div>
							        </td>
							    </tr>
	            				<tr>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
	            						<input type="text" placeholder="专业名称" name="professionalName" class="professionalName">
	            					</td>
	            					<td valign="top">
							        	<span class="redstar">*</span>
							      	</td> 
	            					<td>
		            					<div class="fl">
		            						<input type="hidden" class="schoolYearStart" value="" name="schoolYearStart">
								        	<input type="button" value="开始年份" class="profile_select_139 profile_select_normal select_schoolYearStart">
											<div class="box_schoolYearStart boxUpDown boxUpDown_139 dn" style="display: none;">
									            <ul>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
									        	</ul>
									        </div>
										</div>
										<div class="fl">
		            						<input type="hidden" class="schoolYearEnd" value="" name="schoolYearEnd">
								        	<input type="button" value="结束年份" class="profile_select_139 profile_select_normal select_schoolYearEnd">
											<div class="box_schoolYearEnd  boxUpDown boxUpDown_139 dn" style="display: none;">
									            <ul>
								        			<li>2014</li>
								        			<li>2013</li>
								        			<li>2012</li>
								        			<li>2011</li>
								        			<li>2010</li>
								        			<li>2009</li>
								        			<li>2008</li>
								        			<li>2007</li>
								        			<li>2006</li>
								        			<li>2005</li>
								        			<li>2004</li>
								        			<li>2003</li>
								        			<li>2002</li>
								        			<li>2001</li>
								        			<li>2000</li>
								        			<li>1999</li>
								        			<li>1998</li>
								        			<li>1997</li>
								        			<li>1996</li>
								        			<li>1995</li>
								        			<li>1994</li>
								        			<li>1993</li>
								        			<li>1992</li>
								        			<li>1991</li>
								        			<li>1990</li>
								        			<li>1989</li>
								        			<li>1988</li>
								        			<li>1987</li>
								        			<li>1986</li>
								        			<li>1985</li>
								        			<li>1984</li>
								        			<li>1983</li>
								        			<li>1982</li>
								        			<li>1981</li>
								        			<li>1980</li>
								        			<li>1979</li>
								        			<li>1978</li>
								        			<li>1977</li>
								        			<li>1976</li>
								        			<li>1975</li>
								        			<li>1974</li>
								        			<li>1973</li>
								        			<li>1972</li>
								        			<li>1971</li>
								        			<li>1970</li>
									        	</ul>
									        </div>
	            						</div>
	            						<div class="clear"></div>
	            					</td>
	            				</tr>
	            				<tr>
	            					<td></td>
	            					<td colspan="3">
										<input type="submit" value="保 存" class="btn_profile_save">
										<script type="text/javascript">
										 $(function(){
								          		$('input[type=submit]').removeAttr('disabled');
								          })
										 </script>
						          		<a class="btn_profile_cancel" href="javascript:;">取 消</a>
	            					</td>
	            				</tr>
	            			</tbody></table>
	            			<input type="hidden" class="eduId" value="">
            			</form><!--end .educationalForm-->
            		</div><!--end .educationalEdit-->
            		<div class="educationalAdd pAdd <?php echo ($data['eduction_second']); ?>">教育背景可以充分体现你的学习和专业能力，<br>且完善后才可投递简历哦！<span>添加教育经历</span>
            		</div><!--end .educationalAdd-->
            	</div><!--end #educationalBackground-->

            	<div class="profile_box" id="selfDescription">
            		<h2>自我描述</h2>
            		    <span class="c_edit <?php echo ($data['introduction_third']); ?>"></span>
            		<div class="descriptionShow <?php echo ($data['introduction_first']); ?>">
            		          <?php echo ($data['introduction_value']); ?>  			
            		</div><!--end .descriptionShow-->
            		<div class="descriptionEdit dn">
            			<form class="descriptionForm" action="<?php echo U('Resume/introduce_ajax');?>" method="post" onsubmit="return $.sub(this)">
	            			<table>
	            				<tbody><tr>
									<td colspan="2">
										<textarea class="selfDescription s_textarea" name="selfDescription" placeholder=""></textarea>
										<div class="word_count">你还可以输入 <span>500</span> 字</div>
									</td>
	            				</tr>
	            				<tr>
	            					<td colspan="2">
										<input type="submit" value="保 存"  class="btn_profile_save">
						          		<a class="btn_profile_cancel" href="javascript:;">取 消</a>
	            					</td>
	            				</tr>
	            			</tbody></table>
            			</form><!--end .descriptionForm-->
            		</div><!--end .descriptionEdit-->
            		<div class="descriptionAdd pAdd <?php echo ($data['introduction_second']); ?>">描述你的性格、爱好以及吸引人的经历等，<br>让企业了解多元化的你！
						<span>添加自我描述</span>
            		</div><!--end .descriptionAdd-->
            	</div><!--end #selfDescription-->

            	<div class="profile_box" id="worksShow">
            		<h2>作品展示</h2>
            		    <span class="c_add <?php echo ($data['show_works_third']); ?>"></span>
            		<div class="workShow $data['show_works_second']">
            		    <ul class="slist clearfix">
                            <?php if(is_array($data['show_works_value'])): foreach($data['show_works_value'] as $key=>$vo): ?><li data-id="<?php echo ($vo["id"]); ?>">
                                <div class="workList c7">
                                    <a href="<?php echo U('Resume/delshow_ajax',array('id'=> $vo['id']));?>"><i class="sm_del dn"></i></a>
                                    <i class="sm_edit dn"></i>
                                    <div class="f16">
                                    <span>网址：</span>
                                        <a href="<?php echo ($vo["link"]); ?>" target="_blank"><?php echo ($vo["link"]); ?></a>
                                    </div>
                                    <p><?php echo ($vo["description"]); ?></p>
                                </div>
                            </li><?php endforeach; endif; ?>          		    	
            		    </ul>
            		</div><!--end .workShow-->
            		<div class="workEdit dn">
            			<form class="workForm" action="<?php echo U('Resume/show_ajax');?>" method="post" onsubmit="return $.sub(this)">
	            			<table>
	            				<tbody><tr>
							      	<td>
							        	<input type="text" placeholder="请输入作品链接" name="workLink" class="workLink">
							      	</td>
							    </tr>
	            				<tr>
									<td>
										<textarea maxlength="100" class="workDescription s_textarea" name="workDescription" placeholder="请输入说明文字"></textarea>
										<div class="word_count">你还可以输入 <span>100</span> 字</div>
									</td>
	            				</tr>
	            				<tr>
	            					<td>
										<input type="submit" value="保 存" class="btn_profile_save">
						          		<a class="btn_profile_cancel" href="javascript:;">取 消</a>
	            					</td>
	            				</tr>
	            			</tbody></table>
	            			<input type="hidden" name="show_id" class="showId" value="">
            			</form><!--end .workForm-->
            		</div><!--end .workEdit-->
            		<div class="workAdd pAdd <?php echo ($data['show_works_first']); ?>">好作品会说话！<br>快来秀出你的作品打动企业吧！
						<span>添加作品展示</span>
            		</div><!--end .workAdd-->
            	</div><!--end #worksShow-->
				<input type="hidden" id="resumeId" value="268472">
            </div><!--end .content_l-->
            <div class="content_r">
            	<div class="mycenterR" id="myInfo">
            		<h2>我的信息</h2>
            		<a target="_blank" href="collections.html">我收藏的职位</a><br>
            		<a target="_blank" href="subscribe.html">我订阅的职位</a>
            	</div><!--end #myInfo-->

				<div class="mycenterR" id="myResume">
            		<h2>我的附件简历 <a title="上传附件简历" href="#uploadFile" class="inline cboxElement">上传简历</a></h2>
            		<div class="resumeUploadDiv">暂无附件简历</div>
            	</div><!--end #myResume-->

            	<div class="mycenterR" id="resumeSet">
            		<h2>投递简历设置  <span>修改设置</span></h2>
            		<!-- -1 (0=附件， 1=在线， 其他=未设置) -->
            		    <div class="noSet set0 dn">默认使用<span>附件简历</span>进行投递</div>
            			<div class="noSet set1 dn">默认使用<span>在线简历</span>进行投递</div>
						<div class="noSet">暂未设置默认投递简历</div>
            		    <input type="hidden" class="defaultResume" value="-1">
            		<form class="dn" id="resumeSetForm">
	            		<label><input type="radio" value="1" class="resume1" name="resume">默认使用<span>在线简历</span>进行投递</label>
	            		<label><input type="radio" value="0" class="resume0" name="resume">默认使用<span>附件简历</span>进行投递</label>
	            		<span class="setTip error"></span>
	            		<div class="resumeTip">设置后投递简历时将不再提醒</div>
	            		<input type="submit" value="保 存" class="btn_profile_save">
						<a class="btn_profile_cancel" href="javascript:;">取 消</a>
	            	</form>
            	</div><!--end #resumeSet-->
				
				<div class="mycenterR" id="myShare">
            		<h2>当前每日投递量：10个</h2>
            		<a target="_blank" href="h/share/invite.html">邀请好友，提升投递量</a>
            	</div><!--end #myShare-->
            	
								
				<div class="greybg qrcode mt20">
                	<img width="242" height="242" alt="拉勾微信公众号二维码" src="/Public/HomeStyle/images/qr_resume.png">
                    <span class="c7">微信扫一扫，轻松找工作</span>
                </div>
            </div><!--end .content_r-->
        </div>
        
      <input type="hidden" id="userid" name="userid" value="314873">

<!-------------------------------------弹窗lightbox ----------------------------------------->
<div style="display:none;">
	<!-- 上传简历 -->
	<div class="popup" id="uploadFile">
	    <table width="100%">
	    	<tbody><tr>
	        	<td align="center">
	                <form>
	                    <a class="btn_addPic" href="javascript:void(0);">
	                    	<span>选择上传文件</span>
	                        <input type="file" onchange="file_check(this,'h/nearBy/updateMyResume.json','resumeUpload')" class="filePrew" id="resumeUpload" name="newResume" size="3" title="支持word、pdf、ppt、txt、wps格式文件，大小不超过10M" tabindex="3">
	                    </a>
	                </form>
	            </td>
	        </tr>
	    	<tr>
	        	<td align="left">支持word、pdf、ppt、txt、wps格式文件<br>文件大小需小于10M</td>
	        </tr>
	        <tr>
	        	<td align="left" style="color:#dd4a38; padding-top:10px;">注：若从其它网站下载的word简历，请将文件另存为.docx格式后上传</td>
	        </tr>
	    	<tr>
	        	<td align="center"><img width="55" height="16" alt="loading" style="visibility: hidden;" id="loadingImg" src="/Public/HomeStyle/images/loading.gif"></td>
	        </tr>
	    </tbody></table>
	</div><!--/#uploadFile-->
	
	<!-- 简历上传成功 -->
	<div class="popup" id="uploadFileSuccess">
     	<h4>简历上传成功！</h4>
         <table width="100%">
             <tbody><tr>
                 <td align="center"><p>你可以将简历投给你中意的公司了。</p></td>
             </tr>
         	<tr>
             	<td align="center"><a class="btn_s" href="javascript:;">确&nbsp;定</a></td>
             </tr>
         </tbody></table>
     </div><!--/#uploadFileSuccess-->
     
	<!-- 没有简历请上传 -->
    <div class="popup" id="deliverResumesNo">
        <table width="100%">
            <tbody><tr>
                <td align="center"><p class="font_16">你在拉勾还没有简历，请先上传一份</p></td>
            </tr>
        	<tr>
            	<td align="center">
                    <form>
                        <a class="btn_addPic" href="javascript:void(0);">
                        	<span>选择上传文件</span>
                        	<input type="file" onchange="file_check(this,'h/nearBy/updateMyResume.json','resumeUpload1')" class="filePrew" id="resumeUpload1" name="newResume" size="3" title="支持word、pdf、ppt、txt、wps格式文件，大小不超过10M">
                        </a>
                    </form>
                </td>
            </tr>
        	<tr>
            	<td align="center">支持word、pdf、ppt、txt、wps格式文件，大小不超过10M</td>
            </tr>
        </tbody></table>
    </div><!--/#deliverResumesNo-->
    
    <!-- 上传附件简历操作说明-重新上传 -->
    <div class="popup" id="fileResumeUpload">
        <table width="100%">
            <tbody><tr>
                <td>
                	<div class="f18 mb10">请上传标准格式的word简历</div>
                </td>
            </tr>
            <tr>
                <td>
                	<div class="f16">
                		操作说明：<br>
                		打开需要上传的文件 - 点击文件另存为 - 选择.docx - 保存
                	</div>
                </td>
            </tr>
        	<tr>
            	<td align="center">
            		<a title="上传附件简历" href="#uploadFile" class="inline btn cboxElement">重新上传</a>
            	</td>
            </tr>
        </tbody></table>
    </div><!--/#fileResumeUpload-->
    
    <!-- 上传附件简历操作说明-重新上传 -->
    <div class="popup" id="fileResumeUploadSize">
        <table width="100%">
            <tbody><tr>
                <td>
                	<div class="f18 mb10">上传文件大小超出限制</div>
                </td>
            </tr>
            <tr>
                <td>
                	<div class="f16">
                		提示：<br>
                		单个附件不能超过10M，请重新选择附件简历！
                	</div>
                </td>
            </tr>
        	<tr>
            	<td align="center">
            		<a title="上传附件简历" href="#uploadFile" class="inline btn cboxElement">重新上传</a>
            	</td>
            </tr>
        </tbody></table>
    </div><!--/#deliverResumeConfirm-->
    
</div>
<!------------------------------------- end ----------------------------------------->  

<script src="/Public/HomeStyle/js/Chart.min.js" type="text/javascript"></script>
<script src="/Public/HomeStyle/js/profile.min.js" type="text/javascript"></script>
<!-- <div id="profileOverlay"></div> -->
<div class="" id="qr_cloud_resume" style="display: none;">
	<div class="cloud">
		<img width="134" height="134" src="">
		<a class="close" href="javascript:;"></a>
	</div>
</div>
			<div class="clear"></div>
			<input type="hidden" value="97fd449bcb294153a671f8fe6f4ba655" id="resubmitToken">
	    	<a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
	    </div><!-- end #container -->
	</div><!-- end #body -->
	<div id="footer">
		<div class="wrapper">
			<a rel="nofollow" target="_blank" href="h/about.html">联系我们</a>
		    <a target="_blank" href="h/af/zhaopin.html">互联网公司导航</a>
		    <a rel="nofollow" target="_blank" href="http://e.weibo.com/lagou720">拉勾微博</a>
		    <a rel="nofollow" href="javascript:void(0)" class="footer_qr">拉勾微信<i></i></a>
			<div class="copyright">&copy;2013-2014 Lagou <a href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action" target="_blank">京ICP备14023790号-2</a></div>
		</div>
	</div>
<!--  -->
</body>
<script>
	//单选框按钮变色
	$('#fo2_1').find('li').click(function(){
		var fo2_res=$(this).html();
		$('input[name=type]').val(fo2_res);				
		$('#fo2_1').children('li').removeClass('current');
		$(this).addClass('current');
	});
	//AJAX提交表单
	jQuery(function($){
		//表单验证
        $.extend({
            sub : function(obj) {
                var obj = $(obj);
                $.ajax({
                    url : obj.attr('action'),
                    type : 'post',
                    data : obj.serialize(),
                    success : function(data) {
                    	if(data == 1){
                    		location.reload();
                    	}else{
                    		alert('输入错误,重新填写');
                    	}
                    }
                })
                return false;
            }
        });

	});
	//图片上传
    function uploadFile() {
         $.ajaxFileUpload({
            url : '<?php echo U('Home/Resume/upload');?>',
            secureuri: false,
            fileElementId: 'headPic',
            dataType: 'json',
            success: function (data)  //服务器成功响应处理函数
            {
                if (data.code > 0) {
                    $('#portrait').removeClass('dn');
                    data.msg = data.msg + '?' + parseInt(Math.random()*1000);
                    $('#portrait').children('img').attr('src', data.msg);
                } else {
                    alert(data.msg);
                }            	
            },
        })
    }
</script>
</html>