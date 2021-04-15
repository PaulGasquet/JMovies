<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Site JMovies"/>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
		//This file implement the main Page where you can find your recommendation and add reviews
		include('./Rest/function_rest.php');
		include('./Soap/function_soap.php');
	?>
    <header>
        <h1>JMovies</h1>
		<?php
			echo'<p>';
			echo'Hello '.$_SESSION['userName'].'';
			echo' your id '.$_SESSION['user_id'].'';
			echo'</p>';
			$_POST['user_id'] = $_SESSION['user_id'];
		?>
    </header>
	<?php
	if(!isset($_POST['movie_title']) || $_POST['movie_title'] == "" || !isset($_POST['review']) || $_POST['review'] == "" || !isset($_POST['mark']) || $_POST['mark'] == "" || !isset($_POST['user_id']) || $_POST['user_id'] == "" || !isset($_POST['method']) || $_POST['method'] == ""){
		echo'<div class ="review">';
			echo'<div>';
				echo'<form method= "POST" action="">';
					echo'<input type="text" name="movie_title" id="movie_title" placeholder="movie title">';
					echo'</br>';
					echo'<input type="text" name="review" id="review" placeholder="your review">';
					echo'</br>';
					echo'<input type="number" name="mark" id="mark" min = "0" max = "5" placeholder="mark">';
					echo'</br>';
					echo'<h3>Soap or Rest :</h3>';
					echo'<label for="Soap">SOAP</label>';
					echo'<input type="radio" name="method" Value="Soap" id="Soap"/>';
					echo'</br>';
					echo'<label for="Rest">Rest</label>';
					echo'<input type="radio" name="method" Value="Rest" id="Rest"/>';
					echo'</br>';
					echo'<input type="submit" value="Submit review"/>';
				echo'</form>';
			echo'</div>';
		echo'</div>';
		echo '<p class ="error">field for the review not or incorrectly filled</p>';
	}
	else if (!(!isset($_POST['movie_title']) || $_POST['movie_title'] == "" || !isset($_POST['review']) || $_POST['review'] == "" || !isset($_POST['mark']) || $_POST['mark'] == "" || !isset($_POST['user_id']) || $_POST['user_id'] == "" || !isset($_POST['method']) || $_POST['method'] == "")){	
			echo'<div class ="review">';
			echo'<div>';
				echo'<form method= "POST" action="">';
					echo'<input type="text" name="movie_title" id="movie_title" placeholder="movie title">';
					echo'</br>';
					echo'<input type="text" name="review" id="review" placeholder="your review">';
					echo'</br>';
					echo'<input type="number" name="mark" id="mark" min = "0" max = "5" placeholder="mark">';
					echo'</br>';
					echo'<h3>Soap or Rest :</h3>';
					echo'<label for="Soap">SOAP</label>';
					echo'<input type="radio" name="method" Value="Soap" id="Soap"/>';
					echo'</br>';
					echo'<label for="Rest">Rest</label>';
					echo'<input type="radio" name="method" Value="Rest" id="Rest"/>';
					echo'</br>';
					echo'<input type="submit" value="Submit review"/>';
				echo'</form>';
			echo'</div>';
		echo'</div>';
		echo '<p class ="error">Your review have been send, if you want to send a other one filed the field, consult the link down below for see the reviews.</p>';
		$review_id = 0;
		$mark = $_POST['mark'];
		$reviewcontent = $_POST['review'];
		$user_id = $_POST['user_id'];
		$movie_title = $_POST['movie_title'];
		if($_POST['method'] == "Rest"){
			addReview($review_id,$mark,$reviewcontent,$user_id,$movie_title);
			echo '<p class = "methodMessage">You use the REST method</p>';
		}
		else{
			addReviewSoap($review_id,$mark,$reviewcontent,$user_id,$movie_title);
			echo '<p class = "methodMessage">You use the SOAP method</p>';
		}
	}
	?>
	<?php
		echo'<h2>Recommendation based on your preferences</h2>';
		if($_SESSION['preference'] == 'action'){
			getActionMovie();
		}
		else if($_SESSION['preference'] == 'science fiction'){
			getSciFiMovie();
		}
		else if($_SESSION['preference'] == 'drama'){
			getDramaMovie();
		}
		else{
			echo'you do not have preferences';
		}
	?>
<div id ="link"><a href="./review_page">To consult reviews</a></div>
<footer>JMovies</footer>
</body>
</html>