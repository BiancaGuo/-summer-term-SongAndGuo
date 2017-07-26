<?php
$indexurl = "http://www.enjoycryptology.com/summer_item/html/index.php";
$register_php = "register.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>EnjoyCryptology.com</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<script src="../js/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script> -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }>
</script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="../js/move-top.js"></script>
<script type="text/javascript" src="../js/easing.js"></script>
<script src="../js/md5.js"></script>
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
</script>

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
					<?php

					if ($_SESSION['username'] == null){
						$label = "登录";
						$url = "login.php";
					}
					else {
						$label = $_SESSION['username'];
						$url = "yourprofile.php";
					}

					?>
					<li><a href=<?=$url?>> <?=$label?> </a></li>
					<?php

					if ($_SESSION['username'] == null){
						$label_t = "注册";
						$url_t = "register.php";
					}
					else {
						$label_t = "登出";
						$url_t = "../php/logout.php";
					}
					?>
					<li><a href=<?=$url_t?>><?=$label_t?></a></li>
					<li><a href="../html/uploadFile.php">上传文件</a></li>
					<li><a href="../html/downloadFile.php">下载文件</a></li>
					<li><a class="active"  href="../html/decryptedFile.php">文件解密</a></li>
					<li><a href="../html/verifysign.php">签名验证</a></li>
					<li><a href="../html/verifyhash.php">完整性校验</a></li>
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
<!--banner start here-->
<div class="banner">
	<div class="container">
		<div class="banner-main">

 <!--Upload File  -->
  <form name="postForm" action="../php/decryptfile.php" method="post" enctype="multipart/form-data" >
		 <div >
        <input name="myFile" id="myFile" type="file" style='margin:auto;' value=""/>
        <br></br>
				<h4>解密密钥</h4> <input type="text" name="filekey" value="分享链接时的解密密码" class="text" />
        <br></br><input name="subBtn" id="subBtn" type="submit"  value="点击解密"/>
		</div>
  </form>

		</div>
	</div>
</div>

<!--banner end here-->
<!--below banner start here-->


<!--/news end here-->
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
					<li><a href="../html/decryptfile.php">File Decryption</a></li>
					<li><a href="../html/verifysign.php">Verify Sign</a></li>
					<li><a href="../html/verifyhash.php">Verify Hash</a></li>
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
