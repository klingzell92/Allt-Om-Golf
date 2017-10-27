<?php

namespace Anax\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\User\User;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $user = $this->getUserData($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update details of the item",
            ],
            [


                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->id,
                ],
                "user" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->acronym,
                ],

                "email" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->email,
                ],

                "password" => [
                    "type"        => "password",
                    "placeholder" => "Lämna tomt för att inte uppdatera lösenord",
                ],

                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "type"      => "reset",
                ],
            ]
        );
    }

    /**
     * Fetch data from the database for a specific user with id
     *
     * @param string $id  id for the user.
     *
     * @return array data for the user.
     */
    public function getUserData($id)
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        $data = $user->find("id", $id);
        return $data;
    }


    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $acronym       = $this->form->value("user");
        $email       = $this->form->value("email");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");

        // Check password matches
        if ($password !== $passwordAgain) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        // Save to database
        // $db = $this->di->get("db");
        // $password = password_hash($password, PASSWORD_DEFAULT);
        // $db->connect()
        //    ->insert("User", ["acronym", "password"])
        //    ->execute([$acronym, $password]);
        $user = new User();
        $user->setDb($this->di->get("db"));
        //var_dump($id);
        $user->find("id", $this->form->value("id"));
        $user->acronym = $acronym;
        $user->email = $email;
        if ($password == null) {
            $password = $user->password;
        } else {
            $user->setPassword($password);
        }


        $user->save();

        $this->form->addOutput("Användaren uppdaterades");
        return true;
    }
}
