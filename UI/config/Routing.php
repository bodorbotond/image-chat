<?php

return Array(
		'class' => 'yii\web\UrlManager',
		'enablePrettyUrl' => true,
		'enableStrictParsing' => true,
		'showScriptName' => false,
		'rules' => Array (
				'/' 								=> 'site/index',
				"site/about" 						=> "site/about",

				"user/login"						=> "user/login",
				"user/logout"						=> "user/logout",
				"user/signup"						=> "user/sign-up",
				"user/profile/show/<userId:\d+>"	=> "user/show-profile",
				"user/profile/edit/<userId:\d+>"	=> "user/edit-profile",
				"friends/index"						=> "friends/index",
				"friends/search" 					=> "friends/search",
				"friends/add/<friendId:\d+>"		=> "friends/add-friend",
				"friends/delete/<relationId:\d+>" 	=> "friends/delete-friend",
				"message/index"						=> "message/index",
				"image/index"						=> "image/index",
				),
		);