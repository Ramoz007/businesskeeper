<?php

class CodeGen {
	// Properties
	public $client;

	// Constructor with DB
	public function __construct($clientPassed) {
			$this->client = $clientPassed;
	}
	
	// Function to be called
	public function userInput($input) : string{
			// Return with message when empty
			if($input == "") {
					return printf("Invalid Input: Empty string provided!");
			}

			// Exchange variables
			$username = $input;
			// This will not passed an empty string
			return $this->generateCode($username);
	}

	// Create Code for Client
	private function generateCode(string $username) : string {
		$alpha_out = "";
		// Trim the before and after whitespace
		$trimmed_name = trim($username);
		// Get the first character and assign it to code
		$alpha_out .= $trimmed_name[0];

		// Loop all characters
		for($i = 1; $i < strlen($trimmed_name); $i++){
			// Add the first character from every new word
			if($trimmed_name[$i] == " " && $trimmed_name[$i+1] != " "){
				// Only add up-to 3 characters to alpha_out
				if(strlen($alpha_out) <= 2){
					$alpha_out .= $trimmed_name[$i+1];
				}
			}
		}

		// Manipulate alpha_out to fit code gen specifications
		// Found documented below in this file
		if(strlen($trimmed_name) >= 3){
			if(strlen($alpha_out) == 2){
				$alpha_out .= substr($trimmed_name, -1);
			}
			elseif (strlen($alpha_out) == 1){
				$alpha_out .= $trimmed_name[1] . $trimmed_name[2];
			}
		}
		if(strlen($trimmed_name) == 2){
			// This append needs to be dynamic
			// Otherwise 999 is the max code combinations for occurance
			$alpha_out .= $trimmed_name[1] . "A";
		}
		elseif (strlen($trimmed_name) == 1){
			// This append needs to be dynamic
			// " " "
			$alpha_out .= "BC";
		}

		// Find last similar alpha's numeric
		// Change to Uppercase
		$upper_alpha_out = strtoupper($alpha_out);
		$this->client->alphaPart = $upper_alpha_out;
		// Get the last similar code
		$result = $this->client->findSimilar();
		$row = $result->fetch(PDO::FETCH_ASSOC);

		// If there exist a result
		if($result->rowCount() > 0){
			// Get the code member
			$lastAlphaNumeric = $row['code'];
			// Extract the numeric part
			$lastNumeric = substr($lastAlphaNumeric, 3);
			// Increment the numeric part
			$newNumeric = intval($lastNumeric) + 1;
		}
		// If non exist
		else{
			// Start the increment
			$newNumeric = 1;
		}
		// Format the numeric part to three digits
		$out_numeric = sprintf("%03d", $newNumeric);

		// return the new alphanumeric code
		return $upper_alpha_out.$out_numeric;
	}
}