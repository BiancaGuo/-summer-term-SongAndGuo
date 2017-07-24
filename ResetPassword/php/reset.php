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
$email = stripslashes(trim($_GET['email']));
$sql = "select * from `Users` where Email='$email'";

$query = $mysqli->query($sql);
$row = $query->fetch_assoc();
if($row)
{
   $mt = md5($row['username'].$row['password']);
   if($mt==$token)
   {
       if(time()-$row['getpasstime']>24*60)
       {
           $msg = '该链接已过期！';
           echo "<script>alert('".$msg."');location='../html/login.php';</script>";
           exit();
       }
       else
       {
            // echo '重置密码...';

           $sql = "select * from `Users` where Email='$email'";
           $query = $mysqli->query($sql);
           $result = $query->fetch_assoc();
           $id=md5($result['id'].$result['username']);

          //  $_SESSION[$session_id]=$result['id'] ;
          //  $msg = "<script>alert('将跳转至重置密码界面...');location='setpsw.html?id='.$session_id;</script>";
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

 	<script type="text/javascript">

      function Check()
      {
          //用户名为空
          if (document.send_psw.pass.value != document.send_psw.repass.value)
          {
            alert('两次密码输入不一致，请重新输入！');
            return false;
          }

          return true;
      }
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
 					<li><a class="active" href="index.php">主页</a></li>
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
 <div class="get">
 	<div class="container">
 		<div class="get-main">
 			  <h3>重置密码</h3>
 			  <div class="col-md-6 get-left">
 					 <div class="findpass">
 					     <div id="page">
 					         <div id="div_tab">

                       <form method="post" action="../php/setpsw.php" name="send_psw" onSubmit="return Check()">

                       <p>请输入新密码</p>
                         <input type="password" name="pass" id="pass" class="pass"  value="请输入新密码" onfocus="this.value = '';" onblur="if (this.value == '') " >

                       <p>请输入确认密码</p>
                         <input type="password" class="repass" name="repass" id="repass"   value="确认新密码" onfocus="this.value = '';" onblur="if (this.value == '') " >
                         <span id="chkmsg"></span>

                       <p>
                         <input style="display:none;" type="text" class="id" name="id" id="id"  value=<?php echo $id ?> >
                         <input style="display:none;" type="text" class="email" name="email" id="email"  value=<?php echo $email ?> >
                         <input style="display:none;" type="text" class="token" name="token" id="token"  value=<?php echo $token ?> >
                      </p>

                       <div class="signin">
                         <input type="reset" class="btn" value="重  置">
                         <input type="submit" class="btn" id="sub_btn" value="提  交" >
                       </div>

                     </form>
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
        }
   }
   else
   {
       $msg =  '无效的链接';
       echo "<script>alert('".$msg."');location='../html/login.php';</script>";
       exit();
   }
}
else
{
   $msg =  '错误的链接！';
   echo "<script>alert('".$msg."');location='../html/login.php';</script>";
   exit();
}
