<?php
declare(strict_types = 1);

class ValidateForm {
    private $surname;
    private $lastname;
    private $birth_number;
    private $birthday;
    public $zprava = "<h2>Nesprávně vyplněný formulář:</h2> <br> Chyby: <br>";
    private $birthNumberWarning;
    private $birthdayWarning;

    public function __construct($surname, $lastname, $birth_number, $birthday){
        $this->surname = $surname;
        $this->lastname = $lastname;
        $this->birth_number = $birth_number;
        $this->birthday = $birthday;
    }

    private function validateSurnameInput() {
        if(preg_match("/^([a-zA-ZáéěíýóúůžščřďťňÁÉĚÍÝÓÚŮŽŠČŘĎŤŇ]+)$/", $this->surname)) {
            return true;
        }
        else {
            return false;
        }
    }
    private function validateLastnameInput() {
        if(preg_match("/^([a-zA-ZáéěíýóúůžščřďťňÁÉĚÍÝÓÚŮŽŠČŘĎŤŇ]+)$/", $this->lastname)) {
            return true;
        }
        else {
            return false;
        }
    }

    private function validateBirthNumber() {
        if($this->birth_number) {
            if(preg_match("/^(\d{6}\/\d{4})$/", $this->birth_number)) {
                return $this->birth_number;
            }
            else {
                $this->birthNumberWarning = "Špatně zadané rodné číslo.";
                return false;
            }
        }
        return false;
    }

    private function validateBirthday() {
        if($this->birthday) {
            $birthTimestamp = strtotime($this->birthday);
            $currentTimestamp = time();
            if ($birthTimestamp < $currentTimestamp) {
                return $this->birthday;
            } else {
                $this->birthdayWarning = "Špatně zadané datum narození, je v budoucnosti";
                return false;
            }
        }
        return false;
    }

    /*private function birthDateHandler() {
        if($this->validateBirthNumber()) {
            return "birth_number";
        }
        if ($this->validateBirthday()) {
            return "birthday";
        }
    }*/
    private function leaveInfo() {
        $isSurname = (isset($_POST["surname"]) ? $_POST["surname"] : "");
        $isLastname = (isset($_POST["lastname"]) ? $_POST["lastname"] : "");
        $isBirthNumber = (isset($_POST["birth_number"]) ? $_POST["birth_number"] : "");
        $isBirthday = (isset($_POST["birthday"]) ? $_POST["birthday"] : "");
    }

    private function checkAll() {
        if ($this->validateSurnameInput() && $this->validateLastnameInput() && ($this->validateBirthday() || $this->validateBirthNumber())) {
            return true;
        }
        return false;
    }

    private function wrongForm() {
        $this->leaveInfo();
        if (!$this->validateSurnameInput()) {
            $this->zprava = $this->zprava . "Špatně zadané jméno.<br>";
        }

        if (!$this->validateLastnameInput()) {
            $this->zprava = $this->zprava . "Špatně zadané příjmení.<br>";
        }

        if (!($this->validateBirthday() || $this->validateBirthNumber())) {
            if(!($this->birthNumberWarning && $this->birthdayWarning)) {
                $this->zprava = $this->zprava . "Není zadáno ani datum narození ani rodné číslo.<br>";
            }
            if($this->birthdayWarning) {
                $this->zprava = $this->zprava . $this->birthdayWarning. "<br>";
            }
            if($this->birthNumberWarning) {
                $this->zprava = $this->zprava . $this->birthNumberWarning. "<br>";
            }
        }
    }

    public function printOutput() {
        if($this->checkAll()) {

            echo("<h2>Odeslaný formulář</h2><br>");
            echo("Jméno: " . $this->surname . "<br>");
            echo("Příjmení: " . $this->lastname . "<br>");
            if($this->validateBirthNumber()) {
                echo("Rodné číslo: " . $this->validateBirthNumber() . "<br>");
            }
            else {
                echo("Rodné číslo: " . $this->birthNumberWarning . "<br>");
            }
            if($this->validateBirthday()) {
                echo("Datum narození: " . $this->validateBirthday() . "<br>");
            }
            else {
                echo("Datum narození: " . $this->birthdayWarning . "<br>");
            }
        }
        else {
            $this->wrongForm();
            echo($this->zprava);
        }
    }

    public function printForm() {

    }
}