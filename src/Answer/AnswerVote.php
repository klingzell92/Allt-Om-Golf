<?php

namespace Anax\Answer;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class AnswerVote extends ActiveRecordModel
{

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "answerVotes";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $answerId;

    /**
     * Add a vote
     *
     *@param int $userId
     * @param string $commentId
     *
     * @return void
     */
    public function addVote($userId, $answerId)
    {
        $this->userId = $userId;
        $this->answerId  = $answerId;
        $this->save();
    }
}
