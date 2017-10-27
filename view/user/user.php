<?php
$article = $di->get("url")->create("question");
$edit = $di->get("url")->create("user/update");
$admin = $di->get("url")->create("user/admin");
 ?>
<div class="profileContainer">
    <div class="profile">

        <img src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($user->email))) ?>" class="gravatar"/>
        <div class="textSection">
            <b>Email:</b><p><?= $user->email ?></p>
        </div>
        <div class="textSection">
            <b>Användarnamn:</b><p><?= $user->acronym ?></p>
        </div>
    </div>
    <div class="profileOptions">
    <?php
    if ($di->get("session")->has("username")) {
        if ($di->get("session")->get("username") == $user->acronym) {
    ?>
    <a href="<?=$edit?>">Redigera</a>
    <?php if ($di->get("session")->has("admin")) {
            if ($di->get("session")->get("admin") == $user->acronym) {
            ?>
                <a href="<?=$admin?>">Admin</a>
    <?php
                }
            }
        }
    }
     ?>
     </div>
</div>
<div class="userQnA">
    <div class="userQuestions">
        <h3>Frågor</h3>
        <?php
        foreach ($questions as $question) {
        ?>
        <a href="<?=$article?>/<?=$question->id?>"><p><?=$question->title?></p></a>
        <p><?=$question->created?></p>
        <?php
        }
         ?>
    </div>

    <div class="userAnswers">
        <h3>Svar</h3>
        <?php
        foreach ($answers as $answer) {
        ?>
        <a href="<?=$article?>/<?=$answer->articleId?>"><p><?=$answer->content?></p></a>
        <p><?=$answer->created?></p>
        <?php
        }
         ?>
    </div>
    <div class="userComments">
        <h3>Kommentarer</h3>
        <?php
        foreach ($comments as $comment) {
        ?>
        <p><?=$comment->content?></p>
        <p class="created"><?=$comment->created?></p>
        <?php
        }
         ?>
    </div>
</div>
