<!doctype html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Database to PDF</title>
    <link rel="stylesheet" href="../css/main.css">
  </head>
  <body>
    <?php
    	include "const.php";

		if (isset($_POST["export"])){
			require_once('../scripts/tcpdf/tcpdf.php');
			ob_end_clean();
			// create new PDF document
			$pdf = new TCPDF("P", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Nicola Asuni');
			$pdf->SetTitle('TCPDF Example 001');
			$pdf->SetSubject('TCPDF Tutorial');



			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


			// ---------------------------------------------------------

			// set default font subsetting mode
			$pdf->setFontSubsetting(true);

			// Set font
			// dejavusans is a UTF-8 Unicode font, if you only need to
			// print standard ASCII chars, you can use core fonts like
			// helvetica or times to reduce file size.
			$pdf->SetFont('dejavusans', '', 8, '', true);

			// Add a page
			// This method has several options, check the source code documentation for more information.
			$pdf->AddPage("L");

			// set text shadow effect
			$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

			// Set some content to print
			$html = $_POST["export"];

			// Print text using writeHTMLCell()
			$pdf->writeHTML($html,true,false,true,true,"C");

			// ---------------------------------------------------------

			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output('export.pdf', 'D');

			//============================================================+
			// END OF FILE
			//============================================================+

		} else if ($_GET["preview"]=="yes"){

			#Trying to establish connection to database
			$mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
			if ($mysqli->connect_errno){
			    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
			}
			$mysqli->set_charset('utf8');



			#Creating query and fetching data
			$sql=("select * from chemicals ");
			
			if ($_GET["value"] != ""){
		    $sql.=("where ".$_GET['key']." like '%".$_GET['value']."%' ");
			}
			$sql.=("order by ".$_GET['sort']." ".$_GET["order"]." ");
			if ($_GET["amt"]>0){
			$sql.=("limit ".$_GET['amt'].";");
			}
			$res=$mysqli->query($sql) or die($mysqli->error);

			
			#Generic buttons
			?>
			<button onclick=window.location='export.php'>Back</button>
			<button onclick=window.location='../index.php'>Main Menu</button>
			<?php

			#Controlling that query is not empty
			if ($res->num_rows==0){
			    echo'<p class="red">Query returned no results</p>';


			#Query not empty, displaying table with results from search
			} else {
				?>
				<?php ob_start(); ?>
				<table border="1" cellpadding="2" cellspacing="2">
				<tr>
				<th width="50" style="font-weight:bold;">ID</th>
				<th width="100" style="font-weight:bold;">CAS</th>
				<th width="100" style="font-weight:bold;">Name</th>
				<th width="50" style="font-weight:bold;">Size</th>
				<th width="100" style="font-weight:bold;">Supplier</th>
				<th width="100" style="font-weight:bold;">Home Location</th>
				<th width="100" style="font-weight:bold;">Current Location</th>
				<!-- <th style="font-weight:bold;">Hazard Statements</th> -->
				<th width="80" style="font-weight:bold;">Hazard Statements</th>
				<th width="300" style="font-weight:bold;">Hazard Classes and Categories</th>
				
				</tr>
				<?php
				while ($row = $res->fetch_assoc()){
					?>
					<tr id="<?=$row["id"]?>" class="clickableRow">
					<td width="50"><?=$row["id"]?></td>
					<td width="100"><?=$row["cas"]?></td>
					<td width="100"><?=$row["name"]?></td>
					<td width="50"><?=$row["size"]?></td>
					<td width="100"><?=$row["supplier"]?></td>
					<td width="100"><?=$row["home"]?></td>
					<td width="100"><?=ucfirst($row["location"])?></td>

					<?php

					#Looping out hazard statements in ul
					$haz_statArray = explode(", ",$row["haz_stat"]);
					echo"<td width='80'>";
					if (strlen($haz_statArray[0])>0){
						foreach($haz_statArray as $stat){
							echo($stat."<br>");
						}
					}
					echo"</td>";

					#Looping out Translations for hazard statements
					#$haz_statArray = explode(", ",$row["haz_stat"]);
					#echo"<td>";
					#if (strlen($haz_statArray[0])>0){
					#	foreach($haz_statArray as $stat){
					#		echo($ghsTranslate[$stat]);
					#		echo("<br>");
					#	}
					#}
					#echo"</td>";

					
					#Looping out Translations for hazard statements in ul
					echo"<td width='300'><ul>";
					if (strlen($haz_statArray[0])>0){
						foreach($haz_statArray as $stat){
							echo("<li>");
							echo($classAssoc[$stat][0]." (".$classAssoc[$stat][1].")");
							echo("</li>");
						}
					}
					echo"</ul></td>";
					?>
					
					</tr>
					<?php
				}
				?>
				</table>
				<?php $export = str_replace("'",'"',ob_get_clean());
				
				
				echo"<form action='export.php' method='post'>";
				echo"<input type='hidden' name='export' value='".$export."'>";
				echo"<input class='search' type='submit' value='Export'>";
				echo"</form>";
				echo("<h1>PREVIEW</h1>".$export);
				
				
				
			}


			#Closing database connection
			mysqli_close($mysqli);
			
		#Search form
		} else {
			?>
		    <h1>Export settings:</h1>
		    <form action="export.php" method="get">
			<table class="exportTable">
				<tr>
					<th>
						<h2>Amount of entries to export:</h2>
					</th>
					<th>
						<h2>Filter settings (optional)</h2>
					</th>
				</tr>
				<tr>
					<td>
						<h3>Leave blank to export all</h3>
						<input type="number" id="amt" name="amt">
						<input type="hidden" name="preview" value="yes">
					</td>
					<td>
						<h3>Filter by:</h3>
						<select name="key">
							<option value="name">Name</option>
							<option value="cas">CAS-Nr</option>
							<option value="location">Current Location</option>
							<option value="home">Home Location</option>
							<option value="haz_stat">Hazard Statement</option>
						</select>
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
					</td>
				</tr>
				<tr>
					<td colspan=2 >
						<h3>Sort by:</h3>
						<select name="sort">
							<option value="id">ID</option>
							<option value="name">Name</option>
							<option value="cas">CAS-Nr</option>
							<option value="location">Current Location</option>
							<option value="home">Home Location</option>
						</select>
						<select name="order">
							<option value="asc">Ascending</option>
							<option selected value="desc">Descending</option>
						</select>
					</td>
				</tr>
			</table><br>
			<input class="search" type="submit" value="Export">
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
