<?php

namespace Anax\View;

/**
 * Geolocation
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
//var_dump($di);
?><h1><?= $title ?></h1>

<p>Med denna tjänst kan du få fram detaljer utav ditt ip så som närmsta huvudstad, vilket land, longitud, latitud samt kontinent
den innefattar. Till vänster om dessa detaljer visas även en karta med longitud och latitud som parametrar.</p>

<p>Tjänsten erbjuder också ett REST API där du helt enkelt får fram samma värden fast i en JSON struktur. Nedan finner du exempel
på hur du använder denna tjänst.
</p>

<div>
    <h4>TEST ROUTES FÖR REST API</h4>
    <p>IPV4<br><a href="<?= url("geo?ipAddress=172.16.254.1"); ?>">/geo?ipAddress=172.16.254.1</a></p>
    <p>IPV6<br><a href="<?= url("geo?ipAddress=2001:4860:4860::8844"); ?>">/geo?ipAddress=2001:4860:4860::8844</a></p>
</div>

<div class="form-wrapper">
    <form method="post">
        IP:<br>
        <input type="text" name="ipAddress" value="<?= $userIp; ?>"><br><br>
        <input class="button save" type="submit" name="doSubmit" value="SUBMIT">
    </form>
</div>

<?php if ($ipAddress) : ?>
    <p><a href="<?= url("geo?ipAddress=$ipAddress"); ?>">REST API - <?= $ipAddress ?></a></p>
    <?php include "result.php" ?>
<?php endif; ?>
