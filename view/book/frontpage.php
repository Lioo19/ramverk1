<?php

namespace Anax\View;

/**
 * Frontpage for books
 */

?>
<h1>Böcker</h1>

<?php
$urlToView = url("book");
$urlToCreate = url("book/create");
?>
<div style="height: 400px;">
    <h4>Välkommen att dyka ner i böckernas värld!</h4>
    <p>Om du är nyfiken på vilka böcker som går att
        se i listan finns dessa här:
        <br>
        <b><a href="<?= $urlToView ?>">Boklista</a></b>
    <p>
    <p>Om du istället vill lägga till böcker till listan klickar du här:
        <br>
        <b><a href="<?= $urlToCreate ?>">Lägg till böcker</a></b>
    </p>
    <br>
    <br>
</div>
