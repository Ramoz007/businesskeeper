<?php
  // This API endpoint needs checks to ensure it has origin and access control
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

  // Perform sanitation
  $nameInput = urldecode($data->name);
  $nameInput = htmlspecialchars(strip_tags($nameInput));
  $surnameInput = urldecode($data->surname);
  $surnameInput = htmlspecialchars(strip_tags($surnameInput));
  $emailInput = urldecode($data->email);
  $emailInput = htmlspecialchars(strip_tags($emailInput));

  // Set ID to update
  $contact->contact_id = isset($_GET['contact_id']) ? $_GET['contact_id'] : die();
  $contact->name = $nameInput;
  $contact->surname = $surnameInput;
  $contact->email = $emailInput;

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

