<?php require PAGE_HEAD . ".php"; ?>

<div class="navbar">
    <?php require PAGE_NAVIGATION . ".php"; ?>
</div>
<div id="section-landing">

    <div class="wrapper-account">
        <h2>Hello <?= $_SESSION["username"] ?></h2>
        <h2> Manage or delete you're account here.</h2>

        <hr>

        <form action="<?= URL_ACCOUNT; ?>" method="POST">
            <input type="hidden" name="username" value="<?= $_SESSION["username"] ?>">
            <table id="tableStyle">
                <tr>
                    <th scope="row">
                        <label for="email">Change you're email here:</label>
                    </th>
                    <td>
                        <input type="text" name="email" placeholder="Email" value="<?= $_SESSION["email"]; ?>" id="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="emailSubmit"></label>
                    </th>
                    <td>
                        <button type="submit" name="submit" value="email" id="emailSubmit">submit</button>
                    </td>
                </tr>
                <p><?= $userData["emailError"]; ?></p>
            </table>
        </form>

        <hr>

        <form action="<?= URL_ACCOUNT; ?>" method="POST">
            <input type="hidden" name="username" value="<?= $_SESSION["username"] ?>">
            <table id="tableStyle">
                <tr>
                    <th scope="row">
                        <label for="password">Change you're password:</label>
                    </th>
                    <td>
                        <input type="password" name="password" id="password" placeholder="Password">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="confirmPassword">Confirm you're password:</label>
                    </th>
                    <td>
                        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm password">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="passwordSubmit"></label>
                    </th>
                    <td>
                        <button type="submit" name="submit" value="password" id="passwordSubmit">submit</button>
                    </td>
                </tr>
                <p><?= $userData["passwordError"] ? $userData["passwordError"] : $userData["confirmPasswordError"]; ?></p>
            </table>
        </form>

        <hr>

        <form action="<?= URL_CONFIRM; ?>/" method="POST">
            <p>Delete you're account!</p>
            <input type="submit" name="submit" value="Delete" id="submit">
        </form>
    </div>
</div>
</body>
</html>
<?php /** Close body and the html tag. Which is opened in the head.php file. */ ?>
