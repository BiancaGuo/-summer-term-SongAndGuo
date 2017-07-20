<?php

/*
*	@time:2017/7/19
*	@author:Bianca
*	@version:1.0
*/
function testPsw($password)
{

  $score = 0;
  if(empty($password)){   //接收的值

      echo "<script>alert('密码为空,请重新注册...');location='../html/register.html';</script>";
      exit;
  }

  // php7 mbstring扩展的安装：mbstring is missing for phpadmin in ubuntu 16.04
  if(mb_strlen($password,'utf-8')>36){   //接收的值

      echo "<script>alert('密码过长,请重新注册...');location='../html/register.html';</script>";
      exit;
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

//
function testUsr($username)
{
  // echo $username;
  $pattern= '/^[\x4e00-\x9fa5a-zA-Z0-9]+$/';
  if(preg_match($pattern,$username)==0)
  {
    return 0;
  }
  else
  {
    return 1;
  }
}


$username = $_POST["username"];
$password = $_POST["password"];
$Email=$_POST["Email"];
$phonenumber=$_POST["phonenumber"];

//判断密码强度和长度
$score=testPsw($password);

if($score ==0 || $score==1)
{
     echo "<script>alert('密码强度过低,请重新注册...');location='../html/register.html';</script>";
     exit;
}
//判断用户名是否合法
if(testUsr($username)== 0)
{
    // echo $username;
    echo "<script>alert('用户名不合法,请重新注册...');location='../html/register.html';</script>";
    exit;
}
//对密码进行hash
$password_hash=password_hash($password, PASSWORD_DEFAULT);
//连接数据库
$mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
if($mysqli->connect_errno)
{
  echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
  exit();
}
else
{
    echo "数据库连接成功\n";
}


$sql = "select * from Users where username = \"".$username."\";";
$result = $mysqli->query($sql);
$result2 = $result->fetch_assoc();

//不允许用户名重复
if ($result2["username"] == $username)
{
        echo "<script>alert('已有人注册此名，请重新选择!');location='../html/register.html';</script>";
        exit;
}
else
{

      $sql = "insert into Users(`username`,`password`,`Email`,`phonenumber`)values('$username','$password_hash','$Email','$phonenumber')";#放进表单中
      $result = $mysqli->query($sql);
      if ($result === true)
      {
            //echo "<script>alert('注册成功,将跳转至登录页面...');location='';</script>";
            echo "注册成功,将跳转至登录页面...";

      }
      else
      {
            echo "注册失败\n". mysqli_error($conn);;
      }
}
