<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET', '/news', 'Default#news', 'default_news'],

		// route pour l'inscription de l'utilisateur
		["GET|POST", "/user/signin","User#signin", "user_signin"],

		// route pour le login et logout de l'utilisateur
		["GET|POST", "/user/login","User#login", "user_login"],
		["GET|POST", "/user/logout","User#logout", "user_logout"],

		// route de l'espace user
		['GET', '/user/account', 'User#account', 'user_account'],

		// route de redirection vers les pages DMI
		['GET', '/[:target]/', 'Nav#linkNav', 'nav_linkNav'],

	);
