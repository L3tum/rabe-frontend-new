<?php

// TODO: Arbeitsplätze anlegen ändern löschen
// TODO: Fehlerkategorieren anlegen ändern löschen
// TODO: Standardfehler
// TODO: Betreuer Arbeitsplätze ändern
// TODO: Mehrere Betreuer
// TODO: Fehler anlegen
// TODO: Unterrichtslehrer anlegen

$parts = explode('/', $uri);

if (count($parts) < 2) {
    http_response_code(404);
    die();
}

$id = $parts[count($parts) - 1];

$response = makeGetRequest($backend . '/api/room/' . $id, $user->getToken());
$room = json_decode($response);

$response = makeGetRequest($backend . '/api/teacher', $user->getToken());
$teachers = json_decode($response);

$response = makeGetRequest($backend . '/api/teacherRoom/getBetreuer/' . $id, $user->getToken());
$authority = json_decode($response)->lehrerId;

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
                Raum aktualisieren
            </h2>
            <p>
                Hier können Sie Räume bearbeiten.
            </p>
        </div>
    </div>
    <div class="row mb-5 justify-content-center">
        <div class="col-lg-8">
            <form class="w-100">
                <div class="form-group">
                    <label class="w-100" for="name">
                        Name
                        <input id="name" class="form-control" value="<?php echo $room->name ?>"/>
                    </label>
                </div>
                <div class="form-group mb-5">
                    <label for="template" class="form-check-input w-75 ml-1">
                        Vorlage
                        <select id="template" class="browser-default custom-select">
                            <option value="1"<?php echo($room->vorlage === 1 ? 'selected="selected"' : ''); ?>>1
                            </option>
                            <option value="2"<?php echo($room->vorlage === 2 ? 'selected="selected"' : ''); ?>>2
                            </option>
                            <option value="3" <?php echo($room->vorlage === 3 ? 'selected="selected"' : ''); ?>>3
                            </option>
                            <option value="4" <?php echo($room->vorlage === 4 ? 'selected="selected"' : ''); ?>>4
                                (Usinger)
                            </option>
                        </select>
                    </label>
                </div>
                <br>
                <br>
                <div class="form-group mb-5">
                    <label for="authority" class="form-check-input w-75 ml-1">
                        Betreuer
                        <select id="authority" class="browser-default custom-select">
                            <?php foreach ($teachers as $teacher): ?>
                                <option value="<?php echo $teacher->id; ?>"
                                    <?php echo($teacher->id === $authority ? 'selected="selected"' : ''); ?>>
                                    <?php echo $teacher->name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
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
        if (window.confirm("Wollen Sie den Raum wirklich löschen?\nWARNUNG: EXPERIMENTELL")) {
            doRequest(backend + '/api/room/<?php echo $teacher->id ?>', {...getJsonHeader(), method: 'DELETE'})
                .then(response => {
                    if (response.status === 200) {
                        displayError('Raum erfolgreich gelöscht.');

                        setTimeout(() => {
                            window.location.href = "/admin/rooms";
                        }, 1000);
                    } else if (response.status === 400) {
                        displayError('Fehler beim Raum löschen.');
                    } else if (response.status === 401) {
                        displayError('Sie dürfen keine Räume löschen.');
                    }
                })
        }
    }

    function update() {
        let name = $('#name').val();
        let authority = $('#authority').val();
        let template = $('#template').val();

        if (name.trim() === '') {
            displayError('Bitte füllen Sie alle Felder aus.')
        }

        let request = {
            name: name,
            vorlage: parseInt(template)
        };

        doRequest(backend + "/api/room", {...getJsonHeader(), method: 'PUT', body: JSON.stringify(request)})
            .then(response => {
                if (response.status === 200) {
                    doRequest(backend + '/api/teacher/removeFromAuthority/<?php echo "$authority/$id"; ?>', {
                        ...getJsonHeader(),
                        method: 'POST',
                    })
                        .then(resp => {
                            if (resp.status === 200) {
                                doRequest(backend + '/api/teacher/markAsAuthority/' + authority + '<?php echo $id; ?>', {
                                    ...getJsonHeader(),
                                    method: 'POST',
                                }).then(res => {
                                    if (res.status === 200) {
                                        displayError('Raum erfolgreich bearbeitet.');

                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 1000);
                                    } else if (response.status === 400) {
                                        displayError('Fehler beim Raum bearbeiten.');
                                    } else if (response.status === 401) {
                                        displayError('Sie dürfen keine Räume bearbeiten.');
                                    }
                                });
                            } else if (response.status === 400) {
                                displayError('Fehler beim Raum bearbeiten.');
                            } else if (response.status === 401) {
                                displayError('Sie dürfen keine Räume bearbeiten.');
                            }
                        });
                } else if (response.status === 400) {
                    displayError('Fehler beim Raum bearbeiten.');
                } else if (response.status === 401) {
                    displayError('Sie dürfen keine Räume bearbeiten.');
                }

                $('.container').scrollTop(0);
            });
    }

    $(function () {
        $('input').on('keypress', (event) => {
            if (event.key === 'Enter') {
                update();
            }
        });
    });
</script>