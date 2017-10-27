<?php

namespace Anax\Question;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Question\Question;
use \Anax\Comment\Comment;
use \Anax\Answer\Answer;
use \Anax\User\User;

/**
 * A controller for the Question module
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class QuestionController implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * Show all the questions
     *
     */

    public function showStart()
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "
        SELECT * FROM proj_question
        ORDER BY created DESC
        LIMIT 5;
        ";
        $questions =  $db->executeFetchAll($sql);
        $sql = "
        SELECT * FROM proj_tags
        ORDER BY used DESC
        LIMIT 5;
        ";
        $tags =  $db->executeFetchAll($sql);
        $sql = "
        SELECT * FROM proj_user
        ORDER BY activity DESC
        LIMIT 5;
        ";
        $this->di->get("view")->add("question/start", [
         "questions" => $questions,
         "tags" => $tags,
         "users" => $db->executeFetchAll($sql)
        ]);

       // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Question",
        ]);
    }

    /**
     * Create a new item by getting the entry from the request body and add
     * to the dataset.
     *
     * @return void
     */
    public function postQuestion()
    {
        $session = $this->di->get("session");
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $tag = new Tag();
        $tag->setDb($this->di->get("db"));
        $q2tag = new q2Tag();
        $q2tag->setDb($this->di->get("db"));
        $user = new User();
        $user->setDb($this->di->get("db"));

        $username = $session->get("username");
        $title = $_POST["title"];
        $content = $_POST["question"];
        $tags = $_POST["tags"];
        $gravatar = "https://www.gravatar.com/avatar/" . $question->convertEmail($session->get("email"));
        $question->addQuestion($username, $title, $content, $gravatar);
        $questionId = $this->di->get("db")->lastInsertId();
        $tag->addTag(explode(",", $tags));
        foreach (explode(",", $tags) as $value) {
            $currentTag = $tag->findWhere("tag = ?", [$value]);
            $q2tag->addRelation($currentTag->id, $questionId);
        }
        $user->increaseActivity($username);
        $this->di->get("response")->redirect("question");
    }

    /**
     * Show creat form
     *
     * @return array
     */

    public function showCreate()
    {
        $this->di->get("view")->add("question/create");

       // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Skapa fråga",
        ]);
    }

    /**
     * Show all the questions
     *
     */

    public function showQuestions()
    {
        //$this->start();
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $tag = new Tag();
        $tag->setDb($this->di->get("db"));
        $q2tag = new q2Tag();
        $q2tag->setDb($this->di->get("db"));

        $this->di->get("view")->add("question/index", [
         "questions" => $question->findAll(),
         "tags"     => $tag->findAll(),
         "relations" => $q2tag->findAll()
        ]);

       // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Question",
        ]);
    }

    /**
     * Show a single question
     *
     *@param int id
     */

    public function showQuestion($id)
    {
        //$this->start();
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $comment = new Comment();
        $comment->setDb($this->di->get("db"));
        $answer = new Answer();
        $answer->setDb($this->di->get("db"));
        $tag = new Tag();
        $tag->setDb($this->di->get("db"));

        $view = $this->di->get("view");

        $view->add("question/question", [
         "question" => $question->findByID($id),
         "tags"     => $tag->findAll(),
         "relations" => $this->getRelations($id),
         "answers" => $answer->findAll(),
        ]);
        $view->add("comment/comments",[
            "comments" => $comment->findAllWhere("articleId = ?", [$id]),
            "answers" => $answer->findAll(),
            "articleId" => $id,
        ]);
        $view->add("comment/create",[
            "id" => $id,
        ]);
       // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Question",
        ]);
    }



    /**
     * Edit a post
     *
     * @param string $postId for the post to edit
     *
     * @return void
     */

    public function showEdit($postId)
    {
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $this->di->get("view")->add("question/edit", [
         "values" => $question->find("id", $postId)
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
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $id = $_POST["id"];
        $title = $_POST["title"];
        $content = $_POST["question"];
        $question->updateQuestion($id, $title, $content);
        $this->di->get("response")->redirect("question/$id");
    }

    /**
     * Delete a post
     *
     * @param string $postId for the post to delete
     *
     * @return void
     */

    public function deletePost($postId, $username)
    {
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $user = new User();
        $user->setDb($this->di->get("db"));
        $q2tag = new q2Tag();
        $q2tag->setDb($this->di->get("db"));
        $tag = new Tag();
        $tag->setDb($this->di->get("db"));
        $relations = $q2tag->findAllWhere("questionId = ?", [$postId]);

        foreach ($relations as $relation) {
            $tag->decreaseUsed($relation->tagId);
        }
        $q2tag->deleteQuestionRelation($postId);
        $question->deletePost($postId);
        $user->decreaseActivity($username);

        $this->di->get("response")->redirect("question");
    }

    /**
     * Get question to tag relations
     *
     * @param $questionId for the question to get tags for
     *
     * @return array
     */

    public function getRelations($questionId)
    {
        $q2tag = new q2Tag();
        $q2tag->setDb($this->di->get("db"));
        $relations = $q2tag->findAllWhere("questionId = ?", [$questionId]);
        return $relations;
    }


}
