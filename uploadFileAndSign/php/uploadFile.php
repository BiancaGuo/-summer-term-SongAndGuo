<?php
session_start();
include("sign.php");
//include 'encryptfile.php';
include '../weibo_sdk/config.php';
header('content-type:text/html;charset=utf-8');
//接受文件，临时文件信息
$fileinfo=$_FILES["myFile"];//降维操作
$filename=$fileinfo["name"];
$tmp_name=$fileinfo["tmp_name"];
$size=$fileinfo["size"];//文件大小
$error=$fileinfo["error"];//错误类型
$type=$fileinfo["type"];//文件格式

$username=$_SESSION['username'];
//php.ini限制
// 在php.ini中找这么几项：
//
// file_upload:On
//
// upload_tmp_dir=——临时文件保存目录；
//
// upload_max_filesize=2M
//
// max_file_uploads=20——允许一次上传的最大文件数量（注意和上面那个的区别，有没有size，别乱想）
//
// post_max_size=8M——post方式发送数据的最大值

//服务器端设定限制
$maxsize=10485760;//10M,10*1024*1024
$allowExt=array('jpeg','jpg','png','doc','docx','gif','JPEG','JPG','PNG','DOC','DOCX','GIF');//允许上传的文件类型（拓展名
$allowExt_pic=array('jpeg','jpg','png','gif','JPEG','JPG','PNG','GIF');
$ext=pathinfo($filename,PATHINFO_EXTENSION);//提取上传文件的拓展名

//目的信息
$path="../uploads/";
$path_s="../signFile/";
if (!file_exists($path)) {   //当目录不存在，就创建目录
    mkdir($path,0777,true);
    chmod($path, 0777);
}
//$destination=$path."/".$filename;
//得到唯一的文件名！防止因为文件名相同而产生覆盖
$uniName=md5(uniqid(microtime(true),true)).$ext;//md5加密，uniqid产生唯一id，microtime做前缀


if ($error==0) {
    if ($size>$maxsize) {
        echo "<script>alert('文件过大，请选择10M以下文件上传...');location='../html/uploadFile.php';</script>";
        exit();

    }
    if (in_array($ext, $allowExt_pic)) {
      //判断是否为真实图片（防止伪装成图片的病毒一类的
      if (!getimagesize($tmp_name)) {//getimagesize真实返回数组，否则返回false
        echo "<script>alert('不是真正的图片类型！');location='../html/uploadFile.php';</script>";
        exit();
      }
    }
    if (!in_array($ext, $allowExt)) {
        echo "<script>alert('非法文件类型...');location='../html/uploadFile.php';</script>";
        exit();
    }
    if (!is_uploaded_file($tmp_name)) {
        echo "<script>alert('上传方式有误，请使用post方式...');location='../html/uploadFile.php';</script>";
        exit();
    }
    if (move_uploaded_file($tmp_name, $path.$uniName)) {//@错误抑制符，不让用户看到警告

      $fileName = $path.$uniName;
      $file = fopen($fileName, "r+") or die("Unable to open file!");
      $data= fread($file,filesize($fileName));
      fseek($file,0);
      $method = "AES-256-CBC";
      $seed = time();
      mt_srand($seed);
      $iv =openssl_random_pseudo_bytes(16);
      $key = $_POST['filekey'];
      $code = openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
      //$message = openssl_decrypt($code,$method,$key);
      fwrite($file, $code);
      fclose($file);
      $enbase64iv = base64_encode($iv);
      $publickey = openssl_pkey_get_public(file_get_contents('../public.key'));
      if(!openssl_public_encrypt ($key ,$encryptedkey,$publickey)){
         echo "public encrypt error!!!";
         exit();
      }
      else {
        $encryptedkey = base64_encode($encryptedkey);
      }
      $mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");

      if($mysqli->connect_errno)
      {
      	 echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
      	 exit();
      }

      $sql = "insert FileKey values('".$_SESSION['username']."','".$filename."','".$uniName."','".$size."','".$encryptedkey."','signstring','".$enbase64iv."')";
      $result=$mysqli->query($sql);
      if($result == false)
      {
        echo "ERROR!!!".$sql;
        echo $mysqli->error;
        echo $mysqli->errno;
      }
      signFile($path.$uniName,$path_s.$uniName.".sign",$username);
      echo "<script>alert('文件".$filename." 上传成功!\\n请务必记住加密密码(".$key.")!!\\n如果您想将本文件分享给匿名用户，得到此密码后，其他人才可以解密文件。');location='../html/uploadFile.php';</script>";
      exit();
    }
    else{
        // echo "<script>alert('文件".$filename."上传失败!');location='../html/uploadFile.php';</script>";
        echo "文件".$filename."上传失败";
        print_r(error_get_last());
        exit();
    }


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
