<?php


namespace App\Model;


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

    public function selectAllWithLanguage(): array
    {
        return $this->pdo->query('SELECT *, post.id as post_unique_id, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id;')->fetchAll();
    }

    public function selectPostsOrderedBy($orderedBy): array
    {
        return $this->pdo->query('SELECT *, post.id as post_unique_id, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id ORDER BY ' . $orderedBy . ' DESC;')->fetchAll();
    }

    public function postByLanguage($id): array
    {
        return $this->pdo->query('SELECT *, post.id as post_unique_id,(post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id WHERE language.id=' . $id . ';')->fetchAll();
    }

    public function selectAllMyFavorites($user): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN favorite ON post.id = favorite.post_id WHERE favorite.user_id=' . $user . ';')->fetchAll();

    }

    public function selectAllMyPosts($user): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' WHERE post.user_id=' . $user . ';')->fetchAll();
    }

    public function createPost($user, $title, $content, $language): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (user_id, title, content, language_id, creation_at) VALUES (:user, :title, :content, :language, now())");
            $statement->bindValue('user', $user, \PDO::PARAM_INT);
            $statement->bindValue('title', $title, \PDO::PARAM_STR);
            $statement->bindValue('content', $content, \PDO::PARAM_STR);
            $statement->bindValue('language', $language, \PDO::PARAM_INT);
            $statement->execute();
    }

    public function postByKeyword($keyword): array
    {
        $statement= $this->pdo->prepare('SELECT * FROM ' . self::TABLE . ' WHERE title = :keyword;');;
        $statement->bindValue(':keyword', $keyword, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }

}