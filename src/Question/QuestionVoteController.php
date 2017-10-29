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
class QuestionVoteController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

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
}
