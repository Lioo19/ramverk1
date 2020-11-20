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
</p>
<?php
?>
<div id="currweather">
    <?php
    if ($data["currweather"]) {
        echo "<p>Vädret hos dig just nu är " . $data["currweather"]["description"];
        echo "<br>Temperaturen är " . $data["currweather"]["temp"] .
            " grader och det känns som " . $data["currweather"]["feels_like"] . "</p>";
    } else {
        echo "<p>Tyvärr går det inte att visa vädret hos dig just nu</p>";
    }?>
</div>

<div id="histweather">
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
        echo "Historiskt väder kan inte visas för dig, haha.";
    }?>
</div>


<pre>
    <?= var_dump($data); ?>
    <?= var_dump($_POST); ?>
