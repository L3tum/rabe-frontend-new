<?php

$response = makeGetRequest($backend . '/api/room', $user->getToken());
$rooms = json_decode($response);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
            <div class="card w-100">
                <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                    <img src="svgs/add.svg" alt="Hinzufügen" style="width: 80px; height: 80px"/>
                </div>
                <div class="card-body d-flex align-items-start flex-column">
                    <h1 class="card-title">Raum hinzufügen</h1>
                    <button type="button" class="btn btn-dark btn-block mt-auto"
                            onclick="window.location.href = '/admin/room/create'">Hinzufügen
                    </button>
                </div>
            </div>
        </div>
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
                <div class="card w-100">
                    <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                        <img src="svgs/room.svg" alt="Lehrer" style="width: 80px; height: 80px;"/>
                    </div>
                    <div class="card-body d-flex align-items-start flex-column">
                        <h1 class="card-title"><?php echo $room->name ?></h1>
                        <button type="button" class="btn btn-dark btn-block mt-auto"
                                onclick="window.location.href='/admin/room/<?php echo $room->id ?>';">Öffnen
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>