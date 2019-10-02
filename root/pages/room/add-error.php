<?php

$parts = explode('/', $uri);

if (count($parts) < 2) {
    http_response_code(404);
    die();
}

$id = $parts[count($parts) - 1];

$response = makeGetRequest($backend . '/api/categories', $user->getToken());
$categories = json_decode($response);

?>

<div class="container">
    <div class="row justify-content-center d-none mb-lg-5 mb-2" id="error-container">
        <div class="col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="alert alert-danger" id="error-div">

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2>
                Fehler melden
            </h2>
            <p>
                Hier können Sie Fehler melden.
            </p>
        </div>
    </div>
    <div class="row mb-5 justify-content-center">
        <div class="col-lg-8">
            <form class="w-100">
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
                <div class="form-group mb-5">
                    <label for="status" class="form-check-input w-75 ml-1">
                        Status
                        <select id="status" class="browser-default custom-select">
                            <option value="1">Normaler Fehler</option>
                            <option value="2">Schwerwiegender Fehler</option>
                        </select>
                    </label>
                </div>
                <br><br>
                <div class="form-group mb-5">
                    <label for="category" class="form-check-input w-75 ml-1">
                        Kategorie
                        <select id="category" class="browser-default custom-select">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 d-flex justify-content-end">
            <button type="button" class="btn btn-danger" onclick="report()">Melden</button>
        </div>
    </div>
</div>

<script type="application/javascript">
    function report() {
        let title = $('#title').val();
        let description = $('#description').val();
        let status = parseInt($('#status').val());
        let category = parseInt($('#category').val());

        if (title.trim() === '') {
            displayError('Bitte füllen Sie alle Felder aus.');

            return;
        }

        let request = {
            Id: 0,
            Titel: title,
            Beschreibung: description,
            Status: status,
            KategorieId: category,
            ArbeitsplatzId: <?php echo $id; ?>
        };

        doRequest(backend + '/api/error', {...getJsonHeader(), method: 'POST', body: JSON.stringify(request)})
            .then(response => {
                if (response.status === 200) {
                    displayError('Fehler erfolgreich gemeldet.');

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else if (response.status === 422) {
                    displayError('Fehler erfolgreich gemeldet.\nE-Mail an alle Lehrer konnte nicht gesendet werden.');
                } else if (response.status === 409) {
                    displayError('Fehler wurde schon gemeldet.');
                }
            });
    }

    $('input').on('keypress', (event) => {
        if (event.key === 'Enter') {
            report();
        }
    });
</script>