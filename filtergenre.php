<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","gebremam-db","BtliORR6VJzie7qL","gebremam-db");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<div>
	<table>
		<tr>
			<td>List of songs by Genre</td>
		</tr>
		<tr>
			<td>Song</td>
			<td>Genre</td>
			<td>Album</td>
			<td>Artist</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT song.song_name, song.genre, song.album_name, artist.fname, artist.lname FROM song INNER JOIN artist ON song.artist_id = artist.artist_id WHERE song.genre= ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s",$_POST['genre']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($song_name, $genre, $album_name, $artist_fname, $artist_lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $song_name . "\n</td>\n<td>\n" . $genre . "\n</td>\n<td>\n" . $album_name . "\n</td>\n<td>\n" . $artist_fname . "\n</td>\n<td>\n" . $artist_lname . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>
