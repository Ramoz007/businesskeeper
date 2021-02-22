<?php
  // This API endpoint needs checks to ensure it has origin and access control
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Client.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate client object
  $client = new Client($db);

  // Set ID to DELETE
  $client->client_id = isset($_GET['client_id']) ? $_GET['client_id'] : die();

  // Delete Client
  if($client->delete()) {
    echo json_encode(
      array('message' => 'Client deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Client not deleted')
    );
  }
