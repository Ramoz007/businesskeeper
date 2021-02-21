<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../../config/Database.php';
  include_once '../../../models/Contact.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate contact object
  $contact = new Contact($db);

  // Contact query
  $result = $contact->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any contacts
  if($num > 0) {
    $contact_arr = array();
    $contacts_arr['data'] = array();

    // For all the rows
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $contact_item = array(
          'id' => $id,
          'name' => $name,
          'surname' => $surname,
          'email' => $email,
      );
      array_push($contacts_arr['data'], $contact_item);
    }
    echo json_encode($contacts_arr);
  } 
  // No Contacts
  else {
      $contact_arr = array();
      $contact_arr['data'] = array();
      array_push($contact_arr, array('message' => 'No Contact(s) Found'));
      echo json_encode($contact_arr);
  }
