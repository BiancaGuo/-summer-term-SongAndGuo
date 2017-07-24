<?
function encryptFile($path,$uniName){
  echo "testFUnction";
  $fileName = $path.$uniName;
  $file = fopen($fileName, "r+") or die("Unable to open file!");
  $data= fread($file,filesize($fileName));
  fseek($file,0);
  $method = "AES-256-CBC";
  $seed = time();                   // 使用时间作为种子源
  mt_srand($seed);                  // 播下随机数发生器种子
  $key = mt_rand();//随机生成
  $code = openssl_encrypt($data,$method,$key);
  //$message = openssl_decrypt($code,$method,$key);
  echo $data;
  fwrite($file, $code);
  fclose($file);
  $key = openssl_encrypt($key,$method,$server_public_key);
  $mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
  print_r(error_get_last());
  if($mysqli->connect_errno)
  {
  	 echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
  	 exit();
  }
  $sql = "insert into table FileKey(username,key,filename,uniname) values('".$_SESSION['username']."','".$key."','".$filename."','".$uniName."')";
  $result=$mysqli->query($sql);
  if($result == false)
  {
    echo "somthing about MySql is wrong!!!!";
  }
  print_r(error_get_last());
  return $key;
  }
?>
