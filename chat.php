<!doctype>
<html>
<head>
    <title>Global Chat</title>
    <?php
    include('include/dbcon.php');
    ?>
    <script src="jquery.js"></script>
    <script> 
        $(document).ready(function() {
            $('#messages').load('ajaxload.php');
            $(function(){
                $('#postchat').submit(function() {
                    $.post('ajaxpost.php', $('#postchat').serialize(),function(messages) {
                        $('#messages').append('messages');
                        $('#input').val('');
                    });
                    return false;
                });
            });
            setInterval(oneSecondFunction, 1000);
            function oneSecondFunction() {
                $("#messages").load('ajaxload.php');
            }
        }); 
    </script>

    <?php include('include/import.php');?>

    <style>
        #messages {
            height: 400px;
            width: 100%;
            overflow-y: scroll;
            overflow-x: hidden;
            background: #f7f8f8;
        }

        .msgto {
            position: relative;
            text-align: right;
            right: 60px;
        }

        .msgfrom .info {
            position: relative;
            top: 3px;
            left: 60px;
            margin: 5px;
            font-size: 9.5pt;
            color: #899;
        }

        .msgto .info {
            position: relative;
            top: 3px;
            right: 2px;
            margin: 5px;
            font-size: 9.5pt;
            color: #899;
        }

        .avatar {
            width: 40px; height: 40px;
            border-radius: 50%;
            margin: 0px 9px;
        }

        .msgfrom .avatar { float: left; }

        .msgto .avatar { position: absolute; bottom: 20px; }

        .msgcontent {
            background-color: #455a64;
            position: relative;
            display: inline-block;
            border-radius: 8px;
            max-width: 60%;
            top: 2px;
            padding: 3px 15px;
            color: #fff;
        }

        .msgto .msgcontent { background: #dedede; color: #000; }

        .string {
            line-height: 19px;
            display: block;
            margin: 6px 0px;
            text-align: left;
        }
    </style>
</head>

<body style="height: 100%;">
    <?php include('include/header.php');?>

    <!-- Main container -->
    <div class="container card z-depth-1" style="margin: 0 auto; overflow: visible;">
        <br/>

        <!-- Messages container -->
        <div id="messages"></div>


        <hr />

        <!-- Post -->
        <form id="postchat">
            <input type="text" id="input" maxlength="255" name="messages" placeholder="Write a message..."/>
        </form>
        </div>


</body>

</html>
