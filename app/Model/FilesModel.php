<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class FilesModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $name;
  public $type;
  public $size;
  public $projects_id;

  //Méthode init de peuplement des propriétés
  public function init($id = 'NULL', $name, $type, $size, $projects_id)
  {
    $this->__set('id',$id);
    $this->__set('name',$name);
    $this->__set('type',$type);
    $this->__set('size',$size);
    $this->__set('projects_id',$projects_id);
  }

  //Getters: on recupere une propriete de l'objet
  public function __get($value) {
    if($value==="id") {
      return $this -> id;
    } elseif ($value==="name") {
      return $this -> name;
    } elseif ($value==="type") {
      return $this -> type;
    } elseif ($value==="size") {
      return $this -> size;
    } elseif ($value==="projects_id") {
      return $this -> projects_id;
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
    } elseif ($value==="type") {
      $this -> type = $arg;
    } elseif ($value==="size") {
      $this -> size = $arg;
    } elseif ($value==="projects_id") {
      $this -> projects_id = $arg;
    }
  }

  /**
	 * Récupère une ligne de la table en fonction d'un identifiant
	 * @param  $projects_id L'id du projet listant ces fichiers
	 */
	public function findFilesFromProjects($projects_id)
	{
		if (!is_numeric($projects_id)){
			return false;
		}

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE projects_id = :projects_id';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':projects_id', $projects_id);
		$sth->execute();

		return $sth->fetchAll();
	}










}
