<?php

$ServerName = 'localhost';//mysql的服务器地址
$UserName = getenv('MYSQL_USERNAME');//mysql用户名
$UserPwd = getenv('MYSQL_PASSWORD');//mysql密码
$DbName = 'User';//数据库名称

$conn = mysqli_connect($ServerName,$UserName,$UserPwd,$DbName);
//获取连接数据库
mysqli_select_db($conn,"User");#连接数据库

$conn->query('set names utf8') or die('query字符集错误');//这句一定不能忘记
//否则查询出来的中文会在页面显示问号

if(!$conn){
    die("Connection faild: ".mysqli_connect_error());
}
