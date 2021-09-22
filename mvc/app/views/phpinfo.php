<?php require PAGE_HEAD . ".php"; ?>

<div class="navbar">
    <?php require PAGE_NAVIGATION . ".php"; ?>
</div>

<div class="container" style="margin-right: 12%;">
    <div class="phpinfo">
        <?php phpinfo() . PHP_EOL; ?>
        <!-- Override the default phpinfo() style. -->
        <link rel="stylesheet" href="<?= URL_ROOT; ?>/public/css/phpinfo.css">
    </div>
</div>
</body>
</html><?php /** Close body and html tag. Which are opened in head.php file. */ ?>