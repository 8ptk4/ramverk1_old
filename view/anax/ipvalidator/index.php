<?php

namespace Anax\View;

/**
 * Ip Validator
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

//var_dump($data);

?><h1><?= $title ?></h1>

<p>Denna tjänst erbjuds också som ett REST API för att kunna få tillgång till dess data i JSON format.</p>
<div>
    <h4>TEST ROUTES FÖR REST API</h4>
    <p>IPV4<br><a href="<?= url("ip-json?ipAdress=19.117.63.126"); ?>">/ip-json?ipAdress=19.117.63.126</a></p>
    <p>IPV6<br><a href="<?= url("ip-json?ipAdress=2001:db8:85a3::8a2e:370:7334"); ?>">/ip-json?ipAdress=2001:db8:85a3::8a2e:370:7334</a></p>
</div>

<div class="form-wrapper">
    <form method="post">
        IP:<br>
        <input type="text" name="ipAdress"><br><br>
        <input class="button save" type="submit" name="doSubmit" value="SUBMIT">
    </form>
</div>

<?php if ($data['ipAdress']) : ?>
    <p><a href="<?= url("ip_json?ipAdress={$data['ipAdress']}"); ?>">REST API - <?= $data['ipAdress'] ?></a></p>
<?php endif ?>

<?php if (!empty($this->di->get("request")->getPost("doSubmit"))) : ?>
    <?php include "result.php" ?>
<?php endif; ?>
