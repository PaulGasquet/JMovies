<?php	
	$soap_client = new SoapClient("http://localhost:8080/JMoviesWebSoap/services/UserServiceImplPort?wsdl");
	$query = array('arg0'=>8776);
	$result = $soap_client->getWorstReviews($query);
	print_r($result);
	if(!isset ($result->return)){
		echo "nul c'est bon ?";
	}
	else {
		echo "pas nul";
	}
?>
		