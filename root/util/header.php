<?php

?>

<head>
    <title><?php echo $header ?></title>
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
    <script type="application/javascript">
        const backend = '<?php echo $backend; ?>';

        function getJsonHeader() {
            return {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                    'Authorization': 'Bearer <?php echo $user->getToken(); ?>'
                }
            };
        }

        function redirectLogin() {
            if (window.location.href !== '/' && window.location.href !== '/login') {
                window.location.href = '/login';
            }
        }

        function displayError(error) {
            $('#error-container').removeClass('.d-none');
            $('#error-div').text(error);
        }
    </script>
    <script type="application/javascript">
        if ('<?php echo($user->isPasswordChanged() ? 1 : 0) ?>' !== '1') {
            redirectLogin();
        }

        fetch(`${backend}/api/login`, getJsonHeader()).then(resp => {
            if (!resp.ok) {
                redirectLogin();
            }
        });
    </script>
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="../favicon.ico"/>
    <link rel="stylesheet" href="../rabe.css"/>
</head>
