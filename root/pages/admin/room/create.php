<?php

$response = makeGetRequest($backend . '/api/teacher', $user->getToken());
$teachers = json_decode($response);

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
                Raum hinzufügen
            </h2>
            <p>
                Hier können Sie neue Räume zum System hinzufügen.
                Dazu müssen Sie den Namen des Raums und seinen Betreuer angeben.
            </p>
        </div>
    </div>
    <div class="row mb-5 justify-content-center">
        <div class="col-lg-8">
            <form class="w-100">
                <div class="form-group">
                    <label class="w-100" for="name">
                        Name
                        <input id="name" class="form-control"/>
                    </label>
                </div>
                <div class="form-group mb-5">
                    <label for="template" class="form-check-input w-75 ml-1">
                        Vorlage
                        <select id="template" class="browser-default custom-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4 (Usinger)</option>
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
                                <option value="<?php echo $teacher->id; ?>"><?php echo $teacher->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 d-flex justify-content-end">
            <button type="button" class="btn btn-dark" onclick="create()">Hinzufügen</button>
        </div>
    </div>
</div>
<script type="application/javascript">
    function create() {
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

        doRequest(backend + "/api/room", {...getJsonHeader(), method: 'POST', body: JSON.stringify(request)})
            .then(response => {
                if (response.status === 200) {
                    response.json().then(json => {
                        doRequest(backend + '/api/teacher/markAsAuthority/' + authority + '/' + json.id, {
                            ...getJsonHeader(),
                            method: 'POST'
                        })
                            .then(resp => {
                                if (resp.status === 200) {
                                    displayError('Raum erfolgreich angelegt.');

                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                } else if (response.status === 400) {
                                    displayError('Fehler beim Raum anlegen.');
                                } else if (response.status === 401) {
                                    displayError('Sie dürfen keine Räume anlegen.');
                                }
                            });
                    });
                } else if (response.status === 400) {
                    displayError('Fehler beim Raum anlegen.');
                } else if (response.status === 401) {
                    displayError('Sie dürfen keine Räume anlegen.');
                }

                $('.container').scrollTop(0);
            });
    }

    $(function () {
        $('input').on('keypress', (event) => {
            if (event.key === 'Enter') {
                create();
            }
        });
    });
</script>