<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],

		// route pour l'inscription de l'utilisateur
		["GET|POST", "/inscriptionUser","User#inscriptionUser", "user_inscriptionUser"]

		// route de redirection vers les pages DMI
		['GET', '/[:target]', 'Nav#linkNav', 'nav_linkNav'],

	);
