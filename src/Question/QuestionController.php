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
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT * FROM proj_question  ORDER BY created DESC";
        $tag = new Tag();
        $tag->setDb($this->di->get("db"));
        $q2tag = new q2Tag();
        $q2tag->setDb($this->di->get("db"));

        $this->di->get("view")->add("question/index", [
         "questions" => $db->executeFetchAll($sql),
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

    public function showQuestion($id, $sort = "created")
    {
        $db = $this->di->get("db");
        $db->connect();
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $sql = "SELECT * FROM proj_comment WHERE articleId = $id ORDER BY $sort DESC";
        $answer = new Answer();
        $answer->setDb($this->di->get("db"));
        $tag = new Tag();
        $tag->setDb($this->di->get("db"));

        $view = $this->di->get("view");

        $view->add("question/question", [
         "question" => $question->findByID($id),
         "tags"     => $tag->findAll(),
         "relations" => $this->getRelations($id),
         "answers" => $answer->findAll()
        ]);
        $view->add("comment/comments", [
            "comments" => $db->executeFetchAll($sql),
            "answers" => $answer->findAll(),
            "article" => $question->find("id", $id)
        ]);
        $view->add("comment/create", [
            "id" => $id
        ]);
       // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Question",
        ]);
    }


    /**
     * Sort the comments for a quesiton
     *
     *@param int id
     *@param string sort
     */

    public function showQuestionSort($id, $sort)
    {
        $this->showQuestion($id, $sort);
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

    /**
    * Upvote a question
    * @param int questionId
    *
    *@return void
    */

    public function questionUpVote($userId, $questionId)
    {
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $questionVote = new questionVote();
        $questionVote->setDb($this->di->get("db"));

        $question->upVote($questionId);
        $questionVote->addVote($userId, $questionId);
        $this->di->get("response")->redirect("question/$questionId");
    }

    /**
    * Downvote a question
    * @param int questionId
    *
    *@return void
    */

    public function questionDownVote($userId, $questionId)
    {
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $questionVote = new questionVote();
        $questionVote->setDb($this->di->get("db"));
        $question->downVote($questionId);
        $questionVote->addVote($userId, $questionId);
        $this->di->get("response")->redirect("question/$questionId");
    }

    /**
    * Check if user has voted on the question
    *
    * @return void
    */
    public function checkIfVoted($userId, $questionId)
    {
        $questionVote = new questionVote();
        $questionVote->setDb($this->di->get("db"));
        $exists = $questionVote->findWhere("userId = ? and questionId = ?", [$userId, $questionId]);
        if ($exists) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Return number of comments for a quesiton
    *
    * @param $articleId
    *
    * @return void
    */
    public function getNumberOfComments($articleId)
    {
        $db = $this->di->get("db");
        $db->connect();
        $sql = "SELECT COUNT(id) AS rows FROM proj_comment WHERE articleId = $articleId";
        $result = $db->executeFetchAll($sql);
        return $result;
    }
}
