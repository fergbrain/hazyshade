<?PHP 
$mysqlhost         = 'localhost';    // Database host URL 
$mysqluser         = '';        // Database user 
$mysqlpassword     = '';    // Database password 
$mysqldb         = '';        // Database name 
$mysqlconnect = mysqlconnect($mysqlhost, $mysqluser, $mysqlpassword); 
$mysqlquery = mysql_select_db($mysqldb, $mysqlconnect); </p>
 
function singer_list($song){ 
    $song = stripslashes($song); 
    echo "</p><p><fieldset><legend>$song</legend>"; 
    $song = addslashes($song); 
        $query_i = "SELECT singer FROM song_to_singer WHERE song = '".$song."'"; 
        $result_i = mysql_query($query_i); 
        $num_results_i = mysql_num_rows($result_i); 
        for ($i=0; $i &lt;$num_results_i; $i++){ 
            $row_i = mysql_fetch_array($result_i); 
            $singer_i = $row_i['singer']; 
            $songs_singers_i = explode("|", $singer_i); 
            $singer_count_i = count($songs_singers_i); 
            for($c=0; $c &lt;$singer_count_i; $c++){ 
                echo $songs_singers_i[$c]." ";     
            }             
        } 
        echo "</fieldset>"; 
        echo " "; 
    }
     
function song_list($song,$alt_song){ 
      
        //build the list of singers in SQL format 
        $query = "SELECT singer FROM song_to_singer WHERE $song"; 
        $result = mysql_query($query); 
        $num_results = mysql_num_rows($result); 
        //echo "c ".$num_results; 
        for ($c=0; $c &lt;$num_results; $c++){ 
            $row = mysql_fetch_array($result); 
            $singer = $row['singer']; 
            $songs_singers = explode("|", $singer); 
            $singer_count = count($songs_singers); 
            for($d=0; $d &lt;$singer_count; $d++){ 
                $singers .= "singer NOT LIKE '%$songs_singers[$d]%'"; 
                    if(($d+1)!=$singer_count){ 
                        $singers .= " AND "; 
                    } 
            } 
            if(($c+1)!=$num_results){ 
                $singers .= " AND "; 
            } 
            //echo $singers."hello"; 
            } 
            //$singers .= "id != NULL"; 
            //echo $singers;
             
        //run the SQL query 
        $query = "SELECT song FROM song_to_singer WHERE ".$singers; 
        //echo $query; 
        $result = mysql_query($query); 
        $num_results = mysql_num_rows($result); 
        //echo "d ".$num_results; 
        echo "<option =""></option>"; 
        for ($d=0; $d &lt;$num_results; $d++){ 
            $row = mysql_fetch_array($result); 
            $song_a = addslashes($row['song']); 
            echo "<option ="</FONT">"$song_""</option>; 
            if($alt_song == $song_a){ 
                echo "selected"; 
            } 
            $song_a = stripslashes($song_a); 
            echo "&gt;$song_a"; 
        } 
        echo ""; 
        //echo $alt_song; 
      
              
} 
//output 
echo "<a href="index.php">Reset</a>"; 
echo " </p><form action=index.php method=get>"</form>; 
?>

<input id=submit type=submit value=submit name=submit/>
	<p><?
//initial list
echo "<select name=song_a>";
$query = "SELECT song FROM song_to_singer";
$result = mysql_query($query);
$num_results = mysql_num_rows($result);
//echo "e ".$num_results;
for ($z=0; $z < $num_results; $z++){
	$row = mysql_fetch_array($result);
	$song_initial = $row['song'];
	echo "<option selected FONT ?>";
if(stripslashes($_GET['song_a']) == $song_initial){
echo " selected ";
}
echo ">$song_initial</option>";
}
echo "</select>";
//all others
singer_list($_GET['song_a']);
if($_GET['song_a'] !== ('' || NULL)){
echo "<select name=song_b>";
song_list("song = '".$_GET['song_a']."'", $_GET['song_b']); } singer_list($_GET['song_b']);
if($_GET['song_b'] !== ('' || NULL)){
echo "</select>";
song_list("song = '".$_GET['song_b']."' or song = '".$_GET['song_a']."'", $_GET['song_c']);
}
singer_list($_GET['song_c']);
if($_GET['song_c'] !== ('' || NULL)){
echo "<select name=song_d>";
song_list("song = '".$_GET['song_c']."' or song = '".$_GET['song_b']."' or song = '".$_GET['song_a']."'", $_GET['song_d']);
}
singer_list($_GET['song_d']);
if($_GET['song_d'] !== ('' || NULL)){
echo "</select>";
song_list("song = '".$_GET['song_d']."' or song = '".$_GET['song_c']."' or song = '".$_GET['song_b']."' or song = '".$_GET['song_a']."'", $_GET['song_e']);
}
singer_list($_GET['song_e']);
if($_GET['song_e'] !== ('' || NULL)){
echo "<select name=song_f>"; song_list("song = '".$_GET['song_e']."' or song = '".$_GET['song_d']."' or song = '".$_GET['song_c']."' or song = '".$_GET['song_b']."' or song = '".$_GET['song_a']."'", $_GET['song_f']); } singer_list($_GET['song_f']);
if($_GET['song_f'] !== ('' || NULL)){
echo "</select>";
song_list("song = '".$_GET['song_f']."' or song = '".$_GET['song_e']."' or song = '".$_GET['song_d']."' or song = '".$_GET['song_c']."' or song = '".$_GET['song_b']."' or song = '".$_GET['song_a']."'", $_GET['song_g']);
}
singer_list($_GET['song_g']);
if($_GET['song_g'] !== ('' || NULL)){
echo "<select name=song_h>"; song_list("song = '".$_GET['song_g']."' or song = '".$_GET['song_f']."' or song = '".$_GET['song_e']."' or song = '".$_GET['song_d']."' or song = '".$_GET['song_c']."' or song = '".$_GET['song_b']."' or song = '".$_GET['song_a']."'", $_GET['song_h']);
}
?>

<input id=submit type=submit value=submit name=submit/>
  </select></p>
