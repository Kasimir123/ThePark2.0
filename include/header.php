<style>
#sidenav-overlay {
    z-index: 9;
}

#hamburger {
    position: relative; 
    right: 5px;
    font-size: 30px;
    color: #666;
}
</style>

<nav class="white" role="navigation" style="position: relative; z-index: 10;">
    <div class="nav-wrapper container">

        <!-- Add links to hamburger menu for mobile devices -->
        <ul id="nav-mobile" class="side-nav">
            <?php
                //Add links to hamburger menu for loggin in and out, depending on if the user has already logged in
                if (isset($sesuser['id'])) {
                    echo '<li><a href="profile.php">Profile</a></li>';
                    echo '<li><a href="settings.php">Settings</a></li>';
                    echo '<li><a href="chat.php">Chat</a></li>';
                    echo '<li><a href="helpcenter.php">Help Center</a></li>';
                    echo '<li class="divider"></li>';
                    echo '<li><a class="modal-trigger" href="php/logout.php">Log Out</a></li>';
                } else {
                    echo '<li><a class="modal-trigger" href="#loginmodal">Log In</a></li>';
                    echo '<li><a class="modal-trigger" href="#signupmodal">Sign Up</a></li>';
                }
            ?>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons" id="hamburger">menu</i></a>

        <?php
            //Search box
            $u = "";
            if (isset($_SESSION['user_login'])) {
                if ($u) {
                    $uq = $_POST['u'];
                }
                echo '<div class="search_box left" style="width: 75%;">
                          <form action="profile.php?u=$uq" method= "GET" id= "search">
                              <input class="black-text" type="text" name="u" id="u" size="60" width="100px" placeholder="Search ..." />
                          </form>
                      </div>';
            }
        ?>

        <ul class="right hide-on-med-and-down">
            <?php
                //Add links at top for loggin in and out, depending on if the user has already logged in
                if (isset($_SESSION['user_login'])) {
                    echo '<a class="dropdown-button black-text" data-activates="notifications" style="display: inline-block; padding: 5px; position: relative; bottom: 3px; cursor: pointer;"><i class="material-icons" style="font-size: 1.8rem;">notifications</i>';
                    echo '<a class="dropdown-button black-text" data-activates="navigation" style="display: inline-block; cursor: pointer;"><img src="'.$sesuser['avatar'].'" id="smallavatar"/></a>';
                } else {
                    echo '<li><a class="modal-trigger" href="#loginmodal">Log In</a></li>';
                    echo '<li><a class="modal-trigger" href="#signupmodal">Sign Up</a></li>';
                }
            ?>

            <!-- Navigation dropdown menu -->
            <ul id="navigation" class="dropdown-content">
                <li><a href="profile.php">Profile</a></li>
                <li><a href="chat.php">Chat</a></li>
                <li><a href="helpcenter.php">Help Center</a></li>
                <li class="divider"></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a class="modal-trigger" href="php/logout.php">Log Out</a></li>
            </ul>

            <!-- Notifications dropdown menu -->
            <ul id="notifications" class="dropdown-content black-text" style="padding: 15px;">
                <p>Kasimir wants to be your friend</p>
                <li><a href="profile.php">Test</a></li>
            </ul>
        </ul>

        
    </div>


</nav>

<!-- Log in modal -->
<div id="loginmodal" class="modal align-center">
    <div class="modal-content center-align">
        <h4>Log In</h4>
        <?php include('include/login.html');?>
    </div>
</div>

<!-- Sign up modal -->
<div id="signupmodal" class="modal">
    <div class="modal-content center-align">
        <h4>Sign Up</h4>
        <?php include('include/signup.html');?>
    </div>
</div>

<script>

$(document).ready(function() {
    //Settings for dropdown menus. Doesn't work when put in init.js
    $('.dropdown-button').dropdown({
            inDuration: 300,
            outDuration: 225,
            constrain_width: false, // Does not change width of dropdown to that of the activator
            hover: false, // Activate on hover
            belowOrigin: true // Displays dropdown below the button
        }
    );
})

</script>
