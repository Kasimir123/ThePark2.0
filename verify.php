<html>
<head>
    <title>Verify</title>
</head>
<body>
    <!-- start header div --> 
    <div>
        <h3>Verify</h3>
    </div>
    <!-- end header div -->   
     
    <!-- start wrap div -->   
<?php
//if "email" variable is filled out, send email
  if (isset($_REQUEST['email']))  {
  
  //Email information
  $admin_email = "Kasimirkhschulz@gmail.com";
  $email = $_REQUEST['email'];
  $subject = $_REQUEST['subject'];
  $comment = $_REQUEST['comment'];
  
  //send email
  mail($email, "$subject", $comment, "From:" . $admin_email);
  
  //Email response
  echo "Thank you for contacting us!";
  }
  
  //if "email" variable is not filled out, display the form
  else  {
?>

 <form method="post">
  Email: <input name="email" type="text" /><br />
  Subject: <input name="subject" type="text" /><br />
  Message:<br />
  <textarea name="comment" rows="15" cols="40"></textarea><br />
  <input type="submit" value="Submit" />
  </form>
  
<?php
  }
?>
    <!-- end wrap div --> 
</body>
</html>
