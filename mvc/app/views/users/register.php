<?php require PAGE_HEAD . ".php"; ?>

<div class="navbar">
    <?php require PAGE_NAVIGATION . ".php"; ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>

        <form id="register-form" method="POST" action="<?= URL_REGISTER; ?>">
            <input type="text" name="username" placeholder="Username">
            <p class="invalidFeedback">
                <?= $userData["usernameError"]; ?>
            </p>

            <input type="email" name="email" placeholder="Email">
            <p class="invalidFeedback">
                <?= $userData["emailError"]; ?>
            </p>

            <input type="password" name="password" placeholder="Password">
            <p class="invalidFeedback">
                <?= $userData["passwordError"]; ?>
            </p>

            <input type="password" name="confirmPassword" placeholder="Confirm Password">
            <p class="invalidFeedback">
                <?= $userData["confirmPasswordError"]; ?>
            </p>

            <button id="submit" type="submit" value="submit">Submit</button>
        </form>
    </div>
</div>
</body>
</html><?php /** Close body and html tag. Which are opened in head.php file. */ ?>