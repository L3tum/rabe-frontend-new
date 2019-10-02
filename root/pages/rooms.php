<?php

// TODO: GetAllRoomsOfTeacher/$teacherId replace
$response = makeGetRequest($backend . '/api/room', $user->getToken());

$rooms = json_decode($response);
?>

<div class="container">
    <div class="row mt-lg-5 mt-2" id="container">
        <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                    <img src="svgs/add.svg" alt="Hinzufügen" style="width: 80px; height: 80px;">
                </div>
                <div class="card-body">
                    <h1 class="card-title">Neuen Raum</h1>
                    <p class="card-text"></p>
                    <a href="#" class="btn btn-dark btn-block">Hinzufügen</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    const template = `            <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                        <img src="svgs/room.svg" alt="Raum" style="width: 80px; height: 80px;">
                    </div>
                    <div class="card-body">
                        <h1 class="card-title">[name]</h1>
                        <p class="card-text">Mängel:
                            <span class="badge badge-success" id="[id]-green">KEIN MANGEL</span>
                            <span class="badge badge-warning text-white" id="[id]-warning">BEEINTRÄCHTIGUNG</span>
                            <span class="badge badge-danger" id="[id]-danger">KRITISCHE MÄNGEL</span>
                        </p>
                        <a href="/rooms/view/[id]" class="btn btn-dark btn-block">Öffnen</a>
                    </div>
                </div>
            </div>`;

    $(function () {
        let rooms = JSON.parse('<?php echo $response; ?>');

        rooms.forEach(function (room) {
            doRequest(backend + '/api/errors/getAllErrorsOfRoom/' + room.id, getJsonHeader())
                .then(response => {
                    response.json().then(json => {
                        let status = 0;

                        json.forEach(function (error) {
                            if (error.status > status) {
                                status = error.status;
                            }
                        });

                        let templ = template;

                        templ = templ.replace(/\[name\]/gi, room.name);
                        templ = templ.replace(/\[id\]/gi, room.id);

                        $('#container').append(templ);

                        switch (status) {
                            case 0: {
                                $(`#${room.id}-warning`).addClass('d-none');
                                $(`#${room.id}-danger`).addClass('d-none');
                                break;
                            }
                            case 1: {
                                $(`#${room.id}-green`).addClass('d-none');
                                $(`#${room.id}-danger`).addClass('d-none');
                                break;
                            }
                            case 2: {
                                $(`#${room.id}-green`).addClass('d-none');
                                $(`#${room.id}-warning`).addClass('d-none');
                                break;
                            }
                        }
                    });
                });
        });
    })
</script>
