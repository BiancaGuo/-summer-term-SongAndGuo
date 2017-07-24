 <?php
 // session_start();

 function testPsw($password)
 {

   $score = 0;
   if(empty($password)){   //接收的值

       echo "<script>alert('密码为空,请重新修改...');location='../html/register.php';</script>";
       exit();
   }

   // php7 mbstring扩展的安装：mbstring is missing for phpadmin in ubuntu 16.04
   if(mb_strlen($password,'utf-8')>36){   //接收的值

       echo "<script>alert('密码过长,请重新修改...');location='../html/register.php';</script>";
       exit();
   }

   if(preg_match('/(?=.{6,}).*/',$password)==0)
   {
     $score = 1;
   }

   else if(preg_match('/^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$/',$password))
   {
     $score = 3;
   }
   else if(preg_match('/^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$/',$password))
   {
     $score = 2;
   }
   else {
     $score = 1;
   }

   return $score;
 }

 $mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
 if($mysqli->connect_errno)
 {
   echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
   exit();
 }

 $id= $_POST['id'];
 $password=$_POST['pass'];
 $Email=$_POST['email'];
 $token=$_POST['token'];
 $score=testPsw($password);
 if($score ==0 || $score==1)
 {
  // $url = "http://www.enjoycryptology.com/summer_item/php/reset.php?email=".$Email."&token=".$token;
  echo "<script>alert('密码强度过低,请重新点击链接设置...');window.location.href='../html/login.php';</script>";
  // echo "<script>alert('密码强度过低,请重新设置...');location='../html/register.html';</script>";
  exit();
 }
 $password_hash=password_hash($password, PASSWORD_DEFAULT);

 // $session_id=md5($result['id'].$result['username']);
 $sql = "select * from `Users`";
 $query = $mysqli->query($sql);
 $result = $query->fetch_assoc();
 $serch_id=1;
 while($result == true)
 {

   if(md5($result['id'].$result['username'])==$id)
   {
     $username=$result['username'];
     break;
   }
   $serch_id++;
   $sql = "select * from `Users` where id='$serch_id'";
   $query = $mysqli->query($sql);
   $result = $query->fetch_assoc();
 }


 $sql="update Users set password=\"".$password_hash."\" where username=\"".$username."\"";
 $query = $mysqli->query($sql);

 if(mysqli_affected_rows($mysqli))
 {
   echo "<script>alert('密码重置成功，将跳转至登录页面...');location='../html/login.php';</script>";
 }
 else
 {
   echo "<script>alert('密码重置失败...');location='../html/lostPsw.html';</script>";
 }
