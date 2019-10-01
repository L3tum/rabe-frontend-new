<div class="container">
    <div class="row justify-content-center d-none mb-lg-5 mb-2" id="error-container">
        <div class="col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="alert alert-danger" id="error-div">

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-10 col-12">
            <div class='card'>
                <div class="card-header bg-dark text-white">
                    Passwort Ändern
                </div>
                <div class="card-body">
                    <p class="font-weight-bold mb-0">
                        Passwort Anforderungen
                    </p>
                    <ul>
                        <li>
                            Mindestens acht Zeichen.
                        </li>
                        <li>
                            Mindestens eine Großbuchstabe.
                        </li>
                        <li>
                            Mindestens eine Zahl.
                        </li>
                        <li>
                            Mindestens eines der folgendenden Sonderzeichen:
                            {' '}
                            <span class="font-weight-bold">!</span>
                            {', '}
                            <span class="font-weight-bold">@</span>
                            {', '}
                            <span class="font-weight-bold">#</span>
                            {' oder '}
                            <span class="font-weight-bold">&</span>
                            .
                        </li>
                    </ul>
                    <div class="form-group">
                        <label class="w-100" for="password">
                            Altes Passwort
                            <input id="oldPassword" class="form-control" type="password"/>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="w-100" for="password">
                            Neues Passwort
                            <input id="password" class="form-control" type="password"/>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="w-100" for="password">
                            Neues Passwort wiederholen
                            <input id="password_repeat" class="form-control" type="password"/>
                        </label>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-light mr-3" onclick="window.location.href='/login';">
                        Zurück
                    </button>
                    <button type="button" class="btn btn-dark" onClick={changePassword}>Passwort ändern
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    const strongRegex = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})');

    function changePassword() {
        let password = $('#password').val();
        let passwordRepeat = $('#password_repeat').val();
        let oldPassword = $('#oldPassword').val();

        if (password !== passwordRepeat) {
            displayError('Passwörter stimmen nicht überein.');
        } else if (!password.match(strongRegex)) {
            displayError('Passwort entspricht nicht den Mindestanforderungen.');
        } else {
            doRequest(`${backend}/api/login/changePassword`, {
                ...getJsonHeader(),
                method: 'POST',
                body: JSON.stringify({newPassword: password, oldPassword: oldPassword})
            }).then(response => {
                if (response.ok) {
                    window.location.href = '/rooms';
                } else if (response.status === 401) {
                    displayError('Ihr altes Passwort ist inkorrekt.');
                } else {
                    displayError('Es ist ein Fehler aufgetreten.');
                }
            });
        }
    }
</script>
