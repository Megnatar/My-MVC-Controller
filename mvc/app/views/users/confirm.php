<?php require PAGE_HEAD . ".php"; ?>

<div class="navbar">
    <?php require PAGE_NAVIGATION . ".php"; ?>
</div>
<div class="container-login" >
    <div class="wrapper-login">
        <h2>Confirm delete!</h2>

        <form action="<?= URL_CONFIRM; ?>" method="POST">
            <th>
                <tr>
                    <td>
                        <input type="hidden" name="username" value="<?= $_SESSION["username"] ?>">
                        <input type="submit" name="submit" id="submit" value="Ok">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" id="submit" value="Cancel">
                    </td>
                </tr>
            </th>
        </form>
    </div>
</div>
</body>
</html><?php /** Close body and html tag. Which are opened in head.php file. */ ?>