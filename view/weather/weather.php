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

<h1> Vädret </h1>
<p>Här kan du få ut ditt nuvarande väder, prognos för de närmaste fem dagarna
    samt vädret för de fem föregående dagarna.
<br>Du väljer själv om du vill ange din ip-adress eller lon/lat.</p>

<form method="POST" action="weather/validation">
    <label>
        Ip-adress:
    </label>
    <input type="text"  class="ipinput" name="ipinput">
    </input>
    <br>
    <br>
    <legend><b>Eller</b></legend>
    <br>
    <label>
        Longitude:
    </label>
    <input type="text" name="lon">
    </input>
    <label>
        Latitude:
    </label>
    <input type="text" name="lat">
    </input>
    <br>
    <br>
    <input type="submit" class="submitbutton" value="Vädra!"></input>
</form>
<br>

<div>
    <h3>JSON-validering</h3>
    <p>Om du hellre vill se vädret som JSON går det också bra.
        <br>
        Antingen gör du det med din ip, eller lon/lat.
        <br>
        Detta gör du genom att skicka en GET-request, likt följande exempel: </p>
        <p><i> GET /weather-json?ip=216.58.211.142</i></p>
        <p><i> GET /weather-json?lon=17.79&lat=5.69</i></p>
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
    <form action=<?= url("weather-json")?>>
        <br>
        <input type="hidden" name="ip" value="216.58.211.142">
        <input type="submit" class="JSONbutton right" value="Fungerande">
    </form>
    <form action=<?= url("weather-json")?>>
        <br>
        <input type="hidden" name="ip" value="216.58.21">
        <input type="submit" class="JSONbutton wrong" value="Felaktig">
    </form>
    <br>
    <form action=<?= url("weather-json")?>>
        <label>Du kan även testa vädret genom att skriva in en egen ip:</label>
        <br>
        <input type="text" name="ip">
        <br>
        <br>
        <input type="submit" class="JSONbutton" value="Validera">
    </form>
</div>

<!-- <pre>
<?= var_dump($data["defaultIp"]); ?> -->
