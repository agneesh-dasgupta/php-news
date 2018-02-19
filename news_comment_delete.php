<!DOCTYPE html>
    <html>
        <head>
            <title></title>
        </head>
        <body>
            <?php
                require 'database.php';
                //query that will delete a comment based on the given id
                //will be called when pushing delete comment in the view_story
                $comment_id= $_POST['comment_id'];       
                $stmt = $mysqli->prepare("delete from comments where comment_id=?");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
    
                $stmt->bind_param('i', $comment_id);
    
                $stmt->execute();

                
                $stmt->close();
                //redirects to the main page
                header("Location: main_page.php");
            ?>
        </body>
    </html>