<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vädret</title>
</head>

<h1>Vädret - misslyckades</h1>
<div>
    <p>
        <?php
        echo $data["message"];
        ?>
    </p>
</div>

<!--
<pre>
    <?= var_dump($data); ?>
    <?= var_dump($_POST); ?> -->
