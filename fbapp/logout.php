<?php
	require 'php-sdk/facebook.php';
	$facebook = new Facebook(array(
    'appId'=>'386401654786650',
    'secret'=>'a86daa147f6790c90b3cb853f1727844'
	));

	setcookie('fbs_'.$facebook->getAppId(),'', time()-100, '/', 'sudeep-cv.tk/');
	$facebook->destroySession();
	header('Location: index.php');
?>
