<?php

namespace Anax\View;

/**
 * Result.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

var_dump($data);

?><div>

    <h1><?= $ipAddress ?></h1>

    <?php if ($status) : ?>
        <p>Status: <?= $status ?></p>
    <?php endif; ?>

    <?php if ($domain and $domain != $ipAddress) : ?>
        <p>Domän: <?= $domain ?></p>
    <?php endif; ?>

</div>
