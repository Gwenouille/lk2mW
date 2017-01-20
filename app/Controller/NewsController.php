<?php

namespace Controller;

use \W\Controller\Controller;
use Model\NewsModel;
use \W\Model\Model;

class NewsController extends Controller
{

	public function edit($id)
	{
    $newsList = new NewsModel();
    $list = $newsList -> findAll();
		$this->show("news/NewsView", ['connectLinkChoice' => false]);
	}



}
