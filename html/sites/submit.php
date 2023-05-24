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
    <?php
	#Importing constants
    include "const.php";
	require_once "func.php";

	#Importing gränsvärden
	$gransvardenFile = file_get_contents("../scripts/tables.json");
	$gransvarden = json_decode($gransvardenFile, true);

	#Trying to establish connection to database
	$mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
	if ($mysqli->connect_errno){
	  die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
	}
	$mysqli->set_charset('utf8');


	#If post isn't empty, submit registration for chemical
	if (!empty($_POST)){



		#Extrapolating exposure limits
		foreach($extrapolationFields as $field){
			if (array_key_exists($_POST["cas"],$gransvarden)){
				$_POST[$field]=$gransvarden[$_POST["cas"]][$field];
			} else{
				$_POST[$field]="";
			}
		}

		#Scraping sds data from web
		$hazData=getHazCodes($_POST["cas"]);
		$_POST["haz_urls"]=implode(", ",$hazData["urls"]);
		unset($hazData["urls"]);
		foreach ($hazData as $hazStat=>$hazClassCat){
			$_POST["haz_stat"].=$hazStat.">".$hazClassCat."<";
		}

		$_POST["haz_stat"]=substr($_POST["haz_stat"],0,-1);

		#Turning post data into sql query
		$sqlKeys=array_keys($_POST);
		$sqlValues=array_values($_POST);
		array_push($sqlKeys,"location");
		array_push($sqlValues,$_POST["home"]);
        $sqlKeys=implode(', ',$sqlKeys);
        $sqlValues=implode('", "',$sqlValues);
        $sqlValues=str_replace('"true"','true',$sqlValues);
        $sqlValues=str_replace('"false"','false',$sqlValues);

		
		#Finalizing sql query
        $sql=('insert into chemicals ('.$sqlKeys.') values ("'.$sqlValues.'");');

		#Try to submit registration for chemical
        if ($mysqli->query($sql)==TRUE){
			$last_id = $mysqli->insert_id;
			?>
            <p class='green'>Registered successfully!</p>
			<p class='yellow'>Info for label print:
			<p>ID: <?=$last_id?></p>
			<p>CAS: <?=$_POST['cas']?></p>
			<p>Home: <?=$_POST['home']?></p>
            <button onclick=window.location='register.php'>Register another</button>
	    	<button type='button' onclick=window.location='chemprofile.php?id=<?=$last_id?>'>Go to Chemical profile</button>
            <button onclick=window.location='../index.php'>Main Menu</button>
		<?php

		#Couldn't submit, displaying error
        } else {
            echo "<p class='red'>Error updating record: " . $mysqli->error."</p>";
        }
	}


      #Closing database connection
      mysqli_close($mysqli);
    ?>


	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="module" src="../scripts/const.js?random=<?= uniqid() ?>"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>
</body>
</html>
