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

<h1>Vädret</h1>
<?php
if ($data["geoInfo"] == "Inget att visa") {
    echo "Domänen för adressen är " . $data["hostname"] ;
    echo "<br>Ingen tillgänglig plats";
} elseif ($data["hostname"] != "Ej korrekt ip") {
    echo "<br><br>Addressen befinner sig i " . $data["geoInfo"]["city"] . ", " .
         $data["geoInfo"]["country"];
    echo "<br>Koordinaterna är <br><b>latitude:</b> " .  round($data["geoInfo"]["latitude"], 2) .
         "<br><b>longitude</b>: " . round($data["geoInfo"]["longitude"], 2);
} else {
    echo "Ingen tillgänglig domän";
    echo "<br>Ingen tillgänglig plats";
}
?>
<h3>Vädret Just Nu</h3>
<div id="currweather">
    <?php
    if (is_array($data["forweather"])) {
        echo "<p>Vädret hos dig just nu är " . $data["forweather"]["current"]["weather"][0]["description"];
        echo "<br>Temperaturen är " . $data["forweather"]["current"]["temp"] .
            " grader och det känns som " . $data["forweather"]["current"]["feels_like"] . "</p>";
    } else {
        echo "<p>Tyvärr går det inte att visa vädret hos dig just nu.</p>";
    }?>
</div>

<h3>Kommande väder</h3>
<div id="forweather">
    <p>
    <?php
    if (is_array($data["forweather"])) {
        echo "Imorgon blir det ca " . $data["forweather"]["daily"][0]["temp"]["day"] .
            " grader och det blir " . $data["forweather"]["daily"][0]["weather"][0]["description"];
        echo "<br>I övermorgon blir det ca " . $data["forweather"]["daily"][1]["temp"]["day"] .
        " grader och det blir " . $data["forweather"]["daily"][1]["weather"][0]["description"];
        echo "<br>Om tre dagar blir det ca " . $data["forweather"]["daily"][2]["temp"]["day"] .
        " grader och det blir " . $data["forweather"]["daily"][2]["weather"][0]["description"];
        echo "<br>Om fyra dagar blir det ca " . $data["forweather"]["daily"][3]["temp"]["day"] .
        " grader och det blir " . $data["forweather"]["daily"][3]["weather"][0]["description"];
        echo "<br>Om fem dagar blir det ca " . $data["forweather"]["daily"][4]["temp"]["day"] .
        " grader och det blir " . $data["forweather"]["daily"][4]["weather"][0]["description"];
    } else {
        echo "Väderprognosen går ej att hämta.";
    }?>
    </p>
</div>

<h3>Historiskt väder</h3>

<div id="histweather">
    <p>
    <?php
    if (count($data["histweather"]) == 5) {
        echo "Igår var det " . $data["histweather"][0]["temp"] .
            " grader ute och det var " . $data["histweather"][0]["weather"][0]["description"];
        echo "<br>I förrgår var det " . $data["histweather"][1]["temp"] .
            " grader ute och det var " . $data["histweather"][1]["weather"][0]["description"];
        echo "<br>Dagen innan dess var det " . $data["histweather"][2]["temp"] .
            " grader ute och det var " . $data["histweather"][2]["weather"][0]["description"];
        echo "<br>För fyra dagar sen var det " . $data["histweather"][3]["temp"] .
            " grader ute och det var " . $data["histweather"][3]["weather"][0]["description"];
        echo "<br>För fem dagar sen var det " . $data["histweather"][4]["temp"] .
            " grader ute och det var " . $data["histweather"][4]["weather"][0]["description"];
    } else {
        echo "Historiskt väder kan inte visas för dig.";
    }?>
    </p>
</div>


<!-- <pre>
    <?= var_dump($data); ?>
    <?= var_dump($_POST); ?> -->
