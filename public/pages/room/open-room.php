<?php

use RaBe\Models\Room;
use RaBe\Util\Serializer;

$parts = explode('/', $uri);

if (count($parts) < 2) {
    http_response_code(404);
    die();
}

$id = $parts[count($parts) - 1];

$response = makeGetRequest($backend . '/api/room/' . $id, $user->getToken());

$room = Serializer::deserialize($response, Room::class);
$vorlage = $room->vorlage;

$response = makeGetRequest($backend . '/api/Room/GetAllWorkplacesOfRoom/' . $id, $user->getToken());
?>

<div class="container">
    <style>
        .td {
            width: 80px;
            height: 80px;
            padding: 2px;
            flex;
            0 1 auto;
        }

        .td > button {
            width: 76px;
            height: 76px;
        }

        .bottom {
            border-bottom: 2px solid darkgreen;
        }
    </style>
    <h2><?php echo $room->name; ?></h2>
    <div class="row">
        <div class="col-12">
            <?php
            require_once("templates/$vorlage.php");
            ?>
        </div>
    </div>
</div>
<script type="application/javascript">
    $(function () {
        let workplaces = JSON.parse('<?php echo $response; ?>');

        workplaces.forEach(function (workplace) {
            doRequest(backend + '/api/errors/getAllErrorsOfWorkplace/' + workplace.id, getJsonHeader()).then(response => {
                response.json().then(json => {
                    let status = 0;
                    let htmlId = "";

                    json.forEach(function (error) {
                        if (error.status > status) {
                            status = error.status;
                        }

                        if (error.kategorieId === 6) {
                            htmlId = "beamer";
                        } else if (error.kategorieId === 7) {
                            htmlId = "speaker";
                        } else if (error.kategorieId === 8) {
                            htmlId = "accesspoint";
                        }
                    });

                    if (htmlId === "") {
                        if (workplace.position === 0) {
                            htmlId = "pcteacher";
                        } else {
                            htmlId = "pc" + (workplace.position - 1);
                        }
                    }

                    let html = $(`#${htmlId}`);

                    if (html) {
                        switch (status) {
                            case 1: {
                                html.find('.btn').removeClass('btn-dark').addClass('btn-warning');
                                break;
                            }
                            case 2: {
                                html.find('.btn').removeClass('btn-dark').addClass('btn-danger');
                                break;
                            }
                            default: {
                                html.find('.btn').removeClass('btn-dark').addClass('btn-success');
                                break;
                            }
                        }

                        html.attr('title', workplace.name);
                    }
                });
            });
        });

        $('.td').on('click', function () {
            if ($(this).find('.btn.btn-dark').length === 0) {
                return;
            }

            let id = $(this).attr('id');
            let position = 0;

            if (id && id.startsWith('pc')) {
                position = parseInt(id.replace('pc', '')) + 1;
            }

            let workplaceId = -1;

            workplaces.forEach(function (workplace) {
                if (workplace.position === position) {
                    workplaceId = workplace.id;
                }
            });

            if (workplaceId !== -1) {
                window.location.href = '/rooms/workplace/' + workplaceId;
            }
        });
    });
</script>
