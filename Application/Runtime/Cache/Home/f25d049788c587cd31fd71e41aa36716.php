<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>简历预览-我的简历-拉勾网-最专业的互联网招聘平台</title>
<meta name="baidu-site-verification" content="QIQ6KC1oZ6">
<link rel="stylesheet" type="text/css" href="/Public/HomeStyle/css/style.css">
</head>

<body>
  	<div id="previewWrapper">
        <div class="preview_header">
            <h1 title="<?php echo ($data['name']); ?>的简历"><?php echo ($data['name']); ?>的简历</h1>
            <a href="#downloadOnlineResume" class="inline cboxElement" title="下载简历">下载该简历</a>
        </div><!--end .preview_header-->

        <div class="preview_content">
            <div id="basicInfo" class="profile_box <?php echo ($data['first']); ?>">
                <h2>基本信息</h2>
                <div class="basicShow">
                   <span>
                   		<?php echo ($data['name']); ?> |<?php echo ($data['sex']); ?> |<?php echo ($data['education']); ?> |<?php echo ($data['work_year']); ?><br><?php echo ($data['phone']); ?> | <?php echo ($data['email']); ?><br><?php echo ($data['now_state']); ?>
            	   </span>
           			<div class="m_portrait">
                    	<div></div>
                    	<img src="/Uploads/User/image/<?php echo ($data['image']); ?>" alt="<?php echo ($data['name']); ?>" height="120" width="120">
                    </div>
                </div><!--end .basicShow-->
            </div><!--end #basicInfo-->
			
			<div id="expectJob" class="profile_box <?php echo ($data['second']); ?>">
                <h2>期望工作</h2>
                <div class="expectShow">
                	<?php echo ($data['hope_city']); ?>，<?php echo ($data['hope_job']); ?>，月薪<?php echo ($data['hope_salary']); ?>
                </div><!--end .expectShow-->
	        </div><!--end #expectJob-->
						
			<div id="workExperience" class="profile_box <?php echo ($data['third']); ?>">
                <h2>工作经历</h2>
                <div class="experienceShow">
                    <ul class="wlist clearfix">
           				<?php if(is_array($data['work_history_value'])): foreach($data['work_history_value'] as $key=>$vo): ?><li class="clear">
        					<span class="c9"><?php echo ($vo["begin_yeartime"]); ?>.<?php echo ($vo["begin_monthtime"]); ?>-<?php echo ($vo["end_yeartime"]); ?>.<?php echo ($vo["end_monthtime"]); ?></span>
           					<div>
           						<img src="/Public/HomeStyle/images/logo_default.png" alt="xiaomi1" height="56" width="56">
           						<h3><?php echo ($vo["job"]); ?></h3>
           						<h4><?php echo ($vo["company"]); ?></h4>
           					</div>
           				</li><?php endforeach; endif; ?>
           			</ul>
                </div><!--end .experienceShow-->
	        </div><!--end #workExperience-->
			
			<div id="projectExperience" class="profile_box <?php echo ($data['fouth']); ?>">
                <h2>项目经验</h2>
                <div class="projectShow">
                    <ul class="plist clearfix">
        				<?php if(is_array($data['res_project_value'])): foreach($data['res_project_value'] as $key=>$vo): ?><li class="noborder">
	        					<div class="projectList">
	            					<div class="f16 mb10"><?php echo ($vo["name"]); ?>，<?php echo ($vo["job"]); ?>
	            						<span class="c9">（<?php echo ($vo["begin_yeartime"]); ?>.<?php echo ($vo["begin_monthtime"]); ?>-<?php echo ($vo["end_yeartime"]); ?>.<?php echo ($vo["end_monthtime"]); ?>）</span>
	            					}
	            					</div>
	            					<div class="dl1">
	            						<?php echo ($vo["description"]); ?>
	            					</div>
	            				</div>
	        				</li><?php endforeach; endif; ?>
            		</ul>
                </div><!--end .projectShow-->
	        </div><!--end #projectExperience-->
						
			<div id="educationalBackground" class="profile_box <?php echo ($data['five']); ?>">
	            <h2>教育背景</h2>
	                <div class="educationalShow">
	                    <ul class="elist clearfix">
            				<?php if(is_array($data['res_education_value'])): foreach($data['res_education_value'] as $key=>$vo): ?><li class="clear">
            				    <span class="c9"><?php echo ($vo["begin_time"]); ?>-<?php echo ($vo["end_time"]); ?></span>
            					<div>
            						<h3><?php echo ($vo["school"]); ?></h3>
            						<h4><?php echo ($vo["professional"]); ?>，<?php echo ($vo["education"]); ?></h4>
            					</div>
            				</li><?php endforeach; endif; ?>
            			</ul>
	                </div><!--end .educationalShow-->
	            </div><!--end #educationalBackground-->
				<div id="worksShow" class="profile_box <?php echo ($data['sixty']); ?>">
	                <h2>作品展示</h2>
	                <div class="workShow">
	                    <ul class="slist clearfix">
            				<?php if(is_array($data['res_show_works_value'])): foreach($data['res_show_works_value'] as $key=>$vo): ?><li class="noborder">
	            				    <div class="workList c7">
		            					<div class="f16">
		            						网址：<a href="http://<?php echo ($vo["link"]); ?>/" target="_blank"><?php echo ($vo["link"]); ?></a>
		            					</div>
		            					<p><?php echo ($vo["description"]); ?></p>
		            				</div>
	            				</li><?php endforeach; endif; ?>
            			</ul>
	                </div><!--end .workShow-->
	            </div><!--end #worksShow-->
			        </div><!--end .preview_content-->
  	</div><!--end #previewWrapper-->

<!-------------------------------------弹窗lightbox ----------------------------------------->
<div style="display:none;">
	<!-- 下载简历 -->
	<div id="downloadOnlineResume" class="popup">
         <table width="100%">
             <tbody><tr>
                 <td class="c5 f18">请选择下载简历格式：</td>
             </tr>
         	<tr>
             	<td>
             		<a href="http://www.lagou.com/resume/downloadResume?key=f8c9cb931414c41a2f5c461f170d980a&amp;type=1" class="btn_s">word格式</a>
             		<a href="http://www.lagou.com/resume/downloadResume?key=f8c9cb931414c41a2f5c461f170d980a&amp;type=2" class="btn_s">html格式</a>
             		<a href="http://www.lagou.com/resume/downloadResume?key=f8c9cb931414c41a2f5c461f170d980a&amp;type=3" class="btn_s">pdf格式</a>
             	</td>
             </tr>
         </tbody></table>
    </div><!--/#downloadOnlineResume-->   
</div>
</body>
</html>