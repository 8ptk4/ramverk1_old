<?php

namespace Anax\View;

/**
 * Ip Validator
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1><?= $title ?></h1>

<p>Denna tjänst erbjuds också som ett REST API för att kunna få tillgång till dess data i JSON format.</p>
<div>
    <h4>TEST ROUTES FÖR REST API</h4>
    <p>IPV4<br><a href="<?= url("ip?ipAddress=172.16.254.1"); ?>">/ip?ipAddress=172.16.254.1</a></p>
    <p>IPV6<br><a href="<?= url("ip?ipAddress=2001:4860:4860::8844"); ?>">/ip?ipAddress=2001:4860:4860::8844</a></p>
</div>

<div class="form-wrapper">
    <form method="post">
        IP:<br>
        <input type="text" name="ipAddress"><br><br>
        <input class="button save" type="submit" name="doSubmit" value="SUBMIT">
    </form>
</div>

<?php if ($ipAddress) : ?>
    <p><a href="<?= url("ip?ipAddress=$ipAddress"); ?>">REST API - <?= $ipAddress ?></a></p>
    <?php include "result.php" ?>
<?php endif ?>
