<?php
 $post = $di->get("url")->create("comment/post");
?>
<?php
if ($di->get("session")->has("username") || $di->get("session")->has("admin")) {
?>
<form action="<?= $post ?>" method="post" class="commentSection">
  Svar:<br>
  <textarea rows="4" cols="50" name="comment" class="input">
  </textarea>
  <input type="hidden" value="<?=$id?>" name="articleId">
  <input type="submit" value="Skriv Kommentar" class="btn btn-success">
</form>
<?php
}
?>
