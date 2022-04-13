<?php

require('connect-imdb.php');
require('imdb_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Register") {
      registerUser($_POST['username'], $_POST['email'], $_POST['password']);
    }
}


?>

<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 
  Bootstrap is designed to be responsive to mobile.
  Mobile-first styles are part of the core framework.
   
  width=device-width sets the width of the page to follow the screen-width
  initial-scale=1 sets the initial zoom level when the page is first loaded   
  -->
  
  <meta name="author" content="sarah gould">
  <meta name="description" content="include some description about your page">  
    
  <title>Sample IMDB</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- you may also use W3's formats -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
  <!-- 
  Use a link tag to link an external resource.
  A rel (relationship) specifies relationship between the current document and the linked resource. 
  -->
  
  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> --> 
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <!--  open the dropdown if movie fields need to be updated-->
  <!-- reference: https://stackoverflow.com/questions/58911249/maintain-colllapse-state-after-refresh -->
  <script>
      $(function() {
        const collapseTrigger = $("#content");
        if(<?php echo $open_menu; ?> != null) {
            collapseTrigger.collapse("show");
        }
        
      });
  </script>    
  
  <style>
    h2 {font-family: Impact; color: #F6BE00; text-align: center;}
    b {color: white;}
    
    .wrapper{ width: 360px; padding: 20px; }
    
    </style>


</head>
 
    

    <body style="background-color: black;">

    <h2 > Weclome to IMDB Movie Guide!</h2>
    <div class="wrapper">
        <form action="register.php" method="post" id="register User">

            <b>Username:</b> <input type="text" class="form-control" name="username">
            <b>Email: </b> <input type="text" class="form-control" name="email">
            <b>Password: </b> <input type="password" class="form-control" name="password">

            <input type="submit" value="Register" name="btnAction" class="btn btn-secondary"
            title = "register user" />

        </form>
    </div>
    <p style="font-size: 20px; color: white; margin-left: 25px">Already have an account? <a href="login.php">Log in here</a>.</p>
    </body>
</html>