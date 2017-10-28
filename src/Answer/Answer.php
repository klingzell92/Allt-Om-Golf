<?php

namespace Anax\Answer;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Answer extends ActiveRecordModel
{

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "proj_answer";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $commentId;
    public $questionId;
    public $user;
    public $content;
    public $points;
    public $created;

    /**
     * Add a answer to the session.
     *
     * @param string $username
     * @param string $answer
     * @param string $gravatar
     *
     * @return void
     */
    public function addAnswer($commentId, $username, $answer)
    {
        $this->user  = $username;
        $this->commentId = $commentId;
        $this->content = $answer;
        date_default_timezone_set('Europe/Stockholm');
        $this->created = date('Y-m-d H:i:s', time());
        $this->save();
    }

    /**
     * Add a answer to the session.
     *
     * @param string $username
     * @param string $answer
     *
     * @return void
     */
    public function addAnswerQuestion($questionId, $username, $answer)
    {
        $this->user  = $username;
        $this->questionId = $questionId;
        $this->content = $answer;
        date_default_timezone_set('Europe/Stockholm');
        $this->created = date('Y-m-d H:i:s', time());
        $this->save();
    }

    /**
     * Convert email to md5 string
     *
     * @return string
     */
    public function convertEmail($email)
    {
        return md5(strtolower(trim($email)));
    }

    /**
    * Delete answer
    *@param int id
    *
    *@return void
    */

    public function deleteAnswer($id)
    {
        $this->delete($id);
    }

    /**
     * Update answer
     *
     * @param int $id
     * @param string $content
     *
     * @return void
     */
    public function updateAnswer($id, $content)
    {
        $this->find("id", $id);
        $this->content = $content;
        $this->save();
    }
    /**
    *Upvote a comment
    *
    *@param int $id
    *
    *@return void
    */
    public function upVote($id)
    {
        $this->find("id", $id);
        $this->points += 1;
        $this->save();
    }

    /**
    *Downvote a comment
    *
    *@param int $id
    *
    *@return void
    */
    public function downVote($id)
    {
        $this->find("id", $id);
        $this->points -= 1;
        $this->save();
    }
}
