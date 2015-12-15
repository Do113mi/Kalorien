

<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <BODY>
       <link href="css/site.css" rel='stylesheet' type='text/css' />
       <ul id="navi">
<li>
<a href="login.php" id="akt">Login</a>
</li>
<li>
<a href="kalorienberechnung.php">Kalorien</a>
</li>
<li>
    <a href="edituser.php">Userdaten</a>
</li>
<li>
<a href="logout.php">Logout</a>
</li>
</ul>
   </BODY>
    
    <form action="login.php" method="post">
        <h2>Login</h2>
        Dein Username:<br>
        <input type="text" size="24" maxlength="50"
               name="ID"><br><br>

        Dein Passwort:<br>
        <input type="password" size="24" maxlength="50"
               name="passwort"><br><br>
        <br>
        <input type="submit" name="Submit" value="Login">

        <a href="benutzer.php" target="_blank">Registrieren</a>
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
$passwort = filter_input(INPUT_POST, "passwort");
$submit = filter_input(INPUT_POST, "submit");

$abfrage = "SELECT ID, passwort FROM benutzerlogin WHERE ID LIKE '$ID' LIMIT 1";
$ergebnis = mysqli_query($connection->myconn, $abfrage);
$row = mysqli_fetch_object($ergebnis);

if (isset($_POST['Submit'])) {

    if (!empty($ID) && !empty($passwort )) {
        if ($row == true && $row->passwort == $passwort) {
            $_SESSION["ID"] = $ID;
            header('Location: anzeige3.php');
        } else {
            echo "Benutzername und/oder Passwort waren falsch. <a href=\"login.html\">Login</a>";
        }
    } else {
        echo "Bitte Benutzername und Passwort eingeben";
    }
}


// Funktion die Passwort mit Hash kombiniert und den so erzeugten hash zurückgibt
function saltPassword($password, $salt)
{
     return hash('sha256', $password . $salt);
}

// Prüfung (beispielhaft)
$saltedHash = "SELECT passwort FROM benutzerlogin WHERE ID LIKE '$ID' LIMIT 1"; // Fiktive Funktion um salted Hash aus der Datenbank zu laden
$salt = $ID; //get_user_id($_POST['id']); // Fiktive Funktion um UserID abzurufen

if ($saltedHash == saltPassword($_POST['password'], $salt)) // Prüfung mit Salt
{
     echo "Passwort stimmt überein";
}


/*
mysqli_close($connection);
 * s
 */
?>
