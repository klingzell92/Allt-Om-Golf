<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "Show all users",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["userController", "showUsers"],
        ],
        [
            "info" => "User Controller index.",
            "requestMethod" => "get",
            "path" => "profile",
            "callable" => ["userController", "getIndex"],
        ],
        [
            "info" => "Login a user.",
            "requestMethod" => "get|post",
            "path" => "login",
            "callable" => ["userController", "getPostLogin"],
        ],
        [
            "info" => "Logout a user.",
            "requestMethod" => null,
            "path" => "logout",
            "callable" => ["userController", "logoutUser"],
        ],
        [
            "info" => "Create a user.",
            "requestMethod" => "get|post",
            "path" => "create",
            "callable" => ["userController", "getPostCreateUser"],
        ],
        [
            "info" => "Update a user.",
            "requestMethod" => "get|post",
            "path" => "update/{id:digit}",
            "callable" => ["userController", "getPostUpdateUser"],
        ],
        [
            "info" => "Admin page.",
            "requestMethod" => "get|post",
            "path" => "admin",
            "callable" => ["userController", "getAdminIndex"],
        ],
        [
            "info" => "Delete a user.",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}",
            "callable" => ["userController", "adminDeleteUser"],
        ],
        [
            "info" => "Show a user",
            "requestMethod" => "get",
            "path" => "profile/{user:alphanum}",
            "callable" => ["userController", "showUser"],
        ],
    ]
];
