<?php

namespace Anax\Comment;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class CommentVote extends ActiveRecordModel
{

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "commentVotes";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $commentId;

    /**
     * Add a vote
     *
     *@param int $userId
     * @param string $commentId
     *
     * @return void
     */
    public function addVote($userId, $commentId)
    {
        $this->userId = $userId;
        $this->commentId  = $commentId;
        $this->save();
    }
}
