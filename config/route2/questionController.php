<?php
return [
    "routes" => [
        [
            "info" => "Start page",
            "requestMethod" => null,
            "path" => "start",
            "callable" => ["questionController", "showStart"],
        ],
        [
            "info" => "Display all questions and question form",
            "requestMethod" => null,
            "path" => "",
            "callable" => ["questionController", "showQuestions"],
        ],
        [
            "info" => "Show create",
            "requestMethod" => null,
            "path" => "create",
            "callable" => ["questionController", "showCreate"],
        ],
        [
            "info" => "Show a question",
            "requestMethod" => "get",
            "path" => "{id:digit}",
            "callable" => ["questionController", "showQuestion"],
        ],
        [
            "info" => "Show a question with sorted comments",
            "requestMethod" => "get",
            "path" => "{id:digit}/{sort:alphanum}",
            "callable" => ["questionController", "showQuestionSort"],
        ],
        [
            "info" => "Show the edit page with values",
            "requestMethod" => "get",
            "path" => "edit/{id:digit}",
            "callable" => ["questionController", "showEdit"],
        ],
        [
            "info" => "Save the changes made from the edit",
            "requestMethod" => "post",
            "path" => "save",
            "callable" => ["questionController", "saveEdit"],
        ],
        [
            "info" => "Post a question",
            "requestMethod" => "post",
            "path" => "post",
            "callable" => ["questionController", "postQuestion"],
        ],
        [
            "info" => "Delete Question",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}/{username:alphanum}",
            "callable" => ["questionController", "deletePost"],
        ],
        [
            "info" => "Upvote a question",
            "requestMethod" => "get",
            "path" => "up/{userId:digit}/{questionId:digit}",
            "callable" => ["questionVoteController", "questionUpVote"],
        ],
        [
            "info" => "Downvote a comment",
            "requestMethod" => "get",
            "path" => "down/{userId:digit}/{questionId:digit}",
            "callable" => ["questionVoteController", "questionDownVote"],
        ],
    ]
];
