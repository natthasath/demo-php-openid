<?php
require_once "common.php";

global $pape_policy_uris;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>ทดสอบ OpenID และ OAuth ด้วยภาษา PHP</title>
	  <style type="text/css">
		  * {
			font-family: verdana,sans-serif;
		  }
		  body {
			width: 50em;
			margin: 1em;
		  }
		  div {
			padding: .5em;
		  }
		  table {
			margin: none;
			padding: none;
		  }
		  .alert {
			border: 1px solid #e7dc2b;
			background: #fff888;
		  }
		  .success {
			border: 1px solid #669966;
			background: #88ff88;
		  }
		  .error {
			border: 1px solid #ff0000;
			background: #ffaaaa;
		  }
		  #verify-form {
			border: 1px solid #777777;
			background: #dddddd;
			margin-top: 1em;
			padding-bottom: 0em;
		  }
	  </style>
  </head>
  <body>
    <h1></h1>
    <p>
		หน้าทดสอบการทำงานของ OpenID และ OAuth
    </p>

    <div id="verify-form">
		<ul>
			<li>ทดสอบการทำงานของ OpenID <a href="http://127.0.0.1:8090/OpenID/SSOLogin.php" target="_blank">SSOLogin.php</a></li>
			<li>ทดสอบการทำงานของ OAuth <a href="http://127.0.0.1:8090/OpenID/OAuthConsumer.php" target="_blank">OAuthConsumer.php</a></li>
		</ul>
    </div>
  </body>
</html>
