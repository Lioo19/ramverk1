<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>IP</title>
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
if ($data["geoInfo"] == "Inget att visa") {
    echo "Domänen för adressen är " . $data["hostname"] ;
    echo "<br>Ingen tillgänglig plats";
} elseif ($data["hostname"] != "Ej korrekt ip") {
    echo "Domänen för adressen är " . $data["hostname"] ;
    echo "<br><br>Addressen befinner sig i " . $data["geoInfo"]["city"] . ", " .
         $data["geoInfo"]["country"];
    echo "<br>Koordinaterna är <br><b>latitude:</b> " .  $data["geoInfo"]["latitude"] .
         "<br><b>longitude</b>: " . $data["geoInfo"]["longitude"];
} else {
    echo "Ingen tillgänglig domän";
    echo "<br>Ingen tillgänglig plats";
}
?>


<!-- <pre>
<?= var_dump($data); ?> -->
