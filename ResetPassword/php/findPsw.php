<?php

  $username = $_POST["username"];
  $Email=stripslashes(trim($_POST["email"]));
  $Email = injectChk($Email);


  $Email_address_host=getenv('EMAIL_ADDRESS');
  $Email_psw_host=getenv('EMAIL_PSW');

  //include_once("connect.php");//连接数据库
  $mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
  if($mysqli->connect_errno)
  {
    echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
    exit();
  }
  else
  {
    echo "连接成功";
  }


  $sql = "select * from Users where username = \"".$username."\" and Email = \"".$Email."\";";
  $result = $mysqli->query($sql);
  $result2 = $result->fetch_assoc();

  if($result2 == false)
  {
    echo "<script>alert('该用户尚未注册，将跳转至注册页面...');location='../html/register.html';</script>";
    exit();
  }

  $getpasstime = time();

  $token = md5($result2['username'].$result2['password']);

  //后期修改为https
  $url = "http://www.enjoycryptology.com/summer_item/php/reset.php?email=".$Email."&token=".$token;
  // echo $url;
  $time = date('Y-m-d H:i');
  $ret = sendmail($time,$Email,$url,$Email_address_host,$Email_psw_host);

  if($ret!="")
  {//邮件发送成功
        echo '系统已向您的邮箱发送了一封邮件<br/>请登录到您的邮箱及时重置您的密码！';
        //更新数据发送时间
        $sql_update = "update Users set getpasstime=\"".$getpasstime."\" where username=\"".$username."\"";
        $stmt_update = $mysqli->query($sql_update);
  }
  else
  {
        echo "发送失败！";
  }


  function sendmail($time,$Email,$url,$Email_address_host,$Email_psw_host){
      echo $Email_address_host;
      echo $Email_psw_host;
	    include("smtp.class.php");
	    $smtpserver = "smtp.163.com"; //SMTP服务器
      $smtpserverport = 25; //SMTP服务器端口
      $smtpusermail = $Email_address_host; //SMTP服务器的用户邮箱
      $smtpuser = $Email_address_host; //SMTP服务器的用户帐号
      $smtppass = $Email_psw_host; //SMTP服务器的用户密码
      $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
      $smtp->debug = false;//是否显示发送的调试信息
      $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
      $smtpemailto = $Email;
      $smtpemailfrom = $smtpusermail;
      $emailsubject = "EnjoyCryptology.com - 找回密码";
      $emailbody = "亲爱的".$Email."：<br/>您在".$time."提交了找回密码请求。请点击下面的链接重置密码（按钮24小时内有效）。<br/><a href='".$url."' target='_blank'>".$url."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。<br/>如果您没有提交找回密码请求，请忽略此邮件。";
      $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);

  return $rs;
}

function injectChk($sql_str) { //防止注入
    $check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);
    if ($check)
    {
      echo('非法字符串');
      exit ();
    }
    else
    {
      return $sql_str;
    }
  }
