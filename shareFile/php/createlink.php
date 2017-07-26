<?php
  
  $username = $_POST["username"];
  $filename = $_POST["filename"];

  //include_once("connect.php");//连接数据库
  $mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
  if($mysqli->connect_errno)
  {
    echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
    exit();
  }

  $token_sql=base64_encode(openssl_random_pseudo_bytes(8));
  $token=base64_encode($username.$token_sql);
  $url = "http://www.enjoycryptology.com/summer_item/php/fileshare.php?filename=".$filename."&token=".$token;

  $requesttime = time();
  $times=5;
  //$sql = "insert FileKey values('".$_SESSION['username']."','".$filename."','".$uniName."','".$size."','".$uploadtime."','".$encryptedkey."','signstring','".$enbase64iv."','".$encryFilemd5."')";
  //username,filename,token,times,requesttime

  $sql = "insert FileShare values('".$username."','".$filename."','".$token_sql."','".$times."','".$requesttime."')";
  $result = $mysqli->query($sql);
  // $result2 = $result->fetch_assoc();
  if($result!=false)
  {
    echo $url;
  }
