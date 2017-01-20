<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class ProjectsModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $name;
  public $date;
  public $descrition;

  //constructeur standard, redéfini sur celui hérité de Model
  public function __construct($id = 'NULL', $name, $date, $description)
  {
    $this->setTableFromClassName();
    $this->dbh = ConnectionModel::getDbh();
    $this->__set('id',$id);
    $this->__set('name',$name);
    $this->__set('date',$date);
    $this->__set('description',$description);
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













}
