<?php


namespace App\Controller;


use App\Model\ItemManager;
use App\Model\LanguageManager;
use App\Model\PostManager;

class PostController extends AbstractController
{
    public function post (){
        $postManager = new PostManager();
        $posts = $postManager->selectAll();
        $langManager = new postManager();
        $languages = $langManager->combinedSelectAll();
        return $this->twig->render('Item/postmodel.html.twig', ['posts' => $posts,'languages' => $languages]);
    }



}