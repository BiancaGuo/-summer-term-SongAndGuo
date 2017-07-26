<?php
$file=$_FILES['filename'];
$hash=$_POST['hash'];
$tmp_name=$file["tmp_name"];
// default md5
$hashtmp = md5_file($tmp_name);
if($hash == $hashtmp)
{
  echo "验证成功，文件完整";
}
else {
  echo "验证失败，文件不完整";
}
?>
