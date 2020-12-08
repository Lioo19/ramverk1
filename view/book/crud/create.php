<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToViewItems = url("book");



?><h1>Skapa en bok</h1>
<p>För att skapa en ny bok fyller du i formuläret nedan.
    Image skickas med som en länk till en bild på din bok.</p>

<?= $form ?>

<p>
    <a href="<?= $urlToViewItems ?>">Visa alla</a>
</p>
