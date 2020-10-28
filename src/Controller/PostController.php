<?php


namespace App\Controller;


use App\Model\ItemManager;
use App\Model\LanguageManager;
use App\Model\PostManager;

class PostController extends AbstractController
{

    public function post (){
        $allPostManager = new PostManager();
        $allPosts = $allPostManager->combinedSelectAll();

        $allPostByDateManager = new PostManager();
        $allPostsByDate = $allPostByDateManager->selectAllByDate();

        $allPostByPopManager = new PostManager();
        $allPostsByPop = $allPostByPopManager->selectAllByPopularity();

        $categoryManager = new LanguageManager();
        $categories = $categoryManager->selectCategories();

        foreach ($categories as $category){
            foreach ($category as $key=>$eachlanguage) {
                $catManager = new PostManager();
                $languages = $catManager->postByLanguage("'" . $eachlanguage . "'");
                $languagesSelection[$eachlanguage] =$languages;
            }
        }


        return $this->twig->render('Item/postmodel.html.twig', ['allposts' => $allPosts, 'allpostsByDate' => $allPostsByDate, 'allpostsByPop' => $allPostsByPop, 'PostsbyLang' => $languagesSelection ]);
    }


}