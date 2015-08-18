<style>
#post-textarea {
    height: 87px;
    border: solid 1px #E0E0E0;
    border-radius: 4px;
    resize: none;
    background: #FFF;
}
</style>
<!-- php for posting request -->
<?php
    $user = $sesuser['username'];
    $helprequest = @$_POST['post-textarea'];
    $pagepost = @$_POST['page'];
    if ($helprequest != "") {
    $date_added = date("Y-m-d");
    $added_by = $user;
    $page = $pagepost;
    $sqlCommand = "INSERT INTO helpwanted VALUES('', '$helprequest','$date_added','$added_by','$page')";  
    $query = mysql_query($sqlCommand) or die (mysql_error()); 
    }
?>

<div class="masonry-grid">

    <!-- Write post card -->
    <div class="grid-item card grey lighten-5">
        <form style="margin-bottom: 0px;" method="POST">
            <div class="card-content">            
                <textarea id="post-textarea" name="post-textarea" placeholder="Write a help request!" style="padding: 8px;"></textarea>
                <textarea id="post-textarea" name="page" placeholder="What page should it be on!" style="padding: 8px;"></textarea>
            </div>
            <div class="card-action">
                <button type="submit" class="teal-text btn-flat" name="send" style="height: 24px; line-height: 0px; padding: 0px;">Post</button>
            </div>
        </form>
    </div>
    
        <?php
        //Allow use of user defined functions
        if ($category == 'all') {
        $gethelp = mysql_query("SELECT * FROM helpwanted WHERE id>= '0' ORDER BY id DESC") or die (mysql_error());
        while ($row = mysql_fetch_assoc($gethelp)) {
            $username = $row['added_by'];
            getInfo($username);
            //echo $user_info['email'];
            echo filterwords( '
            <div class="grid-item card">
                <div class="card-content">
                    <div><!-- Name and avatar of post -->
                        <div class="right">
                            <i class="material-icons grey-text hover-icon">flag</i>
                        </div>
                        <a href="profile.php?u='.$user_info['username'].'">
                        <img src="'.$user_info['avatar'].'" class="circle" style="width: 50px;">
                        <div style="display: inline-block; position: relative; bottom: 4px; left: 11px; overflow: visible;">
                            <span class="title black-text">'.$user_info['first_name'].' '.$user_info['last_name'].'</span>
                        </a>
                            <p style="position: relative; bottom: 5px;">'.$row['date_added'].'</p>
                        </div>
                    </div>
                    <div style="padding-top: 5px;">
                        <p style="line-height: 24px;">'.htmlspecialchars($row['helprequest']).'</p>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#" class="teal-text">Reply</a>
                </div>
            </div>
            ');
        }
        
        }
        else
        {
        $gethelp = mysql_query("SELECT * FROM helpwanted WHERE page= '$category' ORDER BY id DESC") or die (mysql_error());
        while ($row = mysql_fetch_assoc($gethelp)) {
            $username = $row['added_by'];
            getInfo($username);
            //echo $user_info['email'];
            echo filterwords( '
            <div class="grid-item card">
                <div class="card-content">
                    <div><!-- Name and avatar of post -->
                        <div class="right">
                            <i class="material-icons grey-text hover-icon">flag</i>
                        </div>
                        <a href="profile.php?u='.$user_info['username'].'">
                        <img src="'.$user_info['avatar'].'" class="circle" style="width: 50px;">
                        <div style="display: inline-block; position: relative; bottom: 4px; left: 11px; overflow: visible;">
                            <span class="title black-text">'.$user_info['first_name'].' '.$user_info['last_name'].'</span>
                        </a>
                            <p style="position: relative; bottom: 5px;">'.$row['date_added'].'</p>
                        </div>
                    </div>
                    <div style="padding-top: 5px;">
                        <p style="line-height: 24px;">'.htmlspecialchars($row['helprequest']).'</p>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#" class="teal-text">Reply</a>
                </div>
            </div>
            ');
        }
        }
    ?>
    
</div>
