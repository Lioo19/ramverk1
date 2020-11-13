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

<h1> Validera din ip-adress </h1>

<form method="POST" action="ip/validation">
    <label>
        Vad har du för ip-adress?
    </label>
    <br>
    <input type="text" name="ipinput" value="<?= $data["defaultIp"]?>">
    </input>
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

<div>
    <h3>Testroutes</h3>
    <p>Här nedan kan du testa routes för JSON-valideringen</p>
    <form action=<?= url("ip-json")?>>
        <br>
        <input type="hidden" name="ip" value="216.58.211.142">
        <input type="submit" class="JSONbutton right" value="Fungerande">
    </form>
    <form action=<?= url("ip-json")?>>
        <br>
        <input type="hidden" name="ip" value="216.58.21">
        <input type="submit" class="JSONbutton wrong" value="Felaktig">
    </form>
    <br>
    <form action=<?= url("ip-json")?>>
        <label>Du kan även testa JSON-validerngen genom att skriva in en egen ip:</label>
        <br>
        <input type="text" name="ip">
        <br>
        <br>
        <input type="submit" class="JSONbutton" value="Validera">
    </form>
</div>

<!--
<pre>
<?= var_dump($data["defaultIp"]); ?> -->
