<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET', '/[:target]', 'Nav#linkNav', 'nav_linkNav'],
	);
