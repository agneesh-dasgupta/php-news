<!DOCTYPE html>
    <html>
        <head>
            <title></title>
        </head>
        <body>
            <?php
                require 'database.php';
                //selects the comment_text based on the comment_id given
                $comment_text= (string) $_POST['comment_text'];
                $comment_id= (int) $_POST['comment_id'];
                $stmt = $mysqli->prepare("select comment_text from comments where comment_id=?");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
    
                $stmt->bind_param('i', $comment_id);
    
                $stmt->execute();
                 $stmt->bind_result($comment_text);

                 //Will print off a textbox with the comment text to be edited 
                while($stmt->fetch()){
                    echo "<form action = 'edit_comment.php' method = POST>";
                    echo '<textarea name = "comment_text">' . $comment_text . '</textarea>';
                    echo "<label for='viewbutton'></label>";
                    echo "<input type='submit' id ='viewbutton' value='Edit Comment'/>";
                    echo '<input type = "hidden" name = "comment_id" value ="'.$comment_id.'" >';
                    echo "</form>";
                }
                
                
                $stmt->close();
                
            ?>
        </body>
    </html>