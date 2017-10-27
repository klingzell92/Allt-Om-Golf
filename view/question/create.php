<?php
 $post = $di->get("url")->create("question/post");
 $edit = $di->get("url")->create("question/edit");
?>
<?php
if ($di->get("session")->has("username") || $di->get("session")->has("admin")) {
?>
<form action="<?= $post ?>" method="post" class="commentSection">
    <p>Titel</p>
    <input type="text" name="title">
    <p>Fråga:</p>
    <textarea rows="4" cols="50" name="question" class="input"></textarea>
    <p>Taggar</p>
    <input type="text" name="tags" placeholder="Ange minst en tagg använd kommatecken om du ska ange fler">
    <input type="submit" value="Skriv Fråga" class="btn btn-success">
</form>
<?php
}
?>
