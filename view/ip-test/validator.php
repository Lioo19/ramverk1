<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>100</title>
</head>

<h1> BLEPP </h1>

<form id="ipform" method="POST">
    <label>
        Vad har du för ip-adress?
    </label>
    <br>
    <input type="text" name="ipinput">
    </input>
    <br>
    <br>
    <input type="submit" class="submitbutton" value="Validera"></input>
</form>



<pre>
<?= var_dump($_POST); ?>
