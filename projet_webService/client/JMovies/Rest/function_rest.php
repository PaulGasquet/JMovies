<?php
//This file implement all the functions who use SOAP and are use in the client
	//function use for create an user
	function CreateUser($user_id,$userName,$preference){
        $xml = simplexml_load_file("./Rest/fonction_rest_create_user.xml");
		$xml->user_id = $user_id; 
        $xml->userName = $userName;
        $xml->preference = $preference;
		$xml->asXML("./Rest/fonction_rest_create_user.xml");
		$xml = file_get_contents("./Rest/fonction_rest_create_user.xml");
        $url = 'http://localhost:8080/JMoviesWeb/webapi/userResource/Create';

        $curl = curl_init($url);
		
        curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));

     
        curl_setopt($curl, CURLOPT_POST, true);
 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    
        $result = curl_exec($curl);
		
        if(curl_errno($curl)){
            throw new Exception(curl_error($curl));
        }

        curl_close($curl);
	}
	//function for add a review
	function addReview($review_id,$mark,$reviewcontent,$user_id,$movie_title){
        $xml = simplexml_load_file("./Rest/fonction_rest_add_review.xml");
		$xml->reviewId = $review_id; 
        $xml->mark = $mark;
        $xml->reviewContent = $reviewcontent;
		$xml->user_id = $user_id;
		$xml->movieTitle = $movie_title;
		$xml->asXML("./Rest/fonction_rest_add_review.xml");
		$xml = file_get_contents("./Rest/fonction_rest_add_review.xml");
        $url = 'http://localhost:8080/JMoviesWeb/webapi/userResource/addReview';

        $curl = curl_init($url);
		
        curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));

     
        curl_setopt($curl, CURLOPT_POST, true);
 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    
        $result = curl_exec($curl);
		
        if(curl_errno($curl)){
            throw new Exception(curl_error($curl));
        }

        curl_close($curl);
	}
	
	//function for getting all users
	function getAllUser(){
		$url='http://localhost:8080/JMoviesWeb/webapi/userResource/users';
		$xml = simplexml_load_file($url);
		$NbUsers = $xml->count();
		//we create a html table of all the users
		echo'<table class ="table">';
		echo'<tr>';
		echo'<td>';
		echo'User id';
		echo'</td>';
		echo'<td>';
		echo'User name';
		echo'</td>';
		echo'<td>';
		echo'preference';
		echo'</td>';
		echo'</tr>';
		//We have several elements in the xml 
		if(isset($xml->user[0]->userName) AND (!empty($xml->user[0]->userName))){
			for($i = 0;$i < $NbUsers ;$i++){
				echo'<tr><td>';
				echo $xml->user[$i]->user_id;
				echo'</td><td>';
				echo $xml->user[$i]->userName;
				echo'</td><td>';
				echo $xml->user[$i]->preference;
				echo'</td></tr>';
			}
		}
		else if($NbUsers == 0){
			echo '<p class ="not_found_message">There is no user.</p>'; 
		}
		else{
			echo'<tr><td>';
			echo $xml->user->user_id;
			echo'</td><td>';
			echo $xml->user->userName;
			echo'</td><td>';
			echo $xml->user->preference;
			echo'</td></tr>';
		}
		echo'</table>';
	}
	
	//function for getting all reviews, given a user id
	function getAllReview($user_id){
		$url='http://localhost:8080/JMoviesWeb/webapi/userResource/'.$user_id.'';
		$xml = simplexml_load_file($url);
		$NbReviews=$xml->count();
		//we create a html table of all the reviews
		echo'<table class ="table">';
		echo'<tr>';
		echo'<td>';
		echo'review id';
		echo'</td>';
		echo'<td>';
		echo'movie Title';
		echo'</td>';
		echo'<td>';
		echo'mark';
		echo'</td>';
		echo'<td>';
		echo'review Content';
		echo'</td>';
		echo'<td>';
		echo'id of the user';
		echo'</td>';
		echo'</tr>';
		//we have several elements in the xml
		if(isset($xml->review[0]->movieTitle) AND (!empty($xml->review[0]->movieTitle))){
			for($i = 0;$i < $NbReviews ;$i++){
				echo'<tr><td>';
				echo $xml->review[$i]->reviewId;
				echo'</td><td>';
				echo $xml->review[$i]->movieTitle;
				echo'</td><td>';
				echo $xml->review[$i]->mark;
				echo'</td><td>';
				echo $xml->review[$i]->reviewContent;
				echo'</td><td>';
				echo $xml->review[$i]->user_id;
				echo'</td></tr>';
			}
		}
		else if($NbReviews == 0){
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult'].' have post no review or does not exist.</p>'; 
		}
		else{
			echo'<tr><td>';
			echo $xml->review->reviewId;
			echo'</td><td>';
			echo $xml->review->movieTitle;
			echo'</td><td>';
			echo $xml->review->mark;
			echo'</td><td>';
			echo $xml->review->reviewContent;
			echo'</td><td>';
			echo $xml->review->user_id;
			echo'</td></tr>';
		}
		echo'</table>';
	}
	
	//function for getting best reviews, with a mark >= 4 ,given a user id
	function getBestReview($user_id){
		$url='http://localhost:8080/JMoviesWeb/webapi/userResource/'.$user_id.'/best';
		$xml = simplexml_load_file($url);
		$NbReviews=$xml->count();
		//we create a html table of all the reviews
		echo'<table class ="table">';
		echo'<tr>';
		echo'<td>';
		echo'review id';
		echo'</td>';
		echo'<td>';
		echo'movie Title';
		echo'</td>';
		echo'<td>';
		echo'mark';
		echo'</td>';
		echo'<td>';
		echo'review Content';
		echo'</td>';
		echo'<td>';
		echo'id of the user';
		echo'</td>';
		echo'</tr>';
		//we have several elements in the xml
		if(isset($xml->review[0]->movieTitle) AND (!empty($xml->review[0]->movieTitle))){
			for($i = 0;$i < $NbReviews ;$i++){
				echo'<tr><td>';
				echo $xml->review[$i]->reviewId;
				echo'</td><td>';
				echo $xml->review[$i]->movieTitle;
				echo'</td><td>';
				echo $xml->review[$i]->mark;
				echo'</td><td>';
				echo $xml->review[$i]->reviewContent;
				echo'</td><td>';
				echo $xml->review[$i]->user_id;
				echo'</td></tr>';
			}
		}
		else if($NbReviews == 0){
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult_best'].' have post no review with a mark >= 4 or does not exist.</p>'; 
		}
		else{
			echo'<tr><td>';
			echo $xml->review->reviewId;
			echo'</td><td>';
			echo $xml->review->movieTitle;
			echo'</td><td>';
			echo $xml->review->mark;
			echo'</td><td>';
			echo $xml->review->reviewContent;
			echo'</td><td>';
			echo $xml->review->user_id;
			echo'</td></tr>';
		}
		echo'</table>';
	}
	
	//function for getting the worst reviews, with a mark >=2 ,given a user id
	function getWorstReview($user_id){
		$url='http://localhost:8080/JMoviesWeb/webapi/userResource/'.$user_id.'/worst';
		$xml = simplexml_load_file($url);
		$NbReviews=$xml->count();
		//we create a html table of all the reviews
		echo'<table class ="table">';
		echo'<tr>';
		echo'<td>';
		echo'review id';
		echo'</td>';
		echo'<td>';
		echo'movie Title';
		echo'</td>';
		echo'<td>';
		echo'mark';
		echo'</td>';
		echo'<td>';
		echo'review Content';
		echo'</td>';
		echo'<td>';
		echo'id of the user';
		echo'</td>';
		echo'</tr>';
		//we have several elements in the xml
		if(isset($xml->review[0]->movieTitle) AND (!empty($xml->review[0]->movieTitle))){
			for($i = 0;$i < $NbReviews ;$i++){
				echo'<tr><td>';
				echo $xml->review[$i]->reviewId;
				echo'</td><td>';
				echo $xml->review[$i]->movieTitle;
				echo'</td><td>';
				echo $xml->review[$i]->mark;
				echo'</td><td>';
				echo $xml->review[$i]->reviewContent;
				echo'</td><td>';
				echo $xml->review[$i]->user_id;
				echo'</td></tr>';
			}
		}
		else if($NbReviews == 0){
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult_worst'].' have post no review with a mark <=2 or does not exist.</p>'; 
		}
		else{
			echo'<tr><td>';
			echo $xml->review->reviewId;
			echo'</td><td>';
			echo $xml->review->movieTitle;
			echo'</td><td>';
			echo $xml->review->mark;
			echo'</td><td>';
			echo $xml->review->reviewContent;
			echo'</td><td>';
			echo $xml->review->user_id;
			echo'</td></tr>';
		}
		echo'</table>';
	}
	
	//get one user given a user id, use for login
	function getUser($user_id){
		$url='http://localhost:8080/JMoviesWeb/webapi/userResource/'.$user_id.'/oneUser';
		$xml = simplexml_load_file($url);
		$Nbuser = $xml->count();
		if($Nbuser == 0){
			echo'<div class ="inscription">';
				echo '<h2>Or Login</h2>';
				echo'<div>';
					echo'<form method= "POST" action="">';
						echo'<input type="number" name="user_id_login" id="user_id_login" min = "1000" max = "30000" placeholder="Your id">';
						echo'</br>';
						echo'<h3>Soap or Rest :</h3>';
						echo'<label for="Soap">SOAP</label>';
						echo'<input type="radio" name="method" Value="Soap" id="Soap"/>';
						echo'</br>';
						echo'<label for="Rest">Rest</label>';
						echo'<input type="radio" name="method" Value="Rest" id="Rest"/>';
						echo'</br>';
						echo'<input type="submit" value="Login"/>';
					echo'</form>';
				echo'</div>';
			echo'</div>';
			echo '<p class ="error">field not or incorrectly filled</p>';
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_login'].' does not exist, try again with your id or re-open the page if you want to register.</p>';
		}
		//we get the data of the user
		else{
			$_SESSION['user_id'] = strval($xml->user->user_id);
			$_SESSION['userName'] = strval($xml->user->userName);
			$_SESSION['preference'] = strval($xml->user->preference);
		}
	}
	
	//get Action movie from the API http://www.omdbapi.com/
	function getActionMovie(){
		//we get the first movie
		$url1 = 'http://www.omdbapi.com/?t=rambo&r=xml&apikey=22be9873';
		$xml1 = simplexml_load_file($url1);
		$movie_title1 = strval($xml1->movie['title']);
		$year1 = strval($xml1->movie['year']);
		$runtime1 = strval($xml1->movie['runtime']);
		$director1 = strval($xml1->movie['director']);
		$actors1 =  strval($xml1->movie['actors']);
		$plot1 = strval($xml1->movie['actors']);
		$poster1 = strval($xml1->movie['poster']);
		
		//we get the second movie
		$url2 = 'http://www.omdbapi.com/?t=the fifth element&r=xml&apikey=22be9873';
		$xml2 = simplexml_load_file($url2);
		$movie_title2 = strval($xml2->movie['title']);
		$year2 = strval($xml2->movie['year']);
		$runtime2 = strval($xml2->movie['runtime']);
		$director2 = strval($xml2->movie['director']);
		$actors2 =  strval($xml2->movie['actors']);
		$plot2 = strval($xml2->movie['actors']);
		$poster2 = strval($xml2->movie['poster']);
		
		//we get the third movie
		$url3 = 'http://www.omdbapi.com/?t=terminator genisys&r=xml&apikey=22be9873';
		$xml3 = simplexml_load_file($url3);
		$movie_title3 = strval($xml3->movie['title']);
		$year3 = strval($xml3->movie['year']);
		$runtime3 = strval($xml3->movie['runtime']);
		$director3 = strval($xml3->movie['director']);
		$actors3 =  strval($xml3->movie['actors']);
		$plot3 = strval($xml3->movie['actors']);
		$poster3 = strval($xml3->movie['poster']);
		
		echo'<table class = "movie_table"><tr>';
		echo'<td>Title</td>';
		echo'<td>year</td>';
		echo'<td>run time</td>';
		echo'<td>director</td>';
		echo'<td>actors</td>';
		echo'<td>plot</td>';
		echo'<td>poster</td>';
		echo'</tr>';
		
		echo'<tr>';
		echo'<td>'.$movie_title1.'</td>';
		echo'<td>'.$year1.'</td>';
		echo'<td>'.$runtime1.'</td>';
		echo'<td>'.$director1.'</td>';
		echo'<td>'.$actors1.'</td>';
		echo'<td>'.$plot1.'</td>';
		echo'<td>';
		echo'<img src="'.$poster1.'alt="poster"/>';
		echo'</td>';
		echo'</tr>';
		
		echo'<tr>';
		echo'<td>'.$movie_title2.'</td>';
		echo'<td>'.$year2.'</td>';
		echo'<td>'.$runtime2.'</td>';
		echo'<td>'.$director2.'</td>';
		echo'<td>'.$actors2.'</td>';
		echo'<td>'.$plot2.'</td>';
		echo'<td>';
		echo'<img src="'.$poster2.'" alt="poster"/>';
		echo'</td>';
		echo'</tr>';
		
		echo'<tr>';
		echo'<td>'.$movie_title3.'</td>';
		echo'<td>'.$year3.'</td>';
		echo'<td>'.$runtime3.'</td>';
		echo'<td>'.$director3.'</td>';
		echo'<td>'.$actors3.'</td>';
		echo'<td>'.$plot3.'</td>';
		echo'<td>';
		echo'<img src="'.$poster3.'" alt="poster"/>';
		echo'</td>';
		echo'</tr>';
		echo'</table>';
	}
	
	//get Action movie from the API http://www.omdbapi.com/
	function getDramaMovie(){
		//we get the first movie
		$url1 = 'http://www.omdbapi.com/?t=devil all the time&r=xml&apikey=22be9873';
		$xml1 = simplexml_load_file($url1);
		$movie_title1 = strval($xml1->movie['title']);
		$year1 = strval($xml1->movie['year']);
		$runtime1 = strval($xml1->movie['runtime']);
		$director1 = strval($xml1->movie['director']);
		$actors1 =  strval($xml1->movie['actors']);
		$plot1 = strval($xml1->movie['actors']);
		$poster1 = strval($xml1->movie['poster']);
		
		//we get the second movie
		$url2 = 'http://www.omdbapi.com/?t=the mission &r=xml&apikey=22be9873';
		$xml2 = simplexml_load_file($url2);
		$movie_title2 = strval($xml2->movie['title']);
		$year2 = strval($xml2->movie['year']);
		$runtime2 = strval($xml2->movie['runtime']);
		$director2 = strval($xml2->movie['director']);
		$actors2 =  strval($xml2->movie['actors']);
		$plot2 = strval($xml2->movie['actors']);
		$poster2 = strval($xml2->movie['poster']);
		
		//we get the third movie
		$url3 = 'http://www.omdbapi.com/?t=richard jewell&r=xml&apikey=22be9873';
		$xml3 = simplexml_load_file($url3);
		$movie_title3 = strval($xml3->movie['title']);
		$year3 = strval($xml3->movie['year']);
		$runtime3 = strval($xml3->movie['runtime']);
		$director3 = strval($xml3->movie['director']);
		$actors3 =  strval($xml3->movie['actors']);
		$plot3 = strval($xml3->movie['actors']);
		$poster3 = strval($xml3->movie['poster']);
		
		echo'<table class = "movie_table"><tr>';
		echo'<td>Title</td>';
		echo'<td>year</td>';
		echo'<td>run time</td>';
		echo'<td>director</td>';
		echo'<td>actors</td>';
		echo'<td>plot</td>';
		echo'<td>poster</td>';
		echo'</tr>';
		
		echo'<tr>';
		echo'<td>'.$movie_title1.'</td>';
		echo'<td>'.$year1.'</td>';
		echo'<td>'.$runtime1.'</td>';
		echo'<td>'.$director1.'</td>';
		echo'<td>'.$actors1.'</td>';
		echo'<td>'.$plot1.'</td>';
		echo'<td>';
		echo'<img src="'.$poster1.'alt="poster"/>';
		echo'</td>';
		echo'</tr>';
		
		echo'<tr>';
		echo'<td>'.$movie_title2.'</td>';
		echo'<td>'.$year2.'</td>';
		echo'<td>'.$runtime2.'</td>';
		echo'<td>'.$director2.'</td>';
		echo'<td>'.$actors2.'</td>';
		echo'<td>'.$plot2.'</td>';
		echo'<td>';
		echo'<img src="'.$poster2.'" alt="poster"/>';
		echo'</td>';
		echo'</tr>';
		
		echo'<tr>';
		echo'<td>'.$movie_title3.'</td>';
		echo'<td>'.$year3.'</td>';
		echo'<td>'.$runtime3.'</td>';
		echo'<td>'.$director3.'</td>';
		echo'<td>'.$actors3.'</td>';
		echo'<td>'.$plot3.'</td>';
		echo'<td>';
		echo'<img src="'.$poster3.'" alt="poster"/>';
		echo'</td>';
		echo'</tr>';
		echo'</table>';
	}
	
	//get Action movie from the API http://www.omdbapi.com/
	function getSciFiMovie(){
		//we get the first movie
		$url1 = 'http://www.omdbapi.com/?t=back to the future&r=xml&apikey=22be9873';
		$xml1 = simplexml_load_file($url1);
		$movie_title1 = strval($xml1->movie['title']);
		$year1 = strval($xml1->movie['year']);
		$runtime1 = strval($xml1->movie['runtime']);
		$director1 = strval($xml1->movie['director']);
		$actors1 =  strval($xml1->movie['actors']);
		$plot1 = strval($xml1->movie['plot']);
		$poster1 = strval($xml1->movie['poster']);
		
		//we get the second movie
		$url2 = 'http://www.omdbapi.com/?t=2001 a space odyssey&r=xml&apikey=22be9873';
		$xml2 = simplexml_load_file($url2);
		$movie_title2 = strval($xml2->movie['title']);
		$year2 = strval($xml2->movie['year']);
		$runtime2 = strval($xml2->movie['runtime']);
		$director2 = strval($xml2->movie['director']);
		$actors2 =  strval($xml2->movie['actors']);
		$plot2 = strval($xml2->movie['plot']);
		$poster2 = strval($xml2->movie['poster']);
		
		//we get the third movie
		$url3 = 'http://www.omdbapi.com/?t=interstellar&r=xml&apikey=22be9873';
		$xml3 = simplexml_load_file($url3);
		$movie_title3 = strval($xml3->movie['title']);
		$year3 = strval($xml3->movie['year']);
		$runtime3 = strval($xml3->movie['runtime']);
		$director3 = strval($xml3->movie['director']);
		$actors3 =  strval($xml3->movie['actors']);
		$plot3 = strval($xml3->movie['plot']);
		$poster3 = strval($xml3->movie['poster']);
		
		echo'<table class = "movie_table"><tr>';
		echo'<td>Title</td>';
		echo'<td>year</td>';
		echo'<td>run time</td>';
		echo'<td>director</td>';
		echo'<td>actors</td>';
		echo'<td>plot</td>';
		echo'<td>poster</td>';
		echo'</tr>';
		
		echo'<tr>';
		echo'<td>'.$movie_title1.'</td>';
		echo'<td>'.$year1.'</td>';
		echo'<td>'.$runtime1.'</td>';
		echo'<td>'.$director1.'</td>';
		echo'<td>'.$actors1.'</td>';
		echo'<td>'.$plot1.'</td>';
		echo'<td>';
		echo'<img src="'.$poster1.'alt="poster"/>';
		echo'</td>';
		echo'</tr>';
		
		echo'<tr>';
		echo'<td>'.$movie_title2.'</td>';
		echo'<td>'.$year2.'</td>';
		echo'<td>'.$runtime2.'</td>';
		echo'<td>'.$director2.'</td>';
		echo'<td>'.$actors2.'</td>';
		echo'<td>'.$plot2.'</td>';
		echo'<td>';
		echo'<img src="'.$poster2.'" alt="poster"/>';
		echo'</td>';
		echo'</tr>';
		
		echo'<tr>';
		echo'<td>'.$movie_title3.'</td>';
		echo'<td>'.$year3.'</td>';
		echo'<td>'.$runtime3.'</td>';
		echo'<td>'.$director3.'</td>';
		echo'<td>'.$actors3.'</td>';
		echo'<td>'.$plot3.'</td>';
		echo'<td>';
		echo'<img src="'.$poster3.'" alt="poster"/>';
		echo'</td>';
		echo'</tr>';
		echo'</table>';
	}
?>