<?php
 $save = $di->get("url")->create("comment/save");

?>

<form action="<?= $save ?>" method="post" class="commentSection">
  Svar:<br>
  <textarea rows="4" cols="50" name="comment" class="input">
<?= $values->content ?>
  </textarea>
  <input type="hidden" name="id" value="<?= $values->id ?>">
  <input type="hidden" name="articleId" value="<?= $articleId ?>">
  <input type="submit" value="Spara ändringar" class="btn btn-success">
</form>
