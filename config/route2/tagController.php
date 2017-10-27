<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "Show all questions",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["tagController", "showQuestions"],
        ],
        [
            "info" => "Show questions with a certain tag",
            "requestMethod" => "get",
            "path" => "{tagId:digit}",
            "callable" => ["tagController", "showQuestionsWithTag"],
        ],
    ]
];
