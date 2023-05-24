<!doctype html>
<?php
#Importing constants
include "const.php";
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Manage Locations</title>
		<link rel="stylesheet" href="../css/main.css">
		<style>
		</style>
	</head>
	<body>

    <!-- No Javascript Error Message -->
    <noscript>
      <div style="width: 22em; position: absolute; left: 50%; margin-left: -11em; color: red; background-color: white; border: 1px solid red; padding: 4px; font-family: sans-serif">
        Your web browser must have JavaScript enabled
        in order for this application to display correctly.
      </div>
    </noscript>
	<button onclick="window.location='../index.php'">Main Menu</button>

    <?php

    #Trying to establish connection to database
    $mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
    if ($mysqli->connect_errno){
        die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    }
    $mysqli->set_charset('utf8');


	#Delete Sequence
	if (!empty($_POST["delete"])){
		if ($_POST["delete"]=="YES"){
			$file = '../config.json';
			$json_data = file_get_contents($file);
			$json = json_decode($json_data);

			foreach ($json->locations->{$_POST["cat"]} as $key => $value){
				if ($value == $_POST["id"]) {
					unset($json->locations->{$_POST["cat"]}[$key]);
				}
			}
			//save the file
			file_put_contents($file,json_encode($json));
			include "const.php";
			
		} else{
			echo"<p>Are you sure you want to delete location \"".$_POST["delete"]."\" from \"".$_POST["cat"]."\"?</p>";
			echo"<form action='locations.php' method='post'>";
			echo"<input type='hidden' name='id' value='".$_POST["delete"]."'>";
			echo"<input type='hidden' name='cat' value='".$_POST["cat"]."'>";
			echo("<button type='submit' name='delete' value='YES'>YES</button>");
			echo"<button type='button' onclick=window.location='locations.php'>Back</button>";
			echo"</form>";
			die();
	 
		}


	#Adding new Location
	} else if (!empty($_POST["add"])){
		$file = '../config.json';
		$json_data = file_get_contents($file);
		$json = json_decode($json_data);
		if (!in_array($_POST["add"],$json->locations->{$_POST["cat"]})){
			//add new locations to file
			$json->locations->{$_POST["cat"]}[]=$_POST["add"];
			//save the file
			file_put_contents($file,json_encode($json));
		}
		include "const.php";

	}


	#Display Location Manager
	echo"<div class='locgrid'>";
		foreach($locations as $catname => $cat){
			echo"<form method='post' action='locations.php'>";
			echo"<table class='minitable'>";
			echo"<input type='hidden' name='cat' value='".$catname."'>";
			echo"<tr><th>";
			echo($catname);
			echo"</th></tr><tr><td>";
			foreach($cat as $location){
				echo"<div>";
				echo("<input onclick='window.location=\"../sites/querysearch.php?key=location&value=".$location."\"' class='inactive' readonly type='text' value='".$location."'>");
				echo("<button type='submit' formnovalidate name='delete' value='".$location."' class='smallbutton'>−</button>");
				echo"</div>";
			};
			echo"</td></tr><tr><td><div>";
			echo("<p>Add new \"".$catname."\"</p>");
			echo"<input required name='add' type='text'>";
			echo("<button class='smallbutton'>＋</button>");
			echo"</div></td></tr>";
			echo"</table>";
			echo"</form>";
			
		};
	echo"</div>";


?>
	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="module" src="../scripts/const.js?random=<?= uniqid() ?>"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>

  </body>
</html>
