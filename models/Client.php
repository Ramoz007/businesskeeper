<?php

class Client {
    // DB Stuff
    private $conn;
    private $table = 'clients';
    private $linked_table = 'contacts';

    // Properties
    public $client_id;
    public $name;
    public $code;

    //ClientCode Parts
    public $alphaPart;
    public $numericPart;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

  // Get clients
  public function read() {
    // Create query
    $query = 'SELECT
      client_id,
      name,
      code
    FROM
      ' . $this->table . '
    ORDER BY
      name ASC';

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }

  // Get last incremented code that is similar
  // Still requires tests for values above 999
  public function findSimilar() {
    // Create query
    $query = 'SELECT
      code
    FROM
      ' . $this->table . '
    WHERE code LIKE :alpha
    ORDER BY
      code DESC
    LIMIT 1';

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    //Bind Data
      $alphaToBePassed = $this->alphaPart."%";
    $stmt-> bindParam(':alpha', $alphaToBePassed);
    // Execute query
    $stmt->execute();
    return $stmt;
  }

  // Create Client
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      name = :name,
      code = :code';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);
    // Clean data | Already done in the model object
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->code = htmlspecialchars(strip_tags($this->code));
    // Bind data
    $stmt-> bindParam(':name', $this->name);
    $stmt-> bindParam(':code', $this->code);
    // Execute query
    if($stmt->execute()) {
      return true;
    }
    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);
    return false;
  }

  // Update Client
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      name = :name,
      WHERE
      client_id = :client_id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);
    // Clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    // Bind data
    $stmt-> bindParam(':client_id', $this->client_id);
    // Execute query
    if($stmt->execute()) {
      return true;
    }
    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);
    return false;
  }

  // Delete Client
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE client_id = :client_id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);
    // clean data
    $this->client_id = htmlspecialchars(strip_tags($this->client_id));
    // Bind Data
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
