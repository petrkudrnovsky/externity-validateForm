<?php
declare(strict_types = 1);

class ValidateForm {
    private $surname;
    private $lastname;
    private $birth_number;
    private $birthday;
    public $zprava = "Nesprávně vyplněný formulář: <br> Chyby: <br>";

    public function __construct($surname, $lastname, $birth_number, $birthday){
        $this->surname = $surname;
        $this->lastname = $lastname;
        $this->birth_number = $birth_number;
        $this->birthday = $birthday;
    }

    private function validateSurnameInput() {
        if(preg_match("/^([a-zA-Z]+)$/", $this->surname)) {
            return true;
        }
        else {
            return false;
        }
    }
    private function validateLastnameInput() {
        if(preg_match("/^([a-zA-Z]+)$/", $this->lastname)) {
            return true;
        }
        else {
            return false;
        }
    }

    private function validateBirthNumber() {
        if($this->birth_number) {
            if(preg_match("/^(/d{6}\//d{4})$/", $this->birth_number)) {
                return true;
            }
            else {
                return false;
            }
        }
        return false;
    }

    private function validateBirthday() {
        if($this->birthday) {
            $birthTimestamp = strtotime($this->birthday);
            $currentTimestamp = time();
            if ($birthTimestamp > $currentTimestamp) {
                return false;
            } else {
                return true;
            }
        }
        return false;
    }

    private function birthDateHandler() {
        if($this->validateBirthNumber()) {
            return "birth_number";
        }
        else if ($this->validateBirthday()) {
            return "birthday";
        }
        else {
            return false;
        }
    }

    private function checkAll() {
        if ($this->validateSurnameInput() && $this->validateLastnameInput() && ($this->validateBirthday() || $this->validateBirthNumber())) {
            return true;
        }
    }

    private function wrongForm() {
        if (!$this->validateSurnameInput()) {
            $this->zprava = $this->zprava . "Špatně zadané jméno.<br>";
        }

        if (!$this->validateLastnameInput()) {
            $this->zprava = $this->zprava . "Špatně zadané příjmení.<br>";
        }

        if (!$this->validateBirthNumber()) {
            $this->zprava = $this->zprava . "rfe";
        }

        if(!$this->validateBirthday()) {
            $this->zprava = $this->zprava . "Zadali jste datum narození v budoucnosti.<br>";
        }
    }

    public function printOutput() {
        if($this->checkAll()) {
            echo("<h2>Odeslaný formulář</h2><br>");
            echo("Jméno: " . $this->surname);
            echo("Příjmení: " . $this->lastname);
            if($this->birthDateHandler() === "birth_number") {
                echo("Rodné číslo: " . $this->birth_number);
            }
            if($this->birthDateHandler() === "birthday") {
                echo("Datum narození: ");
            }
        }
        else {
            $this->wrongForm();
            echo($this->zprava);
        }

    }
}