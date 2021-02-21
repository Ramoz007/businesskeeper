<?php

	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../../config/Database.php';
	include_once '../../../models/Client_Contact.php';

	// Instantiate DB & connect
	$database = new Database();
	$db = $database->connect();

	// Instantiate client_contact object
	$client_contact = new Client_Contact($db);

	// Get ID
	$client_contact->contact_id = isset($_GET['id']) ? $_GET['id'] : die();

	// Get client's contacts
	$result = $client_contact->read_not_clients();

	// Get the row count
	$num = $result->rowCount();

	// Add data to an array and encode
	if($num > 0){
			$client_contact_arr = array();
			$client_contact_arr['data'] = array();

			// For all the rows
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					$client_contact_item = array(
							'name' => $name,
							'code' => $code
					);
					array_push($client_contact_arr['data'], $client_contact_item);
			}
			echo json_encode($client_contact_arr);
	}
	// No Clients for the Contact to add
	else{
			$client_contact_arr = array();
			$client_contact_arr['data'] = array();
			array_push($client_contact_arr, array('message' => 'The Contact has links to all available clients.'));
			echo json_encode($client_contact_arr);
	}
