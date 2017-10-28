<?php

namespace Anax\Question;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class QuestionVote extends ActiveRecordModel
{

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "questionVotes";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $questionId;

    /**
     * Add a vote
     *
     *@param int $userId
     * @param string $cquestionId
     *
     * @return void
     */
    public function addVote($userId, $questionId)
    {
        $this->userId = $userId;
        $this->questionId  = $questionId;
        $this->save();
    }
}
