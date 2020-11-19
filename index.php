<?php
    declare(strict_types = 1);
    mb_internal_encoding("UTF-8");
?>

<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <meta charset="UTF-8">
        <title>Formulář</title>
    </head>
    <body>
        <h1>Formulář</h1>
        <form method="post">
            <label for="surname">Jméno:</label><br>
                <input type="text" id="surname" name="surname" required><br>
            <label for="lastname">Příjmení:</label><br>
                <input type="text" id="lastname" name="lastname" required><br>
            <label for="birth_number">Rodné číslo: <i>(prosíme, zadejte ve formátu XXXXXX/XXXX)</i></label><br>
                <input type="text" id="birth_number" name="birth_number"><br>
            <label for="birthday">Datum narození</label><br>
                <input type="date" id="birthday" name="birthday"><br>
            <input type="submit" value="Odeslat formulář">
        </form>

        <?php
            if($_POST) {
                if($_POST["birthday"]) {
                    echo("yay");
                }
                else {
                    echo("nah");
                }
            }
        ?>
    </body>
</html>
