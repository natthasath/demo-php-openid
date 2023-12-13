<?php
header ('Content-type: text/html; charset=utf-8');
ob_start() ;
require_once "OAuth/OAuth.php";       //oauth library
require_once "OAuth/common.php";      //common functions and variables
require_once "OAuth/Utility.php";  	  // EGA Utility

$secret = Utility::prepareSecret($secret);

//ทำ OAuth ขั้นตอน A-C
if(!isset($_GET['oauth_token']) && !isset($_GET['oauth_verifier']))
{
	//initialize consumer
	$consumer = new OAuthConsumer($key, $secret, NULL);

	//prepare to get request token
	$sig_method = new OAuthSignatureMethod_HMAC_SHA1();
	//$parsed = parse_url($request_token_endpoint);
	$params = array('scope' => $scope, 'oauth_callback' => $base_url);

	//sign request and get request token
	$req_req = OAuthRequest::from_consumer_and_token($consumer, NULL, "GET", $request_token_endpoint, $params);
	$req_req->sign_request($sig_method, $consumer, NULL);
	
	$req_token = run_curl($req_req->to_url(), 'GET');
	//if fetching request token was successful we should have oauth_token and oauth_token_secret
	parse_str($req_token, $tokens);
	$oauth_token = $tokens['oauth_token'];
	$oauth_token_secret = $tokens['oauth_token_secret'];

	//store key and token details in cookie to pass to complete stage
	setcookie("requestToken", "key=$key&token=$oauth_token&token_secret=$oauth_token_secret");

	//build authentication url following sign-in and redirect user
	 $oauth_token=urlencode($oauth_token);
	 $auth_url = $authorize_endpoint . "?oauth_token=$oauth_token";
	  header("Location: $auth_url");
}
//ทำ OAuth ขั้นตอน D-G
else
{
	$request_cookie = $_COOKIE["requestToken"];
	parse_str($request_cookie);
	
	/*
	function parse_str ของ php จะทำการแปลง เครื่องหมาย "+" เป็น " " 
	ทำให้ต้องทำใช้ str_replace ในการทำให้ $token และ  $token_secret
	ถูกต้องเพื่อจะทำงานได้
	*/
	$token = str_replace(" ", "+", $token);
	$token_secret = str_replace(" ", "+", $token_secret);
	
	
	//initialize consumer
	$consumer = new OAuthConsumer($key, $secret, NULL);
    $req_token = new OAuthConsumer($token, $token_secret, NULL);
	setcookie("requestToken");
	//prepare to get access token
	$sig_method = new OAuthSignatureMethod_HMAC_SHA1();
	
	//$parsed = parse_url($oauth_access_token_endpoint);
	$params = array('oauth_verifier' => $_GET['oauth_verifier']);
	
	//sign request and get request token
	$acc_req = OAuthRequest::from_consumer_and_token($consumer, $req_token, "GET", $oauth_access_token_endpoint, $params);
	$acc_req->sign_request($sig_method, $consumer, $req_token);
	$acc_token = run_curl($acc_req->to_url(), 'GET');

	//เอาค่าออกมาจาก Response
	parse_str($acc_token);
	
	/*
	function parse_str ของ php จะทำการแปลง เครื่องหมาย "+" เป็น " " 
	ทำให้ต้องทำใช้ str_replace ในการทำให้ $oauth_token ถูกต้องเพื่อจะทำงานได้
	*/
	$oauth_token = str_replace(" ", "+", $oauth_token);
	
	$oauth_token=urlencode($oauth_token);
	$auth_url = $xmlUrl . "?AccessToken=$oauth_token";
	 header("Location: $auth_url");

}
?>
<script>//location.href='<?echo $auth_url?>';</script>
