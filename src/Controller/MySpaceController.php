<?php

namespace App\Controller;

use App\Model\LanguageManager;
use App\Model\PostManager;

class MySpaceController extends AbstractController
{


    /**
     * Display My space page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index($user)
    {
        $languageManager = new LanguageManager();
        $languageManager = $languageManager->selectAll();
        $allMyFavoris = new PostManager();
        $allMyFavoris = $allMyFavoris->selectAllMyFavoris($user);
        $allMyPosts = new PostManager();
        $allMyPosts = $allMyPosts->selectAllMyPosts($user);
        return $this->twig->render('MySpace/myspacepage.html.twig', [
            'languages' => $languageManager,
            'favoris' => $allMyFavoris,
            'myposts' => $allMyPosts,
        ]);
    }
}
