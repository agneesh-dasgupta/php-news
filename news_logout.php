<!DOCTYPE html>
    <html>
        <head>
            <title></title>
        </head>
        <body>
            <?php
            //simple php file that will simply logout the user if user clicks on logout button in main_page.php
                session_start();
                session_destroy();
                header("Location: loginnews.html");
                exit;
            ?>
        </body>
    </html>