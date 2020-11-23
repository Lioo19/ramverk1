<?php

namespace Anax\View;

/**
 * Rendering map for open street view
 */
?>
<?php if ($data["lat"] && $data["lon"]) : ?>
    <h4> Karta över ditt område</h4>

    <div id="map">
    </div>

    <!-- Downloading leaflet library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
         integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
         crossorigin=""></script>
    <script type="text/javascript">
    let lon = <?= $data["lon"] ?>;
    let lat = <?= $data["lat"] ?>;

    let map = L.map('map').setView([lat, lon], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lon]).addTo(map)
        .bindPopup('Din position')
        .openPopup();
    </script>
<?php else : ?>
    <p><b>Din position går tyvärr inte att läsa ut på kartan</b></p>
<?php endif; ?>

<!-- <pre>
    <?= var_dump($data); ?> -->
