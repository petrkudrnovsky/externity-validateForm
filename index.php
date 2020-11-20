<?php
    declare(strict_types = 1);
    mb_internal_encoding("UTF-8");
    require_once("classes/ValidateForm.php");
?>

<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <meta charset="UTF-8">
        <title>Formulář</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    </head>
    <body>
        <h1>Formulář</h1>

        <?php
            $isSurname = (isset($_POST["surname"]) ? $_POST["surname"] : "");
            $isLastname = (isset($_POST["lastname"]) ? $_POST["lastname"] : "");
            $isBirthNumber = (isset($_POST["birth_number"]) ? $_POST["birth_number"] : "");
            $isBirthday = (isset($_POST["birthday"]) ? $_POST["birthday"] : "");

            echo(" <form method='post'>");
                echo("<label for='surname'>Jméno:</label><br>");
                echo("<input type='text' id='surname' name='surname' value='" . htmlspecialchars($isSurname) . "' required><br>");
                echo("<label for='lastname'>Příjmení:</label><br>");
                echo("<input type='text' id='lastname' name='lastname' value='" . htmlspecialchars($isLastname) . "' required><br>");
                echo("<label for='birth_number'>Rodné číslo: <i>(prosíme, zadejte ve formátu XXXXXX/XXXX)</i></label><br>");
                echo("<input type='text' id='birth_number' name='birth_number' value='" . htmlspecialchars($isBirthNumber) . "'><br>");
                echo("<label for='birthday'>Datum narození</label><br>");
                echo("<input type='date' id='birthday' name='birthday' value='" . htmlspecialchars($isBirthday) . "'><br>");
                echo("<input type='submit' value='Odeslat formulář'>");
            echo("</form>");

            if($_POST) {
                $form = new ValidateForm($_POST["surname"],  $_POST["lastname"], $_POST["birth_number"], $_POST["birthday"]);
                header("index.php");
                $form->printOutput();
                exit();
            }
        ?>
    </body>
</html>
