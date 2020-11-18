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

<h1> Vädret </h1>

<form method="POST" action="weather/validation">
    <label>
        Ange din ip-adress eller närmaste ort för att se vädret där du befinner dig!
    </label>
    <br>
    <input type="text" name="ipinput" value="<?= $data["defaultIp"]?>">
    </input>
    <br>
    <br>
    <input type="radio" id="future" name="radiochoice" value="kommande">
    <label for="future">Kommande</label><br>
    <input type="radio" id="previous" name="radiochoice" value="historiskt">
    <label for="future">Historiskt</label>
    <br>
    <br>
    <input type="submit" class="submitbutton" value="Validera"></input>
</form>
<br>

<div>
    <h3>JSON-validering</h3>
    <p>Om du hellre vill validera din IP via din url går det också bra.
        <br>
        Detta gör du genom att skicka en GET-request, likt följande exempel: </p>
    <p><i> GET /ip-json?ip=216.58.211.142</i></p>
    <pre>
    {
        "ip": "216.58.211.142",
        "ip4": "true"
        "ip6": "false"
        "host": "arn09s10-in-f14.1e100.net"
    }
    </pre>
</div>


<pre>
<?= var_dump($data["defaultIp"]); ?>
