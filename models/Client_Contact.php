<?php

class Client_Contact {
    // DB Stuff
    private $conn;
    private $client_table = 'clients';
    private $contact_table = 'contacts';
    private $interm_table = 'clients_contacts';

    // Properties
    public $client_id;
    public $contact_id;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

  // Get Client's contacts
  public function read_contacts(){
    // Create query
    $query = 'SELECT
       co.id,
      co.name,
      co.surname,
      co.email
      FROM
        ' . $this->contact_table . '
        co
      INNER JOIN ' . $this->interm_table . '
        im
      ON co.id = im.contact_id
      INNER JOIN ' . $this->client_table . '
        cl
      ON cl.id = im.client_id
      WHERE cl.id = ?
      ORDER BY
        name ASC';

    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Bind ID
    $stmt->bindParam(1, $this->client_id);
    // Execute query
    $stmt->execute();
    return $stmt;
  }

  // Get Client's available contacts
  public function read_not_contacts(){
    // Create query
    $query = 'SELECT
      co.name,
      co.surname,
      co.email
      FROM
        ' . $this->contact_table . '
        co
      INNER JOIN ' . $this->interm_table . '
        im
      ON co.id = im.contact_id
      INNER JOIN ' . $this->client_table . '
        cl
      ON cl.id = im.client_id
      WHERE cl.id != ?
      ORDER BY
        name ASC';

    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Bind ID
    $stmt->bindParam(1, $this->client_id);
    // Execute query
    $stmt->execute();
    return $stmt;
  }

  // Get Contact's clients
  public function read_clients(){
    // Create query
    $query = 'SELECT
       cl.id,
      cl.name,
      cl.code
      FROM
        ' . $this->client_table . '
        cl
      INNER JOIN ' . $this->interm_table . '
        im
      ON cl.id = im.client_id
      INNER JOIN ' . $this->contact_table . '
        co
      ON co.id = im.contact_id
      WHERE co.id = ?
      ORDER BY
        name ASC';

    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Bind ID
    $stmt->bindParam(1, $this->contact_id);
    // Execute query
    $stmt->execute();
    return $stmt;
  }

  // Get Contact's available clients
  public function read_not_clients(){
    // Create query
      $query = 'SELECT
      cl.name,
      cl.code
      FROM
        ' . $this->client_table . '
        cl
      INNER JOIN ( SELECT * FROM ' . $this->interm_table . '
        imi 
      WHERE imi.contact_id != ? ) as im
      ON cl.id = im.client_id
      ORDER BY
        name ASC';

    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Bind ID
    $stmt->bindParam(1, $this->contact_id);
    // Execute query
    $stmt->execute();
    return $stmt;
  }

  // Add to a Client's contact | Add to a Contact's client
  public function add_link() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->interm_table . '
    SET
      client_id = :client_id,
      contact_id = :contact_id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);
    // Bind data
    $stmt-> bindParam(':client_id', $this->client_id);
    $stmt-> bindParam(':contact_id', $this->contact_id);
    // Execute query
    if($stmt->execute()) {
      return true;
    }
    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);
    return false;
  }

  // Remove a Client's contact | Remove a Contact's client
  public function del_link() {
    // Create query
    $query = 'DELETE FROM ' . $this->interm_table . ' WHERE contact_id = :contact_id AND client_id = :client_id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);
    // Bind Data
    $stmt-> bindParam(':contact_id', $this->contact_id);
    $stmt-> bindParam(':client_id', $this->client_id);
    // Execute query
    if($stmt->execute()) {
      return true;
    }
    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);
    return false;
    }
  }



