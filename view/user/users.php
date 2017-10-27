<?php
$userUrl = $di->get("url")->create("user/profile");
 ?>
 <div class="users">
     <ul class="rig columns-3">
<?php
foreach ($users as $user) {
?>
        <li>
            <a href="<?=$userUrl?>/<?=$user->acronym?>">
                <img src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($user->email))) ?>" class="gravatar"/>
                <p><?= $user->acronym ?></p>
            </a>
        </li>
<?php
}
?>
    </ul>
</div>
