<?php

namespace Anax\Question;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Question extends ActiveRecordModel
{

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "proj_question";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $user;
    public $title;
    public $gravatar;
    public $content;
    public $accepted;
    public $points;
    public $created;

    /**
     * Add a question to the session.
     *
     * @param string $username
     * @param string $question
     * @param string $gravatar
     *
     * @return void
     */
    public function addQuestion($username, $title, $question, $gravatar)
    {
        $this->user  = $username;
        $this->title = $title;
        $this->content = $question;
        $this->gravatar = $gravatar;
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
    * Delete post
    *@param int id
    *
    *@return void
    */

    public function deletePost($id)
    {
        $this->delete($id);
    }

    /**
     * Update question
     *
     * @param int $id
     * @param string $user
     * @param string $content
     *
     * @return void
     */
    public function updateQuestion($id, $title, $content)
    {
        $this->find("id", $id);
        $this->title = $title;
        $this->content = $content;
        $this->save();
    }

    /**
    *Upvote a question
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
    *Downvote a question
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

    /**
    *Accept a answer
    *
    *@param int $id
    *
    *@return void
    */
    public function acceptAnswer($id)
    {
        $this->find("id", $id);
        $this->accepted = true;
        $this->save();
    }
}
