<?php

?>

<head>
    <title><?php echo $header ?></title>
    <base href="/">
    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossOrigin="anonymous"
    />
    <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossOrigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"
            integrity="sha256-EPrkNjGEmCWyazb3A/Epj+W7Qm2pB9vnfXw+X6LImPM=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/black/pace-theme-flat-top.min.css"
          integrity="sha256-aJG6SjusubfP2N2IpE0fSZ2rjTJkOJaZkjQzDWtDSZ4=" crossorigin="anonymous"/>
    <script type="application/javascript">
        var backend = '<?php echo $backend; ?>';

        function getJsonHeader() {
            return {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer <?php echo $user->getToken(); ?>'
                }
            };
        }

        function displayError(error) {
            $('#error-container').removeClass('d-none');
            $('#error-div').text(error);
        }

        function doRequest(url, data) {
            Pace.restart();

            return fetch(url, data)
                .catch(() => {
                    displayError('Es ist ein Netzwerkfehler aufgetreten.');
                })
                .then(response => {
                    return response;
                });
        }
    </script>
    <style>
        .pace, .pace .pace-progress {
            position: fixed !important;
            z-index: 2000 !important;
            top: 0 !important;
            /*right: 100%;*/
            width: 100% !important;
            height: 2px !important;
        }

        .pace .pace-progress {
            background-color: lightblue;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="../favicon.ico"/>
    <link rel="stylesheet" href="../rabe.css"/>
</head>
