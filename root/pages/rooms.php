<?php

// TODO: GetAllRoomsOfTeacher/$teacherId replace
$response = file_get_contents($backend . '/api/room', false, createContextWithToken($user->getToken()));

$rooms = json_decode($response);
?>

<div class="container">
    <div class="row mt-lg-5 mt-2">
        <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                    <img src="../icons/add.svg" alt="Hinzufügen" style="width: 80px; height: 80px;">
                </div>
                <div class="card-body">
                    <h1 class="card-title">Neuen Raum</h1>
                    <p class="card-text"></p>
                    <a href="#" class="btn btn-dark btn-block">Hinzufügen</a>
                </div>
            </div>
        </div>

        <?php foreach ($rooms as $room): ?>
            <?php
            $response = file_get_contents($backend . '/api/errors/getAllErrorsOfRoom/' . $room->id, false, createContextWithToken($user->getToken()));
            $errors = json_decode($response);
            $status = 0;

            foreach ($errors as $error) {
                if ($error->status > $status) {
                    $status = $error->status;
                }
            }
            ?>

            <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                        <img src="../icons/room.svg" alt="Raum" style="width: 80px; height: 80px;">
                    </div>
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $room->name; ?></h1>
                        <p class="card-text">Mängel:
                            <?php if ($status === 0): ?><span class="badge badge-success">KEIN MANGEL</span>
                            <?php elseif ($status === 1): ?><span class="badge badge-warning text-white">BEEINTRÄCHTIGUNG</span>
                            <?php elseif ($status === 2): ?> <span class="badge badge-danger">KRITISCHE MÄNGEL</span>
                            <?php endif; ?>
                        </p>
                        <a href="/rooms/view/<?php echo "$room->id/$room->name"; ?>" class="btn btn-dark btn-block">Öffnen</a>
                        <a href="#" class="btn btn-dark btn-block">Bearbeiten</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>
