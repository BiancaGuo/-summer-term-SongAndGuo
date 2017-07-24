<?php
$indexurl = "../html/index.php";
$registerurl = "../html/register.php";
session_start();

 ?>

<!DOCTYPE html>
<html>
<head>
<title>EnjoyCryptology.com</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--web-fonts-->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
<!--js-->
<script src="../js/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }>
</script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="../js/move-top.js"></script>
<script type="text/javascript" src="../js/easing.js"></script>
<script type=text/javascript src=../js/register.js></script>
<link href="../css/register.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

function tabclick(){
	//先将所有选项卡的样式恢复为默认，再给被点击的选项卡添加选中样式
	var tab=document.getElementById("tab").getElementsByTagName("dt");
	var form=document.getElementById("div_tab").getElementsByTagName("form");
	for(i=0;i<tab.length;i++){
			tab[i].className='';
			form[i].className='';
			if(tab[i]==this){
					tab[i].className='tab';
					form[i].className='form_tab';
			}
	}
}
//如果被点击，就执行tabclick函数
function changetab(){
	var tab = document.getElementById("tab").getElementsByTagName("dt");
	for(i=0;i<=tab.length;i++){
			tab[i].onclick=tabclick;
	}
}

window.onload=function(){
	changetab();
}



</script>
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
</script>
<!-- //end-smoth-scrolling -->
</head>

<body>
<!--header start here-->
<div class="mothergrid">
	<div class="container">
		<div class="header">
			<div class="logo">
				<a href="index.php"> <img src="../image/title.png" alt=""/> </a>
			</div>
			<span class="menu"> <img src="../image/icon.png" alt=""/></span>
			<div class="clear"> </div>
			<div class="navg">
				<ul class="res">
					<li><a href="index.php">主页</a></li>
					<li><a href="../html/login.php">登录</a></li>
					<li><a class="active" href="../html/register.php">注册</a></li>
					<li><a href="../html/uploadFile.php">上传文件</a></li>
					<li><a href="../html/downloadFile.php">下载文件</a></li>
					<li><a href="">文件解密</a></li>
				</ul>
				 <script>
			    $( "span.menu").click(function() {
			           $(  "ul.res" ).slideToggle("slow", function() {
			            // Animation complete.
			             });
			  });
		      </script>
			</div>
		<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--heder end here-->

