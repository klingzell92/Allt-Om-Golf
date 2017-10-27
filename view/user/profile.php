<?php
    $edit = $di->get("url")->create("user/update/{$content->id}");
    $admin = $di->get("url")->create("user/admin");
?>
<div class="profile">
    <h3>Profil</h3>

    <!--<img src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($content->email))) ?>" class="gravatar"/>!-->
    <div class="textSection">
        <b>Email:</b><p><?= $content->email ?></p>
    </div>
    <div class="textSection">
        <b>Användarnamn:</b><p><?= $content->acronym ?></p>
    </div>
    <a href="<?=$edit?>" class="navButton">Redigera</a>
    <?php if ($di->get("session")->has("admin")) {?>
        <a href="<?=$admin?>" class="navButton">Admin</a>
    <?php } ?>
</div>
