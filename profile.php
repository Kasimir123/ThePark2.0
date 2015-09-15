    <?php

    include('include/dbcon.php');

    //Redirect user to main page if not signed in
    if (!isset($_SESSION['user_login'])) {
        header('Location: index.php');
    }

    //Redirect user to main page if requested user doesn't exist
    $currentusername = $currentuser['username'];
    $sql_find_username = mysql_query("SELECT username FROM users WHERE username = '$currentusername'");
    if (mysql_num_rows($sql_find_username) == 0) {
        header('Location: index.php');
    }
    $user = $sesuser['username'];
    ?>

    <html>
    <head>

    <?php include('include/import.php'); ?>

    <style>

    .main {
        transition: ease-in-out all .3s;
    }

    #coverphoto {
            height: 470px;
            background-image: url(<?php echo $currentuser['cover'];?>);
            background-size: cover;
            background-position: 50% 50%;
            transition: .3s ease-in-out all;
            /*
            -webkit-box-shadow: inset 0px 17px 5px -15px rgba(0,0,0,0.2);
                 -moz-box-shadow: inset 0px 17px 5px -15px rgba(0,0,0,0.2);
                    box-shadow: inset 0px 17px 5px -15px rgba(0,0,0,0.2);*/
    }

    #gradient {
            height: inherit;
            background: rgba(0,0,0,.5);
            background: linear-gradient(0deg, rgba(0,0,0,.4), rgba(0,0,0,.1), rgba(0,0,0,0));
            position: relative;
    }

    #info {
            color: #FFF;
            width: 100%;
            text-align: center;
            position: absolute;
            bottom: 0;
            padding: 25px;
    }

    #profileavatar {
            width: 150px; border-radius: 50%;
            transition: ease-in-out all .3s;
            -webkit-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.6);
                 -moz-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.6);
                            box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.6);
    }

    #name { font-size: 27pt; font-weight: 300; }

    #bio { font-size: 14pt; position: relative; bottom: 8px; }

    #tabcontainer {
        padding: 5px 30px;
    }

    #post-textarea {
        height: 87px;
        border: solid 1px #E0E0E0;
        border-radius: 4px;
        resize: none;
        background: #FFF;
    }

    .grid {
        width: 100%;
    }

    /* clearfix */
    .grid:after {
        content: '';
        display: block;
        clear: both;
    }

    .grid-item {
        float: left;
        transition: .3s ease-in-out all;
        /* vertical gutter */
        margin-bottom: 10px;
    }

    .grid-sizer,
    .grid-item { width: 49%; }

    @media ( max-width: 900px ) {
        .grid-item {
            width: 100%;
        }
    }

    @media ( max-width: 700px ) {
        .main {
            width: 100%;
        }
        #tabcontainer {
            padding: 5px 0px;
        }
        #profileavatar {
            width: 120px;
        }
        #coverphoto {
            height: 300px;
        }
    }

    #friendbtn {
        display: inline;
        padding: 0;
    }

    </style>

    </head>
    <body style=" height: 100%;">

    <?php include('include/header.php'); ?>

    <div class="container z-depth-1 main" style="background: #f9f9f9;">

        <!-- Cover photo -->
        <div id="coverphoto">
                <div id="gradient">
                        <div id="info">
                                <img id="profileavatar" src="<?php echo $currentuser['avatar'];?>"/>
                                <h3 id="name"><?php echo $currentuser['first_name'].' '.$currentuser['last_name'];?></h3>
                                <h5 id="bio"><?php echo '@'.$currentuser['username'];?></h5>
                        </div>
                </div>
        </div>

        <!-- Tabs and content -->
        <div id="tabs" style="min-height: 534px;">
            <div class="s12" style="margin-bottom: 12px;">
                <ul class="tabs" style="width: 100px; background: #eaeaea;">
                    <li class="tab"><a href="#about">About</a></li>
                    <li class="tab"><a href="#interests">Interests</a></li>
                    <li class="tab"><a class="active" href="#posts">Posts</a></li>
                    <li class="tab"><a href="#photos">Photos</a></li>
                    <li class="tab"><a href="#places">Places</a></li>
                </ul>
            </div>

            <div id="tabcontainer"><!-- Container for content -->

                <!-- About tab -->
                <div id="about">
                    <div class="row">
                        <div class="masonry-container">
                            <div class="grid">
                                <div class="grid-sizer"></div>

                                <!-- Friends card -->
                                <div class="card grid-item">
                                    <div class="card-content">
                                        <span class="card-title black-text">Friends</span>
                                        <br/>
                                        <style> #avatar { margin: 5px 5px 0px 5px; } </style>
                                        <?php include('include/friends/all.php');?>
                                    </div>

                                    <div class="card-action" style="padding: 14px 20px;">
                                        <!-- Links -->
                                        <a href="#friendsmodal" class="modal-trigger"><button class="white teal-text  btn-flat" style="padding: 0;">See all friends</button></a>
                                        <!-- send friend request -->
                                        <?php include('include/addfriend.php');?>

                                    <form action="<?php echo 'profile.php?u='.$username; ?>" method="POST" style="margin-bottom: 0; display: inline;">

                                        <?php
                                            $friendButton = '';

                                            if ($currentuser['username'] != $sesuser['username']) {
                                                if (checkFriends($sesuser['username'],$currentuser['username'])) {
                                                    if (checkAccepted($sesuser['username'],$currentuser['username'])) {
                                                        //If the two users are already friends, create remove friend button
                                                        $friendButton = '<button type="submit" name="removefriend" id="friendbtn" class="white teal-text btn-flat">Unfriend</button>';
                                                    } else {
                                                        //If the other friend hasn't accepted yet, create cancel request button
                                                        $friendButton = '<button type="submit" name="removefriend" id="friendbtn" class="white teal-text btn-flat">Cancel Request</button>';
                                                    }
                                                } else {
                                                    //If they are friends, create add friend button
                                                    $friendButton = '<button type="submit" name="addfriend" id="friendbtn" class="white teal-text btn-flat">Add Friend</button>';
                                                }
                                            }

                                            echo $friendButton;
                                            
                                        ?>

                                    </div>

                                    </form>
                                        
                                    <!-- All friends modal -->
                                    <div id="friendsmodal" class="modal modal-fixed-footer">
                                        <div class="modal-content">
                                            <!-- Title -->
                                            <h5><?php $string = $currentuser['first_name']; echo $string.'\''.($string[strlen($string) - 1] != 's' ? 's' : '');?> friends</h5>
                                            <br/>
                                            <?php include('include/friends/formatted.php');?>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#!" class="modal-action teal-text waves-effect waves-teal btn-flat" onmouseup="$('#friendsmodal').closeModal();">Done</a>
                                        </div>
                                    </div>
                                </div>


                                <div class="grid-item card">
                                    <div class="card-content">
                                        <span class="card-title black-text">Bio</span>
                                        <br/>
                                        <?php echo htmlspecialchars($currentuser['bio']);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Interests tab -->
                <div id="interests" class="col s12">
                    <!-- Hobbies  -->
                    <div>
                        <h6>Hobbies: </h1>
                    </div> <br />
                    <hr />
                    <!-- Favorite Songs  -->
                    <div>
                        <h6>Favorite Songs: </h1>
                    </div> <br />
                    <hr />
                    <!-- Favorite Movies  -->
                    <div>
                        <h6>Favorite Movies: </h1>
                    </div> <br />
                    <hr />
                    <!-- Favorite Things To Do  -->
                    <div>
                        <h6>Things I Like To Do: </h1>
                    </div> <br />
                    <hr />
                </div>

                <!-- Posts tab -->
                <div id="posts">
                    <?php include('include/posts.php');?>
                </div>

                <!-- Photos tab -->
                <div id="photos" class="col s12">Test 4</div>
                <!-- Places tab -->
                <div  id="places" class="col s12">Test 5</div>

            </div>
        </div>
    </div>

    <script>

    $(document).ready(function() {
        loadMsnry();
    });

    $('.tab').click(function() {
        setTimeout(function() {
            loadMsnry();
        }, 1);
    })

    function loadMsnry() {
        $('.grid').masonry({
        percentPosition: true,
        columnWidth: '.grid-sizer',
        itemSelector: '.grid-item',
        transitionDuration: 0,
        gutter: 18
        });
    }

    $('.loadcomments').click(function() {
        loadMsnry();
    })

    </script>

    </body>
    </html>
