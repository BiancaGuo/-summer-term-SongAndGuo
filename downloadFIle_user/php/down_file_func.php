<?php
function down_file($file_name,$file_path="")
{

  if($file_path == "" && preg_match('/.+\.sign$/',$file_name))
  {
      $file_path ="../signFile/".$file_name;
  }
  if($file_path == "" && !(preg_match('/.+\.sign$/',$file_name)))
  {
      $file_path ="../uploads/".$file_name;
  }
  if(!file_exists($file_path))
  {   //检查文件是否存在
    echo   "文件找不到";
    exit;
  }
  else
  {
      ob_end_clean();
      header("Content-Type: application/force-download");
      header("Content-Disposition: attachment; filename=".($file_name));
      readfile($file_path);

   }

}

$filename=$_GET['filename'];
$filepath="../signFile/".$file_name;

down_file($filename,$filepath);
