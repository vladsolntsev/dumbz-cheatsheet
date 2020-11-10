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

}