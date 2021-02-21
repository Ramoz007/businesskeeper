<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Client.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate client object
  $client = new Client($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $client->name = $data->name;

  // Update post
  if($client->update()) {
    echo json_encode(
      array('message' => 'Contact Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact not updated')
    );
  }
