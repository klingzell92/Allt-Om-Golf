<?php

namespace Anax\Answer;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Answer\Answer;
use \Anax\User\User;

/**
 * A controller for the Answer module
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class AnswerController implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * Create a new answer
     *
     * @return void
     */
    public function postAnswer()
    {
        $session = $this->di->get("session");
        $answer = new Answer();
        $answer->setDb($this->di->get("db"));
        $user = new User();
        $user->setDb($this->di->get("db"));
        $username = $session->get("username");
        $articleId = $_POST["articleId"];
        $commentId = $_POST["commentId"];
        $content = $_POST["answer"];
        $gravatar = "https://www.gravatar.com/avatar/" . $answer->convertEmail($session->get("email"));
        $answer->addAnswer($commentId, $username, $content, $gravatar);
        $user->increaseActivity($username);
        $this->di->get("response")->redirect("question/$articleId");
    }

    /**
     * Create a new answer
     *
     * @return void
     */
    public function postAnswerQuestion()
    {
        $session = $this->di->get("session");
        $answer = new Answer();
        $answer->setDb($this->di->get("db"));
        $user = new User();
        $user->setDb($this->di->get("db"));
        $username = $session->get("username");
        $articleId = $_POST["articleId"];
        $content = $_POST["answer"];
        $gravatar = "https://www.gravatar.com/avatar/" . $answer->convertEmail($session->get("email"));
        $answer->addAnswerQuestion($articleId, $username, $content, $gravatar);
        $user->increaseActivity($username);
        $this->di->get("response")->redirect("question/$articleId");
    }

    /**
     * Edit a answer
     *
     * @param string $answerId for the answer to edit
     *
     * @return void
     */

    public function showEdit($id, $articleId)
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("db"));
        $this->di->get("view")->add("answer/edit", [
         "values" => $answer->find("id", $id),
         "articleId" => $articleId
        ]);

       // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Edit",
        ]);
    }

    /**
     * Save the edited post
     *
     * @return void
     */

    public function saveEdit()
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("db"));
        $id = $_POST["id"];
        $content = $_POST["answer"];
        $answer->updateAnswer($id, $content);
        $this->di->get("response")->redirect("answer");
    }

    /**
     * Delete a post
     *
     * @param string $postId for the post to delete
     *
     * @return void
     */

    public function deleteAnswer($id, $articleId)
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("db"));
        $user = new User();
        $user->setDb($this->di->get("db"));
        $comment = $answer->findByID($id);
        $user->decreaseActivity($comment->user);
        $answer->deleteAnswer($id);
        $this->di->get("response")->redirect("question/$articleId");
    }

    /**
    * Upvote a comment
    * @param int asnwerId
    * @param int articleId
    *
    *@return void
    */

    public function answerUpVote($userId, $answerId, $articleId)
    {
        $answer= new Answer();
        $answer->setDb($this->di->get("db"));
        $answerVote = new answerVote();
        $answerVote->setDb($this->di->get("db"));

        $answer->upVote($answerId);
        $answerVote->addVote($userId, $answerId);
        $this->di->get("response")->redirect("question/$articleId");
    }

    /**
    * Downvote a comment
    * @param int answerId
    * @param int articleId
    *
    *@return void
    */

    public function answerDownVote($userId, $answerId, $articleId)
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("db"));
        $answerVote = new answerVote();
        $answerVote->setDb($this->di->get("db"));
        $answer->downVote($answerId);
        $answerVote->addVote($userId, $answerId);
        $this->di->get("response")->redirect("question/$articleId");
    }

    /**
    * Check if user has voted on the answer
    *
    * @return void
    */
    public function checkIfVoted($userId, $answerId)
    {
        $answerVote = new answerVote();
        $answerVote->setDb($this->di->get("db"));
        $exists = $answerVote->findWhere("userId = ? and answerId = ?", [$userId, $answerId]);
        if ($exists) {
            return true;
        } else {
            return false;
        }
    }
}
