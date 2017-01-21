<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class ProjectsModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $name;
  public $date;
  public $description;

  //Méthode init de peuplement des propriétés
  public function init($id = 'NULL', $name='', $date='', $description='')
  {
    $this -> __set('id',$id);
    $this -> __set('name',$name);
    $this -> __set('date',$date);
    $this -> __set('description',$description);
  }

  //Getters: on recupere une propriete de l'objet
  public function __get($value) {
    if($value==="id") {
      return $this -> id;
    } elseif ($value==="name") {
      return $this -> name;
    } elseif ($value==="date") {
      return $this -> date;
    } elseif ($value==="description") {
      return $this -> description;
    } else {
      throw new Exception('Propriété invalide !');
    }
  }

  //Setters: on modifie une propriete d'un objet
  public function __set($value, $arg) {
    if($value==="id") {
      $this -> id = $arg;
    } elseif ($value==="name") {
      $this -> name = $arg;
    } elseif ($value==="date") {
      $this -> date = $arg;
    } elseif ($value==="description") {
      $this -> description = $arg;
    }
  }


	/**
	 * Récupère toutes les lignes de la table
	 * @param $id L'utilisateur dont on veut récupérer les projets
	 */
	public function findAllProjectsFromUser($id)
	{
		$sql = 'SELECT * FROM ' . $this -> table . ' INNER JOIN projects_has_users ON '.$this -> table.'.id=projects_id';

		$sql .= ' WHERE users_id = '.$id;

		$sth = $this -> dbh -> prepare($sql);
		$sth -> execute();

		return $sth -> fetchAll();
	}
}
