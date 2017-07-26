<?php

$mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
if($mysqli->connect_errno)
{
  echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
  exit();
}
// else
// {
//     echo "数据库连接成功\n";
// }
// session_start();
//$url = "http://www.enjoycryptology.com/summer_item/php/reset.php?email=".$Email."&token=".$token;

$token = stripslashes(trim($_GET['token']));
$filename = stripslashes(trim($_GET['filename']));
$sql = "select * from `FileShare` where filename='$filename'";

$result = $mysqli->query($sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach ($files as $key => $value)
{
  $username=$value[username];
  $token_sql=$value[token];
  $requesttime=$value[requesttime];
  $times=$value[times];
  if(base64_encode($username.$token_sql)==$token)
  {
    break;
  }
  else
  {
    $username="";
    $token_sql="";
    $requesttime="";
    $times="";
  }

}

//$username,$filename

if($username == "" && $token == "")
{
  $msg = '该链接无效！';
  echo "<script>alert('".$msg."');location='../html/index.php';</script>";
  exit();

}
else
{
    if(time()-$requesttime>24*60*60)//链接24小时有效
    {
        $msg = '该链接已过期！';
        echo "<script>alert('".$msg."');location='../html/index.php';</script>";
        exit();
    }
    else if ($times==0)
    {
        $msg = '该链接分享次数已达上限！';
        echo "<script>alert('".$msg."');location='../html/index.php';</script>";
        exit();
    }
    else
    {
        $times=$times-1;
        $sql_update = "update FileShare set times=".$times." where username=\"".$username."\" and filename=\"".$filename."\" and token=\"".$token_sql."\"";
        $stmt_update = $mysqli->query($sql_update);
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
 					<li><a href="../html/index.php">主页</a></li>
 					<li><a href="../html/login.php">登录</a></li>
 					<li><a href="../html/register.php">注册</a></li>
 					<li><a href="../html/uploadFile.php">上传文件</a></li>
 					<li><a class="active" href="../html/downloadFile.php">下载文件</a></li>
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
 <div class="get">
 	<div class="container">
 		<div class="get-main">
 			  <h3>共享文件下载</h3>
 			  <div class="col-md-6 get-left">
 					 <div class="findpass">
 					     <div id="page">
 					         <div id="div_tab">

                       <!-- <form method="post" action="../php/decryptfile_user.php" name="send_share_file"> -->

                       <p>请点击文件下载：</p></br></br>
<?php
                       $aurl= "<a href=\"../php/decryptfile_user.php?username=".$username."&filename=".$filename."\">".$filename."</a>";
                       echo "<font size=4px; color=white;>文  件 ：".$aurl . "&nbsp;&nbsp;&nbsp;";

?>                     <!-- </form> -->
 					            </div>
 					      </div>
 					 </div>

 					 </form>
 			  </div>

 		 	<div class="clearfix"> </div>
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


<?php
        }
}
