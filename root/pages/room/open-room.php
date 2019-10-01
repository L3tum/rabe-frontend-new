<?php

$parts = explode('/', $uri);

if (count($parts) < 2) {
    http_response_code(404);
    die();
}

$id = $parts[count($parts) - 2];
$name = $parts[count($parts) - 1];

$response = file_get_contents($backend . '/api/errors/getAllErrorsOfRoom/' . $id, false, createContextWithToken($user->getToken()));
$errors = json_decode($response);

?>

<div class="container">
    <h2><?php echo $name; ?></h2>
    <div class="row mt-lg-5 mt-2">
        <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                    <img src="../../icons/add.svg" alt="Hinzufügen" style="width: 80px; height: 80px;">
                </div>
                <div class="card-body">
                    <h1 class="card-title">Neuen Fehler</h1>
                    <p class="card-text"></p>
                    <a href="/rooms/add-error/<?php echo "$id/$name"; ?>" class="btn btn-dark btn-block">Hinzufügen</a>
                </div>
            </div>
        </div>

        <?php foreach ($errors as $error): ?>
            <?php
            $response = file_get_contents($backend . '/api/categories/' . $error->kategorieId, false, createContextWithToken($user->getToken()));
            $category = json_decode($response);
            ?>

            <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                        <img src="../../icons/caution.svg" alt="Standard-Mangel" style="width: 80px; height: 80px;">
                    </div>
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $error->titel ?></h1>
                        <p class="card-text">Kategorie: <?php echo $category->name; ?><br>
                            Text: <?php echo $error->beschreibung; ?><br>
                            Status:
                            <?php if ($error->status === 1): ?><span class="badge badge-warning text-white">BEEINTRÄCHTIGUNG</span>
                            <?php else: ?><span class="badge badge-danger">KRITISCHER MANGEL</span>
                            <?php endif; ?>
                        </p>
                        <a href="#" class="btn btn-dark btn-block">Bearbeiten</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>
