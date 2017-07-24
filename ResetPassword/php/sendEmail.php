<?php

  $username = $_POST["username"];
  $Email=stripslashes(trim($_POST["email"]));
  $Email = injectChk($Email);



  $Email_address_host=getenv('EMAIL_ADDRESS');
  $Email_psw_host=getenv('EMAIL_PSW');

  //include_once("connect.php");//连接数据库
  $mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
  if($mysqli->connect_errno)
  {
    echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
    exit();
  }



  $sql = "select * from Users where username = \"".$username."\" and Email = \"".$Email."\";";
  $result = $mysqli->query($sql);
  $result2 = $result->fetch_assoc();

  if($result2 == false)
  {
    echo "<script>alert('该用户尚未注册...');location='../html/lostPsw.html';</script>";
    exit();
  }



  $getpasstime = time();

  $token = md5($result2['username'].$result2['password']);

  //后期修改为https
  $url = "http://www.enjoycryptology.com/summer_item/php/reset.php?email=".$Email."&token=".$token;
  // echo $url;
  $time = date('Y-m-d H:i');
  $ret = sendmail($time,$Email,$url,$Email_address_host,$Email_psw_host);

  if($ret!="")
  {//邮件发送成功
        // echo '系统已向您的邮箱发送了一封邮件<br/>请登录到您的邮箱及时重置您的密码！';
        //更新数据发送时间
        //html页面
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
				<a href="../html/index.php"> <img src="../image/title.png" alt=""/> </a>
			</div>
			<span class="menu"> <img src="../image/icon.png" alt=""/></span>
			<div class="clear"> </div>
			<div class="navg">
				<ul class="res">
					<li><a class="active" href="../html/index.php">主页</a></li>
					<li><a href="../html/login.php">登录</a></li>
					<li><a href="../html/register.php">注册</a></li>
					<li><a href="../html/uploadFile.php">上传文件</a></li>
					<li><a href="../html/downloadFile.php">下载文件</a></li>
					<li><a href="../">文件解密</a></li>
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
			<h1>邮件已发送...</h1>
    </br>
			<p>系统已向您的邮箱发送了一封邮件<br/>请登录到您的邮箱及时重置您的密码！</p>

      <a href="../html/lostPsw.html">未收到邮件？点击重新发送</a>
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


<?php
        $sql_update = "update Users set getpasstime=\"".$getpasstime."\" where username=\"".$username."\"";
        $stmt_update = $mysqli->query($sql_update);
  }
  else
  {
        echo "发送失败！";
  }


  function sendmail($time,$Email,$url,$Email_address_host,$Email_psw_host){

	    include("smtp.class.php");
	    $smtpserver = "smtp.163.com"; //SMTP服务器
      $smtpserverport = 25; //SMTP服务器端口
      $smtpusermail = $Email_address_host; //SMTP服务器的用户邮箱
      $smtpuser = $Email_address_host; //SMTP服务器的用户帐号
      $smtppass = $Email_psw_host; //SMTP服务器的用户密码
      $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
      $smtp->debug = false;//是否显示发送的调试信息
      $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
      $smtpemailto = $Email;
      $smtpemailfrom = $smtpusermail;
      $emailsubject = "EnjoyCryptology.com - 找回密码";
      $emailbody = "亲爱的".$Email."：<br/>您在".$time."提交了找回密码请求。请点击下面的链接重置密码（按钮24小时内有效）。<br/><a href='".$url."' target='_blank'>".$url."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。<br/>如果您没有提交找回密码请求，请忽略此邮件。";
      $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);

  return $rs;
}

function injectChk($sql_str) { //防止注入
    $check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);
    if ($check)
    {
      echo('非法字符串');
      exit ();
    }
    else
    {
      return $sql_str;
    }
  }
?>
