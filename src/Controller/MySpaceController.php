<?php

namespace App\Controller;

use App\Model\LanguageManager;
use App\Model\PostManager;
use App\Model\UserManager;

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
    public function main($user)
    {
        $theUser = new UserManager();
        $theUser = $theUser->userInfos($user);
        $languageManager = new LanguageManager();
        $languageManager = $languageManager->selectAll();
        $allMyFavorites = new PostManager();
        $allMyFavorites = $allMyFavorites->selectAllMyFavorites($user);
        $allMyPosts = new PostManager();
        $allMyPosts = $allMyPosts->selectAllMyPosts($user);
        if (($_SERVER["REQUEST_METHOD"] === "POST")) {
            $thePost = new PostManager();
            $user = $theUser['id'];
            $title = $_POST['newPostTitle'];
            $content = $_POST['newPostContent'];
            $language = $_POST['newPostLanguage'];
            $thePost->createPost($user, $title, $content, $language);
        }
        $_SESSION['userid'] =  $theUser['id'];
        $this->twig->addGlobal('session', $_SESSION);
        return $this->twig->render('MySpace/myspacepage.html.twig', [
            'languages' => $languageManager,
            'favorites' => $allMyFavorites,
            'myposts' => $allMyPosts,
            'user' => $theUser,
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            if ($userData = $userManager->selectOneByName($_POST['name'])) {
                header('Location: /#registration');
            } else {
                $newUserData = [];
                $newUserData['name'] = $_POST['name'];
                $newUserData['email'] = $_POST['email'];
                $newUserData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $userID = $userManager->createUser($newUserData);
                //TODO login directly
                header('Location:/');
            }
        } else {
            echo '404';
        }
    }

    public function check()
    {
        $userManager = new UserManager();
        if ($userData = $userManager->selectOneByName($_POST['name'])) {
            if (password_verify($_POST['password'], $userData['password'])) {
                $_SESSION['user'] = $userData;
                header('Location: /MySpace/main/' . $userData['id']);
            } else {
                header('Location: /');
            }
        } else {
            header('Location: /');
        }
    }

    public function logout()
    {
        session_destroy();
        session_unset();
        header('Location: /');
    }
}
