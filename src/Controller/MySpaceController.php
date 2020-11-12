<?php

namespace App\Controller;

use App\Model\LanguageManager;
use App\Model\PostManager;
use App\Model\UserManager;
use App\Service\FormValidator;

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
        $allMyFavorites = $allMyFavorites->selectAll($user);
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
        $_SESSION['userid'] = $theUser['id'];
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
            if ($newUserData = $userManager->selectOneByName($_POST['name'])) {
                $_SESSION['nameErrorAlreadyExists'] = 'Ce nom est déjà utilisé, choisis en un autre';
                $errorsQueryString = http_build_query($_SESSION);
                header('Location: /#registration?' . $errorsQueryString);
            } else {
                $newUserData = [];
                $newUserData['name'] = $_POST['name'];
                $newUserData['email'] = $_POST['email'];
                $newUserData['email'] = filter_var($newUserData['email'], FILTER_VALIDATE_EMAIL);
                $newUserData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $userManager->createUser($newUserData);
                $userData = $userManager->selectOneByName($_POST['name']);
                $_SESSION['user'] = $userData;
                header('Location: /MySpace/main/' . $userData['id']);
            }
        } else {
            echo '404';
            //TODO add error messages abt password and email incorrect format
        }
    }
    public function check()
    {
        $userManager = new UserManager();
        if (empty($_POST['name']) || empty($_POST['password'])) {
            $_SESSION['nameError'] = 'Renseignes ton nom';
            $_SESSION['passwordError'] = 'Renseignes ton mot de passe';
            $errorsQueryString = http_build_query($_SESSION);
            header('Location: /#login?' . $errorsQueryString);
            session_destroy();
        } else {
            if ($userData = $userManager->selectOneByName($_POST['name'])) {
                if (password_verify($_POST['password'], $userData['password'])) {
                    $_SESSION['user'] = $userData;
                    header('Location: /MySpace/main/' . $userData['id']);
                } else {
                    header('Location: /#login');
                }
            } else {
                header('Location: /#login');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        session_unset();
        header('Location: /');
    }
    /*
    public function ajaxErrors()
    {
        $json = file_get_contents('php://input');
        $jsonData = json_decode($json, true);
        $nameError = $jsonData['name'];
        $passwordError = $jsonData['password'];
        $checkErrors = new MySpaceController();
        $checkErrors->check();
        $response = [
            'status' => 'success',
            'nameError' => $nameError,
            'passwordError' => $passwordError
        ];
        return json_encode($response);
    }
    */

}
