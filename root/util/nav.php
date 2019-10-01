<?php
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3 sticky-top">
    <a class="navbar-brand rabe-logo" href="/">RaBe</a>
    <?php if ($user->isAuthenticated()): ?>
        <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class='nav-item <?php if ($uri === "/rooms") echo "active"; ?>'>
                    <a class="nav-link" href="/rooms">
                        Räume
                    </a>
                </li>
                <li class='nav-item dropdown <?php if (startsWith($uri, '/supervisor')) echo "active"; ?>'>
                    <a
                            href="#"
                            class="nav-link dropdown-toggle"
                            id="navbarDropdownMenuBetreuer"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                    >
                        Betreuer
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/supervisor/defects">Gemeldete Mängel</a>
                        <a class="dropdown-item" href="/supervisor/rooms">Betreute Räume</a>
                        <a class="dropdown-item" href="/supervisor/common-defects">Häufige Mängel</a>
                    </div>
                </li>
                <?php if ($user->isAdmin()): ?>
                    <li class='nav-item dropdown <?php if (startsWith($uri, "/admin")) echo "active"; ?>'>
                        <a
                                href="#"
                                class="nav-link dropdown-toggle"
                                id="navbarDropdownMenuAdmin"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                        >
                            Administration
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/admin/teachers">Lehrerverwaltung</a>
                            <a class="dropdown-item" href="/admin/rooms">Raumverwaltung</a>
                            <a class="dropdown-item" href="/admin/categories">Kategorieverwaltung</a>
                        </div>
                    </li>
                <?php endif; ?>
                <li class='nav-item dropdown <?php if (startsWith($uri, "/user")) echo "active"; ?>'>
                    <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdownMenuUser"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                    >
                        Benutzer
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/reset-password">Passwort ändern</a>
                        <button type="button" class="dropdown-item" onClick={logoutUser}>Abmelden</button>
                    </div>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</nav>
