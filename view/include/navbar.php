<nav class='navbar'>
    <ul>
        <li><a href="<?=$di->get("url")->create("question/start");?>">Allt om golf</a></li>
        <li><a href="<?=$di->get("url")->create("question");?>">Frågor</a></li>
        <li><a href="<?=$di->get("url")->create("tags");?>">Taggar</a></li>
        <li><a href="<?=$di->get("url")->create("user");?>">Användare</a></li>
        <li><a href="<?=$di->get("url")->create("about");?>">Om</a></li>
        <?php
        if ($di->get("session")->has("username")) {
        ?>
        <li><a href="<?=$app->url->create("question/create");?>">Skriv fråga</a></li>
        <li style="float:right"><a href="<?=$di->get("url")->create("user/logout");?>">Logga ut</a></li>
        <li style="float:right"><a href="<?=$app->url->create("user/profile")?>/<?=$di->get("session")->get("username")?>">Profil</a></li>
        <?php
        } else {
        ?>
        <li style="float:right"><a href="<?=$app->url->create("user/login");?>" class="navright">Logga in</a></li>
        <?php
        }
            ?>
    </ul>
</nav>
