<?php

use \Anax\Route\Router;

/**
 * Configuration file for routes.
 */
return [
    //"mode" => Router::DEVELOPMENT, // default, verbose execeptions
    //"mode" => Router::PRODUCTION,  // exceptions turn into 500

    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            // These are for internal error handling and exceptions
            "mount" => null,
            "file" => __DIR__ . "/route2/internal.php",
        ],
        [
            // For debugging and development details on Anax
            "mount" => "debug",
            "file" => __DIR__ . "/route2/debug.php",
        ],
        [
            // To read flat file content in Markdown from content/
            "mount" => null,
            "file" => __DIR__ . "/route2/flat-file-content.php",
        ],
        [
            // Keep this last since its a catch all
            "mount" => null,
            "sort" => 999,
            "file" => __DIR__ . "/route2/404.php",
        ],
        [
            // Routes for user
            "mount" => "user",
            "file" => __DIR__ . "/route2/userController.php",
        ],
        [
            // Routes for user
            "mount" => "question",
            "file" => __DIR__ . "/route2/questionController.php",
        ],
        [
            // Routes for comment
            "mount" => "comment",
            "file" => __DIR__ . "/route2/comment.php",
        ],
        [
            // Routes for answer
            "mount" => "answer",
            "file" => __DIR__ . "/route2/answerController.php",
        ],
        [
            // Routes for tags
            "mount" => "tags",
            "file" => __DIR__ . "/route2/tagController.php",
        ],
    ],

];