<?php
require('connect-imdb.php');
require('imdb_db.php');

$list_of_comments_by_user = getComment_byUser($_SESSION['username']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Back to Home") {
        echo "<script> window.location.href = 'sampleImdb.php'; </script>";
    }
    else if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Delete") {
        deleteComment($_POST['comment_to_delete'], $_SESSION['username']);
        $list_of_comments_by_user = getComment_byUser($_SESSION['username']);
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
    
  <title>Comments Page</title>
  
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
     
  
  <style>
      h1 {
          font-size: 45px;
      }
      p {
        margin-top: 5px; 
        font-family: Impact;
        font-size: 20px;
      }
      .card {
          background-color: moccasin;
      }
      img {
        padding: 10px;
        margin-left: auto;
        margin-right: auto;
      }
    </style>
</head>

<body style="background-color: black;">
    
    <div style="font-size: 35px; font-family: Impact; color: #F6BE00;">Comments by <?php echo $_SESSION['username']?> </div>
    <?php foreach ($list_of_comments_by_user as $comment):  ?>
        <div class="card mt-4" style="background-color: white; margin-left: 25px; width: 400px; padding:5px;">
            <div style="font-family: impact; font-size: 20px;" >
            Title:    <?php echo $comment['title'] ?> <br> </div>
            Movie Name: <?php echo $comment['Series_Title'] ?> <br>
            Content: <?php echo $comment['content'] ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="submit" value="Delete" name="btnAction" class="btn btn-danger" />
                <input type="hidden" name="comment_to_delete" value="<?php echo $comment['title'] ?>" />      
            </form></td> 
        </div>
    <?php endforeach; ?> -->

    <form action="<?php $_SERVER['PHP_SELF'] ?>"method="post">
        <input style="margin: 0 auto; display: block;" type="submit" value="Back to Home" name="btnAction" 
        class="btn btn-info" title="back home" />
    </form>

</body>
</html>