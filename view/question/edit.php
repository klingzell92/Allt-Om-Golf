<?php
 $save = $di->get("url")->create("question/save");

?>

<form action="<?= $save ?>" method="post" class="commentSection">
  Titel:<br>
  <input type="text" name="title" class="input" value="<?= $values->title ?>"><br>
  Kommentar:<br>
  <textarea rows="4" cols="50" name="question" class="input">
<?= $values->content ?>
  </textarea>
  <input type="hidden" name="id" value="<?= $values->id ?>">
  <input type="submit" value="Spara ändringar" class="formButton">
</form>
