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
		#Importing constants
    	include "const.php";


		#Trying to establish connection to database
		$mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
		if ($mysqli->connect_errno){
			die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
		}
		$mysqli->set_charset('utf8');



		#Fetching data where home location is unknown
		$sql=('select * from chemicals where home="?";');
		$res=$mysqli->query($sql) or die($mysqli->error);

		?>
		<button onclick=window.location='../index.php'>Main Menu</button>
		<?php
		if ($res->num_rows==0){
			echo'<p class="red">Query returned no results</p>';
		} else {
		?>



		<!-- Outputting results in table -->
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
		<!-- ------------------------- -->


		<br>
		<?php
		}

		#Closing database connection
		mysqli_close($mysqli);

    ?>
	
	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="module" src="../scripts/const.js?random=<?= uniqid() ?>"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>
  </body>
</html>
