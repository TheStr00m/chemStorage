<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html, charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=0">
    <title>TEST</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<?php
ini_set('display_errors', 1);
#Importing constants
include "const.php";
require_once "func.php";
require_once "temp.php";



#Trying to establish connection to database
$mysqli=new mysqli($serverName,$serverUID,$serverPASS,$serverDB);
if ($mysqli->connect_errno){
    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
$mysqli->set_charset('utf8');

if (isset($_GET["submit"]) && $_GET["submit"]=="yes"){
    $sql="update chemicals set haz_time='".time()."', haz_stat='".$_GET["haz"]."' where cas='".$_GET["cas"]."'";

    if ($mysqli->query($sql)==FALSE){
        echo("<p>ERROR Could not submit</p>");
        echo($mysqli->error);
        exit;
    }
}

#Finding next chemical for update
if (isset($_GET["prev"])){
    $id=intval($_GET["prev"]);
    while (empty($next)){
        $id++;
        $sql="select id,cas,haz_stat from chemicals where id=$id";
		$res=$mysqli->query($sql) or die($mysqli->error);
		$next=$res->fetch_assoc();
    }
} else{
    $id=0;
    while (!isset($next)){
        $id++;
        $sql="select id,cas,haz_stat from chemicals where id=$id";
		$res=$mysqli->query($sql) or die($mysqli->error);
		$next=$res->fetch_assoc();
    }
}
$hazData=(getHazCodes($next["cas"]));
var_dump($hazData);
$haz_urls=implode(", ",$hazData["urls"]);
$haz_stat="";
unset($hazData["urls"]);
foreach ($hazData as $hazStat=>$hazClassCat){
    $haz_stat.=$hazStat.">".$hazClassCat."<";
}

$haz_stat=substr($haz_stat,0,-1);

if ($haz_stat==$next["haz_stat"]){
    header("location: test.php?prev=".$next["id"]);
} else{
    ?>
    <h1><?=$id?></h1>
    <?php
    $before = explode("<",$next["haz_stat"]);
        echo"<table class='minitable'>";
        echo"<tr><th>Hazard Statement</th>";
        echo"<th>Hazard Classification</th>";
        echo"<th>Hazard Category</th></tr>";
        foreach($before as $stat){
            $statplode=explode(">",$stat);
            if (!isset($statplode[2])){
                $statplode[2]="";
                if (!isset($statplode[1])){
                    $statplode[1]="";
                }
            }
            echo"<tr>";
            echo"<td>$statplode[0]</td>";
            echo"<td>$statplode[1]</td>";
            echo"<td>$statplode[2]</td>";
            echo"</tr>";
        }
        echo"</table></td></tr>";
    $after = explode("<",$haz_stat);
        echo"<table class='minitable'>";
        echo"<tr><th>Hazard Statement</th>";
        echo"<th>Hazard Classification</th>";
        echo"<th>Hazard Category</th></tr>";
        foreach($after as $stat){
            $statplode=explode(">",$stat);
            if (!isset($statplode[2])){
                $statplode[2]="";
                if (!isset($statplode[1])){
                    $statplode[1]="";
                }
            }
            echo"<tr>";
            echo"<td>$statplode[0]</td>";
            echo"<td>$statplode[1]</td>";
            echo"<td>$statplode[2]</td>";
            echo"</tr>";
        }
        echo"</table></td></tr>";
    ?>
    <p>Submit change?<p>
    <button onclick='window.location="test.php?prev=<?=$next["id"]?>&cas=<?=$next["cas"]?>&haz=<?=$haz_stat?>&submit=yes"'>SUBMIT</button>
    <button onclick='window.location="test.php?prev=<?=$next["id"]?>"'>SKIP</button>
    <?php
}

//if($next["id"]<20){
//    header("location: test.php?id=".$next["id"]);
//}
    
?>
</body>
</html>