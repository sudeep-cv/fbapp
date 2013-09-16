<?php 
	require 'php-sdk/facebook.php';
	$facebook = new Facebook(array(
		'appId'  => 'YOUR_APP_ID',
		'secret' => 'YOUR_APP_SECRET'
	));
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Movie Friend List</title>
	<link rel="stylesheet" href="styles.css" />
</head>
<body>
<?php
	//get user from facebook object
	$user = $facebook->getUser();
	
	if ($user): //check for existing user id

		//print logout link
		echo '<a href="logout.php">logout</a>';

		//Insert Query Here
		$moviefriends_graph = $facebook->api(array(
			'method' => 'fql.query',
			'query' => "SELECT name, uid, movies, pic_square FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND movies !='' LIMIT 10"
		));
		
		foreach ($moviefriends_graph as $key => $value) {
			echo '<img src="', $value['pic_square'],' alt="', $value['name'], '" />';
		}
		
	else: //user doesn't exist
		$loginUrl = $facebook->getLoginUrl(array(
			'diplay'=>'popup',
			'scope'=>'email, friends_likes',
			'redirect_uri' => 'http://apps.facebook.com/viewsourcephp/fqlquery.php'
		));
		echo '<p><a href="', $loginUrl, '" target="_top">login</a></p>';
	endif; //check for user id
?>
</body>
</html>
