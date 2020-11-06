<?php


namespace App\Model;

use Michelf\MarkdownExtra;


class LanguageManager extends AbstractManager
{
    const TABLE = 'language';

    /**
     *  Initializes this class.
     */

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    private function cleanPosts($posts)
    {
        $cleanPost = [];
        foreach ($posts as $post) {
            $post['content'] = MarkdownExtra::defaultTransform($post['content']);
            $cleanPost[] = $post;
        }
        return $cleanPost;
    }

    public function selectPostsByLanguageOrderedBy(int $id, $order): array
    {
        $posts = $this->pdo->query('SELECT *, post.id as post_unique_id, (post.nbOfLikes - post. nbOfDislikes) as popularity FROM post LEFT JOIN ' . $this->table . ' ON post.language_id = language.id HAVING language.id = "' . $id . '" ORDER BY ' . $order . ' DESC;')->fetchAll();
        return $this->cleanPosts($posts);
    }


}


