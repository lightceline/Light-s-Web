<?php
// Check if user is logged in


require_once __DIR__ . '/../includes/session.php';
checkLogin();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/home.css">
        <link rel="stylesheet" href="../css/post.css">
        <title>Light</title>
    </head>
    <body>
        <header>
            <div class="top-bar">
                <nav>
                    <div class="nav-left">
                        <a href="index.php">Light</a>
                    </div>
                    <div class="nav-right">
                        <a href="contact.php">Contact</a>
                        <a href=""><?= htmlspecialchars($_SESSION['username']) ?></a>
                        <form action="../login/logout.php" method="post">
                            <button type="submit" class="logout-btn">Log Out</button>
                        </form>
                    </div>
                </nav>
            </div>
        </header>
        
        <div class="leftbar">
            <h2>Menu</h2>
            <nav>
                <a href="addpost.php">New Post</a>
                <!-- <a href="viewmodule.php">Module</a> -->
                <a href="controlpanel.php">Control Panel</a>
            </nav>
        </div>
        
        <main>
            <?=$output?>
        </main>
        
        <footer>&copy; Light</footer>
    </body>
</html>