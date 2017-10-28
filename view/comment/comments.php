<?php
 $delete = $di->get("url")->create("comment/delete");
 $edit = $di->get("url")->create("comment/edit");
 $answerHandler = $di->get("url")->create("answer/post");
 $user = $di->get("url")->create("user/profile");
 $showArticle = $di->get("url")->create("question/$article->id");
 $commentUpVote = $di->get("url")->create("comment/up");
 $commentDownVote = $di->get("url")->create("comment/down");
 $answerUpVote = $di->get("url")->create("answer/up");
 $answerDownVote = $di->get("url")->create("answer/down");
 $commentAccept = $di->get("url")->create("comment/accept");
?>
<div class="sortAnswers">
    <a href="<?=$showArticle?>/created">Datum</a>
    <a href="<?=$showArticle?>/points">Poäng</a>
</div>
<?php
if ($comments) {
    foreach ($comments as $comment) :
?>
<table class="question">
    <tr>
        <td class="user">
            <img src="<?=$comment->gravatar ?>" class="gravatar"/>
            <a href="<?=$user?>/<?=$comment->user?>"><?=$comment->user?></a>
        </td>
        <td>
            <div>
                <div class="content">
                    <p><?=$di->get("textfilter")->markdown($comment->content)?></p>
                </div>
                <p class="commentCreated"><?=$comment->created?></p>
                <table class="edit">
                    <tr>
                        <td>
                            <?php
                            if ($di->get("session")->get("username") == $comment->user || $di->get("session")->has("admin")) {
                            ?>
                            <a href="<?= $delete."/$comment->id/$article->id/$comment->user" ?>"> Ta bort </a>
                            <a href="<?= $edit."/$comment->id/$article->id" ?>"> Redigera </a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            if ($article->accepted == false) {
                if ($di->get("session")->has("username")) {
                    if ($di->get("session")->get("username") == $article->user) {
            ?>
            <a href="<?=$commentAccept?>/<?=$comment->id?>/<?=$article->id?>">Acceptera svar</a>
            <?php
                    }
                }
            } else {
                if ($comment->accepted == true) {
            ?>
            <span class="glyphicon glyphicon-ok"></span>
            <?php
                }
            }
            if ($comment->points > 0) {
            ?>
            <p>+<?=$comment->points?></p>
            <?php
            } else {
            ?>
            <p><?=$comment->points?></p>
            <?php
            }
                ?>
        </td>
        <td>
        <?php
        if ($di->get("session")->has("username") || $di->get("session")->has("admin")) {
            $userId = $di->get("userController")->getUserId($di->get("session")->get("username"));
            if (!$di->get("commentController")->checkIfVoted($userId, $comment->id)) {
            ?>
                <a href="<?=$commentUpVote?>/<?=$userId?>/<?=$comment->id?>/<?=$article->id?>">+1</a>
                <a href="<?=$commentDownVote?>/<?=$userId?>/<?=$comment->id?>/<?=$article->id?>">-1</a>
        <?php
            }
        ?>
        <form method="post" action="<?=$answerHandler?>" class="answerSection">
            <input class="answerInput" type="text" name="answer" placeholder="Skriv en kommentar">
            <input type="hidden" name="articleId" value="<?=$article->id?>">
            <input type="hidden" name="commentId" value="<?=$comment->id?>">
            <input class="answerSubmit" type="submit" value="Skriv">
        </form>
        <?php
        }
        ?>
        </td>
    </tr>
        <?php
        if ($answers) {
            foreach ($answers as $answer) :
                if ($answer->commentId == $comment->id) {
        ?>
        <tr class="answerRow">
            <td></td>
            <td class="answer">
            <p><?=$di->get("textfilter")->markdown($answer->content)?></p>
            <a href="<?=$user?>/<?=$answer->user?>"><?=$answer->user?></a>
            <?php
            if ($di->get("session")->has("username") || $di->get("session")->has("admin")) {
                $userId = $di->get("userController")->getUserId($di->get("session")->get("username"));
                if (!$di->get("answerController")->checkIfVoted($userId, $answer->id)) {
                ?>
                    <a href="<?=$answerUpVote?>/<?=$userId?>/<?=$answer->id?>/<?=$article->id?>">+1</a>
                    <a href="<?=$answerDownVote?>/<?=$userId?>/<?=$answer->id?>/<?=$article->id?>">-1</a>
            <?php
                }
            }
            ?>
            </td>
        </tr>
        <?php
                }
            endforeach;
        }?>
</table>
<?php
    endforeach;
}?>
