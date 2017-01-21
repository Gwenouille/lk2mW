<?php

namespace Controller;

use \W\Controller\Controller;
use Model\NewsModel;
use \W\Model\Model;

class NewsController extends Controller
{


	public function home()
	{
    $newsList = new NewsModel();
    $list = $newsList -> findAll();
    var_dump($list);
    die();
	$this->show("news/NewsView", ['connectLinkChoice' => false]);
	}


	public function page($id)
	{
    var_dump($id);
    die();
    $newsList = new NewsModel();
    $list = $newsList -> find($id);
		$this->show("news/NewsView", ['connectLinkChoice' => false]);
	}

	public function edit()
	{
		

	}




}
