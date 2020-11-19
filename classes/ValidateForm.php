<?php
declare(strict_types = 1);

class ValidateForm {
    private $surname;
    private $lastname;
    private $birth_number;
    private $birthday;

    public function __construct($surname, $lastname, $birth_number, $birthday){
        $this->surname = $surname;
        $this->lastname = $lastname;
        $this->birth_number = $birth_number;
        $this->birthday = $birthday;
    }

    private function validateNameInput($surname, $lastname) {
        if(preg_match("/^([a-zA-Z]+)$/", $surname) && preg_match("/^([a-zA-Z]+)$/", $lastname)) {
            return true;
        }
        else {
            return false;
        }
    }

    private function validateBirthNumber($birth_number) {
        if(preg_match("/^(/d{6}\//d{4})$/", $birth_number)) {
            return true;
        }
        else {
            return false;
        }
    }

    private function birthDateHandler($birth_number, $birthday) {
        if($birth_number === "") {
            if($birthday === "")
        }
    }

    public function printOutput($surname, $lastname) {
        if(validateNameInput($surname, $lastname)) {

        }
    }
}