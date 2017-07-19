<?php

/*
*	@time:2017/7/19
*	@author:Bianca
*	@version:1.0
*/

$username = $_POST["username"];
$password = $_POST["password"];
$Email=$_POST["Email"];
$phonenumber=$_POST["phonenumber"];

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


$sql = "select * from User where username = \"".$username."\";";
$result = $mysqli->query($sql);

//不允许用户名重复
if ($result === false)
{
        echo "已有人注册此名，请重新选择!\n";
}
else
{

      $sql = "insert into User(`username`,`password`,`Email`,`phonenumber`)values('$username','$password_hash','$Email','$phonenumber')";#放进表单中
      $result = $mysqli->query($sql);
      if ($result === true)
      {
            echo "注册成功,将跳转至登录页面...\n";
      }
      else
      {
            echo "注册失败\n";
      }
}



?>
