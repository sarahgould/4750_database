<?php

require('connect-db.php');
require('imdb_db.php');

$title = $_COOKIE["movie_to_view"];
$movie_to_view = getMovie_byTitle($title);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Back to Home") {
        header("Location: http://localhost/cs4750/sampleImdb.php");
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
    <br>
    <h1 style="text-align: center; font-family: Impact; color: #F6BE00;"><?php echo $title; ?></h1>
    
    <div class="w3-row">
    <div class="w3-col s4 w3-center" style="padding: 20px;">
            <div class="card">
                <p>Movie Info:</p> 
                Released Year: <?php echo $movie_to_view['year']; ?> <br>
                Gross: <?php echo $movie_to_view['gross']; ?> <br>
                Runtime (min): <?php echo $movie_to_view['runtime']; ?> <br>
                IMDB Rating: <?php echo $movie_to_view['rating']; ?> <br>
                <br>
                Genre(s): <br>
                <br>
                <button type="button" style="margin-left: 100px; margin-right: 100px;" class="btn btn-info" data-toggle="collapse" data-target="#genreSubmit" id="dropMenu">Add Genre</button>
                <br>
                <div id="genreSubmit" class="collapse">
                    <form action="movieView.php" method="post">
                        <div>
                            <div style="display: inline-block;"> Type: </div>    
                            <div style="display: inline-block;">
                            <input type="text" style="width:150px;" class="form-control" name="genreType"> </div>
                        </div>
                        <br>
                        <div>
                            <div style="display: inline-block;"> Description: </div>    
                            <div style="display: inline-block;">
                            <input type="text" style="width:300px;" class="form-control" name="genreDescription"> </div>
                        </div>
                        <br>
                        <input type="submit" value="Submit Genre" name="btnAction" class="btn btn-secondary" title = "add genre" />
                    </form>
                </div>
                <br>

            </div>
        </div>
        <div class="w3-col s4 w3-center" style="padding: 20px;">
            <div class="card">
                <p>Star Names:</p> 
                <button type="button" style="margin-left: 100px; margin-right: 100px;" class="btn btn-info" data-toggle="collapse" data-target="#starSubmit" id="dropMenu">Add Star</button>
                <br>
                <div id="starSubmit" class="collapse">
                    <form action="movieView.php" method="post">
                        <div>
                            <div style="display: inline-block;"> Star Name: </div>    
                            <div style="display: inline-block;">
                            <input type="text" style="width:150px;" class="form-control" name="starName"> </div>
                        </div>
                        <br>
                        <input type="submit" value="Submit Star" name="btnAction" class="btn btn-secondary" title = "add star" />
                    </form>
                </div>
                <br>
            </div>
        </div>
        <div class="w3-col s4 w3-center" style="padding: 20px;">
            <div class="card">
                <p>Poster:</p> 
                <img style="padding: 10px; max-width:50%;" src="link" alt="poster here">
                <button type="button" style="margin-left: 100px; margin-right: 100px;" class="btn btn-info" data-toggle="collapse" data-target="#posterAdd" id="dropMenu">Embed Poster</button>
                <br>
                <div id="posterAdd" class="collapse">
                    <form action="movieView.php" method="post">
                        <div>
                            <div style="display: inline-block;"> Poster Link: </div>    
                            <div style="display: inline-block;">
                            <input type="text" style="width:150px;" class="form-control" name="posterLink"> </div>
                        </div>
                        <br>
                        <input type="submit" value="Submit Poster" name="btnAction" class="btn btn-secondary" title = "add poster link" />
                    </form>
                </div>
                <br>
            </div>
        </div>

    </div>   
    
    <form action="movieView.php"method="post">
        <input style="margin: 0 auto; display: block;" type="submit" value="Back to Home" name="btnAction" 
        class="btn btn-info" title="back home" />
    </form>

</body>
</html>