<?php

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
        if(time()-$row['getpasstime']>24*60*60)
        {
            $msg = '该链接已过期！';
        }
        else
        {
           //重置密码...
           $msg = '请重新设置密码';
        }
   }
   else
   {
       $msg =  '无效的链接';
   }
}
else
{
   $msg =  '错误的链接！';
}

echo $msg;
