


<html>
<head>	
	<title>Edit User Data</title>
</head>

<?php
// including the database connection file
include "mysql.php";

        $connection = new createCon();
        $connection->connect();
?>
<?php
        session_start();
     ?>
<?php


//getting id from url
if(isset($_GET['id']))
{
    //$id = $_GET['id'];    
    $id = $_SESSION['ID'];
}
else
{
    echo "ID nicht gesetzt";
}
   

$abfrage="SELECT * FROM benutzer WHERE b_id='$id'";
//selecting data associated with this particular id
$result = mysqli_query($connection->myconn,$abfrage);


while($row = mysqli_fetch_array($result))
{
	$gewicht = $row['gewicht'];
        $training = $row['training'];
        $ziel = $row['ziel'];
   
}
   
if(isset($_POST['update']))
{	
    
      
      $ID = $_SESSION['ID'];
      $gewicht = filter_input(INPUT_POST, "gewicht");
      $training = filter_input(INPUT_POST, "training");
      $ziel = filter_input(INPUT_POST, "ziel");


      
	// checking empty fields
	
			
	} else {	
                $abfrage2= "UPDATE benutzer SET gewicht='$gewicht', training='$training', ziel='$ziel'";
		$result2 = mysqli_query($connection->myconn, $abfrage2);
		if ($result2 == true) {
                    //header('Location: anzeige3.php');
		//redirectig to the display page. In our case, it is index.php
                }
                else
                {
                    echo "Fehler beim Update. <a href=\"edituser.php\"></a>";
                }
	}

?>
<body>
	<a href="anzeige3.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edituser.php">
		<table border="0">
			<tr> 
                            <td>
                                <?php echo $id; ?>
                                <?php echo "" . $_SESSION['ID']; ?>
                                
                            </td>
                        </tr>
                        <tr>
				<td>Daten</td>
                                <td>
                                    <input type="hidden" name="id" value=<?php echo '"'.$id.'"';?>/>
                                    <td><input type="hidden" name="gewicht" value=<?php echo $gewicht;?>>
                                        <td><input type="hidden" name="training" value=<?php echo $training;?>/>
                                            <td><input type="hidden" name="ziel" value=<?php echo $ziel;?>/>
                                        
                                                
                                
			</tr>
                       
			<tr>
				<td><input type="submit" name="update" value="update"></td>
			</tr>
                     
		</table>
	</form>
</body>
</html>
