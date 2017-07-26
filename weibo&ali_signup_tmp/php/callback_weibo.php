<?php
$indexurl = "/summer_item/html/index.php";
$registerurl = "/summer_item/html/register.php";
session_start();
include("conn_mysql.php");
$conn = new DBPDO;
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
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }>
</script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="../js/move-top.js"></script>
<script type="text/javascript" src="../js/easing.js"></script>
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
				<a href="index.html"> <img src="../image/title.png" alt=""/> </a>
			</div>
			<span class="menu"> <img src="../image/icon.png" alt=""/></span>
			<div class="clear"> </div>
			<div class="navg">
				<ul class="res">
          <li><a href="index.php">主页</a></li>
          <li><a class="active" href="../html/login.php">登录</a></li>
          <li><a href="../html/register.php">注册</a></li>
          <li><a href="../html/uploadFile.php">上传文件</a></li>
          <li><a href="../html/downloadFile.php">下载文件</a></li>
          <li><a href="../html/decryptedFile.php">文件解密</a></li>
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




<?php


include_once( '../weibo_sdk/config.php' );
include_once( '../weibo_sdk/saetv2.ex.class.php' );
$grant_flag = 0;

//$signupap = $_POST['signap'] ;


$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
	}
}

if ($token) {
	$_SESSION['token'] = $token;
	setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
	$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
	$uid_get = $c->get_uid();
	$weibo_id = $uid_get['uid'];
}else {
		echo "授权失败!";
		exit();
}



$id_type = 'weiboid';
$uid = $weibo_id;

$mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
if($mysqli->connect_errno)
{
	 echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
	 exit();
}
$sql = "select * from Users where ".$id_type." = \"".$uid."\";";
$result = $mysqli->query($sql);
	// 判断当前用户是否已经授权注册过
if($result != false)
{
	if($result->num_rows == 0)
	{
?>

<div class="banner">
	<div class="container">
		<div class="banner-main">

<p>您好，尚未注册过的新用户，请设置您的用户名</p><br></br>
<form -orm action="setusername.php" method="post">
		<input type="text" name="username" class="text" >
    <input name="uid" value=<?php echo $uid; ?> type="hidden" class="text" >
    <input name="grant_type" value=<?php echo $id_type; ?> type="hidden" class="text">
		<!--<input name="uid" value='12344' type="hidden" class="text" >-->
		<input type="submit" value="入口" >
<?php
}else{
		$result = $result->fetch_assoc();
		$_SESSION['username'] = $result["username"];
	 	header("Location: ../html/index.php");
}
}else{
		$message=$mysqli->error;
}
?>

</form>
<p>放弃注册...<a  href="../html/index.php">跳转到首页</a></p>
<p><?=$message?></p>

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
					<li><a class="active" href="../html/index.php">HOME</a></li>
					<li><a href="../html/login.php">Log In</a></li>
					<li><a href="../html/register.php">Register</a></li>
					<li><a href="../html/uploadFile.php">Upload File</a></li>
					<li><a href="../html/downloadFile.php">Download File</a></li>
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
