<div class="container">
    <div class="row justify-content-center d-none mb-lg-5 mb-2" id="error-container">
        <div class="col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="alert alert-danger" id="error-div">

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2>
                Lehrer hinzufügen
            </h2>
            <p>
                Hier können Sie neue Lehrer zum System hinzufügen.
                Dazu müssen Sie den Namen des Lehrers, seine E-Mail Adresse angeben.
            </p>
            <p>
                Hinzu kommt noch ein Passwort wo mit sich der Lehrer einloggen kann.
                Dieses Passwort muss er beim erstmaligen anmelden ändern.
            </p>
            <p>
                Außerdem können Sie festlegen ober der Lehrer Admin Rechte haben soll oder nicht.
            </p>
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
        </div>
    </div>
    <div class="row mb-5 justify-content-center">
        <div class="col-lg-8">
            <form class="w-100">
                <div class="form-group">
                    <label class="w-100" for="name">
                        Name
                        <input id="name" class="form-control"/>
                    </label>
                </div>
                <div class="form-group">
                    <label class="w-100" for="email">
                        E-Mail
                        <input id="email" class="form-control"/>
                    </label>
                </div>
                <div class="form-group">
                    <label class="w-100" for="email">
                        Initiales Passwort
                        <input id="password" type="password" class="form-control"/>
                    </label>
                </div>
                <div class="form-group form-check">
                    <label for="admin" class="form-check-input ml-1">
                        <input id="admin" type="checkbox" class="form-check-input"/>
                        Ist Admin?
                    </label>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 d-flex justify-content-end">
            <button type="button" class="btn btn-dark" onclick="create()">Hinzufügen</button>
        </div>
    </div>
</div>
<script type="application/javascript">
    const strongRegex = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})');

    function create() {
        let name = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let admin = $('#admin').checked;

        if (!password.match(strongRegex)) {
            displayError('Passwort entspricht nicht den Mindestanforderungen');
        }

        if (name.trim() === '' || email.trim() === ''){
            displayError('Bitte füllen Sie alle Felder aus.')
        }

            let request = {
                name: name,
                email: email,
                password: password,
                admin: admin
            };

        doRequest(backend + "/api/teacher", {...getJsonHeader(), method: 'POST', body: JSON.stringify(request)})
            .then(response => {
                if (response.status === 200) {
                    displayError('Lehrer erfolgreich angelegt.');

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else if (response.status === 400) {
                    displayError('Fehler beim Lehrer anlegen.');
                } else if (response.status === 401) {
                    displayError('Sie dürfen keine Lehrer anlegen.');
                }

                $('.container').scrollTop(0);
            });
    }

    $(function () {
        $('input').on('keypress', (event) => {
            if (event.key === 'Enter') {
                create();
            }
        });
    });
</script>