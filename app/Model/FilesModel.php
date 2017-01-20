<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class MessagesModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $name;
  public $type;
  public $size;
  public $projects_id;

  //constructeur standard, redéfini sur celui hérité de Model
  public function __construct($id = 'NULL', $name, $type, $size, $projects_id)
  {
    $this->setTableFromClassName();
    $this->dbh = ConnectionModel::getDbh();
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













}
