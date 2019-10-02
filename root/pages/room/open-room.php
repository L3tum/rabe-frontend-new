<?php

$parts = explode('/', $uri);

if (count($parts) < 2) {
    http_response_code(404);
    die();
}

$id = $parts[count($parts) - 1];

$response = makeGetRequest($backend . '/api/room/' . $id, $user->getToken());

$room = json_decode($response, false);
$vorlage = $room->vorlage;

$response = makeGetRequest($backend . '/api/Room/GetAllWorkplacesOfRoom/' . $id, $user->getToken());
$workplaces = json_decode($response, false);
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
                    });

                    if (workplace.kategorieId === 6) {
                        htmlId = "beamer";
                    } else if (workplace.kategorieId === 7) {
                        htmlId = "speaker";
                    } else if (workplace.kategorieId === 8) {
                        htmlId = "accesspoint";
                    } else if (workplace.position === 0) {
                        htmlId = "pcteacher";
                    } else {
                        htmlId = "pc" + (workplace.position - 1);
                    }

                    let html = $(`#${htmlId}`);

                    if (html) {
                        switch (status) {
                            case 1: {
                                html.find('.btn').removeClass('btn-success').addClass('btn-warning');
                                break;
                            }
                            case 2: {
                                html.find('.btn').removeClass('btn-success').addClass('btn-danger');
                                break;
                            }
                        }
                    }
                });
            });
        });
    });
</script>
