<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../../config/Database.php';
  include_once '../../../models/Client_Contact.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $client_contact = new Client_Contact($db);

  // Get ID
  $client_contact->client_id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get client's contacts
  $result = $client_contact->read_contacts();

  $num = $result->rowCount();

  if($num > 0){
      $client_contact_arr = array();
      $client_contact_arr['data'] = array();

      while($row = $result->fetch(PDO::FETCH_ASSOC)){
          extract($row);

          $client_contact_item = array(
            'name' => $name,
            'surname' => $surname,
            'email' => $email
          );

          array_push($client_contact_arr['data'], $client_contact_item);
      }
      echo json_encode($client_contact_arr);
  }
  else{
      $client_contact_arr = array();
      $client_contact_arr['data'] = array();
      array_push($client_contact_arr, array('message' => 'No Contact(s) for the selected Client.'));
      // No Clients
      echo json_encode($client_contact_arr);
  }
