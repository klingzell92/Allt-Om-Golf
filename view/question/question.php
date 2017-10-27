<?php
$delete = $di->get("url")->create("question/delete");
$edit = $di->get("url")->create("question/edit");
$user = $di->get("url")->create("user/profile");
$tagsUrl = $di->get("url")->create("tags");
$answerHandler = $di->get("url")->create("answer/post/comment");
$deleteComment = $di->get("url")->create("answer/delete");
$editComment = $di->get("url")->create("answer/edit");
?>

<table class="question">
    <tr>
        <td class="user">
            <img src="<?=$question->gravatar ?>" class="gravatar"/>
            <a href="<?=$user?>/<?=$question->user?>"><?=$question->user?></a>
        </td>
        <td class="content">
            <div>
                <div class="text">
                    <h3><?= $question->title?></h3>
                    <p><?=$di->get("textfilter")->markdown($question->content)?></p>
                </div>
                <div class="tags">
                    <?php
                        foreach ($relations as $relation) {
                            foreach ($tags as $tag) {
                                if ($tag->id == $relation->tagId) {
                    ?>
                    <a href="<?=$tagsUrl?>/<?=$tag->id?>" class="tag"><?=$tag->tag?></a>
                    <?php
                                }
                            }
                        }
                     ?>
                </div>
                <table class="edit">
                    <tr>
                        <td>
                            <?php
                            if ($di->get("session")->get("username") == $question->user || $di->get("session")->has("admin")) {
                            ?>
                            <a href="<?= $delete."/$question->id"."/$question->user" ?>"> Ta bort </a>
                            <a href="<?= $edit."/$question->id" ?>"> Redigera </a>
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
            <input type="hidden" name="articleId" value="<?=$question->id?>">
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
                if ($answer->questionId == $question->id) {
        ?>
        <tr class="answerRow">
            <td></td>
            <td class="answer">
            <p><?=$di->get("textfilter")->markdown($answer->content)?></p>
            <a href="<?=$user?>/<?=$answer->user?>"><?=$answer->user?></a>
            <table class="edit">
                <tr>
                    <td>
                        <?php
                        if ($di->get("session")->get("username") == $answer->user || $di->get("session")->has("admin")) {
                        ?>
                        <a href="<?= $deleteComment."/$answer->id/$question->id" ?>"> Ta bort </a>
                        <a href="<?= $editComment."/$answer->id/$question->id" ?>"> Redigera </a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            </table>
            </td>
        </tr>
        <?php
                }
            endforeach;
        }?>
</table>
