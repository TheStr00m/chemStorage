<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html, charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=0">
    <title>Register new Chemical</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <button onclick=window.location='../index.php'>Main Menu</button>
    <form action="submit.php" method="post">

    <?php
	#Importing constants
    include "const.php";



	#Trying to establish connection to database
	$mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
	if ($mysqli->connect_errno){
	  die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
	}
	$mysqli->set_charset('utf8');


	#Fetch data from eventual id for placeholders
	if (!empty($_GET)){
		$sql=('select * from chemicals where id='.$_GET["id"].';');
		$res=$mysqli->query($sql) or die($mysqli->error);
		extract($res->fetch_assoc());
	}
	

	#Fetching database table columns for table headers
	$sql=('show columns from chemicals where Field not like "%id%" and Field not like "%location%" and Field not like "%haz_class%";');
	$res=$mysqli->query($sql) or die($mysqli->error);

	#Creating table
	echo '<table class="regtable">';

	#Creating rows in form for each table columns in database
	while ($row = $res->fetch_assoc()){

		#Header for row
		if (!(in_array($row["Field"],$registrationProhibitedFields))){
			echo'<tr>';
			echo ('<th>'.$prettyFields[$row["Field"]].'</th>');
		};
		
		#Special input for Hazard Statements
/* 		if ($row["Field"]=="haz_stat"){
			echo("<td>");
			if (!empty(${$row["Field"]})){
				foreach (explode(", ",${$row["Field"]}) as $val){
					echo("<div><input class='inactive' readonly value='".$val."' type='text' name='".$row["Field"]."[]'><button onclick='$(this).parent().remove()' class='smallbutton' type='button'>&#65293;</button></div>");
				}
			}	
			echo('<input type="text" id="'.$row["Field"].'"><button class="smallbutton addButton" type="button">&#65291;</button></td>');
 */
		#Special input for Home Location
		if ($row["Field"]=="home"){
			echo'<td><select name="'.$row["Field"].'">';
			foreach ($registrationSelectArray[strtolower($row["Field"])] as $groupname => $group){
				echo'<optgroup label='.$groupname.'>';
				foreach ($group as $option){
					if (!empty(${$row["Field"]}) && $option==${$row["Field"]}){
						echo'<option selected value="'.$option.'">'.ucfirst($option).'</option>';
					} else {
						echo'<option value="'.$option.'">'.ucfirst($option).'</option>';
					}
				}
				echo'</optgroup>';
		 	}
		  	echo'</select></td>';

		#Remaining inputs, normal text boxes 
		} else if (empty($registrationSelectArray[$row["Field"]])){
			
			#Optional inputs
			if (in_array($row["Field"],$registrationOptionalFields)){
				if (isset(${$row["Field"]})){
					echo('<td><input value="'.${$row["Field"]}.'" type="text" name="'.$row["Field"].'"></td>');
				} else {
					echo('<td><input type="text" name="'.$row["Field"].'"></td>');
				}

			#Required inputs
			} else if (!(in_array($row["Field"],$registrationProhibitedFields))){
				if (isset(${$row["Field"]})){
					echo('<td><input value="'.${$row["Field"]}.'" type="text" required="required" name="'.$row["Field"].'"></td>');
				} else {
					echo('<td><input type="text" required="required" name="'.$row["Field"].'"></td>');
				}
			}
		}
		echo('</tr>');
	}?>


	</table>
	<br>
	<input class="submit" type="submit" value="Submit">
	<?php


	#Closing database connection
	mysqli_close($mysqli);
    ?>
    </form>


	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>
</body>
</html>
