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

    public function combinedSelectAll(): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id;')->fetchAll();
    }

    public function selectAllByDate(): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id ORDER BY creation_at DESC;')->fetchAll();
    }

    public function selectAllByPopularity(): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id ORDER BY popularity DESC;')->fetchAll();
    }

    public function postByLanguage($identifier): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_id = language.id WHERE language.identifier=' . $identifier . ';')->fetchAll();
    }

    public function selectAllMyFavoris($user): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN favorite ON post.id = favorite.post_id WHERE favorite.user_id=' . $user . ';')->fetchAll();
    }

    public function selectAllMyPosts($user): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN user ON post.user_id = user.id WHERE post.user_id=' . $user . ';')->fetchAll();
    }

}