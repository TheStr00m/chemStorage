<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Chemical Search</title>
		<link rel="stylesheet" href="../css/main.css">
    	<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
	</head>
	<body>

    <!-- No Javascript Error Message -->
    <noscript>
      <div style="width: 22em; position: absolute; left: 50%; margin-left: -11em; color: red; background-color: white; border: 1px solid red; padding: 4px; font-family: sans-serif">
        Your web browser must have JavaScript enabled
        in order for this application to display correctly.
      </div>
    </noscript>



    <?php

	#Importing constants
	include "const.php";

    #Trying to establish connection to database
    $mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
    if ($mysqli->connect_errno){
        die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    }
    $mysqli->set_charset('utf8');



	#QR Scanned
	if (!empty($_GET)){

		#QR Camera error
        if ($_GET["id"]=="Requested device not found"){
            #No Camera
			?>
            <p class='red'>ERROR, NO CAMERA FOUND</p>
            <br>
            <button onclick=window.location='../index.php'>Main Menu</button>
			<?php



		#Update location to database
        } else if (!empty($_GET["newlocation"])){
            $sql=("update chemicals set location='".$_GET['newlocation']."' where id='".$_GET['id']."'");
			if ($mysqli->query($sql)==FALSE){
				echo "<p class='red'>Error updating record: " . $mysqli->error."</p>";
			} else {
				?>
				<p class='green'>Updated successfully!</p>
				<button onclick=window.location='updatelocation.php'>Scan another chemical</button>
				<button onclick=window.location='chemprofile.php?id=<?=$_GET['id']?>'>Chemical Profile</button>
				<button onclick=window.location='../index.php'>Main Menu</button>
				<?php
			}



		
		#Form for updating location
        } else if (!empty($_GET["id"])){
			#DB Fetch query
            $sql=('select * from chemicals where id='.$_GET['id'].' limit 1;');
            $res=$mysqli->query($sql);
			$row = $res->fetch_assoc();
			$home=$row["home"];
			$location=$row["location"];

			#Outputting table with info about chemical being updated
			?>
            <table>
                <tr>
					<th>CAS</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Home Location</th>
                    <th>Current Location</th>
                </tr>
                <tr>
		            <td><?=$row["cas"]?></td>
		            <td><?=$row["name"]?></td>
		            <td><?=$row["size"]?></td>
		            <td><?=ucfirst($row["home"])?></td>
		            <td><?=ucfirst($row["location"])?></td>
				</tr>
            </table>
			<br>

			

			<!-- Form for updating location -->
            <form action="updatelocation.php?id=<?=$_GET['id']?>" method="get">
            <table class="minitable">
			<?php
			if ($home==$location){
				?>
                <tr>
					<th>Select Location</th>
		        </tr>
	        	<tr>
                	<td>
                    	<select name="newlocation">
		                <optgroup label="Finns hos:">
						<?php
	                        foreach ($employees["employees"] as $key => $employee){
	                            echo'<option value="'.$employee.'">'.ucfirst($employee).'</option>';
	                        };
						?>
						</optgroup>
                    	</select>
					</td>
				</tr>
			<?php
			} else {
				?>
				<tr>
					<th>Return to home?</th>
				</tr>
                <input type="hidden" name="newlocation" value="<?=$home?>">
				<?php
			}
			?>
            </table>
            <br>





            <!-- Keep ID in GET -->
            <input type="hidden" name="id" value="<?=$_GET["id"]?>">
            <input class="submit" type="submit" value="Submit">
            </form>
            <br>
            <button onclick=window.location='updatelocation.php'>Re-Scan</button>
            <button onclick=window.location='../index.php'>Main Menu</button>
			<?php


		    #Closing database connection
		    mysqli_close($mysqli);
			}



	#Scanner
	} else {
		?>
		<h1>Scan QR-Code!</h1>
		<button onclick=window.location='../index.php'>Main Menu</button>
		<br>
		<canvas id="qr-canvas"></canvas>
		<br>
		<?php
	}
?>
	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>
	<script src="../scripts/jsqr.js?random=<?= uniqid() ?>"></script>

  </body>
</html>
