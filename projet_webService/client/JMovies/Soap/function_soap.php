<?php
//This file implement all the functions who use SOAP and are use in the client
//this function create an user with SOAP
	function CreateUserSoap($user_id,$userName,$preference){
		$env='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:q0="http://service.jMoviesWebSoap.webServices.project.com/"
		xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
								<soapenv:Body>
									<q0:CreateUser>
										<arg0>
											<preference>'.$preference.'</preference>
											<userName>'.$userName.'</userName>
											<user_id>'.$user_id.'</user_id>
										</arg0>
									</q0:CreateUser>
								</soapenv:Body>
							</soapenv:Envelope>';

				$headers = array("Content-type: text/xml;charset=\"utf-8\"", 
								 "Accept: text/xml", 
								 "Cache-Control: no-cache", 
								 "Pragma: no-cache", 
								 "SOAPAction: urn:CreateUser", 
								 "Content-length: ".strlen($env)); 

				$soap = curl_init(); 
						   curl_setopt($soap, CURLOPT_URL,"http://localhost:8080/JMoviesWebSoap/services/UserServiceImplPort?wsdl");
						   curl_setopt($soap, CURLOPT_CONNECTTIMEOUT, 10); 
						   curl_setopt($soap, CURLOPT_TIMEOUT,        10); 
						   curl_setopt($soap, CURLOPT_RETURNTRANSFER, true );
						   curl_setopt($soap, CURLOPT_SSL_VERIFYPEER, false);
						   curl_setopt($soap, CURLOPT_SSL_VERIFYHOST, false); 
						   curl_setopt($soap, CURLOPT_POST,           true ); 
						   curl_setopt($soap, CURLOPT_POSTFIELDS,$env); 
						   curl_setopt($soap, CURLOPT_HTTPHEADER,$headers); 

				$result = curl_exec($soap);
				$err = curl_error($soap);
	}

	//this function create a review with SOAP
	function addReviewSoap($review_id,$mark,$reviewcontent,$user_id,$movie_title){
		$env='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:q0="http://service.jMoviesWebSoap.webServices.project.com/"
		xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
								<soapenv:Body>
									<q0:addReviews>
										<arg0>
											<reviewId>'.$review_id.'</reviewId>
											<reviewContent>'.$reviewcontent.'</reviewContent>
											<mark>'.$mark.'</mark>
											<user_id>'.$user_id.'</user_id>
											<movieTitle>'.$movie_title.'</movieTitle>
										</arg0>
									</q0:addReviews>
								</soapenv:Body>
							</soapenv:Envelope>';

				$headers = array("Content-type: text/xml;charset=\"utf-8\"", 
								 "Accept: text/xml", 
								 "Cache-Control: no-cache", 
								 "Pragma: no-cache", 
								 "SOAPAction: urn:AddReviews", 
								 "Content-length: ".strlen($env)); 

				$soap = curl_init(); 
						   curl_setopt($soap, CURLOPT_URL,"http://localhost:8080/JMoviesWebSoap/services/UserServiceImplPort?wsdl");
						   curl_setopt($soap, CURLOPT_CONNECTTIMEOUT, 10); 
						   curl_setopt($soap, CURLOPT_TIMEOUT,        10); 
						   curl_setopt($soap, CURLOPT_RETURNTRANSFER, true );
						   curl_setopt($soap, CURLOPT_SSL_VERIFYPEER, false);
						   curl_setopt($soap, CURLOPT_SSL_VERIFYHOST, false); 
						   curl_setopt($soap, CURLOPT_POST,           true ); 
						   curl_setopt($soap, CURLOPT_POSTFIELDS,$env); 
						   curl_setopt($soap, CURLOPT_HTTPHEADER,$headers); 

				$result = curl_exec($soap);
				$err = curl_error($soap);
	}

	//function for getting all the review with SOAP
	function getAllReviewSoap($user_id){
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
		
		$soap_client = new SoapClient("http://localhost:8080/JMoviesWebSoap/services/UserServiceImplPort?wsdl");
		$query = array('arg0'=>$user_id);
		$result = $soap_client->getAllReviews($query);
		if(!isset ($result->return)){
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult'].' have post no review or does not exist.</p>';;
		}
		else if(!(is_array($result->return)&&!empty($result->return[0]))){
			echo'<tr><td>';
			echo $result->return->reviewId;
			echo'</td><td>';
			echo $result->return->movieTitle;
			echo'</td><td>';
			echo $result->return->mark;
			echo'</td><td>';
			echo $result->return->reviewContent;
			echo'</td><td>';
			echo $result->return->user_id;
			echo'</td></tr>';
		}
		else if(isset ($result->return)){
			$NbReviews = sizeof ($result->return);
			if(is_array($result->return)&&!empty($result->return[0])){
				for($i = 0;$i < $NbReviews ;$i++){
					echo'<tr><td>';
					echo $result->return[$i]->reviewId;
					echo'</td><td>';
					echo $result->return[$i]->movieTitle;
					echo'</td><td>';
					echo $result->return[$i]->mark;
					echo'</td><td>';
					echo $result->return[$i]->reviewContent;
					echo'</td><td>';
					echo $result->return[$i]->user_id;
					echo'</td></tr>';
				}
			}
			else if($NbReviews == 0){
				echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult'].' have post no review or does not exist.</p>'; 
			}
		}
		else{
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult'].' have post no review or does not exist.</p>';
		}
		echo'</table>';
	}

	//function for getting the worst reviews given an user_id with SOAP
	function getWorstReviewSoap($user_id){
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
		
		$soap_client = new SoapClient("http://localhost:8080/JMoviesWebSoap/services/UserServiceImplPort?wsdl");
		$query = array('arg0'=>$user_id);
		$result = $soap_client->getWorstReviews($query);
		if(!isset ($result->return)){
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult_worst'].' have post no review with a mark <=2 or does not exist.</p>';
		}
		else if(!(is_array($result->return)&&!empty($result->return[0]))){
			echo'<tr><td>';
			echo $result->return->reviewId;
			echo'</td><td>';
			echo $result->return->movieTitle;
			echo'</td><td>';
			echo $result->return->mark;
			echo'</td><td>';
			echo $result->return->reviewContent;
			echo'</td><td>';
			echo $result->return->user_id;
			echo'</td></tr>';
		}
		else if(isset ($result->return)){
			$NbReviews = sizeof ($result->return);
			if(is_array($result->return)&&!empty($result->return[0])){
				for($i = 0;$i < $NbReviews ;$i++){
					echo'<tr><td>';
					echo $result->return[$i]->reviewId;
					echo'</td><td>';
					echo $result->return[$i]->movieTitle;
					echo'</td><td>';
					echo $result->return[$i]->mark;
					echo'</td><td>';
					echo $result->return[$i]->reviewContent;
					echo'</td><td>';
					echo $result->return[$i]->user_id;
					echo'</td></tr>';
				}
			}
			else if($NbReviews == 0){
				echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult_worst'].' have post no review with a mark <=2 or does not exist.</p>'; 
			}
		}
		else{
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult_worst'].' have post no review with a mark <=2 or does not exist.</p>';
		}
		echo'</table>';
	}

	//function for getting the best reviews given an user_id with SOAP
	function getBestReviewSoap($user_id){
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
		
		$soap_client = new SoapClient("http://localhost:8080/JMoviesWebSoap/services/UserServiceImplPort?wsdl");
		$query = array('arg0'=>$user_id);
		$result = $soap_client->getBestReviews($query);
		if(!isset ($result->return)){
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult_best'].' have post no review with a mark >= 4 or does not exist.</p>';
		}
		else if(!(is_array($result->return)&&!empty($result->return[0]))){
			echo'<tr><td>';
			echo $result->return->reviewId;
			echo'</td><td>';
			echo $result->return->movieTitle;
			echo'</td><td>';
			echo $result->return->mark;
			echo'</td><td>';
			echo $result->return->reviewContent;
			echo'</td><td>';
			echo $result->return->user_id;
			echo'</td></tr>';
		}
		else if(isset($result->return)){
			$NbReviews = sizeof ($result->return);
			if(is_array($result->return)&&!empty($result->return[0])){
				for($i = 0;$i < $NbReviews ;$i++){
					echo'<tr><td>';
					echo $result->return[$i]->reviewId;
					echo'</td><td>';
					echo $result->return[$i]->movieTitle;
					echo'</td><td>';
					echo $result->return[$i]->mark;
					echo'</td><td>';
					echo $result->return[$i]->reviewContent;
					echo'</td><td>';
					echo $result->return[$i]->user_id;
					echo'</td></tr>';
				}
			}
			else if($NbReviews == 0){
				echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult_best'].' have post no review with a mark >= 4 or does not exist.</p>'; 
			}
		}
		else{
			echo '<p class ="not_found_message"> The user with the id '.$_POST['user_id_consult_best'].' have post no review with a mark >= 4 or does not exist.</p>';
		}
		echo'</table>';
	}

	//function for getting all the user with SOAP
	function getAllUserSoap(){
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
		$soap_client = new SoapClient("http://localhost:8080/JMoviesWebSoap/services/UserServiceImplPort?wsdl");
		$query = array('arg0');
		$result = $soap_client->getAllUser($query);
		if(!isset ($result->return)){
			echo '<p class ="not_found_message">There is no user.</p>';
		}
		if(!(is_array($result->return)&&!empty($result->return[0]))){
			echo'<tr><td>';
			echo $result->return->user_id;
			echo'</td><td>';
			echo $result->return->userName;
			echo'</td><td>';
			echo $result->return->preference;
			echo'</td></tr>';
		}
		else if(isset ($result->return)){
			$NbUsers = sizeof ($result->return);
			if(is_array($result->return)&&!empty($result->return[0])){
				for($i = 0;$i < $NbUsers ;$i++){
					echo'<tr><td>';
					echo $result->return[$i]->user_id;
					echo'</td><td>';
					echo $result->return[$i]->userName;
					echo'</td><td>';
					echo $result->return[$i]->preference;
					echo'</td></tr>';
				}
			}
			else if($NbUsers == 0){
				echo '<p class ="not_found_message">There is no user.</p>'; 
			}
		}
		else{
			echo '<p class ="not_found_message">There is no user.</p>';
		}
		echo'</table>';
	}

	//function for one user given an user_id with SOAP
	function getUserSoap($user_id){
		$soap_client = new SoapClient("http://localhost:8080/JMoviesWebSoap/services/UserServiceImplPort?wsdl");
		$query = array('arg0'=>$user_id);
		$result = $soap_client->getUser($query);
		if(isset ($result->return)){
			$_SESSION['user_id'] = strval($result->return->user_id);
			$_SESSION['userName'] = strval($result->return->userName);
			$_SESSION['preference'] = strval($result->return->preference);
		}
		else{
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
	}
?>