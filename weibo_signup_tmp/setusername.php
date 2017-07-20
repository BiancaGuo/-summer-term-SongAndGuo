<?php
$username = $_POST['username'];
$uid = $_POST['uid'];
$mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");

if($mysqli->connect_errno)
{
  echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
  exit();
}
$sql = "select * from Users where username = \"".$username."\";";
$result = $mysqli->query($sql);
// 判断当前用户是否已经授权注册过
if($result === false)
{
  echo $mysqli->error;
  echo $mysqli->errno;
}
else {
  $sql_insert="insert into Users(username,weiboid) values('".$username."','".$uid."');";
  $res = $mysqli->query($sql_insert);
  if($res == false)
  {
    echo $mysqli->error;
    echo $mysqli->errno;
  }
  else {
    echo "OK!!!";
  }
}
?>
