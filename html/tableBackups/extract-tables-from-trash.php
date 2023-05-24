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
	
	#Importing json file
	$unparsed=file_get_contents("sourcetables.json");
	
	#Parsing json file
	$parsed=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $unparsed), true );

	#$testSplit=((array_values(array_values($parsed["content"][0])[0]["data"])));
	#$testTable=array_values(array_values($testSplit)[0])[0];
	#$testobj=(array_values(array_values(array_values((array_values(array_values($parsed["content"][0])[0]["data"])[0]))[0])[0])[3]["value"]);


	$length=0;
	$gransvardenAssoc=array();
	foreach (($parsed["content"]) as $pdfSplitKey=>$pdfSplit){
		foreach (array_values($pdfSplit)[0]["data"]["Tables"] as $tableSplitKey=> $tableSplit){
			foreach ($tableSplit as $objKey=>$obj){
				if (substr_count(array_values($obj)[1]["value"],"-")>=2){
					foreach(explode(" ",array_values($obj)[1]["value"]) as $cas){
						#No work :(
						$cas=str_replace("*","",$cas);
						$gransvardenAssoc[$cas]=array();
						$gransvardenAssoc[$cas]["gvar"]=(array_values($obj)["2"]["value"]);
						$gransvardenAssoc[$cas]["ngvppm"]=(str_replace("−","",(array_values($obj)["3"]["value"])));
						$gransvardenAssoc[$cas]["ngvmgm3"]=(str_replace("−","",(array_values($obj)[4]["value"])));
						$gransvardenAssoc[$cas]["kgvppm"]=(str_replace("−","",(array_values($obj)[5]["value"])));
						$gransvardenAssoc[$cas]["kgvmgm3"]=str_replace(array("−",""),array(",","."),(array_values($obj)[6]["value"]));
						if(array_values($obj)[7]["value"]!="" && array_values($obj)[8]["value"]!=""){
							$gransvardenAssoc[$cas]["rules"]=str_replace(",",", ",array_values($obj)[7]["value"]).", ".str_replace(",",", ",array_values($obj)[8]["value"]);
						} else{
							$gransvardenAssoc[$cas]["rules"]=(str_replace(",",", ",array_values($obj)[7]["value"]).str_replace(",",", ",array_values($obj)[8]["value"]));
						};
					};
					$length++;
					
				};
			};
			
		};
		
	};
	foreach($gransvardenAssoc as $objKey =>$obj){
		foreach($obj as $dataKey => $data){
			if ($dataKey!="rules"){
				$gransvardenAssoc[$objKey][$dataKey]=str_replace(",",".",$obj[$dataKey]);
				
				$valueList=explode(" ",$gransvardenAssoc[$objKey][$dataKey]);
			} else{
				$valueList=explode(", ",$gransvardenAssoc[$objKey][$dataKey]);
				
			};
		};
	};
    $gransvardenFile = file_get_contents("../scripts/tables.json");
    $gransvarden = json_decode($gransvardenFile, true);
	echo($length);
	echo"<table><tr>";
    echo"<th>cas</th>";
    echo"<th>gvar</th>";
    echo"<th>ngvppm</th>";
    echo"<th>ngvmgm3</th>";
    echo"<th>kgvppm</th>";
    echo"<th>kgvmgm3</th>";
    echo"<th>rules</th>";
    echo"</tr>";
	foreach($gransvardenAssoc as $objKey=>$obj){
		if ($obj["ngvppm"]!=$gransvarden[$objKey]["ngvppm"]){
			echo("<tr><th>".$objKey."</th>");
			foreach($obj as $dataKey => $data){
				echo("<td>".$data."</td>");
			};
			echo"</tr>";
		}

		
	};
	echo"</table>";
	#$export=var_export($gransvardenAssoc,true);
	#$newfile = fopen("trialtables.php", "w") or die("Unable to open file!");
	#fwrite($newfile,'$gransvardenAssoc= '. var_export($gransvardenAssoc,true));
	#fclose($newfile);
    ?>


	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="module" src="../scripts/const.js?random=<?= uniqid() ?>"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>
</body>
</html>
