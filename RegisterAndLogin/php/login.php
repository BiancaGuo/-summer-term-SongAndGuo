<?php
$username = $_POST["username"];
$password = $_POST["password"];
session_start();
$mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
if($mysqli->connect_errno)
{
  echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
  exit();
}
$sql = "select password from Users where username = \"".$username."\";";

$result = $mysqli->query($sql);

if($result === false)
{
  echo $mysqli->error;
  echo $mysqli->errno;
}
else
{
  $result = $result->fetch_assoc();
  $pass_hash = $result["password"];
}
if (password_verify($password,$pass_hash))
{
   $_SESSION['username'] = $_POST['username'];
    header("Location: ../html/index.php");
    exit();
}
else
{
  session_start();
  echo "<script>alert('用户名或密码错误...');location='../html/login.php';</script>";
}
