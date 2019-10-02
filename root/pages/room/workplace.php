<?php

$parts = explode('/', $uri);

if (count($parts) < 2) {
    http_response_code(404);
    die();
}

$id = $parts[count($parts) - 1];

$response = makeGetRequest($backend . '/api/getAllErrorsOfWorkplace/' . $id, $user->getToken());
$errors = json_decode($response);

?>

<div class="container">
    <div class="row justify-content-center d-none mb-lg-5 mb-2" id="error-container">
        <div class="col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="alert alert-danger" id="error-div">

            </div>
        </div>
    </div>
    <div class="row mt-lg-5 mt-2">
        <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
            <div class="card w-100">
                <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                    <img src="svgs/add.svg" alt="Hinzufügen" style="width: 80px; height: 80px"/>
                </div>
                <div class="card-body d-flex align-items-start flex-column">
                    <h1 class="card-title">Fehler melden</h1>
                    <button type="button" class="btn btn-dark btn-block mt-auto"
                            onclick="window.location.href = '/room/add-error/<?php echo $id; ?>'">Hinzufügen
                    </button>
                </div>
            </div>
        </div>
        <?php if ($errors !== null && count($errors) > 0): ?>
            <?php foreach ($errors as $error): ?>
                <?php
                $response = makeGetRequest($backend . '/api/categories/' . $error->kategorieId, $user->getToken());
                $category = json_decode($response);
                ?>
                <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center" id="<?php echo $error->id; ?>">
                    <div class="card" style="width: 18rem;">
                        <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                            <img src="svgs/caution.svg" alt="Mangel" style="width: 80px; height: 80px;">
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
                            <a class="btn btn-dark btn-block"
                               onclick="resolveError(<?php echo $error->id; ?>)">Beheben</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script type="application/javascript">
    function resolveError(id) {
        doRequest(backend + '/api/errors/' + id, {...getJsonHeader(), method: 'DELETE'})
            .then(response => {
                if (response.status === 200) {
                    displayError('Fehler wurde als behoben markiert.');

                    $(`#${id}`).remove();
                } else if (response.status === 404) {
                    displayError('Fehler wurde nicht gefunden.');
                }
            });
    }
</script>
