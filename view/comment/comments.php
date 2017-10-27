<?php
 $delete = $di->get("url")->create("comment/delete");
 $edit = $di->get("url")->create("comment/edit");
 $answerHandler = $di->get("url")->create("answer/post");
 $user = $di->get("url")->create("user/profile");
?>

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
                <table class="edit">
                    <tr>
                        <td>
                            <?php
                            if ($di->get("session")->get("username") == $comment->user || $di->get("session")->has("admin")) {
                            ?>
                            <a href="<?= $delete."/$comment->id/$articleId/$comment->user" ?>"> Ta bort </a>
                            <a href="<?= $edit."/$comment->id/$articleId" ?>"> Redigera </a>
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
        <td></td>
        <td>
        <?php
        if ($di->get("session")->has("username") || $di->get("session")->has("admin")) {
        ?>
        <form method="post" action="<?=$answerHandler?>" class="answerSection">
            <input class="answerInput" type="text" name="answer" placeholder="Skriv ett svar">
            <input type="hidden" name="articleId" value="<?=$articleId?>">
            <input type="hidden" name="commentId" value="<?=$comment->id?>">
            <input class="answerSubmit" type="submit" value="svara">
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
