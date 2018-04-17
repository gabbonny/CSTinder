<?php session_start();
//name and age can be session variables to be passed over
//search database code
require_once("support.php");
require_once("dbkeys.php");

$title = "Search";
		
		$db = new mysqli($host, $user, $password, $database);
		if ($db->connect_error) {
			die($db->connect_error);
		}
        //current user information-->form an object of current user?????????????????????????????????
		$curr_name = "";
		$curr_year = "";
		$curr_pw = "";
		$curr_gender = "";
		$curr_email = $_SESSION['email'];
        $curr_lang = "";
		$curr_class_arr = "";
        $curr_class = "";
        $curr_numproj = "";
        
    	$curr_encpw = "";
		//password_hash($pw, PASSWORD_BCRYPT);
		
		$curr_class1 = "";
		$curr_class2 = "";
		
		
		
		//variables to grab from the database
		$name = "";
		$year = "";
		$pw = "";
		$gender = "";
		$email = "";
        $lang = "";
		$class_arr = "";
        $class = "";
        $numproj = "";
        
    	$encpw = "";
		//password_hash($pw, PASSWORD_BCRYPT);
		
		$class1 = "";
		$class2 = "";
		
		//this array tracks the profile pic and email primary key that matches
		$match_array = [];
		
		/* Query */
		$sqlQuery = "select name, year, email, language, class1, class2, numProject, image from $table;";
    
        /* Executing query */
		$result = $db->query($sqlQuery);
        
		if ($result) {
		    $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows == 0) {
                $body = "<h2>Oops! No account found!</h2>";
            } else {
			
            //collects all the data selected from the query into an array
                while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					if (){
						
					}
                    $name = $recordArray['name'];
                    $year = intval($recordArray['year']);
					$email = $recordArray['email'];
                    $lang = $recordArray['language'];
					$class1 = $recordArray['class1'];
					$class2 = $recordArray['class2'];
                    $numproj = intval($recordArray['numProject']);
					$pic = $recordArray['image'];
                }
            }
		//free the result from the database
            mysqli_free_result($result);
        } else {
		$body = "Retrieving records failed.".mysqli_error($db);
        }
    
 		/* Closing connection */
		$db->close();
        
        if ($curr_lang === $lang || ($curr_class1 === $class1 || $curr_class2 === $class2)){
			//insert the match profile email->profile pic
			$match_array[$email] = $pic;
		}
		$body =<<< EBODY
            <div id="visual_search">
            <img id="search_profile" src="images/$pic" alt="profile_pic"/>
        </div>
        <div id="info_tag">
            <h3>$name,$year</h3>
        </div>
        <div id="basic_info">
            <!--the images are pngs that will make -->
            <img id="Fave" src="coding.png" alt="fave"/>
            <p>$lang</p>
            
            
            <!--Do we want current classes to be a separate info in the
            createAccount.php-->

            <img id="projects" src="folder.png" alt="projects"/>
            <p>$numproj</p>
        </div>
        <div id="choices">
            <a href="#"><img id="deny" src="deny.png" alt="X"/></a>
            <a href="#"><img id="available" src="edit.png" alt="optional"></a>

            <form action=""><a href="#"><img id="accept" src="Accept.png" alt="check"></a></form>

            <a href="#"><img id="accept" src="accept.png" alt="check"></a>

        </div>
EBODY;
        
    
    
    		 echo generatePage($body, $title);

?>
