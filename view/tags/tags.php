<?php
$tagsUrl = $di->get("url")->create("tags")
 ?>
<div class="tagNavContainer">
    <ul class="tagNav">
        <?php
        foreach ($tags as $tag) {
        ?>
        <li><a href="<?=$tagsUrl?>/<?=$tag->id?>"><?=$tag->tag?></a></li>
        <?php
        }
         ?>
    </ul>
</div>
