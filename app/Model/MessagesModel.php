<?php

namespace Model;

use \W\Model\Model;

class MessagesModel extends Model {

// creer un message

public $id;
public $comment;
public $date;
public $users_id;

public function __construct($id = 'NULL', $comment, $date, $users_id)
{
  $this->setTableFromClassName();
  $this->dbh = ConnectionModel::getDbh();
}
// on recupere une propriete de l'objet
public function __GET($value) {
  if($value==="id") {
    return $this -> id;
  } elseif ($value==="comment") {
    return $this -> comment;
  } elseif ($value==="date") {
    return $this -> date;
  } elseif ($value==="users_id") {
    return $this -> users_id;
  }
}

// on modifie une propriete d'un objet
public function __SET($value, $arg) {
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
