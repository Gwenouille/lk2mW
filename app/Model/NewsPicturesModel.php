<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;

class NewsPicturesModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $name;
  public $real_name;
  public $type;
  public $size;
  public $alt;
  public $news_id;
  public $state;

  //Méthode init de peuplement des propriétés
  public function init($id = 'NULL', $name, $real_name, $type, $size, $alt, $news_id, $state)
  {
    $this->__set('id',$id);
    $this->__set('name',$name);
    $this->__set('real_name',$real_name);
    $this->__set('type',$type);
    $this->__set('size',$size);
    $this->__set('alt',$alt);
    $this->__set('news_id',$news_id);
    $this->__set('state',$state);
  }

  // on recupere une propriete de l'objet
  public function __get($value) {
    if($value==="id") {
      return $this -> id;
    } elseif ($value==="name") {
      return $this -> name;
    } elseif ($value==="real_name") {
      return $this -> real_name;
    } elseif ($value==="type") {
      return $this -> type;
    } elseif ($value==="size") {
      return $this -> size;
    } elseif ($value==="alt") {
      return $this -> alt;
    } elseif ($value==="news_id") {
      return $this -> news_id;
    } elseif ($value==="state") {
      return $this -> state;
    } else {
      throw new Exception('Propriété invalide !');
    }
  }

  // on modifie une propriete d'un objet
  public function __set($value, $arg) {
    if($value==="id") {
      $this -> id = $arg;
    } elseif ($value==="name") {
      $this -> name = $arg;
    } elseif ($value==="real_name") {
      $this -> real_name = $arg;
    } elseif ($value==="type") {
      $this -> type = $arg;
    }  elseif ($value==="size") {
      $this -> size = $arg;
    }  elseif ($value==="alt") {
      $this -> alt = $arg;
    }  elseif ($value==="news_id") {
      $this -> news_id = $arg;
    }  elseif ($value==="state") {
      $this -> state = $arg;
    }
  }

  /**
   * Récupère les id des images correspondantes aux articles
   * @param  $news_id L'id de l'article
   */
  public function findPicturesFromArticle($news_id)
  {
    if (!is_numeric($news_id)){
      return false;
    }

    $sql = 'SELECT id FROM ' . $this->table . ' WHERE news_id = :news_id';
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(':news_id', $news_id);
    $sth->execute();
    return $sth->fetchAll();
  }


}
