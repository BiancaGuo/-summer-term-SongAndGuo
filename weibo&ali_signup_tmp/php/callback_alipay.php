<?php

include_once( '../alipay_sdk/aop/AopClient.php' );
include_once( '../alipay_sdk/aop/request/AlipaySystemOauthTokenRequest.php' );
include_once( '../weibo_sdk/config.php' );
include_once( '../weibo_sdk/saetv2.ex.class.php' );
$grant_flag = 0;

//$signupap = $_POST['signap'] ;

echo "granting......";
$aop = new AopClient ();
$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
$aop->appId = '2017072007819781';
$aop->rsaPrivateKey = Private_Key;
$aop->alipayrsaPublicKey=Public_Key;
$aop->apiVersion = '1.0';
$aop->signType = 'RSA2';
$aop->postCharset='utf-8';
$aop->format='json';
$request = new AlipaySystemOauthTokenRequest ();
$request->setGrantType("authorization_code");
$request->setCode($_REQUEST['auth_code']);
$result = $aop->execute ($request);
//echo gettype($result);

$responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
$alipay_id = $result->alipay_system_oauth_token_response->user_id;

$id_type = 'alipayid';
$uid = $alipay_id;



$mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");
if($mysqli->connect_errno)
{
	 echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
	 exit();
}
$sql = "select * from Users where ".$id_type." = \"".$uid."\";";
	$result = $mysqli->query($sql);
// 判断当前用户是否已经授权注册过
	if($result != false)
	{
		if($result->num_rows == 0)
		{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>signup</title>
</head>
<body>
	<p>The current user is not registered !!! <br>
		Do you want to join us? </p>
		<form -orm action="setusername.php" method="post">
				<input type="text" name="username" class="text" >
				<input name="uid" value=<?=$uid?> type="hidden" class="text" >
				<input name="grant_type" value=<?=$id_type?> type="hidden" class="text">
				<!--<input name="uid" value='12344' type="hidden" class="text" >-->
				<input type="submit" value="入口" >
		</form>
		<p>if you don't want to join us: emmm....... bye.....see you again.</p>
		<a href="www.enjoycryptology.com">go back to index.html.........</a>
</body>
</html>
<?php
}else{
				echo "You have already signed up. loging in.......";
}
}else{
		echo $mysqli->error;
		echo $mysqli->errno;
}

?>
