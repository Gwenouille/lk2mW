<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],

		// route pour l'inscription de l'utilisateur
		["GET|POST", "/inscriptionUser","User#inscriptionUser", "user_inscriptionUser"],

		// route pour le login et logout de l'utilisateur
		["GET|POST", "/loginUser","UserConnect#loginUser", "userConnect_loginUser"],
		["GET|POST", "/logoutUser","UserConnect#logoutUser", "userConnect_logoutUser"],


		['GET', '/monCompte', 'User#myaccount', 'user_myaccount'],

		// route de l'envoi de mail
		["GET", "/mail", "Mail#essai", "mail_essai"],

		// route de redirection vers les pages DMI
		['GET', '/[:target]', 'Nav#linkNav', 'nav_linkNav'],
	);
