<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class MessagesModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $comment;
  public $date;
  public $users_id;

  //constructeur standard, redéfini sur celui hérité de Model
  public function __construct($id = 'NULL', $comment, $date, $users_id)
  {
    $this->setTableFromClassName();
    $this->dbh = ConnectionModel::getDbh();
    $this->__set('id',$id);
    $this->__set('comment',$comment);
    $this->__set('date',$date);
    $this->__set('users_id',$users_id);
  }

  //Getters: on recupere une propriete de l'objet
  public function __get($value) {
    if($value==="id") {
      return $this -> id;
    } elseif ($value==="comment") {
      return $this -> comment;
    } elseif ($value==="date") {
      return $this -> date;
    } elseif ($value==="users_id") {
      return $this -> users_id;
    } else {
      throw new Exception('Propriété invalide !');
    }
  }

  //Setters: on modifie une propriete d'un objet
  public function __set($value, $arg) {
    if($value==="id") {
      $this -> id = $arg;
    } elseif ($value==="comment") {
      $this -> comment = $arg;
    } elseif ($value==="date") {
      $this -> date = $arg;
    } elseif ($value==="users_id") {
      $this -> users_id = $arg;
    }
  }













}
