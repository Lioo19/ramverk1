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

<h1> Resultat </h1>

<p>Resultat för adress <i> <?= $data["ip"] ?></i></p>
<p>Godkänd Ip4: <?php
if ($data["ip4"]) {
    echo "<b>ja</b>";
} else {
    echo "<b>nej</b>";
}
?>
</p>
<p>Godkänd Ip6: <?php
if ($data["ip6"]) {
    echo "<b>ja</b>";
} else {
    echo "<b>nej</b>";
}
?>
</p>
<?php
if ($data["ip"] != $data["hostname"]) {
        echo "Domänen för adressen är " . $data["hostname"] ;
} else {
    echo "Ingen tillgänglig domän";
}
?>


<!-- <pre>
<?= var_dump($_POST); ?>
<?= var_dump($data); ?> -->
