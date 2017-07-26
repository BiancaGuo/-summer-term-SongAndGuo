<?php


function getfiletype($filename)
{
  $fp = fopen($filename, "rb");
  $bin = fread($fp, 2); //只读2字节
  fclose($fp);
  $str_info  = @unpack("C2chars", $bin);
  $type_code = intval($str_info['chars1'].$str_info['chars2']);
  $file_type = '';
  switch ($type_code) {
            case 7790:
                $file_type = 'exe';
                break;
            case 7784:
                $file_type = 'midi';
                break;
            case 8075:
                $file_type = 'zip';
                break;
            case 8297:
                $file_type = 'rar';
                break;
            case 255216:
                $file_type = 'jpg';
                break;
            case 7173:
                $file_type = 'gif';
                break;
            case 6677:
                $file_type = 'bmp';
                break;
            case 13780:
                $file_type = 'png';
                break;
            default:
                $file_type = 'unknown';
                break;
        }
    return $file_type;
}
 ?>



<?php



  session_start();
 include '../weibo_sdk/config.php';
 $fileinfo=$_FILES["myFile"];//降维操作
 $filename=$fileinfo["name"];
 $tmp_name=$fileinfo["tmp_name"];
 $size=$fileinfo["size"];//文件大小
 $error=$fileinfo["error"];//错误类型
 $type=$fileinfo["type"];//文件格式

$method='AES-256-CBC';

 $pattern = '/[a-zA-Z1-9]{'.strlen($_POST['filekey']).'}/';
 if(preg_match($pattern, $_POST['filekey'])==0)
 {
     echo $_POST['filekey'];
     echo "<script>alert('wrong password');location='../html/uploadFile.php';</script>";
     exit();
  }
  else {
    $filekey = $_POST['filekey'];
  }

 $maxsize=10485760;
 $path="../tmp/";
 if (!file_exists($path)) {   //当目录不存在，就创建目录
     mkdir($path,0777,true);
     chmod($path, 0777);
 }
$uniName=hash('md5',file_get_contents($tmp_name));


 if ($error==0) {
  // 直接解密????!!!
      // echo  $tmp_name.$method.$filekey;
       $iv = $_POST['iv'];
       $uniName=md5_file($tmp_name);
       //$uniName=md5_file('../uploads/9baa263755f2981b07c221b6d7c6f73a');
      $file = fopen($tmp_name, "r+") or die("Unable to open file!");
        $data= fread($file,filesize($tmp_name));
        fclose($file);
       if($iv==''){
         $mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
         if($mysqli->connect_errno)
         {
         	 echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
         	 exit();
         }
         $sql = "select * from FileKey where `encryFileMd5` = '".$uniName."';";
         $result=$mysqli->query($sql);
         if($result == false)
         {
           echo "ERROR!!!".$sql;
           echo $mysqli->error;
           echo $mysqli->errno;
         }
         else {
           if($result->num_rows != 0)
           {
             $result = $result->fetch_assoc();
             $iv = base64_decode($result['iv']);

           }
           else {
              echo $iv.' go there!!!'.$sql;
           }
         }
      }
      if($iv == '')
      {
        echo "error!!!!";
        $content = openssl_decrypt($data,$method,$filekey);
      }
      else {
        echo $iv;
      //  echo 'data: '.$data.'method:'.$method.'filekey: '.$filekey;
        $content = openssl_decrypt($data,$method,$filekey,OPENSSL_RAW_DATA,$iv);
      }
      $filenametmp =time().'decryptedFile';
      if (!file_exists($path.$filenametmp)) {   //当目录不存在，就创建目录
          mkdir($path,0777,true);
          chmod($path, 0777);
      }
      $filetmp = fopen($path.$filenametmp,'w+');
      fwrite($filetmp, $content);
      fclose($filetmp);
    //  echo "<script>alert('".$path.$filenametmp."');</script>";
      //echo $path.$filenametmp;
      $file =$path.$filenametmp;
      $filename = 'decryptedFile.'.getfiletype($file);
      //
      // //echo 'decryptedFile.'getfiletype($file);
      ob_end_clean();
      header("Content-Type: application/force-download");
      header("Content-Disposition: attachment; filename=".($filename));
      readfile($file);

 }else{
     echo $error;
     switch ($error){
         case 1:
             echo "<script>alert('文件过大，请选择10M以下文件上传...');location='../html/uploadFile.php';</script>";
             break;
         case 2:
             echo "上传文件过多，请一次上传20个及以下文件！";
             break;
         case 3:
             echo "<script>alert('文件上传失败，请重新上传...');location='../html/uploadFile.php';</script>";
             break;
         case 4:
             echo "<script>alert('未选择上传文件...');location='../html/uploadFile.php';</script>";
             break;
         case 6:
             echo "没有临时文件夹";
             break;
     }
 }
