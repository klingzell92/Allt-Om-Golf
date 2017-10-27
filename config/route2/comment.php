<?php
return [
    "routes" => [
        [
            "info" => "Display all comments and comment form",
            "requestMethod" => null,
            "path" => "",
            "callable" => ["commentController", "showComments"],
        ],
        /*[
            "info" => "Start session",
            "requestMethod" => null,
            "path" => "**",
            "callable" => ["commentController", "start"],
        ],*/
        [
            "info" => "Delete Post",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}/{articleId:digit}/{username:alphanum}",
            "callable" => ["commentController", "deletePost"],
        ],
        [
            "info" => "Show the edit page with values",
            "requestMethod" => "get",
            "path" => "edit/{id:digit}/{articleId:digit}",
            "callable" => ["commentController", "showEdit"],
        ],
        [
            "info" => "Save the changes made from the edit",
            "requestMethod" => "post",
            "path" => "save",
            "callable" => ["commentController", "saveEdit"],
        ],
        [
            "info" => "Post a comment",
            "requestMethod" => "post",
            "path" => "post",
            "callable" => ["commentController", "postComment"],
        ],
    ]
];
