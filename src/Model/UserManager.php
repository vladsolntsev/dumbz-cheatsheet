<?php


namespace App\Model;


class UserManager extends AbstractManager
{
    const TABLE = 'user';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function userInfos($user): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE id = ' . $user . ';')->fetch();
    }

}