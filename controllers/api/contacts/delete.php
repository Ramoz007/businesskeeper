<?php
  // This API endpoint needs checks to ensure it has origin and access control
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Contact.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate contact object
  $contact = new Contact($db);

  // Set ID to DELETE
  $contact->contact_id = isset($_GET['contact_id']) ? $_GET['contact_id'] : die();

  // Delete Contact
  if($contact->delete()) {
    echo json_encode(
      array('message' => 'Contact Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact Not Deleted')
    );
  }

