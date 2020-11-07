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

    public function createUser($userData)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `email`, `password`) 
        VALUES (:name, :email, :password)");
        $statement->bindValue('name', $userData['name'], \PDO::PARAM_STR);
        $statement->bindValue('email', $userData['email'], \PDO::PARAM_STR);
        $statement->bindValue('password', $userData['password'], \PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function selectOneByName(string $name): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE name=:name");
        $statement->bindValue('name', $name, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }
    /*
        public function selectOneByNameAndPassword(string $name,string $password): int
        {
            $statement = $this->pdo->prepare("SELECT id FROM $this->table WHERE name=:name AND password=:password");
            $statement->bindValue('name', $name, \PDO::PARAM_STR);
            $statement->bindValue('password', $password, \PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch();
        }
    */

}