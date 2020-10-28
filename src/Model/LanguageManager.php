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


    public function selectCategories(): array
    {
        return $this->pdo->query('SELECT identifier FROM ' . $this->table)->fetchAll();
    }




}


