<?php

function addMovie($title, $year, $gross, $runtime, $rating, $director) {
    global $db;
    $query = "insert ignore into Movies 
    values('" . $title . "', " . $year ." , '" . $gross . "', " . $runtime ." , " . $rating ." , '" . $director . "')";
    $statement = $db->query($query);
}

// function addComment($user, $title, $content) {
//     // db handler
//     global $db;
//     // sql
//     $query = "insert into comment values('" . $user . "', " . $title ." , " . $content .")";
//     // execute
//     $statement = $db->query($query);
// }

function getAllMovies() {
	global $db;
	$query = "select * from Movies";
	$statement = $db->query($query); 
        
    // fetchAll() returns an array of all rows in the result set
    $results = $statement->fetchAll();   
    $statement->closeCursor();
    return $results;
}

function getMovie_byTitle($title) {
	global $db;
	$query = "select * from Movies where Series_Title = :title";

	$statement = $db->prepare($query);
	$statement->bindValue(':title', $title);
	$statement->execute();

	// fetch() returns a row
	$results = $statement->fetch();   
	$statement->closeCursor();

	return $results;	
}

function updateMovie($title, $year, $gross, $runtime, $rating, $director) {
    global $db;
    $query = "update Movies set Released_Year=:year, Gross=:gross, Runtime=:runtime, IMDB_Rating=:rating, Director=:director where Series_Title=:title";

    $statement = $db->prepare($query);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':gross', $gross);
    $statement->bindValue(':runtime', $runtime);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':director', $director);
    $statement->bindValue(':title', $title);
    $statement->execute();

	$statement->closeCursor();

}

function deleteMovie($title) {
    global $db;
    $query = "delete from Movies where Series_Title=:title;
    delete from featuredFor where Series_Title=:title;
    delete from categorizedAs where Series_Title=:title;
    delete from starsIn where Series_Title=:title";

    $statement = $db->prepare($query);
	$statement->bindValue(':title', $title);
	$statement->execute();

	$statement->closeCursor();

}

function getPoster_byTitle($title) {
    global $db;
    $query = "select * from featuredFor where Series_Title=:title";

    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->execute();

    $results = $statement->fetch();   
    $statement->closeCursor();
    return $results;
}

function getStarNames_byTitle($title) {
    global $db;
    $query = "select * from starsIn where Series_Title=:title";

    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->execute();

    $results = $statement->fetchAll();   
    $statement->closeCursor();
    return $results;
}

function getGenres_byTitle($title) {
    global $db;
    $query = "select * from categorizedAs where Series_Title=:title";

    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->execute();

    $results = $statement->fetchAll();   
    $statement->closeCursor();
    return $results;   
}

function addStarName($starName, $title) {
    global $db;
    $query = "insert ignore into starsIn values( '" . $title . "', '" . $starName . "');
    insert ignore into MovieStars values(NULL, '" . $starName . "')";
    $statement = $db->query($query);
}

function addGenre($title, $genreType) {
    global $db;
    $query = "insert ignore into categorizedAs values( '" . $title . "', '" . $genreType . "');
    insert ignore into MovieGenre values(NULL, '" . $genreType . "')";
    $statement = $db->query($query); 
}

function addPosterLink($posterLink, $title) {
    global $db;
    $query = "insert ignore into featuredFor values( '" . $posterLink . "', '" . $title . "')";
    $statement = $db->query($query);
}

function deleteStarName($starName, $title) {
    global $db;
    $query = "delete from starsIn where starName=:starName and Series_Title=:title";
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':starName', $starName);
    $statement->execute();
}

function deleteGenre($title, $genreType) {
    global $db;
    $query = "delete from categorizedAs where genreType=:genreType and Series_Title=:title";
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':genreType', $genreType);
    $statement->execute();
}

function deletePosterLink($posterLink, $title) {
    global $db;
    $query = "delete from featuredFor where Poster_Link=:posterLink and Series_Title=:title";
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':posterLink', $posterLink);
    $statement->execute();
}

?>