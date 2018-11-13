<?php

namespace Anax\View;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

//var_dump($data);

?><div>
    <h1><?= $data['ipAdress'] ?></h1>
    <p><?= $data['status'] ?></p>
    <p><?= $data['domain'] ?></p>
</div>
