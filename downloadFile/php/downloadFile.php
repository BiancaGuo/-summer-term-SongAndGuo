<?php
$filename = $_POST["filename"];
$path = '../uploads/';
session_start();
$mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
if($mysqli->connect_errno)
{
  echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
  exit();
}
$sql = "select * from FileKey where filename like  \"%".$filename."%\";";
$result = $mysqli->query($sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<?php
$indexurl = "http://www.enjoycryptology.com/summer_item/html/index.php";
$register_php = "../html/register.php";
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
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
	<script>
	function Judgelog(){
		<?php
  	if($_SESSION['username'] == null){
		?>

		alert("匿名用户禁止上传文件")
		return false

		<?php
	  }else
		{
		?>
		return true

			<?php
			}
			?>
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
				<a href="../html/index.php"> <img src="../image/title.png" alt=""/> </a>
			</div>
			<span class="menu"> <img src="../image/icon.png" alt=""/></span>
			<div class="clear"> </div>
			<div class="navg">
				<ul class="res">
					<li><a href="../html/index.php">主页</a></li>
					<?php

					if ($_SESSION['username'] == null){
						$label = "登录";
						$url = "../html/login.php";
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
						$url_t = "../html/register.php";
					}
					else {
						$label_t = "登出";
						$url_t = "../php/logout.php";
					}
					?>
					<li><a href=<?=$url_t?>><?=$label_t?></a></li>
					<li><a class="active" href="../html/uploadFile.php">上传文件</a></li>
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
			<h3>查询结果：</h3>
 <!--Upload File  -->
 <div class="downloadFiles">
<?php
  $num=0;
  foreach ($files as $key => $value) {
    $num++;
    $f = $value[uniname];
    $username=$value[username];
    $size=$value[size];
    $url=$path.$f;
    $fname=$value[filename];
    $aurl= "<a href=\"".$url."\">".$fname."</a>";
    echo "<strong><font size=5px; color=white;>条目 ".$num."</font><br/>";
    echo "<font size=4px; color=white;>文  件 ：".$aurl . "&nbsp;&nbsp;&nbsp;";
    echo "上传用户：".$username . "&nbsp;&nbsp;&nbsp;";
    echo "文件大小：".$size . "B</font></strong><br/><br/>";
    echo "文件大小：".$size . "B</font></strong><br/><br/>";
  // echo $f;
}
?>
 </div>
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
					<?php
					if ($_SESSION['username'] == null){
						$label = "Log In";
						$url = "../html/login.php";
					}
					else {
						$label = $_SESSION['username'];
						$url = "yourprofile.php";
					}

					?>
					<li><a href=<?=$url?>> <?=$label?> </a></li>
          <?php

          if ($_SESSION['username']==null){
						$label_t = "Register";
						$url_t = "../html/register.php";
					}
					else {
						$label_t = "Log Out";
						$url_t = "../php/logout.php";;
					}
					?>
					<li><a href=<?=$url_t?>><?=$label_t?></a></li>
					<li><a href="../html/uploadFile.php">上传文件Upload File</a></li>
					<li><a href="../">Download File</a></li>
					<li><a href="../">File Decryption</a></li>
					<!-- <li><a class="active" href="index.html">HOME</a></li>
					<li><a href="about.html">Log In</a></li>
					<li><a href="projects.html">Register</a></li>
					<li><a href="blog.html">Upload File</a></li>
					<li><a href="events.html">Download File</a></li>
					<li><a href="gallery.html">File Decryption</a></li>
					<li><a href="https://github.com/BiancaGuo/-summer-term-SongAndGuo">Contact Us</a></li> -->
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
