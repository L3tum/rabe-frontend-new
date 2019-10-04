<?php

$responseCode = 200;
$body = makeGetRequest($backend . '/api/room', $user->getToken(), $responseCode);

if ($responseCode !== 200) {
    $message = $responseCode;
    require_once('error.php');
    exit();
}
?>

<div class="container">
    <div class="row mt-lg-5 mt-2" id="container">
    </div>
</div>
<script type="application/javascript">
    const template = `            <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center" id="[id]-container">
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
        let rooms = JSON.parse('<?php echo $body; ?>');
        let promises = [];

        rooms.forEach(function (room) {
            promises.push(doRequest(backend + '/api/errors/getAllErrorsOfRoom/' + room.id, getJsonHeader())
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
                }));
        });

        Promise.all(promises).then(() => {
            setTimeout(() => {
                let rooms = $("#container > div");

                rooms.sort((a, b) => {
                    let idA = parseInt($(a).attr('id').replace('-container', ''));
                    let idB = parseInt($(b).attr('id').replace('-container', ''));

                    return idA > idB ? -1 : idA < idB ? 1 : 0;
                }).appendTo('#container');
            }, 100);
        });
    })
</script>
