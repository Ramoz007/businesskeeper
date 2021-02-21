<?php

class CodeGen
{
    public $client;
    // Constructor with DB
    public function __construct($clientPassed) {
        $this->client = $clientPassed;
    }

    public function userInput($input) : string{
        //return with error when empty
        if($input == "") {
            return printf("Invalid Input: Empty string provided!");
        }
        $username = $input;

        //this will not passed an empty string
        return $this->generateCode($username);
    }

    private function generateCode(string $username) : string {

        $alpha_out = "";

        //trim the before and after whitespace
        $trimmed_name = trim($username);

        //get the first character
        $alpha_out .= $trimmed_name[0];

        //loop all characters
        for($i = 1; $i < strlen($trimmed_name); $i++){
            //add the first character from every new word
            if($trimmed_name[$i] == " " && $trimmed_name[$i+1] != " "){
                //only add up-to 3 characters to alpha_out
                if(strlen($alpha_out) <= 2){
                    $alpha_out .= $trimmed_name[$i+1];
                }
            }
        }

        //manipulate alpha_out to fit code gen specifications
        if(strlen($trimmed_name) >= 3){
            if(strlen($alpha_out) == 2){
                $alpha_out .= substr($trimmed_name, -1);
            }
            elseif (strlen($alpha_out) == 1){
                $alpha_out .= $trimmed_name[1] . $trimmed_name[2];
            }
        }
        if(strlen($trimmed_name) == 2){
            //this append needs to be dynamic
            $alpha_out .= $trimmed_name[1] . "A";
        }
        elseif (strlen($trimmed_name) == 1){
            //this append needs to be dynamic
            $alpha_out .= "BC";
        }

        // Find last similar alpha's numeric
        $upper_alpha_out = strtoupper($alpha_out);
        $this->client->alphaPart = $upper_alpha_out;
        $result = $this->client->findSimilar();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if($result->rowCount() > 0){
            $lastAlphaNumeric = $row['code'];
            $lastNumeric = substr($lastAlphaNumeric, 3);

            // increment the numeric
            $newNumeric = intval($lastNumeric) + 1;
        }
        else{
            $newNumeric = 1;
        }
        $out_numeric = sprintf("%03d", $newNumeric);

        // return the new alphanumeric code
        return $upper_alpha_out.$out_numeric;

    }
}