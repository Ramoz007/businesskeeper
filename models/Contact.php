<?php

  class Contact {
    // DB Stuff
    private $conn;
    private $table = 'contacts';

    // Properties
    public $id;
    public $name;
    public $surname;
    public $email;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
        // Create query
        $query = 'SELECT
        id,
        name,
        surname,
        email
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

    // Create Contact
    public function create() {
        // Create Query
        $query = 'INSERT INTO ' .
          $this->table . '
        SET
          name = :name,
          surname = :surname,
          email = :email';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind data
        $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':surname', $this->surname);
        $stmt-> bindParam(':email', $this->email);

        // Execute query
        if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }

    // Update Contact
    public function update() {
        // Create Query
        $query = 'UPDATE ' .
          $this->table . '
        SET
          name = :name, surname = :surname, email = :email
          WHERE
          id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind data
        $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':surname', $this->surname);
        $stmt-> bindParam(':email', $this->email);


        // Execute query
        if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }

    // Delete Contact
    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Bind Data
        $stmt-> bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }
  }
