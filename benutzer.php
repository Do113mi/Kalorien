<html>
    <head>
        <title>Registrieren</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>	
    <form action="benutzer.php" method="post">
        <h2>Registrierung</h2>
        Dein Username:<br>
        <input type="text" size="24" minlength="5" maxlength="50"
               name="ID"><br><br>
        Dein Passwort:<br>
        <input type="password" size="24" minlength="12" maxlength="50" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
               name="passwort"><br>
        
        
        <br>
        Passwort wiederholen:<br>
        <input type="password" size="24" maxlength="50"
               name="passwort2"><br><br>
        Vorname:<br>
        <input type="text" size="24" maxlength="50"
               name="vorname"><br><br>
        Nachname:<br>
        <input type="text" size="24" maxlength="50"
               name="nachname"><br><br>
        <input type="submit" name="Submit" value="Anmelden">
    </form>
</html>

<?php
session_start();
?>

<?php
include "mysql.php";

$connection = new createCon();
$connection->connect();

$ID = filter_input(INPUT_POST, "ID");
$_SESSION['ID'] = $ID;

$passwort = filter_input(INPUT_POST, "passwort");
$passwort2 = filter_input(INPUT_POST, "passwort2");
$vorname = filter_input(INPUT_POST, "vorname");
$nachname = filter_input(INPUT_POST, "nachname");




// Erzeugung von Passwort-Hash mit Salt
$password = $passwort;
$userID   = $ID; // Die UserID dient hier als einfache Möglichkeit für den Salt (hier als Beispiel 5121)
$salt = $userID;
$saltedHash    = saltPassword($password, $salt);
$password . ' : ' . $saltedHash . ' (Salt: ' . $salt . ')';


// Funktion die Passwort mit Hash kombiniert und den so erzeugten hash zurückgibt
function saltPassword($password, $salt)
{
     return crypt('sha256', $password . $salt); //hash()
}



$abfrage="SELECT ID FROM benutzerlogin WHERE ID LIKE '$ID'";
$result = mysqli_query($connection->myconn, $abfrage);
$anzahl = mysqli_num_rows($result);
if (isset($_POST['Submit'])) {

    if ($anzahl == 0) {
        $eintrag = "INSERT INTO benutzerlogin (ID, passwort, vorname, nachname) VALUES ('$ID', '$password', '$vorname', '$nachname')";
        $eintragen = mysqli_query($connection->myconn, $eintrag);

        if ($eintragen == true) {
            header('Location: makros.php');
        } else {
            echo "Fehler beim Speichern des Benutzernames. <a href=\"benutzer.html\">Zurück</a>";
        }
    } else {
        echo "Benutzername schon vorhanden. <a href=\"benutzer.php\">Zurück</a>";
    }
}










?>
