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
		//This file implement the login Page where you register or login
		include('./Rest/function_rest.php');
		include('./Soap/function_soap.php');
	?>
    <header>
        <h1>JMovies</h1>
    </header>
	<?php
	if (!(!isset($_POST['user_id_login']) || $_POST['user_id_login'] == "" || !isset($_POST['method']) || $_POST['method'] == "")){
		$_POST['inscription'] = 1;
	}
	?>
	<?php
	if((!isset($_POST['user_Name']) || $_POST['user_Name'] == "" || !isset($_POST['preference']) || $_POST['preference'] == "" || !isset($_POST['methodIns']) || $_POST['methodIns'] == "") && !isset($_POST['inscription'])){
		echo'<div class ="inscription">';
		echo '<h2>Inscription</h2>';
			echo'<div>';
				echo'<form method= "POST" action="">';
					echo'<input type="text" name="user_Name" id="user_Name" placeholder="user Name">';
					echo'</br>';
					echo'<h3>Your preferences :</h3>';
					echo'<label for="action">action</label>';
					echo'<input type="radio" name="preference" Value="action" id="action"/>';
					echo'</br>';
					echo'<label for="science_fiction">science fiction</label>';
					echo'<input type="radio" name="preference" Value="science fiction" id="science fiction"/>';
					echo'</br>';
					echo'<label for="drama">drama</label>';
					echo'<input type="radio" name="preference" Value="drama" id="drama"/>';
					echo'</br>';
					echo'<h3>Soap or Rest :</h3>';
					echo'<label for="Soap">SOAP</label>';
					echo'<input type="radio" name="methodIns" Value="Soap" id="Soap"/>';
					echo'</br>';
					echo'<label for="Rest">Rest</label>';
					echo'<input type="radio" name="methodIns" Value="Rest" id="Rest"/>';
					echo'</br>';
					echo'<input type="submit" value="Inscription"/>';
				echo'</form>';
			echo'</div>';
		echo'</div>';
		echo '<p class ="error">field not or incorrectly filled</p>';
	}
	?>
	<?php
	if(!(!isset($_POST['user_Name']) || $_POST['user_Name'] == "" || !isset($_POST['preference']) || $_POST['preference'] == "" || !isset($_POST['methodIns']) || $_POST['methodIns'] == "")){
		$_POST['login'] = 1;	
		$user_id = rand(1000, 30000);
		$userName = $_POST['user_Name'];
		$preference = $_POST['preference'];
		$_SESSION['user_id'] = $user_id;
		$_SESSION['userName'] = $userName;
		$_SESSION['preference'] = $preference;
		if($_POST['methodIns'] == "Rest"){
			CreateUser($user_id,$userName,$preference);
			echo '<p class = "methodMessage">You use the REST method</p>';
		}
		else {
			CreateUserSoap($user_id,$userName,$preference);
			echo '<p class = "methodMessage">You use the SOAP method</p>';
		}
		echo '<div id ="link"><a href="./main_page">Page des reviews</a></div>';
	}
	?>
	<?php
	if((!isset($_POST['user_id_login']) || $_POST['user_id_login'] == "" || !isset($_POST['method']) || $_POST['method'] == "") && !isset($_POST['login'])){
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
	}
	else if (!(!isset($_POST['user_id_login']) || $_POST['user_id_login'] == "" || !isset($_POST['method']) || $_POST['method'] == "")){
		if($_POST['method'] == "Rest"){
			getUser($_POST['user_id_login']);
			echo '<p class = "methodMessage">You use the REST method</p>';
			echo '<div id ="link"><a href="./main_page">Page des reviews</a></div>';
		}
		else{
			getUserSoap($_POST['user_id_login']);
			echo '<p class = "methodMessage">You use the SOAP method</p>';
			echo '<div id ="link"><a href="./main_page">Page des reviews</a></div>';
		}
	}
	?>
<footer>JMovies</footer>
</body>
</html>