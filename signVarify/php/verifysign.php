<?php
session_start();
include("verify.php");
//include 'encryptfile.php';
include '../weibo_sdk/config.php';
header('content-type:text/html;charset=utf-8');
//接受文件，临时文件信息
$file=$_FILES["myFile"];//降维操作
$signfile=$_FILES["mySign"];
// $filename=$fileinfo["name"];
$file_tmp_name=$file["tmp_name"];
$sign_tmp_name=$signfile["tmp_name"];


$username=$_POST['users'];
verify($file_tmp_name,$sign_tmp_name);
