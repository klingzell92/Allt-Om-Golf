<?php
$create = $di->get("url")->create("user/create");

if ($di->get("session")->has("username")) {
    $user = $di->get("session")->get("username");
    echo "<h3>Du är inloggad som $user</h3>";
    echo "<p><a href='logout'>Logga ut</a></p>";
    echo "<p>Gå till din <a href='profile'>profil</a> </p>";
    $user_loggedin = "disabled";
} else {
    echo '<div class="form">';
    echo "$content";
    echo "<a href='$create'>Skapa användare</a>";
    echo "</div>";
}
