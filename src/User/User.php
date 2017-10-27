<?php

namespace Anax\User;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class User extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "proj_user";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $acronym;
    public $email;
    public $password;
    public $activity;

    /**
     * Set the password.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verify the acronym and the password, if successful the object contains
     * all details from the database row.
     *
     * @param string $acronym  acronym to check.
     * @param string $password the password to use.
     *
     * @return boolean true if acronym and password matches, else false.
     */
    public function verifyPassword($acronym, $password)
    {
        $this->find("acronym", $acronym);
        return password_verify($password, $this->password);
    }

    /**
     * Fetch data from the database for a specific user
     *
     * @param string $acronym  acronym for the user.
     *
     * @return array data for the user.
     */
    public function getUserData($acronym)
    {
        $data = $this->find("acronym", $acronym);
        return $data;
    }

    /**
     * Increase the activity of a user
     *
     * @param string $acronym  acronym for the user.
     *
     * @return void
     */
    public function increaseActivity($acronym)
    {
        $this->find("acronym", $acronym);
        $this->activity += 1;
        $this->save();
    }

    /**
     * Decrease the activity of a user
     *
     * @param string $acronym  acronym for the user.
     *
     * @return void
     */
    public function decreaseActivity($acronym)
    {
        $this->find("acronym", $acronym);
        $this->activity -= 1;
        $this->save();
    }
}
