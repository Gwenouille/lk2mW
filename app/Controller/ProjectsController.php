<?php

namespace Controller;

use \W\Controller\Controller;
use Model\ProjectsModel;
use Model\FilesModel;

class ProjectsController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		var_dump($_SESSION);
		$user_id=$_SESSION['user']['id'];
		var_dump($user_id);
		$project = new ProjectsModel();
		// var_dump($project);
		$files = new FilesModel();
		$projectFiles=$files->findProjectsUserId(1);
		var_dump($projectFiles);

		// $list=$project->findAll();
		$list=$project->findAllFromUser($user_id);
		// var_dump($list);

		$html='<main class="main">';
		$html.='Ceci est mon contenu';
		$html.='</main>';

		$this->show("projects/home", ['connectLinkChoice' => true, 'html'=>$html,'projectsList' => $list]);
	}


}
