<?php

namespace Anax\Question;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Tag extends ActiveRecordModel
{

    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "proj_tags";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     *@var string $tag
     */
    public $id;
    public $tag;
    public $used;

    /**
     * Add a question to the session.
     *
     * @param array $tags
     *
     * @return void
     */
    public function addTag($tags)
    {
        foreach ($tags as $tag) {
            $this->findWhere("tag = ?", [$tag]);
            if ($this->tag != $tag) {
                $this->id = null;
                $this->tag  = $tag;
                $this->used = 1;
                $this->save();
            } else {
                $this->used += 1;
                $this->save();
            }
        }
    }

    /**
     * Decrease use column of tag
     *
     * @param array $tagId
     *
     * @return void
     */
    public function decreaseUsed($tagId)
    {
        $this->findWhere("id = ?", [$tagId]);
        $this->used -= 1;
        if ($this->used > 0) {
            $this->save();
        } else {
            $this->delete($tagId);
        }

    }

}
