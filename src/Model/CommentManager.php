<?php


namespace App\Model;




class CommentManager extends AbstractManager
{
    const TABLE = 'comment';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addComment($userid, $content, $postid) :void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`user_id`, `content`, `creation_at`, `post_id`) VALUES (:userid, :content, now(), :postid)");
        $statement->bindValue(':userid', $userid, \PDO::PARAM_INT);
        $statement -> bindValue(':content', $content, \PDO::PARAM_STR);
        $statement -> bindValue(':postid', $postid, \PDO::PARAM_INT);
        $statement ->execute();
    }

    public function showComments() :array
    {
        $comment = $this->pdo->query("SELECT content, post_id FROM " . self::TABLE . ";");
        $comment->execute();
        $allComments = $comment->fetchAll();
        return $allComments;
    }
}
