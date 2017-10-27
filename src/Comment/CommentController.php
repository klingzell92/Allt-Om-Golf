<?php

namespace Anax\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Comment\Comment;
use \Anax\User\User;

/**
 * A controller for the Comment module
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class CommentController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * Create a new item by getting the entry from the request body and add
     * to the dataset.
     *
     * @return void
     */
    public function postComment()
    {
        $session = $this->di->get("session");
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $user = new User();
        $user->setDb($this->di->get("db"));
        $username = $session->get("username");
        $content = $_POST["comment"];
        $id = $_POST["articleId"];
        $gravatar = "https://www.gravatar.com/avatar/" . $comment->convertEmail($session->get("email"));
        $comment->addComment($id, $username, $content, $gravatar);
        $user->increaseActivity($username);
        $this->di->get("response")->redirect("question/$id");
    }

    /**
     * Get comments
     *
     * @return array
     */

    public function showComments()
    {
        //$this->start();
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $this->di->get("view")->add("comment/comment", [
         "comments" => $comment->findAll()
        ]);

       // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Comment",
        ]);
    }

    /**
     * Edit a post
     *
     * @param string $postId for the post to edit
     *
     * @return void
     */

    public function showEdit($postId, $articleId)
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));

        $this->di->get("view")->add("comment/edit", [
         "values" => $comment->find("id", $postId),
         "articleId" => $articleId,
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
        $session = $this->di->get("session");
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));

        $id = $_POST["id"];
        $content = $_POST["comment"];
        $articleId = $_POST["articleId"];
        $comment->updateComment($id, $content);
        $this->di->get("response")->redirect("question/$articleId");
    }

    /**
     * Delete a post
     *
     * @param string $postId for the post to delete
     *
     * @return void
     */

    public function deletePost($postId, $articleId, $username)
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $user = new User();
        $user->setDb($this->di->get("db"));

        $comment->deletePost($postId);
        $user->decreaseActivity($username);
        $this->di->get("response")->redirect("question/$articleId");
    }
}
