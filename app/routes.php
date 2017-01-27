<?php

	$w_routes = array(
		//Route de la page du site par défaut
		['GET', '/', 'Default#home', 'default_home'],

		//Route de la page contactez-nous
		['GET', '/contact', 'Default#contact', 'default_contact'],

		// Affichage de la page des news
		["GET|POST", "/fabrication_additive/news/", "News#home", "news_home"],

		// Affichage d'une page news particulière
		// ["GET|POST", "/fabrication_additive/news/[:id]/", "News#page", "news_page"],A developper si le temps le permet

		// route des news dans le compte admin (création/modification/affichage)
		['GET', '/fabrication_additive/admin/news', 'News#edit', 'news_edit'],

		// route vers les controleurs récupérant les requetes Ajax
		["POST", "/fabrication_additive/admin/news/newsShow", "News#ShowNews", "news_showNews"],
		["POST", "/fabrication_additive/admin/news/newsModify", "News#newsModify", "news_newsModify"],
		["POST", "/fabrication_additive/admin/news/newsAjaxModify", "News#newsAjaxModify", "news_newsAjaxModify"],
		["POST", "/fabrication_additive/admin/news/newsToggleCheckbox", "News#newsToggleCheckbox", "news_newsToggleCheckbox"],
		["POST", "/fabrication_additive/admin/news/newsToggleImgCheckbox", "News#newsToggleImgCheckbox", "news_newsToggleImgCheckbox"],

		// route vers les controleurs récupérant les requetes Ajax
		["POST", "/fabrication_additive/admin/users/usersShow", "Users#ShowUsers", "users_showUsers"],


		// route pour l'inscription de l'utilisateur
		["GET|POST", "/fabrication_additive/signin","User#signin", "user_signin"],

		// route pour le login et logout de l'utilisateur
		["GET|POST", "/fabrication_additive/login","User#login", "user_login"],
		["GET|POST", "/fabrication_additive/logout","User#logout", "user_logout"],

		// route de l'espace user: affichage de l'espace utilisateur
		['GET', '/fabrication_additive/user/', 'User#home', 'user_home'],

		// route du compte de l'utilisateur(données personnelles: affichage/modification)
		// ['GET', '/fabrication_additive/user/account', 'User#account', 'user_account'],

		// route du compte de l'utilisateur(données personnelles: affichage/modification)
		['POST', '/fabrication_additive/user/modifyCoordinates', 'User#modifyCoordinates', 'user_modifyCoordinates'],

		// route de l'envoi de mail
		["GET", "/mail", "Mail#essai", "mail_essai"],

		// route de l'affichage des projets: demande au modele ProjectsModel de chercher les projets de l'utilisateur, envoie à la view ces projets, un projet vide a creer et le chat
		["GET", "/fabrication_additive/projects/", "Projects#home", "projects_home"],

		// envoi d'un message sur le chat
		["GET|POST", "/fabrication_additive/projects/sendmsg", "Projects#sendmsg", "projects_sendmsg"],
		["POST", "/fabrication_additive/projects/reloadmsg", "Projects#reloadmsg", "projects_reloadmsg"],
		// Affichage/modification d'UN projet en vue de la modification éventuelle: en fonction du $_POST ou du $_GET on appelle telle ou telle methode
		["GET|POST", "/fabrication_additive/projects/[:id]", "Projects#edit", "projects_edit"],

		// route de redirection vers les pages DMI grace au controller default
		['GET', '/[:target]', 'Default#nav', 'default_nav'], // Cette ligne doit etre en dernière position afin de ne pas interpreter ce qui est derriere le slash en target par defaut
	);
