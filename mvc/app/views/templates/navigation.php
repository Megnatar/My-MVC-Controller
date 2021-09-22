<nav class="top-nav">
    <div class="navbarPhpInfo">
        <ul class="justifyStart">
            <div>
                <li>
                    <a href="<?= URL_PHPINFO; ?>">php info</a>
                </li>
            </div>
        </ul>

        <ul class="justifyEnd">

            <?php if (($_SERVER['REQUEST_URI']) == "/mvc/index") : ?>
            <?php else : ?>
            <?php endif; ?>

            <li>
                <a href="<?= URL_INDEX; ?>">Home |</a>
            </li>
            <li>
                <a href="<?= URL_ABOUT; ?>">About |</a>
            </li>
            <?php if (isset($_SESSION['user_id'])) : ?>
            <li class="btn-login">
                <a href="<?= URL_ACCOUNT; ?>">Account |</a>
            </li>
            <?php endif; ?>
            <li class="btn-login">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="<?= URL_LOGOUT; ?>">Log out |</a>
            <?php else : ?>
                <a href="<?= URL_LOGIN; ?>">Login |</a>
            <?php endif; ?>
            </li>
        </ul>
    </div>

</nav>
