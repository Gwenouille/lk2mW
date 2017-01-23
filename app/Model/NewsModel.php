<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;
use Model\NewsPicturesModel;

class NewsModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $title;
  public $content;
  public $users_id;
  public $date_creation;
  public $date_modification;
  public $state;

  public function init($id = 'NULL', $title = "NULL", $content= "NULL", $users_id= "NULL", $date_creation= "NULL", $date_modification= "NULL", $state= "NULL") {
    $this->__set('id',$id);
    $this->__set('title',$title);
    $this->__set('content',$content);
    $this->__set('users_id',$users_id);
    $this->__set('date_creation',$date_creation);
    $this->__set('date_modification',$date_modification);
    $this->__set('state',$state);
  }

  // on recupere une propriete de l'objet
  public function __get($value) {
    if($value==="id") {
      return $this -> id;
    } elseif ($value==="title") {
      return $this -> title;
    } elseif ($value==="content") {
      return $this -> content;
    } elseif ($value==="users_id") {
      return $this -> users_id;
    } elseif ($value==="date_creation") {
      return $this -> date_creation;
    } elseif ($value==="date_modification") {
      return $this -> date_modification;
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
    } elseif ($value==="title") {
      $this -> title = $arg;
    } elseif ($value==="content") {
      $this -> content = $arg;
    } elseif ($value==="users_id") {
      $this -> users_id = $arg;
    } elseif ($value==="date_creation") {
      $this -> date_creation = $arg;
    } elseif ($value==="date_modification") {
      $this -> date_modification = $arg;
    } elseif ($value==="state") {
      $this -> state = $arg;
    }
  }

  /**
   * Récupère toutes les lignes de la table
   * @param $id L'utilisateur dont on veut récupérer les articles
   * @param $articleId L'id de l'article (int) dont on veut récupérer les données
   */
  public function findNewsFromUser($id,$articleId) {

    $sql = 'SELECT * FROM ' . $this -> table . ' WHERE users_id = '.$id;

    if(is_numeric($articleId)) $sql .= " AND ".$this->table.".id=".$articleId;

    $sth = $this -> dbh -> prepare($sql);
    $sth -> execute();

    $listArticles = $sth -> fetchAll();

    // Ajout des images liées aux articles dans le tableau, sous la clé 'pictures'
    $pictures = new NewsPicturesModel();
    foreach ($listArticles as $key => $value) {
      $listArticles[$key]['pictures'] = $pictures -> findPicturesFromArticle($listArticles[$key]['id']);
    }

    return $listArticles;
  }

}
