<?php

namespace Anax\Comment;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Comment extends ActiveRecordModel
{

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "proj_comment";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $articleId;
    public $user;
    public $gravatar;
    public $content;
    public $accepted;
    public $points;
    public $created;

    /**
     * Add a comment to the session.
     *
     *@param int $articleId
     * @param string $username
     * @param string $comment
     * @param string $gravatar
     *
     * @return void
     */
    public function addComment($articleId, $username, $comment, $gravatar)
    {
        $this->articleId = $articleId;
        $this->user  = $username;
        $this->content = $comment;
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
     * Update Comment
     *
     * @param int $id
     * @param string $content
     *
     * @return void
     */
    public function updateComment($id, $content)
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
