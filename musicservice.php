<?php
//Turn on error reporting
ini_set('display_errors', 'On');

//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","username","password","dbname");

//if there is a connection error
if($mysqli->connect_errno){
   echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<div>
   <form method="post" action="adduser.php"> 
     <fieldset>
	<legend>Create User</legend>
	<p>User Name: <input type="text" name="uname" /></p>
	<p>User email: <input type="text" name="email" /></p>
     	<p><input type="submit" /></p>
     </fieldset>
   </form>
</div>
</br>




<div>
   <form method="post" action="filtersong.php"> 
     <fieldset>
	<legend>Display all songs in database</legend>
     	<p><input type="submit" value="Display all songs" /></p>
     </fieldset>
   </form>
</div>
</br>


<div>
   <form method="post" action="filterartist.php">
     <fieldset>
	<legend>Display by Artist</legend>
	<select name="artist">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT artist_id, fname, lname FROM artist"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($artist_id, $fname, $lname)){
	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
	   echo '<option value=" '. $artist_id . ' "> ' . $fname . $lname . '</option>\n';
	}
	$stmt->close();
	?>
	</select>
     	<input type="submit" value="Run Filter" />
     </fieldset>
   </form>
</div>
</br>

<div>
   <form method="post" action="filtergenre.php">
     <fieldset>
	<legend>Display by Genre</legend>
	<select name="genre">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT song_id, genre FROM song"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($song_id, $genre)){
	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
	   echo '<option value=" '. $song_id . ' "> ' . $genre . '</option>\n';
	}
	$stmt->close();
	?>
	</select>
	<input type="submit" value="Run Filter" />
     </fieldset>
   </form>
</div>
</br>

<div>
   <form method="post" action="filteralbum.php">
     <fieldset>
	<legend>Display by Album Name</legend>
	<select name="album">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT song_id, album_name FROM song"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($song_id, $album_name)){
	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
	   echo '<option value=" '. $song_id . ' "> ' . $album_name . '</option>\n';
	}
	$stmt->close();
	?>
	</select>
	<input type="submit" value="Run Filter" />
     </fieldset>
   </form>
</div>
</br>


<div>
   <form method="post" action="addartist.php"> 
     <fieldset>
	<legend>Add Artist</legend>
	<p>Artist's First Name: <input type="text" name="artistFname" /></p>
	<p>Artist's Last Name: <input type="text" name="artistLname" /></p>
     	<p><input type="submit" /></p>
     </fieldset>
   </form>
</div>
</br>


<div>
   <form method="post" action="addsong.php"> 
     <fieldset>
	<legend>Add Song</legend>
	<p>Song Name: <input type="text" name="songName" /></p>
	<p>Genre: <input type="text" name="genre" /></p>
	<p>Album Name: <input type="text" name="albumName" /></p>
    	<label for="artist">Artist:</label>
	<select name="artist">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT artist_id, fname, lname FROM artist"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($artist_id, $fname, $lname)){
   	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	while($stmt->fetch()){
	   echo '<option value=" '. $artist_id . ' "> ' . $fname . $lname . '</option>\n';
	}
	$stmt->close();
	?>
	</select>
     <p><input type="submit" /></p>
     </fieldset>
   </form>
</div>
</br>


<div>
   <form method="post" action="addplaylist.php"> 
     <fieldset>
	<legend>Create Playlist</legend>
    	<label for="user">User Name:</label>
	<select name="user">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT uname FROM user"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($uname)){
   	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	while($stmt->fetch()){
	   echo '<option value=" '. $uname . ' "> ' . $uname . '</option>\n';
	}
	$stmt->close();
	?>
	</select>

	<p>Playlist Name: <input type="text" name="pname" /></p>
     	<p><input type="submit" /></p>
     </fieldset>
   </form>
</div>
</br>


<div>
   <form method="post" action="addSongToPlaylist.php"> 
     <fieldset>
	<legend>Add Songs to Playlist</legend>
	<label for="song">Select Song to add to playlist:</label>
	<select name="song">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT song_id, song_name FROM song"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($song_id, $song_name)){
	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
	   echo '<option value=" '. $song_id . ' "> ' . $song_name . '</option>\n';
	}
	$stmt->close();
	?>
	</select>
    	<label for="playlist">Select Playlist to add to:</label>
	<select name="playlist">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT playlist_id, pname FROM playlist"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($playlist_id, $pname)){
   	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	while($stmt->fetch()){
	   echo '<option value=" '. $playlist_id . ' "> ' . $pname . '</option>\n';
	}
	$stmt->close();
	?>
	</select>
        <p><input type="submit" /></p>
         </fieldset>
   </form>
</div>
</br>


<div>
   <form method="post" action="updateartist.php"> 
     <fieldset>
	<legend>Update Artist Info</legend>
    	<label for="artist">Select Artist Name to update:</label>
	<select name="artist">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT artist_id, fname, lname FROM artist"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($artist_id, $fname, $lname)){
	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
	   echo '<option value=" '. $artist_id . ' "> ' . $fname . $lname . '</option>\n';
	}
	$stmt->close();
	?>
	</select>

	<p>Update Artist's First Name (specify even if it didnt change): <input type="text" name="artistFname" /></p>
	<p>Update Artist's Last Name(specify even if it didn't change): <input type="text" name="artistLname" /></p>
    	 <p><input type="submit" /></p>
     </fieldset>
   </form>
</div>
</br>


<div>
   <form method="post" action="updatesong.php"> 
     <fieldset>
	<legend>Update Song Info</legend>
	<label for="song">Select Song to update:</label>
	<select name="song">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT song_id, song_name FROM song"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($song_id, $song_name)){
	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
	   echo '<option value=" '. $song_id . ' "> ' . $song_name . '</option>\n';
	}
	$stmt->close();
	?>
	</select>
	<p>Update Song Name (specify even if it didnt change): <input type="text" name="songName" /></p>
	<p>Update Song Genre(specify even if it didn't change): <input type="text" name="genre" /></p>
 	<p>Update Album Name(specify even if it didn't change): <input type="text" name="album" /></p>
    	<label for="artist">Update Artist (select even if it didnt change):</label>
	<select name="artist">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT artist_id, fname, lname FROM artist"))){
	   echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	   echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($artist_id, $fname, $lname)){
   	   echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	while($stmt->fetch()){
	   echo '<option value=" '. $artist_id . ' "> ' . $fname . $lname . '</option>\n';
	}
	$stmt->close();
	?>
	</select>
        <p><input type="submit" /></p>
         </fieldset>
   </form>
</br>
</div>
</body>     
</html>
 
