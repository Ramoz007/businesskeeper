<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Client.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate client object
$client = new Client($db);

// Client read query
$result = $client->read();

// Get row count
$num = $result->rowCount();

// Check if any client
if($num > 0) {
    // Cat array
    $client_arr = array();
    $client_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $client_item = array(
            'name' => $name,
            'code' => $code
        );

        // Push to "data"
        array_push($client_arr['data'], $client_item);
    }

    // Turn to JSON & output
    echo json_encode($client_arr);

} else {
    // No Clients
    echo json_encode(
        array('message' => 'No Client(s) Found')
    );
}
