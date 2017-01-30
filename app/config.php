<?php

$w_config = [
   	//information de connexion à la bdd
	'db_host' => 'localhost',						//hôte (ip, domaine) de la bdd
  'db_user' => 'root',							//nom d'utilisateur pour la bdd
  'db_pass' => '',								//mot de passe de la bdd
  'db_name' => 'c1lk2m',								//nom de la bdd
  'db_table_prefix' => '',						//préfixe ajouté aux noms de table


	//authentification, autorisation
	'security_user_table' => 'users',				//nom de la table contenant les infos des utilisateurs
	'security_id_property' => 'id',					//nom de la colonne pour la clef primaire
	'security_username_property' => 'lastname',		//nom de la colonne pour le "nom"
	'security_userfirstname_property' => 'firstname',		//nom de la colonne pour le "prénom"
	'security_email_property' => 'mail',			//nom de la colonne pour l'"email"
	'security_password_property' => 'password',		//nom de la colonne pour le "mot de passe"
	'security_phone_property' => 'phone',		//nom de la colonne pour le "n° Tel"
	'security_log_property' => 'log',		//nom de la colonne pour le "log"
	'security_role_property' => 'roles_id',				//nom de la colonne pour le "role"
	'security_status_property' => 'status',				//nom de la colonne pour le "status"

	'security_login_route_name' => 'user_signin',			//nom de la route affichant le formulaire de connexion

	// configuration globale
	'site_name'	=> 'Digital Manufacture Innovation', 								// contiendra le nom du site
];

require('routes.php');
// require_once realpath('..\vendor\phpmailer\phpmailer\PHPMailerAutoload.php');
