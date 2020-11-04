<?php


namespace App\Model;
use Michelf\MarkdownExtra;


class PostManager extends AbstractManager
{
    const TABLE = 'post';

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

    public function selectAllWithLanguage(): array
    {
        $posts = $this->pdo->query('SELECT *, post.id as post_unique_id, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id;')->fetchAll();
        return $this->cleanPosts($posts);
    }

    public function selectPostsOrderedBy($orderedBy): array
    {
        $posts = $this->pdo->query('SELECT *, post.id as post_unique_id, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id ORDER BY ' . $orderedBy . ' DESC;')->fetchAll();
        return $this->cleanPosts($posts);
    }

    public function postByLanguage($id): array
    {
        $posts = $this->pdo->query('SELECT *, post.id as post_unique_id,(post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id WHERE language.id=' . $id . ';')->fetchAll();
        return $this->cleanPosts($posts);
    }

    public function selectAllMyFavorites($user): array
    {
        $posts = $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN favorite ON post.id = favorite.post_id WHERE favorite.user_id=' . $user . ';')->fetchAll();
        return $this->cleanPosts($posts);
    }

    public function selectAllMyPosts($user): array
    {
        $posts = $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' WHERE post.user_id=' . $user . ';')->fetchAll();
        return $this->cleanPosts($posts);
    }

    public function postByKeyword($keyword): array
    {
        $statement= $this->pdo->prepare('SELECT * FROM ' . self::TABLE . ' WHERE title = :keyword;');;
        $statement->bindValue(':keyword', $keyword, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();

    }

}