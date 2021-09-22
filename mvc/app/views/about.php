<?php require PAGE_HEAD . ".php"; ?>

<div class="navbar">
    <?php require PAGE_NAVIGATION . ".php"; ?>
</div>

<div class="container">
    <div class="wrapper-tree">
        <h2>Project files and folders</h2>

        <ul id="tree-view">
            <li><span class="caret caret-down">MVC</span>
                <ul class="nested active">
                    <li>.htaccess</li>
                    <li><span class="caret">app</span>
                        <ul class="nested">
                            <li>.htaccess</li>
                            <li>initialize.php</li>
                            <li><span class="caret">config</span>
                                <ul class="nested">
                                    <li>constants.php</li>
                                </ul>
                            </li>
                            <li><span class="caret">controllers</span>
                                <ul class="nested">
                                    <li>Pages.php</li>
                                    <li>Users.php</li>
                                </ul>
                            </li>
                            <li><span class="caret">lib</span>
                                <ul class="nested">
                                    <li>Url_Handler.php</li>
                                    <li>Controller.php</li>
                                    <li>Database.php</li>
                                </ul>
                            </li>
                            <li><span class="caret">models</span>
                                <ul class="nested">
                                    <li>User.php</li>
                                </ul>
                            </li>
                            <li><span class="caret">views</span>
                                <ul class="nested">
                                    <li>about.php</li>
                                    <li>index.php</li>
                                    <li>phpinfo.php</li>
                                    <li><span class="caret">templates</span>
                                        <ul class="nested">
                                            <li>head.php</li>
                                            <li>navigation.php</li>
                                        </ul>
                                    </li>
                                    <li><span class="caret">users</span>
                                        <ul class="nested">
                                            <li>account.php</li>
                                            <li>login.php</li>
                                            <li>register.php</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><span class="caret">public</span>
                        <ul class="nested">
                            <li>.htaccess</li>
                            <li><span class="caret">css</span>
                                <ul class="nested">
                                    <li>style.css</li>
                                    <li>phpinfo.css</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="wrapper-about">
        <h2>Basic explanation about load order and the app folders.</h2>
        <br>
        <h2>Load order</h2>
        <p>
            When the browser sees the root folder 'mvc'. It will only read the .htaccess file and it wil tell
            the browser to 'look' in the public directory. From inside the public folder the first index.php file is loaded.
            This index.php file will load initialize.php from app folder. The app folder is secured and is not visible
            from inside the browser. This is where all the 'stuff' happens.
        </p>
        <p>
            initialize.php is also just an other reverence and it will load all the files from the lib and config folder.
            The Url_Handler.php is responsible for handling url input. It formats them and retuns url  object, method
            or parameters to it's caller. These Pages.php or Users.php controller classes. they hold methods
            for index, about, phpinfo and account related pages.
        </p><br>
        <h2>App folder</h2>
        <p>
            Config folder:<br>
            This is where site constants and namespaces are stored.<br>
            <br>
            Controller folder:<br>
            Pages.php which contains the methods that loads the index.php, about.php and phpinfo.php.<br>
            The Users.php is responsible for handling user data, errors and initiates loading pages.<br>
            <br>
            lib:<br>
            Url_Handler.php class handles url's. It formats and passes them back to the requester via callback.<br>
            Controller.php class will load the requested pages at the into the browser.<br>
            Database.php handles connections with the SQL DB, holds all PDO methods..<br>
            <br>
            models:<br>
            User.php use PDO with prepared statements to communicate with the SQL database.<br>
            <br>
            views:<br>
            Contains the views. Which are in it's essence, all the html pages displayed to the user.<br>
        </p>
    </div>
</div>
<script>
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }
</script>
</body>
</html><?php /** Close body and html tag. Which are opened in head.php file. */ ?>