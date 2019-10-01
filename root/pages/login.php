<div class="container">
    <div class="row justify-content-center d-none" id="error-container">
        <div class="col-lg-6 col-md-8 col-sm-10 col-12">
            <div class="alert alert-danger" id="error-div">

            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Anmelden
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="w-100" for="email">
                            E-Mail
                            <input
                                    id="email"
                                    class="form-control"
                                <?php if ($user->isBlocked()) echo "disabled='disabled'"; ?>
                            />
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="w-100" for="password">
                            Passwort
                            <input
                                    id="password"
                                    class="form-control"
                                    type="password"
                                <?php if ($user->isBlocked()) echo "disabled='disabled'"; ?>
                            />
                        </label>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button
                            type="button"
                            class="btn btn-dark"
                            onClick={this.login}
                        <?php if ($user->isBlocked()) echo "disabled='disabled'"; ?>
                    >
                        Anmelden
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    let failed = 0;

    function displayError(error) {
        $('#error-container').removeClass('.d-none');
        $('#error-div').text(error);
    }

    function login() {
        let email = $('#email').val();
        let password = $('#password').val();

        fetch(`<?php echo $backend; ?>/api/login`, {
            method: 'POST',
            body: {email: email, password: password}
        }).then(resp => {
            if (!resp.ok) {
                if (resp.status === 401) {
                    failed++;

                    if (failed === 3) {
                        $("input").prop('disabled', true);
                        displayError("Ihr Account wurde auf Grund zu vieler fehlgeschlagener Login Versuche gesperrt. Bitte wenden Sie sich an einen Administrator.")
                    } else {
                        displayError(`Benutzerdaten falsch. Noch ${3 - failed} Versuche.`)
                    }
                } else if (resp.status === 404) {
                    displayError("Benutzerdaten falsch.");
                }
            }

            resp.json().then(json => {
                let user = {
                    name: json.name,
                    email: json.email,
                    admin: json.administrator,
                    blocked: json.blocked,
                    passwordChanged: json.passwordGeaendert,
                    token: json.token,
                    isAuthenticated: true
                };

                document.cookie = `user=${JSON.stringify(user)}; max-age=86400; path=/;`;

                if (json.passwordGeaendert) {
                    window.location.href = "/reset-password";
                } else {
                    window.location.href = "/rooms";
                }
            });
        }).catch(() => {
            displayError("Ein Netzwerkfehler ist aufgetreten.");
        });
    }

    $('input').on('keypress', (event) => {
        if (event.key === 'Enter') {
            login();
        }
    });
</script>
