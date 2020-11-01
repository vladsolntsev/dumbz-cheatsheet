<?php


namespace App\Controller;


use App\Model\LanguageManager;

class LanguageController extends AbstractController
{
    public function language(int $id)
    {
        $languageid = new LanguageManager();
        $language = $languageid->selectCategoriesById($id);

        return $this->twig->render('Item/_nav.html.twig', ['id' => $language]);
    }
}