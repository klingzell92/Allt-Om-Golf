<?php
 $save = $di->get("url")->create("answer/save");

?>

<form action="<?= $save ?>" method="post" class="commentSection">
  Kommentar:<br>
  <textarea rows="4" cols="50" name="answer" class="input">
<?= $values->content ?>
  </textarea>
  <input type="hidden" name="id" value="<?= $values->id ?>">
  <input type="hidden" name="articleId" value="<?= $articleId ?>">
  <input type="submit" value="Spara ändringar" class="formButton">
</form>
