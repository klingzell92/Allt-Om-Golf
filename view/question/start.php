<?php
//var_dump($questions);
//var_dump($tags);
//var_dump($users);
$user = $di->get("url")->create("user/profile");
$view = $di->get("url")->create("question");
 ?>
<div class="startContainer">
    <div class="questions">
    <?php
    if ($questions) {
     foreach ($questions as $question) :
    ?>
        <div class="questionStart">

            <div class="text">
                <a href="<?=$view?>/<?=$question->id?>"><h3><?= $question->title?></h3></a>
            </div>

            <div class="userStart">
                <a href="<?=$user?>/<?=$question->user?>"><?=$question->user?></a>
            </div>
            <div class="createdStart">
                <p><?=$question->created?></p>
            </div>
        </div>
    <?php
     endforeach;
    }?>
    </div>
    <div class="startInfo">
        <div class="topTags">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">Mest använda taggar</h3>
              </div>
              <div class="tags-panel panel-body">
        <?php
        if ($tags) {
         foreach ($tags as $tag) :
        ?>
                        <p><?=$tag->tag?></p>
        <?php
         endforeach;
        }?>
            </div>
          </div>
        </div>
        <div class="topUsers">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">Toppanvändare</h3>
              </div>
              <div class="tags-panel panel-body">
        <?php
        if ($users) {
         foreach ($users as $user) :
        ?>
                        <p><?=$user->acronym?></p>
        <?php
         endforeach;
        }?>
                </div>
            </div>
        </div>
    </div>
</div>
