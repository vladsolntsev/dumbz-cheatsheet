<?php

namespace App\Controller;

use App\Model\LanguageManager;
use App\Model\PostManager;

class LanguageController extends AbstractController
{
    public function language($id)
    {
        $languageManager = new LanguageManager();
        $categories = $languageManager->selectAll();

        $languageById = new LanguageManager();
        $allPostsOrderedByDate = $languageById->selectPostsByLanguageOrderedBy($id, 'creation_at');
        $allPostsOrderedByPopularity = $languageById->selectPostsByLanguageOrderedBy($id, 'popularity');
        $colors = ['#EE908A','#EEAE8A', '#EEDC8A', '#B5E1EE', '#D7B0EE' ];
        return $this->twig->render('Home/index.html.twig', [
            'languages' => $categories,
            'all_posts_by_date' => $allPostsOrderedByDate,
            'all_posts_by_pop' => $allPostsOrderedByPopularity,
            'colors' => $colors,
        ]);
    }
}