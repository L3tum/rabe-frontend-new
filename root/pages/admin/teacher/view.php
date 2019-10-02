<?php

$parts = explode('/', $uri);

if (count($parts) < 2) {
    http_response_code(404);
    die();
}

$id = $parts[count($parts) - 1];

$response = makeGetRequest($backend . '/api/teacher/' . $id, $user->getToken());
$teacher = json_decode($response);

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
                Lehrer aktualisieren
            </h2>
            <p>
                Hier können Sie Lehrer bearbeiten.
            </p>
            <p>
                Außerdem können Sie festlegen ober der Lehrer Admin Rechte haben soll oder blockiert nicht.
            </p>
        </div>
    </div>
    <div class="row mb-5 justify-content-center">
        <div class="col-lg-8">
            <form class="w-100">
                <div class="form-group">
                    <label class="w-100" for="name">
                        Name
                        <input id="name" class="form-control" value="<?php echo $teacher->name; ?>"/>
                    </label>
                </div>
                <div class="form-group">
                    <label class="w-100" for="email">
                        E-Mail
                        <input id="email" class="form-control" value="<?php echo $teacher->email; ?>"/>
                    </label>
                </div>
                <div class="form-group form-check">
                    <label for="admin" class="form-check-input w-100 ml-1">
                        <input id="admin" type="checkbox"
                               class="form-check-input" <?php echo($teacher->administrator ? 'checked="checked"' : '') ?>/>
                        Ist Admin?
                    </label>
                </div>
                <br>
                <div class="form-group form-check">
                    <label for="blocked" class="form-check-input w-100 ml-1">
                        <input id="blocked" type="checkbox"
                               class="form-check-input" <?php echo($teacher->blocked ? 'checked="checked"' : '') ?>/>
                        Ist Geblockt?
                    </label>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 d-flex justify-content-end">
            <button type="button" class="btn btn-dark" onclick="update()">Aktualisieren</button>
            <button type="button" class="btn btn-danger ml-2" onclick="remove()">Löschen</button>
        </div>
    </div>
</div>

<script type="application/javascript">
    function remove() {
        if (window.confirm("Wollen Sie den Lehrer wirklich löschen?\nWARNUNG: EXPERIMENTELL")) {
            doRequest(backend + '/api/teacher/deleteTeacher/<?php echo $teacher->id ?>', {
                ...getJsonHeader(),
                method: 'DELETE'
            })
                .then(response => {
                    if (response.status === 200) {
                        displayError('Lehrer erfolgreich gelöscht.');

                        setTimeout(() => {
                            window.location.href = "/admin/teachers";
                        }, 1000);
                    } else if (response.status === 400) {
                        displayError('Fehler beim Lehrer löschen.');
                    } else if (response.status === 401) {
                        displayError('Sie dürfen keine Lehrer löschen.');
                    }
                })
        }
    }

    function update() {
        let name = $('#name').val();
        let email = $('#email').val();
        let blocked = $('#blocked').checked;
        let admin = $('#admin').checked;

        if (name.trim() === '' || email.trim() === '') {
            displayError('Bitte füllen Sie alle Felder aus.');
            return;
        }

        let request = {
            Id: <?php echo $teacher->id; ?>,
            Name: name,
            Email: email,
            Blocked: blocked,
            Administrator: admin,
            PasswordGeaendert: <?php echo $teacher->passwordGeaendert ? 'true' : 'false'; ?>
        };

        doRequest(backend + '/api/teacher', {...getJsonHeader(), method: 'PUT', body: JSON.stringify(request)})
            .then(response => {
                if (response.status === 200) {
                    displayError('Lehrer erfolgreich bearbeitet.');

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else if (response.status === 400) {
                    displayError('Fehler beim Lehrer bearbeiten.');
                } else if (response.status === 401) {
                    displayError('Sie dürfen keine Lehrer bearbeiten.');
                }
            });
    }

    $('input').on('keypress', (event) => {
        if (event.key === 'Enter') {
            update();
        }
    });
</script>
