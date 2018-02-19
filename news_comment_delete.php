<!DOCTYPE html>
    <html>
        <head>
            <title></title>
        </head>
        <body>
            <?php
                $comment_id= $_POST['comment_id'];       
                $stmt = $mysqli->prepare("delete from where comment_id=?");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
    
                $stmt->bind_param('i', $comment_id);
    
                $stmt->execute();

                
                $stmt->close();
                
            ?>
        </body>
    </html>