<?php require PAGE_HEAD . ".php"; ?>

<div class="navbar">
    <?php require PAGE_NAVIGATION . ".php"; ?>
</div>

<div id="section-landing">
    <div class="wrapper-landing">
        <h1>My Model View Project</h1>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <h2>You are logged in</h2>
        <?php else : ?>
            <h2>You are not logged in</h2>
        <?php endif; ?>
    </div>
</div>
</body>
</html><?php /** Close body and html tag. Which are opened in head.php file. */ ?>
