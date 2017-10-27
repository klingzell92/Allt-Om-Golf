<?php

namespace Anax\Question;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Question\Question;

/**
 * A controller for the Question module
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class TagController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

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

        $this->di->get("view")->add("tags/tags", [
         "tags" => $tag->findAll()
        ]);

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
     * Show questions with a certain tag
     *
     */

    public function showQuestionsWithTag($tagId)
    {
        //$this->start();
        $question = new Question();
        $question->setDb($this->di->get("db"));
        $tag = new Tag();
        $tag->setDb($this->di->get("db"));
        $q2tag = new q2Tag();
        $q2tag->setDb($this->di->get("db"));

        $questions = $question->findAll();
        $qWT = [];
        $relations = $q2tag->findAllWhere("tagId = ?", [$tagId]);
        foreach ($relations as $relation) {
            foreach ($questions as $question) {
                if ($question->id == $relation->questionId) {
                    $qWT[] = $question;
                }
            }
        }

        $this->di->get("view")->add("tags/tags", [
         "tags" => $tag->findAll()
        ]);

        $this->di->get("view")->add("question/index", [
         "questions" => $qWT,
         "tags"     => $tag->findAll(),
         "relations" => $q2tag->findAll()
        ]);

       // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Question",
        ]);
    }

}
