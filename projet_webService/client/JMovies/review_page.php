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
		//This file implement the page where you can consult info about the users and the worst/best or all the reviews of an user
		include('./Rest/function_rest.php');
		include('./Soap/function_soap.php');
	?>
    <header>
        <h1>JMovies</h1>
		<?php
			echo'<p>';
			echo'Hello '.$_SESSION['userName'].'';
			echo' your id is '.$_SESSION['user_id'].'';
			echo'</p>';
		?>
    </header>
	<div id ="link"><a href="./main_page.php">for adding a review or see your recommendations</a></div>
	<?php
	if(!isset($_POST['user_id_consult']) || $_POST['user_id_consult'] == "" || !isset($_POST['method']) || $_POST['method'] == ""){
		echo '<h2>Consult review of a user with is id</h2>';
		echo'<div class ="inscription">';
			echo'<div>';
				echo'<form method= "POST" action="">';
					echo'<input type="number" name="user_id_consult" id="user_id_consult" min = "1000" max = "30000" placeholder="user Id">';
					echo'</br>';
					echo'<h3>Soap or Rest :</h3>';
					echo'<label for="Soap">SOAP</label>';
					echo'<input type="radio" name="method" Value="Soap" id="Soap"/>';
					echo'</br>';
					echo'<label for="Rest">Rest</label>';
					echo'<input type="radio" name="method" Value="Rest" id="Rest"/>';
					echo'</br>';
					echo'<input type="submit" value="Consult all reviews"/>';
				echo'</form>';
			echo'</div>';
		echo'</div>';
		echo '<p class ="error">field for the reviews not or incorrectly filled</p>';
	}
	else{
		if($_POST['method'] == "Rest"){
			getAllReview($_POST['user_id_consult']);
			echo '<p class = "methodMessage">You use the REST method</p>';
		}
		else{
			getAllReviewSoap($_POST['user_id_consult']);
			echo '<p class = "methodMessage">You use the SOAP method</p>';
		}
	}
	?>
	<?php
	if(!isset($_POST['user_id_consult_best']) || $_POST['user_id_consult_best'] == "" || !isset($_POST['method']) || $_POST['method'] == ""){
		echo '<h2>Consult the best review of a user with is id</h2>';
		echo'<div class ="inscription">';
			echo'<div>';
				echo'<form method= "POST" action="">';
					echo'<input type="number" name="user_id_consult_best" id="user_id_consult_best" min = "1000" max = "30000" placeholder="user Id">';
					echo'</br>';
					echo'<h3>Soap or Rest :</h3>';
					echo'<label for="Soap">SOAP</label>';
					echo'<input type="radio" name="method" Value="Soap" id="Soap"/>';
					echo'</br>';
					echo'<label for="Rest">Rest</label>';
					echo'<input type="radio" name="method" Value="Rest" id="Rest"/>';
					echo'</br>';
					echo'<input type="submit" value="Consult best reviews"/>';
				echo'</form>';
			echo'</div>';
		echo'</div>';
		echo '<p class ="error">field for the best reviews not or incorrectly filled</p>';
	}
	else{
		if($_POST['method'] == "Rest"){
			getBestReview($_POST['user_id_consult_best']);
			echo '<p class = "methodMessage">You use the REST method</p>';
		}
		else{
			getBestReviewSoap($_POST['user_id_consult_best']);
			echo '<p class = "methodMessage">You use the SOAP method</p>';
		}
	}
	?>
	<?php
	if(!isset($_POST['user_id_consult_worst']) || $_POST['user_id_consult_worst'] == "" || !isset($_POST['method']) || $_POST['method'] == ""){
		echo '<h2>Consult the worst review of a user with is id</h2>';
		echo'<div class ="inscription">';
			echo'<div>';
				echo'<form method= "POST" action="">';
					echo'<input type="number" name="user_id_consult_worst" id="user_id_consult_worst" min = "1000" max = "30000" placeholder="user Id">';
					echo'</br>';
					echo'<h3>Soap or Rest :</h3>';
					echo'<label for="Soap">SOAP</label>';
					echo'<input type="radio" name="method" Value="Soap" id="Soap"/>';
					echo'</br>';
					echo'<label for="Rest">Rest</label>';
					echo'<input type="radio" name="method" Value="Rest" id="Rest"/>';
					echo'</br>';
					echo'<input type="submit" value="Consult worst reviews"/>';
				echo'</form>';
			echo'</div>';
		echo'</div>';
		echo '<p class ="error">field for the worst reviews not or incorrectly filled</p>';
	}
	else{
		if($_POST['method'] == "Rest"){
			getWorstReview($_POST['user_id_consult_worst']);
			echo '<p class = "methodMessage">You use the REST method</p>';
		}
		else{
			getWorstReviewSoap($_POST['user_id_consult_worst']);
			echo '<p class = "methodMessage">You use the SOAP method</p>';
		}
	}
	?>
	<?php
	echo'<div id ="table_div">';
	echo '<h2>List of users Get With REST</h2>';
		getAllUser();
	echo '<h2>List of users Get With SOAP</h2>';
		getAllUserSoap();
	echo'</div>';
	?>
<footer>JMovies</footer>
</body>
</html>