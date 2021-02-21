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

  // Get IDs
  $client_contact->client_id = isset($_GET['client_id']) ? $_GET['client_id'] : die();
  $client_contact->contact_id = isset($_GET['contact_id']) ? $_GET['contact_id'] : die();

  // Create Link
  if($client_contact->add_link()) {
    echo json_encode(
        array('message' => 'Contact Linked')
    );
  } else {
    echo json_encode(
        array('message' => 'Contact Not Linked')
    );
  }
