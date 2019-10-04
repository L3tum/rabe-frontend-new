<?php

use RaBe\Models\Teacher;
use RaBe\Util\Serializer;

$response = makeGetRequest($backend . '/api/teacher', $user->getToken());
/** @var Teacher[] $teachers */
$teachers = Serializer::deserializeArray($response, Teacher::class);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
            <div class="card w-100">
                <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                    <img src="svgs/add.svg" alt="Hinzufügen" style="width: 80px; height: 80px"/>
                </div>
                <div class="card-body d-flex align-items-start flex-column">
                    <h1 class="card-title">Lehrer hinzufügen</h1>
                    <button type="button" class="btn btn-dark btn-block mt-auto"
                            onclick="window.location.href = '/admin/teacher/create'">Hinzufügen
                    </button>
                </div>
            </div>
        </div>
        <?php foreach ($teachers as $teacher): ?>
            <div class="col-md-6 col-lg-4 mb-3 d-flex justify-content-center">
                <div class="card w-100">
                    <div class="card-img-top bg-dark p-3 d-flex justify-content-center text-white">
                        <img src="svgs/teacher.svg" alt="Lehrer" style="width: 80px; height: 80px;"/>
                    </div>
                    <div class="card-body d-flex align-items-start flex-column">
                        <h1 class="card-title"><?php echo $teacher->name ?></h1>
                        <p class="card-text">E-Mail: <?php echo $teacher->email; ?></p>
                        <button type="button" class="btn btn-dark btn-block mt-auto"
                                onclick="window.location.href='/admin/teacher/<?php echo $teacher->id ?>';">Öffnen
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
