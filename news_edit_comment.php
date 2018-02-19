<!DOCTYPE html>
    <html>
        <head>
            <title></title>
        </head>
        <body>
            <?php
                $comment_text= $_POST['comment_text'];
                $comment_id= $_POST['comment_id'];
                $stmt = $mysqli->prepare("select comment_text from comments where comment_id=?");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
    
                $stmt->bind_param('si', $comment_text, $comment_id);
    
                $stmt->execute();

                while($stmt->fetch()){
                    echo "<form action = 'edit_comment.php' method = POST>";
                    echo '<textarea name = "comment_text">' $comment_text '</textarea>';
                    echo "<label for='viewbutton'></label>";
                    echo "<input type='submit' id ='viewbutton' value='Edit Comment'/>";
                    echo "</form>";
                }
                
                
                $stmt->close();
                
            ?>
        </body>
    </html>