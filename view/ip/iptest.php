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
    <input type="text" name="ipinput">
    </input>
    <br>
    <br>
    <input type="submit" class="submitbutton" value="Validera"></input>
</form>

<div>
    <p>Om du hellre vill validera din IP via din URL går det också bra.
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



<!-- <pre>
<?= var_dump($_POST); ?> -->
