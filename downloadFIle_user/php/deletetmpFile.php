<?php
ignore_user_abort(); //客户端断开时，可以让脚本继续在后台执行
set_time_limit(0); //忽略php.ini设置的脚本运行时间限制
$interval = 30; //设置执行周期，单位为秒，5分钟为 5*60=300
do{
$dir = "../tmp/"; //你的临时目录位置
$handle=opendir("{$dir}/");
while (false !== ($file=readdir($handle))) {
if ($file!="." && $file!=".." && !is_dir("{$dir}/{$file}")) {
@unlink ("{$dir}/{$file}");
}
}
closedir($handle); //关闭由 opendir() 函数打开的目录
sleep($interval); //执行一个周期后，休眠$interval时间，休眠结束后脚本继续执行
}while(true); //周期性执行脚本
