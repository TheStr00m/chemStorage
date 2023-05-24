<!doctype html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chemical Scan</title>
    <link rel="stylesheet" href="../css/main.css">
  </head>
  <body>
    <?php
    	include "const.php";

		#After search
    	if (!empty($_GET)){

			#Trying to establish connection to database
		    $mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
		    if ($mysqli->connect_errno){
		        die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
		    }
		    $mysqli->set_charset('utf8');



			#Creating query and fetching data
			if (in_array(($_GET["key"]), ["location","home"])) {
		    	$sql=('select * from chemicals where '.$_GET['key'].' = "'.$_GET['value'].'";');
			} else {
		    $sql=('select * from chemicals where '.$_GET['key'].' like "%'.$_GET['value'].'%" order by '.$_GET['key'].';');
			};
		    $res=$mysqli->query($sql) or die($mysqli->error);

			
			#Generic buttons
			?>
		    <button onclick=window.location='querysearch.php'>New Search</button>
		    <button onclick=window.location='../index.php'>Main Menu</button>
			<?php

			#Controlling that query is not empty
		    if ($res->num_rows==0){
		        echo'<p class="red">Query returned no results</p>';


			#Query not empty, displaying table with results from search
		    } else {
				?>
				<table>
				<tr>
				<th>ID</th>
				<th>CAS</th>
				<th>Name</th>
				<th>Size</th>
				<th>Current Location</th>
				<th>Home Location</th>
				</tr>
				<?php
				while ($row = $res->fetch_assoc()){
					?>
				    <tr id="<?=$row["id"]?>" class="clickableRow">
				    <td><?=$row["id"]?></td>
				    <td><?=$row["cas"]?></td>
				    <td><?=$row["name"]?></td>
				    <td><?=$row["size"]?></td>
				    <td><?=ucfirst($row["location"])?></td>
				    <td><?=$row["home"]?></td>
				    <tr>
					<?php
				}
				?>
				</table>
				<br>
				<?php
		    }


		    #Closing database connection
		    mysqli_close($mysqli);



			
		#Search form
		} else {
			?>
		    <h1>Search for chemical by:</h1>
		    <form action="querysearch.php" method="get">
				<select name="key">
					<option value="id">ID</option>
					<option value="name">Name</option>
					<option value="cas">CAS-Nr</option>
					<option value="location">Current Location</option>
					<option value="home">Home Location</option>
				</select>
				<br>
				<input type="text" id="normal" name="value">
						<?php
							
							#Looping out Select-form for current-locations
							echo'<select name="value" id="location" hidden>';
							foreach ($registrationSelectArray["location"]+$employees as $groupname => $group){
								echo'<optgroup label='.ucfirst($groupname).'>';
								echo'<option hidden disabled selected value></option>';
								foreach ($group as $option){
									echo'<option value="'.$option.'">'.ucfirst($option).'</option>';
								}
								echo'</optgroup>';
							}
							  echo'</select>';

							#Looping out Select-form for home-locations
							echo'<select name="value" id="home" hidden>';
							foreach ($registrationSelectArray["home"] as $groupname => $group){
								echo'<optgroup label='.ucfirst($groupname).'>';
								echo'<option hidden disabled selected value></option>';
								foreach ($group as $option){
									echo'<option value="'.$option.'">'.ucfirst($option).'</option>';
								}
								echo'</optgroup>';
							}
							  echo'</select>';
						?>
				<input class="search" type="submit" value="Search">
		    </form>
		    <br>
		    <button onclick=window.location='../index.php'>Main Menu</button>
			<?php
		  }

    ?>

	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>
	<script>
		$("select[name='key']").change(function(){
			switch($(this).val()){
				case("location"):
					$("#normal").hide();
					$("#normal").val("");
					$("#home").hide();
					$("#home").val("");
					$("#location").show();
					break;
				case("home"):
					$("#normal").hide();
					$("#normal").val("");
					$("#location").hide();
					$("#location").val("");
					$("#home").show();
					break;
				default:
					$("#home").hide();
					$("#home").val("");
					$("#location").hide();
					$("#location").val("");
					$("#normal").show();
					break;
			}
		});
	</script>
  </body>
</html>
