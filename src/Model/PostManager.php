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
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_identifier = language.identifier;')->fetchAll();
    }

    public function selectAllByDate(): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_identifier = language.identifier ORDER BY creation_at DESC;')->fetchAll();
    }

    public function selectAllByPopularity(): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_identifier = language.identifier ORDER BY popularity DESC;')->fetchAll();
    }

    public function postByLanguage($identifier): array
    {
        return $this->pdo->query('SELECT *, (post.like - post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_identifier = language.identifier WHERE language.identifier=' . $identifier . ';')->fetchAll();
    }



}