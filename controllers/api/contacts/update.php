<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Contact.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate contact object
  $contact = new Contact($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  // Sanitizing needed
  $contact->name = $data->name;
  $contact->surname = $data->surname;
  $contact->email = $data->email;

  // Update contact
  if($contact->update()) {
    echo json_encode(
      array('message' => 'Contact Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact Not Updated')
    );
  }

