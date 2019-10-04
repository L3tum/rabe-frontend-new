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
            <h5 class="text-center text-muted mt-3">
                Mit diesem Tool können Sie Probleme an Arbeitsplätzen in Räumen verwalten.
                <br/>
                Sie können bestehende Fehler einsehen und neue Fehler eintragen.
                <br/>
                Diese Fehler werden dann an den entsprechenden Betreuer weitergeleitet
            </h5>
            <?php if (!$user->isAuthenticated()): ?>
                <div class="row justify-content-center mt-3">
                    <div class="col-12 col-md-6">
                        <button type="button" class="btn btn-dark btn-block btn-lg"
                                onclick="window.location.href = '/login';">
                            Einloggen
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
