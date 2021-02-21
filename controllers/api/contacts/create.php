<?php
  // This API endpoint needs checks to ensure it has origin and access control
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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
  $inputName = htmlspecialchars(strip_tags($inputName));
  $surnameInput = urldecode($data->surname);
  $surnameInput = htmlspecialchars(strip_tags($surnameInput));
  $emailInput = urldecode($data->email);
  $emailInput = htmlspecialchars(strip_tags($emailInput));

  // Assign values to object members
  $contact->name = $nameInput;
  $contact->surname = $surnameInput;
  $contact->email = $emailInput;

  // Create Contact
  if($contact->create()) {
    echo json_encode(
      array('message' => 'Contact Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact Not Created')
    );
  }

