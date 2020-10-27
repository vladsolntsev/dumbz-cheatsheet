<?php


namespace App\Model;


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





}
