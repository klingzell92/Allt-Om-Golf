<?php
return [
    "routes" => [
        [
            "info" => "Delete Post",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}/{articleId:digit}",
            "callable" => ["answerController", "deleteAnswer"],
        ],
        [
            "info" => "Show the edit page with values",
            "requestMethod" => "get",
            "path" => "edit/{id:digit}/{articleId:digit}",
            "callable" => ["answerController", "showEdit"],
        ],
        [
            "info" => "Save the changes made from the edit",
            "requestMethod" => "post",
            "path" => "save",
            "callable" => ["answerController", "saveEdit"],
        ],
        [
            "info" => "Post a comment on answer",
            "requestMethod" => "post",
            "path" => "post",
            "callable" => ["answerController", "postAnswer"],
        ],

        [
            "info" => "Post a comment on question",
            "requestMethod" => "post",
            "path" => "post/comment",
            "callable" => ["answerController", "postAnswerQuestion"],
        ],

    ]
];
