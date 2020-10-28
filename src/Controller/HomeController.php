<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\LanguageManager;
use App\Model\PostManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $langManager = new LanguageManager();
        $statement = $langManager->selectAll();

        $allPostManager = new PostManager();
        $allPosts = $allPostManager->combinedSelectAll();

        $allPostByDateManager = new PostManager();
        $allPostsByDate = $allPostByDateManager->selectAllByDate();

        $allPostByPopManager = new PostManager();
        $allPostsByPop = $allPostByPopManager->selectAllByPopularity();

        $categoryManager = new LanguageManager();
        $categories = $categoryManager->selectCategories();

        foreach ($categories as $category){
            foreach ($category as $key => $eachlanguage) {
                $catManager = new PostManager();
                $languages = $catManager->postByLanguage("'" . $eachlanguage . "'");
                $languagesSelection[$eachlanguage] =$languages;
            }
        }


        return $this->twig->render('Home/index.html.twig', [
            'languages'=> $statement,
            'allposts' => $allPosts,
            'allpostsByDate' => $allPostsByDate,
            'allpostsByPop' => $allPostsByPop,
            'PostsbyLang' => $languagesSelection ]);

    }
}
