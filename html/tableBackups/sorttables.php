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

	
	$gransvardenFile = file_get_contents("newesttables.json");
	$gransvarden = json_decode($gransvardenFile, true);

	foreach($gransvarden as $objKey =>$obj){
		foreach($obj as $dataKey => $data){
			if ($dataKey!="rules"){
				$gransvarden[$objKey][$dataKey]=str_replace(",",".",$obj[$dataKey]);
				
				$valueList=explode(" ",$gransvarden[$objKey][$dataKey]);
				if (count($valueList)>1){
					$gransvarden[$objKey][$dataKey]=min(explode(" ",$gransvarden[$objKey][$dataKey]));
					if($gransvarden[$objKey]["rules"]!="" and !strpos($gransvarden[$objKey]["rules"],"A")){
						$gransvarden[$objKey]["rules"].=", A";
					} else if ($gransvarden[$objKey]["rules"]==""){
						$gransvarden[$objKey]["rules"].="A";
					};
				};
			} else{
				$valueList=explode(", ",$gransvarden[$objKey][$dataKey]);
				
			};
		};
	};
	echo"<table><tr><th></th>";
		foreach(array_values($gransvarden)[0] as $keys=>$ex){
			echo("<th>".$keys."</th>");
		};
		echo"</tr>";
		foreach($gransvarden as $objKey=>$obj){
			echo("<tr><th>".$objKey."</th>");
				foreach($obj as $dataKey => $data){
					echo("<td>".$data."</td>");
				};

			echo"</tr>";

			
		};
	echo"</table>";

	#Writing to JSON
	#$export=var_export($gransvarden,true);
	#$newfile = fopen("/var/www/html/newesttables.json", "w") or die("Unable to open file!");
	#fwrite($newfile,json_encode($gransvarden));
	#fclose($newfile);
	
    ?>


	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="module" src="../scripts/const.js?random=<?= uniqid() ?>"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>
</body>
</html>
