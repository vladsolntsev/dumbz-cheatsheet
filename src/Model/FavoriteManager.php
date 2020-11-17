<?php


namespace App\Model;


class FavoriteManager extends AbstractManager
{
    const TABLE = 'favorite';

    /**
     *  Initializes this class.
     */

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllFavoritePostId($user): array
    {
        return $this->pdo->query('SELECT post.id FROM post LEFT JOIN ' . $this->table . ' ON post.id = favorite.post_id WHERE favorite.user_id=' . $user . ';')->fetchAll();
    }

}