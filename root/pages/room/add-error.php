<?php

$parts = explode('/', $uri);

if (count($parts) < 2) {
    http_response_code(404);
    die();
}

$id = $parts[count($parts) - 2];
$name = $parts[count($parts) - 1];

?>

<div class="container">
    <h2><?php echo $name; ?></h2>
    <div class="row justify-content-center d-none mb-lg-5 mb-2" id="error-container">
        <div class="col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="alert alert-danger" id="error-div">

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-10 col-12">
            <div class='card'>
                <div class="card-header bg-dark text-white">
                    Fehler melden
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="w-100" for="title">
                            Titel
                            <input id="title" class="form-control"/>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="w-100" for="description">
                            Beschreibung
                            <input id="description" class="form-control" type="text"/>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="w-100" for="password">
                            Neues Passwort wiederholen
                            <input id="password_repeat" class="form-control" type="password"/>
                        </label>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-light mr-3" onclick="window.location.href='/login';">
                        Zurück
                    </button>
                    <button type="button" class="btn btn-dark" onClick={changePassword()}>Passwort ändern
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
