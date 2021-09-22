<?php require PAGE_HEAD . ".php"; ?>

<div class="navbar">
    <?php require PAGE_NAVIGATION . ".php"; ?>
</div>

<div class="container-login" >
    <div class="wrapper-login">
        <h2>Login</h2>
        
        <form action="<?= URL_LOGIN; ?>" method="POST">
            <input type="text" name="username" placeholder="Username">
            <p class="invalidFeedback">
                <?= $userData["usernameError"]; ?>
            </p>
            
            <input type="password" name="password" placeholder="Password">
            <p class="invalidFeedback">
                <?= $userData["passwordError"]; ?>
            </p>

            <input type="submit" value="Submit" id="submit">

            <p><a href="<?= URL_REGISTER; ?>/" class="register">Click here to create a new account</a></p>
        </form>
    </div>
</div>
</body>
</html><?php /** Close body and html tag. Which are opened in head.php file. */ ?>