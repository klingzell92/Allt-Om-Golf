<?php

namespace Anax\Question;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class q2Tag extends ActiveRecordModel
{

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "proj_q2tag";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     *@var string $tag
     */
    public $id;
    public $questionId;
    public $tagId;


    /**
     * Add a question to the session.
     *
     * @param array $tagId
     *
     * @return void
     */
    public function addRelation($tagId, $questionId)
    {
        $this->id = null;
        $this->tagId = $tagId;
        $this->questionId = $questionId;
        $this->save();
    }

    /**
    * Delete relation
    *@param int questionId
    *
    *@return void
    */

    public function deleteQuestionRelation($questionId)
    {
        $this->deleteWhere("questionId = ?", [$questionId]);
    }

}
