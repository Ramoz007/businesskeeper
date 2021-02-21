<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Client.php';
  include_once '../../../services/CodeGen.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate client object
  $client = new Client($db);

  // Instantiate CodeGen
  $codegen = new CodeGen($client);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //  $name = "Liberty Sunde Inter";
  $inputName = urldecode($data->name);
  $client->name = $inputName;
  $inputName = htmlspecialchars(strip_tags($inputName));
  $client->code = $codegen->userInput($inputName);


  // Create Contact
  if($client->create()) {
    echo json_encode(
      array('message' => 'Client Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Client Not Created')
    );
  }