<!--get touch start here-->
<div class="get">
	<div class="container">
		<div class="get-main">
			  <h3>注  册</h3>
			  <div class="col-md-6 get-left">
					 <div class="register">
					     <div id="page">
					         <dl id="tab">
					             <dt id="tab_phone">手机注册</dt>
					             <dt id="tab_mail">邮箱注册</dt>
					         </dl>
					         <div id="div_tab">
					 						<!-- 手机注册 -->
					             <form method="post" action="../php/register.php" name="send_phone" onSubmit="return Check1()">
					                   <div class="username">
					                     <p>用户名<p>
															 <input type="text" name="username" class="text"  onfocus="this.value = '';" onblur="if (this.value == '') " >
					                   </div>
					                   <div class="password">
					                     <p>密 码</p>
															 <input type="password" name="password" id="pass" >
					 										<div id="level" class="pw-strength" style="margin-bottom:20px;">
					     									<div class="pw-bar"></div>
					     									<div class="pw-bar-on"></div>
					     									<div class="pw-txt">
					         								<span>弱</span>
					         								<span>中</span>
					         								<span>强</span>
					     								  </div>
					 									  </div>
					 								   </div>
                             <div class="repassword">
					                     <p>确认密码</p>
															 <input type="password" name="repassword" id="repass" >
					 								   </div>

					                   <div calss="phonenumber">
					                     <p>手机号码<p>
															 <input type="text" name="phonenumber" onfocus="this.value = '';" onblur="if (this.value == '') ">
					                   </div>
					                   <div class="signin">
					                  		<input type="reset" value="重置">
					                  		<input type="submit" value="提交" >
					                  	</div>
					             </form>

					 						<!-- 邮箱注册 -->
					             <form method="post" action="../php/register.php" name="send_Email" onSubmit="return Check2()">
					                 <div class="username">
					                   <p>用户名</p>
														 <input type="text" name="username" class="text"  onfocus="this.value = '';" onblur="if (this.value == '') " >
					                 </div>
					 								<div class="password">
					 									<p>密 码</p>
														<input type="password" name="password" id="pass2" >
					 									<div id="level2" class="pw-strength" style="margin-bottom:20px;">
					 										<div class="pw-bar"></div>
					 										<div class="pw-bar-on"></div>
					 										<div class="pw-txt">
					 											<span>弱</span>
					 											<span>中</span>
					 											<span>强</span>
					 									  </div>
					 								  </div>
					 							  </div>
                          <div class="repassword">
                            <p>确认密码</p>
                            <input type="password" name="repassword" id="repass" >
                          </div>
					                 <div calss="Email">
					                   <p>邮箱</p>
														 <input type="text" name="Email" onfocus="this.value = '';" onblur="if (this.value == '') ">
					                 </div>
					                 <div class="signin">
					                   <input type="reset" value="重置">
					                   <input type="submit" value="提交" >
					                 </div>
					             </form>

					            </div>

					    </div>
					 </div>

			  </div>

        <div class="col-md-6 get-right">
         <h3>微博登录</h3>
         <p><a href="https://api.weibo.com/oauth2/authorize?client_id=294279255&redirect_uri=http://www.enjoycryptology.com/summer_item/php/callback_weibo.php&response_type=code"><img src="../image/weibo_login.png" title="点击进入授权页面" alt="点击进入授权页面" border="0" style="width:280px;height:150px;"/></a></p>
         <h3>支付宝登录</h3>
         <p><a href="https://openauth.alipay.com/oauth2/publicAppAuthorize.htm?app_id=2017072007819781&scope=auth_user&redirect_uri=http://www.enjoycryptology.com/summer_item/php/callback_alipay.php&state=init"><img src="../image/alipay_login.png" title="点击进入授权页面" alt="点击进入授权页面" border="0" style="width:280px;height:150px;"/></a></p>
       </div>
     <div class="clearfix"> </div>
		 	<div class="clearfix"> </div>
		</div>
	</div>
</div>

<!--get touch end here-->
<!--footer start here-->
<div class="footer">
	<div class="container">
		<div class="footer-main">
			<div class="footer-navg">
				<ul>
					<li><a class="active" href="index.php">HOME</a></li>
					<li><a href="login.php">Log In</a></li>
					<li><a href="register.php">Register</a></li>
					<li><a href="uploadFile.php">Upload File</a></li>
					<li><a href="downloadFile.php">Download File</a></li>
					<li><a href="">File Decryption</a></li>
					<li><a href="https://github.com/BiancaGuo/-summer-term-SongAndGuo">Contact Us</a></li>
				</ul>
			</div>
			<div class="footer-top">
				<div class="col-md-4 footer-right">
					<h3>Contact us</h3>
					<p>Address : the Conmunication University Of China Beijing</p>

				</div>
			<div class="clearfix"> </div>
			</div>
			<div class="footer-bottom">
				<p>2017 &copy Template by Bianca&Sonya </p>
			</div>
		<div class="clearfix"> </div>
			<script type="text/javascript">
										$(document).ready(function() {
											/*
											var defaults = {
									  			containerID: 'toTop', // fading element id
												containerHoverID: 'toTopHover', // fading element hover id
												scrollSpeed: 1200,
												easingType: 'linear'
									 		};
											*/

											$().UItoTop({ easingType: 'easeOutQuart' });

										});
									</script>
						<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
		</div>
	</div>
</div>
<!--/footer end here-->
</body>
</html>
