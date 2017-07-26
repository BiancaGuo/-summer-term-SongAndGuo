<?php
// $filename
//$unipath
include("down_file_func.php");

header("Content-type:text/html; charset=utf-8");



$filename = $_GET["filename"];
$username = $_GET['username'];

$mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
if($mysqli->connect_errno)
{
   echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
   exit();
}
$sql = "select * from FileKey where filename = '".$filename."';";
$result=$mysqli->query($sql);
if($result == false)
{
  echo "ERROR!!!".$sql;
  echo $mysqli->error;
  echo $mysqli->errno;
}
else {
  if($result->num_rows == 0)
  {
    echo "文件不存在";
  }
  else {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $rawkey = base64_decode($row['key']);
    $privatekey = openssl_pkey_get_private(file_get_contents('../private.key'));
    openssl_private_decrypt ($rawkey,$filekey ,$privatekey);
    $uninamepath = '../uploads/'.$row['uniname'];
    $file = fopen($uninamepath, "r+") or die("Unable to open file!");
    $data= fread($file,filesize($uninamepath));
    fclose($file);

    $filetmppath='../tmp/'.$filename;
    $filetmp = fopen($filetmppath, "w+") or die("Unable to open file!");
    $method = "AES-256-CBC";
    $iv =base64_decode($row['iv']);
    $content = openssl_decrypt($data,$method,$filekey,OPENSSL_RAW_DATA,$iv);
    fwrite($filetmp, $content);
    fclose($filetmp);

    down_file($filename,$filetmppath);
    print_r(error_get_last());
    // echo "hhh!";
  }
}
    // $row = $result->fetch_array(MYSQLI_ASSOC);

exit();
