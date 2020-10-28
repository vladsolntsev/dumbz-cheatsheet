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
        return $this->pdo->query('SELECT *, (post.like + post. dislike) as popularity FROM ' . $this->table . ' LEFT JOIN language ON post.language_identifier = language.identifier;')->fetchAll();
    }



}