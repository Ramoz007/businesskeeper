<?php
  // This API endpoint needs checks to ensure it has origin and access control
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
  // Perform sanitation
  $inputName = urldecode($data->name);
  $inputName = htmlspecialchars(strip_tags($inputName));

  // Set ID to UPDATE
  $client->client_id = isset($_GET['client_id']) ? $_GET['client_id'] : die();
  $client->name = $inputName;

  // Update Client
  if($client->update()) {
    echo json_encode(
      array('message' => 'Client Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Client not updated')
    );
  }
