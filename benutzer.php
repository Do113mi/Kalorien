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
        <input type="text" size="24" maxlength="50"
               name="ID"><br><br>
        Dein Passwort:<br>
        <input type="password" size="24" minlength="12" maxlength="50" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
               name="passwort"><br>
        (min. 12 Zeichen)
        
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

/*
  if($passwort != $passwort2 OR $ID == "" OR $passwort == "")
  {
  echo "Eingabefehler. Bitte alle Felder korekt ausfüllen. <a href=\"benutzer.html\">Zurück</a>";
  exit;
  }
 */

/*
  $passwort = $_POST['passwort'];
  $salt_str = 'musta126';

 */

/*
  $gesaltetes_passwort = md5($salt_str . $passwort);
 * 
 */

$abfrage="SELECT ID FROM benutzerlogin WHERE ID LIKE '$ID'";
$result = mysqli_query($connection->myconn, $abfrage);
$anzahl = mysqli_num_rows($result);
if (isset($_POST['Submit'])) {

    if ($anzahl == 0) {
        $eintrag = "INSERT INTO benutzerlogin (ID, passwort, vorname, nachname) VALUES ('$ID', '$passwort', '$vorname', '$nachname')";
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
