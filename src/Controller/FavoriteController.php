<?php


namespace App\Controller;

use App\Model\LanguageManager;
use App\Model\AbstractManager;
use App\Model\PostManager;

class FavoriteController extends AbstractController
{

    public function add()
    {
        $json = file_get_contents('php://input');
        $jsonData = json_decode($json, true);
        $postId = $jsonData['cheatsheet'];
        $userId = $jsonData['userid'];
        $postManager = new PostManager();
        $postManager->addFavorite($postId, $userId);
        $response = [
            'status' =>'success',
            'user' => $userId,
            'cheat' =>$postId
        ];
    }
}
