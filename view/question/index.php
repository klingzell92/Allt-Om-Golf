<?php
 $delete = $di->get("url")->create("question/delete");
 $edit = $di->get("url")->create("question/edit");
 $view = $di->get("url")->create("question");
 $user = $di->get("url")->create("user/profile");
 $controller = $di->get("questionController");
 $tagsUrl = $di->get("url")->create("tags")
 ?>
<div class="questions">
<?php
if ($questions) {
    foreach ($questions as $question) :
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
                    <a href="<?=$view?>/<?=$question->id?>"><h3><?= $question->title?></h3></a>
                </div>
                <div class="tags">
                    <?php
                        foreach ($controller->getRelations($question->id) as $relation) {
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
</table>
<?php
    endforeach;
}?>
</div>
