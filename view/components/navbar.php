<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">EEPIS HIMIT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/praktikum_5/view/home.php">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php session_start();
                    if ($_SESSION['auth'] == true) {
                        echo $_SESSION['username'];
                    } else {
                        echo 'user';
                    } ?>
                </a>
                <?php if ($_SESSION['auth'] == true) : ?>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/praktikum_5/view/home.php?auth=false">logout</a>
                    </div>
                <?php else : ?>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/praktikum_5/view/auth/login.php">login</a>
                        <a class="dropdown-item" href="/praktikum_5/view/auth/register.php">register</a>
                    </div>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</nav>