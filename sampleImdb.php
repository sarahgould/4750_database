<?php

require('connect-imdb.php');
require('imdb_db.php');

$list_of_movies = getAllMovies();
$movie_to_update = null;
$movie_to_view = null;
$open_menu = null;
$search_tilte = null;
$search_filter = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Add") {
    addMovie($_POST['title'], $_POST['year'], $_POST['gross'], $_POST['runtime'], $_POST['rating'], $_POST['director']);
    $list_of_movies = getAllMovies();
  }
  else if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Update Movie") {
    $movie_to_update = getMovie_byTitle($_POST['movie_to_update']);
    $open_menu = True;
  }
  else if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "View Movie Page") {
    $movie_to_view = getMovie_byTitle($_POST['movie_to_view']);
    setcookie("movie_to_view", $movie_to_view['Series_Title']);
    header("Location: movieView");
  }
  else if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Delete Movie") {
    deleteMovie($_POST['movie_to_delete']);
    $list_of_movies = getAllMovies();
  }
  if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Confirm Update") {
    updateMovie($_POST['title'], $_POST['year'], $_POST['gross'], $_POST['runtime'], $_POST['rating'], $_POST['director']);
    $list_of_movies = getAllMovies();
  }
  if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Submit Comment") {
    submitComment($_POST['commentContent'], $_POST['commentTitle'], $_POST['seriesTitle']);
  }
  if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Search") {
    $list_of_movies = getSearchedMovies($_POST['titleFilter']);
    $search_filter = $_POST['titleFilter'];
  }
  else if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Revert Search") {
    $list_of_movies = getAllMovies();
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
    
  <title>IMDB</title>
  
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
    h2 {font-family: Impact; color: #F6BE00;}
    h5 {color: white;}
    button {margin-left:30px; background-color: lightyellow; color:black; border:none;}
    b {font-family:Impact; text-align: center; color: white; margin-left: 25px; font-size: 15px;}
    </style>


</head>

<body style="background-color: black;">


<div class="header">
    <img src="IMDB-Logo.png" alt="IMDb logo" width="125" height="100" style="float:left;">
    <h1 style="color: #F6BE00; position: relative; top: 30px; font-family: Impact; font-size: 45px;">Movies Guide</h1>
</div>
<br>
<br>
<hr/>

<button style="margin-left:30px;" type="button" class="btn btn-info" data-toggle="collapse" data-target="#content" id="dropMenu">Add New Movie</button>

<div id="content" class="collapse" style="margin-left: 20px; margin-right: 20px;">
    <form name="mainForm" action="sampleImdb.php" method="post">
        <br>
        <div class="row mb-3 mx-3" style="text-align:left;">
        <h5>Series Title:</h5>
        <input type="text" class="form-control" name="title" required 
            value="<?php if ($movie_to_update!=null) echo $movie_to_update['Series_Title']?>"
        />
        </div>
        <div class="mb-3 mx-3">
            <div style="display:inline-block;">
            <h5>Year:</h5>
            <input style="width:150px;" type="number" class="form-control" name="year"
                value="<?php if ($movie_to_update!=null) echo $movie_to_update['Released_Year']?>"
                />
            </div> 
            <div style="display:inline-block;"> 
            <h5>Gross:</h5>
            <input type="text" class="form-control" name="gross"
                value="<?php if ($movie_to_update!=null) echo $movie_to_update['Gross'] ?>"
                />
            </div>
            <div style="display:inline-block;">
            <h5>Runtime (min):</h5>
            <input style="width:150px;" type="number" class="form-control" name="runtime" required min="0"
                value="<?php if ($movie_to_update!=null) echo $movie_to_update['Runtime'] ?>"
                />
            </div>
            <div style="display:inline-block;">
            <h5>Rating:</h5>
            <input type="number" class="form-control" name="rating" step="0.1" required min="0" max="10"
                value="<?php if ($movie_to_update!=null) echo $movie_to_update['IMDB_Rating'] ?>"
                />
            </div>
            <div style="display:inline-block;">
            <h5>Director:</h5>
            <input type="text" class="form-control" name="director"
                value="<?php if ($movie_to_update!=null) echo $movie_to_update['Director'] ?>"
                />
            </div>
        </div>
        <br>
        <div class="mb-3 mx-3">
        <input type="submit" value="Add" name="btnAction" class="btn btn-secondary"
        title = "insert a movie" />
        <input type="submit" value="Confirm Update" name="btnAction" class="btn btn-secondary"
        title = "confirm update a movie" />  
        <input type="reset" value="Reset Fields" class="btn btn-secondary" title = "reset movie fields" />  
        </div>
    </form>
</div>

<hr/>

<div style="text-align: right; margin-right: 25px">
    <h2 style="color: white; font-size: 20px">Logged in as: <?php echo htmlspecialchars($_SESSION["username"]); ?></h2>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    <a href="commentView.php" class="btn btn-info">See my comments</a>
</div>

    <h2 style="text-align: center; font-size: 40px;">All Movies</h2>
    <hr/>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="searchMovie">
        <b>Search by Series Title: 
            <input name="titleFilter" type="text" style="color: black;" 
                    placeholder="Search Here"> </b>
            <input type="submit" value="Search" name="btnAction"
                class="btn btn-info" />
            <input type="submit" value="Revert Search" name="btnAction"
                class="btn btn-danger" />
    </form>
    <hr/>
    <?php if($search_filter != null) : ?>
        <em style="color: white; margin-left: 25px;">Showing results for 
            <?php echo $search_filter?>...</em>
    <?php endif; ?>
    <?php
    $i = 0;
    foreach ($list_of_movies as $movie):  ?>
    <div class="card mt-4" style="margin-left: 25px; width: 600px; padding:5px;">
        <h5 style="color:black; font-family: Impact; font-size:30px"><?php echo $movie['Series_Title']; ?> </h5>
        Released Year: <?php echo $movie['Released_Year']; ?> <br>
        Gross: <?php echo $movie['Gross']; ?> <br>
        Runtime (min): <?php echo $movie['Runtime']; ?> <br>
        IMDB Rating: <?php echo $movie['IMDB_Rating']; ?> <br>
        Director: <?php echo $movie['Director']; ?> <br>
        <div>
            <div style="display:inline-block;">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="updateMovie">
                    <!-- <button name="btnAction" value="Update Movie" type="submit" class="btn btn-info" data-toggle="collapse" data-target="#content">Update Movie</button> -->
                    <input type="submit" value="Update Movie" name="btnAction"
                        class="btn btn-info" />
                    <input type="hidden" name="movie_to_update" 
                        value="<?php echo $movie['Series_Title'] ?>"/>
                </form>
            </div>
            <div style="display:inline-block;">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="submit" value="View Movie Page" name="btnAction"
                    class="btn btn-info" />
                <input type="hidden" name="movie_to_view" 
                    value="<?php echo $movie['Series_Title'] ?>"/>
                </form>
            </div>
            <div style="display:inline-block; margin-bottom: 5px; margin-top:10px;" >
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="submit" value="Delete Movie" name="btnAction"
                    class="btn btn-danger" />
                <input type="hidden" name="movie_to_delete" 
                    value="<?php echo $movie['Series_Title'] ?>"/>
                </form>
            </div>
        </div>
        <hr>
        <div>
            <button style="margin-left: 0px; width: 150px;" type="button" class="btn btn-info" data-toggle="collapse" data-target="#<?php echo $i; ?>">Comment on Movie</button>
            <div id="<?php echo $i; ?>" class="collapse">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="submit Comment">
                <h5 style="color:black;">Title: <h5>
                <input type="text" class="form-control" name="commentTitle">
                <h5 style="color:black;">Content: <h5>
                <input type="text" class="form-control" name="commentContent">
                <br>
                <input type="hidden" name="seriesTitle" 
                    value="<?php echo $movie['Series_Title'] ?>"/>
                </form>
                <input type="submit" name="btnAction" value="Submit Comment" class="btn btn-secondary">
                </form>
            </div>
        </div>

    </div>
    <?php $i++; endforeach; ?>


</body>

</html>
