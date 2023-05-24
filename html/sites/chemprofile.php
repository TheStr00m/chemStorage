<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chemical Profile</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <?php
		#Importing constants
        require_once "const.php";

        #Trying to establish connection to database
        $mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
        if ($mysqli->connect_errno){
            die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
        }
        $mysqli->set_charset('utf8');


		#Update data of chemical if edit submited
		if (!empty($_GET["update"])){
			
			#Update both home location and current location if home field edited
			if ($_GET["update"]=="home"){
				$sql="update chemicals set location='".$_GET["value"]."', ".$_GET["update"]."='".$_GET["value"]."' where id=".$_GET["id"];

			
			#Implode rule statements to string if rule field edited
			} else if ($_GET["update"]=="rules"){
				$_GET["value"]=array_unique($_GET["value"]);
				$sql="update chemicals set ".$_GET["update"]."='".implode(", ",$_GET["value"])."' where id=".$_GET["id"];

			#Special query for Hazard statements
			} else if ($_GET["update"]=="haz_stat"){
				$values="";
				foreach ($_GET["value"] as $hazCode){
					$values.=$hazCode[0].">".$hazCode[1].">".$hazCode[2]."<";
				}
				$values=rtrim($values);
				$sql="update chemicals set ".$_GET["update"]."='".$values."' where id=".$_GET["id"];
				echo($sql);
				echo($values);

			#Normal text field edit
			} else {
				$sql="update chemicals set ".$_GET["update"]."='".$_GET["value"]."' where id=".$_GET["id"];
			}

			#Try to update edited record in database
			if ($mysqli->query($sql)==TRUE){
				#Updated successfully
				$last_id = $mysqli->insert_id;
				header('location: chemprofile.php?id='.$_GET['id'].'&edit='.$_GET["update"]);
			} else {
				#Update failed
				echo "<p class='red'>Error updating record: " . $mysqli->error."</p>";
			}
		}

		#If edit button pressed output edit form
		if (!empty($_GET["edit"])){


				#Fetch data of chemical
				$res=$mysqli->query('select * from chemicals where id='.$_GET['id']);
                $row = $res->fetch_assoc();


				#Form for editing specific field of chemical
				?>
		        <form action="chemprofile.php?id=<?=$_GET['id']?>&edit=<?=$_GET['edit']?>" method='get'>
		            <table class="minitable">
		            	<tr>
							<th>Update <?=$prettyFields[$_GET["edit"]]?></th>
						</tr>
			    		<tr>
		            		<td class="added">
							<?php
							

							#Special input for editing Hazard Statements
							if ($_GET["edit"]=="haz_stat"){
								$hazCodes=explode("<",$row[$_GET["edit"]]);
								#Loop out currently assigned Hazard Statement Codes/Rules
								foreach ($hazCodes as $hazKey => $haz){
									if ($haz!=""){
										$split=explode(">",$haz);
										$hazCode=$split[0];
										$hazClass=$split[1];
										$hazCat=$split[2];
										?>
			               				<div>
											<input class='inactive' readonly type='text' name='value[<?=$hazCode?>][0]' value='<?=$hazCode?>'>
											<button class="smallbutton editrem" type="button">&#65293;</button>
											<?php

											if (in_array($hazCode,array_keys($classAssoc))){
												?>
												<input class='inactive'  type="text" name="value[<?=$hazCode?>][1]" readonly value="<?=$classAssoc[$hazCode][0]?>">
												<input class='inactive'  type="text" name="value[<?=$hazCode?>][2]" readonly value="<?=$classAssoc[$hazCode][1]?>">
												<?php
											} else{
												echo"<select name='value[$hazCode][1]'>";
												$added=array();
												#Looping through different hazclass options
												foreach ($obscuredHazCodes[$hazCode] as $short => $hazClassCat){
													if (!in_array($hazClassCat[0],$added)){
														if ($hazClassCat[0]==$hazClass){
															echo"<option selected name='value[$hazCode][1]' value='$hazClassCat[0]'>$hazClassCat[0]</option>";
														} else{
															echo"<option name='value[$hazCode][1]' value='$hazClassCat[0]'>$hazClassCat[0]</option>";
														}
														array_push($added,$hazClassCat[0]);
													}
												}
												echo"</select>";
												echo"<select name='value[$hazCode][2]'>";
												$added=array();
												#Looping through different hazcat options
												foreach ($obscuredHazCodes[$hazCode] as $short => $hazClassCat){
													if (!in_array($hazClassCat[1],$added)){
														if ($hazClassCat[1]==$hazCat){
															echo"<option selected name='value[$hazCode][2]' value='$hazClassCat[1]'>$hazClassCat[1]</option>";
														} else{
															echo"<option name='value[$hazCode][2]' value='$hazClassCat[1]'>$hazClassCat[1]</option>";
														}
														array_push($added,$hazClassCat[1]);
													}
												}
												echo"</select>";
											}
											?>
										</div>
										<?php
									}
								}
								?>
								</tr>
								<tr>
									<td>
										<!-- Add new HazStat -->
										<input type="text" id='<?= $_GET["edit"] ?>'>
										<button class="smallbutton" id="editadd" type="button">&#65291;</button>
									</td>
								</tr>
								<?php

							#Special input for editing Rules
							} else if ($_GET["edit"]=="rules"){
								$split=explode(", ",$row[$_GET["edit"]]);
								#Loop out currently assigned Hazard Statement Codes/Rules
								foreach ($split as $haz){
									if ($haz!=""){
										?>
			               				<div>
											<input class="inactive" readonly type="text" name="value[]" value="<?=$haz?>">
											<button class="smallbutton editrem" type="button">&#65293;</button>
										</div>
										<?php
									}
								}
								?>
								</tr>
								<tr>
									<td>
										<!-- Add new Rule -->
										<input type="text" id='<?= $_GET["edit"] ?>'>
										<button class="smallbutton" id="editadd" type="button">&#65291;</button>
									</td>
								</tr>
								<?php

							#Special input for editing Home Location (Dropdown menu)
							} else if ($_GET["edit"]=="home" || $_GET["edit"]=="location"){
								
								#Looping out Select-form for home-locations
								echo'<select name="value">';
								foreach ($registrationSelectArray[strtolower($_GET["edit"])] as $groupname => $group){
									echo'<optgroup label='.$groupname.'>';
									foreach ($group as $option){
										if ($option==$_GET["placeholder"]){
											echo'<option selected value="'.$option.'">'.ucfirst($option).'</option>';
										} else{
											echo'<option value="'.$option.'">'.ucfirst($option).'</option>';
										}
									}
									echo'</optgroup>';
								}
								  echo'</select>';


							#Input for editing normal text-fields
							} else {
		                		echo'<input id="editbox" type="text" name="value" value="'.$row[$_GET["edit"]].'">';
							}
							?>


						</td>
					</tr>
		        </table>
		        <br>




		        <!--Keep ID and Field in GET -->
		        <input type="hidden" name="id" id="id" value="<?=$_GET["id"]?>">
		        <input type="hidden" name="update" value="<?=$_GET["edit"]?>">
		        <input class="submit" type="submit" value="Submit">

		        </form>
		        <br>
		        <button onclick=window.location='chemprofile.php?id=<?=$_GET["id"]?>'>Back to chemical</button>
		        <button onclick=window.location='../index.php'>Main Menu</button>
				<?php


			#2-Step delete sequence
            } else if (!empty($_POST["delete"])){

				#Step 1
                if ($_POST["delete"]==1){
					?>
                    <p>Are you sure you want to delete this chemical from the database?</p>
					<form action='chemprofile.php?id=<?=$_GET["id"]?>' method='post'>
                    <button name='delete' value=2>YES</button>
                    <button type='button' onclick=window.location='chemprofile.php?id=<?=$_GET["id"]?>'>Back</button>
					</form>
					<?php

				#Step 2, removing from database
                } else if ($_POST["delete"]==2){
                    $sql=('delete from chemicals where id='.$_GET["id"]);
                    if ($mysqli->query($sql)==FALSE){
                        echo "<p class='red'>Error updating record: " . $mysqli->error."</p>";
                    } else {
						?>
                        <p class='green'>Chemical removed from database successfully!</p>
                        <button onclick=window.location='../index.php'>Back to Home</button>
						<?php
                    }
                }


			#No Camera ERROR
            } else if ($_GET["id"]=="Requested device not found"){
                echo"<p class='red'>ERROR, NO CAMERA FOUND</p>";
                echo"<br>";
                echo"<button onclick=window.location='../index.php'>Main Menu</button>";

			#No remove or edit action, show  Chemical Profile of ID
            } else{
				#Requests * of id and checks if exists
				$sql='select * from chemicals where id='.$_GET['id'];
	            $res=$mysqli->query($sql);
	            $row = $res->fetch_assoc();
				if (mysqli_num_rows($res)==0){
                	echo"<p class='red'>ID Not registered, accidental deletion?</p>";
		            echo"<br>";
		            echo"<button onclick=window.location='../index.php'>Main Menu</button>";




				#Echos Detailed description of chemical in table
				} else{
					?>
	            	<form action='chemprofile.php?id=<?=$_GET["id"]?>' method="post">

						<div class="profile">
						<div class="canbox">
							<canvas id="chemStructure"></canvas>
						</div>
							<table id="basicInfo">
								<tr>
									<th>ID</th>
									<td><?=$row["id"]?></td>
								</tr>
								<tr id="name" class="editRow">
									<th>Name</th>
									<td><?=$row["name"]?></td>
								</tr>
								<tr id="cas" class="editRow">
									<th>CAS</th>
									<td><?=$row["cas"]?></td>
								</tr>
								<tr id="size" class="editRow">
									<th>Size</th>
									<td><?=$row["size"]?></td>
								</tr>
								<tr id="supplier" class="editRow">
									<th>Supplier</th>
									<td><?=$row["supplier"]?></td>
								</tr>
								<tr id="home" class="editRow">
									<th>Home Location</th>
									<td><?=$row["home"]?></td>
								</tr>
								<tr id="location">
									<th>Current Location</th>
									<td><?=ucfirst($row["location"])?></td>
								</tr>
							</table>
						</div>
					<button name='delete' value=1>Delete Chemical</button>
					<button type='button' onclick=window.location='querysearch.php?key=cas&value=<?=$row["cas"]?>'>Chemicals with same CAS</button>
				    <button type='button' onclick=window.location='../index.php'>Main Menu</button>
					<button type='button' onclick=window.location='register.php?id=<?=$row["id"]?>'>Copy Chemical</button>


					<h2 class="safetyHeader">↓Safety info:↓</h2>
					<table id="safetyInfo">
						<?php

						#Looping out Translations for hazard statements
				        echo ('<tr id="haz_stat" class="editRow"><td colspan=2>');
						$haz_statArray = explode("<",$row["haz_stat"]);
						if (strlen($haz_statArray[0])>0){
							echo"<table>";
							echo"<tr><th>Hazard Statement</th>";
							echo"<th>Hazard Translation</th>";
							echo"<th>Hazard Classification</th>";
							echo"<th>Hazard Category</th></tr>";
							foreach($haz_statArray as $stat){
								$statplode=explode(">",$stat);
								echo"<tr>";
								echo"<td>$statplode[0]</td>";
								$code=$statplode[0];
								echo"<td>$ghsTranslate[$code]</td>";
								echo"<td>$statplode[1]</td>";
								echo"<td>$statplode[2]</td>";
								echo"</tr>";
							}
							echo"</table></td></tr>";
						}
						?>
						<tr id="rules" class="editRow">
				        	<td colspan=2>
								<table>
									<?php
									#Looping out Translations for rules
									$rulesArray = explode(", ",$row["rules"]);
									if (strlen($rulesArray[0])>0){
										echo"<tr><th>Rule</th><th colspan='3'>Translation</th></tr>";
										foreach($rulesArray as $rule){
											echo("<tr>");
											echo("<td>".$rule."</td>");
											echo("<td colspan='3'>".$notes[$rule]."</td>");
											echo("</tr>");
										}
									}
									?>
								</table>
							</td>
						</tr>
				        <tr id="ngvppm" class="editRow">
							<th>Nivågränsvärde (PPM)</th>
							<td><?=$row["ngvppm"]?></td>
						</tr>
				        <tr id="ngvmgm3" class="editRow">
							<th>Nivågränsvärde (mg/m^3)</th>
							<td><?=$row["ngvmgm3"]?></td>
						</tr>
				        <tr id="kgvppm" class="editRow">
							<th>Korttidsgränsvärde (PPM)</th>
							<td><?=$row["kgvppm"]?></td>
						</tr>
				        <tr id="kgvmgm3" class="editRow">
							<th>Korttidsgränsvärde (mg/m^3)</th>
							<td><?=$row["kgvmgm3"]?></td>
						</tr>
				        <tr id="gvar" class="editRow">
							<th>År vid etablerade gränsvärden</th>
							<td><?=$row["gvar"]?></td>
						</tr>
		            </table>
		            </form>
					<?php
            	}
	}


	#Closing database connection
	mysqli_close($mysqli);
	?>


	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>
	<script type="module">
		import {drawChemical} from "../scripts/func.js";
		<?php
		$cas=("'".$row["cas"]."'");
		if (count($_GET)==1){
			echo'drawChemical('.$cas.',"chemStructure")';
		}
		?>
	</script>
</body>
</html>
