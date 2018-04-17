<?php
require("support.php");
$title = "Search";
$table = "users";
$tbody = "";
$db = mysqli_connect("localhost", "root", "", "search");
$curr_email = "g@notreal.com"; //primary key saved in $_SESSION['email']

//query to get current information use
$sqlQuery1 = "select name, year, email, language, class1, class2, numProjects, image from $table where email='$curr_email';";

//values to be filled by current user info
$curr_name = "";
$curr_year = "";
$curr_email = "";
$curr_lang = "";
$curr_class1 = "";
$curr_class2 = "";
$curr_numProj = "";
$curr_image = "";

$match_array = [];
//accessing database for current user info
$result1 = $db->query($sqlQuery1);
if ($result1) {
		    $numberOfRows = mysqli_num_rows($result1);
            if ($numberOfRows == 0) {
                $body = "<h2>Oops! No account found!</h2>";
            } else {
			
            //collects all the data selected from the query into an array
                while ($recordArray = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                    $curr_name = $recordArray['name'];
                    $curr_year = intval($recordArray['year']);
					$curr_email = $recordArray['email'];
                    $curr_lang = $recordArray['language'];
					$curr_class1 = $recordArray['class1'];
					$curr_class2 = $recordArray['class2'];
                    $curr_numProj = intval($recordArray['numProjects']);
					$curr_pic = $recordArray['image'];
                }
            }
            //free the result from the database
            mysqli_free_result($result1);
} else {
    $body = "Retrieving records failed.".mysqli_error($db);
}


//now searching through the database only when buttons are clicked!!!!!!!!!!!!!!!!!!!!!!!s
$name = "";
$year = "";
$email = "";
$lang = "";
$class1 = "";
$class2 = "";
$numProj = "";
$pic = "";
$accounts = [];
$goNext = true;
$index = 0;

//query to gather all entries in the database
$sqlQuery2 = "select name, year, email, language, class1, class2, numProjects, image from $table where language='$curr_lang';";
$result2 = $db->query($sqlQuery2);
if ($result2) {
		    $numberOfRows = mysqli_num_rows($result2);
            if ($numberOfRows == 0) {
                $body = "<h2>Oops! No matches found!!</h2>";
            } else {
			
                //collects all the data selected from the query into an associative array
                $records = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                $_SESSION['match'] = $records['image'];
                /*my idea was to have a javascript function that will change the values of $name---$pic whenever the
                decline button was pressed. */
                $x = 0;
                /*This while loop inserts all the rows gathered from the database and places them in an array
                with 0 indexing(it works and you get all the information but I couldn't figure out how loop through them
                when a button was pressed without refreshing the page and have the $index go back to 0)*/
				for ($x = 0; $x < count($recordArray); $x++){
					$pic.$x = "";	
				}
				$x = 0;
                while ($recordArray = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
					$accounts[$x] = $recordArray;
                    $x++;
					//$pic.$x = $recordArray['image'];
				}
$index = 0;
$tbody .= "<h1>Here are your Matches!</h1>";
for ( $index = 0; $index<count($accounts); $index++ ){
	$name = $accounts[$index]['name'];
    $year = $accounts[$index]['year'];
    $email = $accounts[$index]['email'];
    $lang = $accounts[$index]['language'];
    $class1 = $accounts[$index]['class1'];
    $class2 = $accounts[$index]['class2'];
    $numProj = $accounts[$index]['numProjects'];
	$tbody .= "
        <form action='match.php' method='post'>
	    <tr>
		<td>$name,$year</td>
		<td>Fave Lang: $lang</td>
		<td>Classes: $class1,$class2</td>
		<td>NumberofProjects:$numProj</td>
		<td><input type='image' id='accept' name='yep.$index' src='Accept.png' alt='submit' height=100, width=100/></td>
		</tr>
		</form>";
}
$i = 0;
for ($i = 0; $i < count($accounts); $i++){
	if (isset($_POST['yep'.$i])){
			$_SESSION['match'] = $pic.$i;
			$_SESSION['current'] = $curr_image;
    }		
}
            //free the result from the database
            mysqli_free_result($result2);
			}
} else {
    $body = "Retrieving records failed.".mysqli_error($db);
}
$db->close();





$body="
<style>
table {
    background-color: blue;
	color:white;		
}
</style>
		<table class='table-condensed' border='1'>
			<tbody>
				$tbody
			<tbody>
		<table><br>
";
echo generatePage($body, $title);

?>
   
    