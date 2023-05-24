<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<?php
    include "const.php";


    #Importing gränsvärden
    $gransvardenFile = file_get_contents("../scripts/tables.json");
    $gransvarden = json_decode($gransvardenFile, true);

    

    #Trying to establish connection to database
    $mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
    if ($mysqli->connect_errno){
        die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    }
    #$mysqli->set_charset('utf8');
    #$sql="select id,cas,ngvppm,ngvmgm3,kgvppm,kgvmgm3,gvar,rules from chemicals where cas in ('".implode("', '",array_keys($gransvarden))."')";
    #$res=$mysqli->query($sql) or die("sql error");
    echo"<table>";
    echo"<tr>";
    echo"<th>cas</th>";
    echo"<th>gvar</th>";
    echo"<th>ngvppm</th>";
    echo"<th>ngvmgm3</th>";
    echo"<th>kgvppm</th>";
    echo"<th>kgvmgm3</th>";
    echo"<th>rules</th>";
    echo"</tr>";
    foreach($gransvarden as $gransvardeKey=>$gransvarde){
        $print=false;
        echo"<tr>";
        echo"<td>".$gransvardeKey."</td>";
        foreach($gransvarde as $dataKey=>$data){
            echo"<td>".$data."</td>";
            if (in_array($dataKey,$gransvardeTypes)){
                if ($data!=""){
                    if ((is_numeric($data))==false){
                        $print=true;
                        #echo($data." is not numeric");
                    }
                }
            }
        }
        if ($print){
            #echo"<p>";
            #echo($gransvardeKey);
            #print_r($gransvarde);
            #echo"</p>";
        }
        echo"</tr>";
    }
    echo"</table>";
    #Closing database connection
    mysqli_close($mysqli);
?>
<!-- Importing scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script type="module" src="../scripts/const.js?random=<?= uniqid() ?>"></script>
<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>

</body>
</html>