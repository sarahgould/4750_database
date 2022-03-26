<?php

function addMovie($title, $year, $gross, $runtime, $rating) {
    // db handler
    global $db;
    // sql
    $query = "insert into Movies values('" . $title . "', " . $year ." , " . $gross ." , " . $runtime ." , " . $rating .")";
    // execute
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
	$query = "select * from Movies where title = :title";

	$statement = $db->prepare($query);
	$statement->bindValue(':title', $title);
	$statement->execute();

	// fetch() returns a row
	$results = $statement->fetch();   
	$statement->closeCursor();

	return $results;	
}

function updateMovie($title, $year, $gross, $runtime, $rating) {
    global $db;
    $query = "update Movies set year=:year, gross=:gross, runtime=:runtime, rating=:rating where title=:title";

    $statement = $db->prepare($query);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':gross', $gross);
    $statement->bindValue(':runtime', $runtime);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':title', $title);
    $statement->execute();

	$statement->closeCursor();

}

function deleteMovie($title) {
    global $db;
    $query = "delete from Movies where title=:title";

    $statement = $db->prepare($query);
	$statement->bindValue(':title', $title);
	$statement->execute();

	$statement->closeCursor();

}

?>