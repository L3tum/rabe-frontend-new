<?php

require_once('./../../vendor/autoload.php');

use RaBe\Models\User;

require_once('../../src/Util/util.php');
require_once('../partials/header.php');
?>
<body>
<?php
$user = new User();
require_once('../partials/nav.php');
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <p class="display-4 text-center text-muted mt-5">
                Willkommen zum Raum-Betreuungs Tool
                <br/>
                <span class="display-2 font-weight-bolder text-dark rabe-logo">
              RaBe
              </span>
            </p>
            <div class="text-center">
                <img src="../favicon.ico" alt="Rabe"/>
            </div>
            <h1 class="text-center">
                <?php echo $message ?? 404; ?>
            </h1>
            <h5 class="text-center text-muted mt-3">
                Mit diesem Tool können Sie Probleme an Arbeitsplätzen in Räumen verwalten.
                <br/>
                Sie können bestehende Fehler einsehen und neue Fehler eintragen.
                <br/>
                Diese Fehler werden dann an den entsprechenden Betreuer weitergeleitet
            </h5>
            <br>
            <h5 class="text-center text-danger mt-3">
                Die von Ihnen gewählte Route ist momentan leider nicht erreichbar.<br>
                Fehler:
            </h5>
            <iframe style="pointer-events:none; border:0;" frameborder="0" width="100%" height="400px"
                    src="http://fakeupdate.net/win10u/"></iframe>
        </div>
    </div>
</div>
<?php
require_once('../partials/footer.php');
?>
</body>
