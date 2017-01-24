<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class MessagesModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $content;
  public $date;
  public $users_id;
  public $to_users_id;

  //Méthode init de peuplement des propriétés
  public function init($id = 'NULL', $content, $date, $users_id, $to_users_id)
  {
    $this->__set('id',$id);
    $this->__set('content',$content);
    $this->__set('date',$date);
    $this->__set('users_id',$users_id);
    $this->__set('to_users_id',$to_users_id);
  }

  //Getters: on recupere une propriete de l'objet
  public function __get($value) {
    if($value==="id") {
      return $this -> id;
    } elseif ($value==="content") {
      return $this -> content;
    } elseif ($value==="date") {
      return $this -> date;
    } elseif ($value==="users_id") {
      return $this -> users_id;
    } elseif ($value==="to_users_id") {
      return $this -> to_users_id;
    } else {
      throw new Exception('Propriété invalide !');
    }
  }

  //Setters: on modifie une propriete d'un objet
  public function __set($value, $arg) {
    if($value==="id") {
      $this -> id = $arg;
    } elseif ($value==="content") {
      $this -> content = $arg;
    } elseif ($value==="date") {
      $this -> date = $arg;
    } elseif ($value==="users_id") {
      $this -> users_id = $arg;
    } elseif ($value==="to_users_id") {
      $this -> to_users_id = $arg;
    }
  }
}
