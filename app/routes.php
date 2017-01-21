<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET', '/fabrication_additive/news', 'Default#news', 'default_news'],

		// route pour l'inscription de l'utilisateur
		["GET|POST", "/fabrication_additive/user/signin","User#signin", "user_signin"],

		// route pour le login et logout de l'utilisateur
		["GET|POST", "/fabrication_additive/user/login","User#login", "user_login"],
		["GET|POST", "/fabrication_additive/user/logout","User#logout", "user_logout"],

		// route de l'espace user: recupération des données de l'utilisateur afin de les afficher/modifier
		['GET', '/fabrication_additive/user/account', 'User#account', 'user_account'],

		// route de l'envoi de mail
		["GET", "/mail", "Mail#essai", "mail_essai"],

		// Affichage/modification d'une news en vue de la modification éventuelle: en fonction du $_POST ou du $_GET on appelle telle ou telle methode
		["GET|POST", "/fabrication_additive/news/[:id]", "News#edit", "news_edit"],

		// route de l'affichage des projets: demande au modele ProjectsModel de chercher les projets de l'utilisateur, envoie à la view ces projets, un projet vide a creer et le chat
		["GET", "/fabrication_additive/projects/", "Projects#home", "projects_home"],

		// envoi d'un message sur le chat
		["GET", "/fabrication_additive/projects/sendmsg", "Projects#sendmsg", "projects_sendmsg"],

		// Affichage/modification d'UN projet en vue de la modification éventuelle: en fonction du $_POST ou du $_GET on appelle telle ou telle methode
		["GET|POST", "/fabrication_additive/projects/[:id]", "Projects#edit", "projects_edit"],


		// route de redirection vers les pages DMI grace au controller default
		['GET', '/[:target]', 'Default#nav', 'default_nav'], // Cette ligne doit etre en dernière position afin de ne pas interpreter ce qui est derriere le slash en target par defaut
	);
