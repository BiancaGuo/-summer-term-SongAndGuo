<?php
session_start();

include_once( 'cal/config.php' );
include_once( 'cal/saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
	}
}

if ($token) {
	$_SESSION['token'] = $token;
	setcookie( 'weibojs_'.$o->client_id, http_builsd_query($token) );
	echo "grant successfully!";
	$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
	$uid_get = $c->get_uid();
	$uid = $uid_get['uid'];
// register a user by uid;
	$mysqli =new mysqli("localhost",getenv('MYSQL_USERNAME'),getenv('MYSQL_PASSWORD'),"FileCloud");

	if($mysqli->connect_errno)
	{
	  echo "Falied to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
	  exit();
	}
	$sql = "select * from Users where weiboid = \"".$uid."\";";
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
	<form -orm action="/setusername.php" method="post">
		<input type="text" name="username" class="text" >
		<input name="uid" value=<?=$uid?> type="hidden" class="text" >
				<input type="submit" value="入口" >
			</form>
</body>
</html>

<?php
	}else{
		echo "You have already signed up. loging in.......";
	}
}
	else
	{
		echo $mysqli->error;
	  echo $mysqli->errno;
	}
	} else {
echo "授权失败!";
}
?>
