
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <style>*{margin: 0;}</style>
</head>
<body>

	<!-- Main Menu Div -->
    <div class="menu">
        <div id='updatelocation'><h1 class="menutext">Update Chemical Location</h1></div>
        <div id='scansearch'><h1 class="menutext">Look up chemical by Scan</h1></div>
        <div id='querysearch'><h1 class="menutext">Look up chemical by Search</h1></div>
        <div id='register'><h1 class="menutext">Register New Chemical</h1></div>
        <div id='missinglist'><h1 class="menutext">Missing Chemicals</h1></div>
        <div id='locations'><h1 class="menutext">Manage Locations</h1></div>
        <div id='export'><h1 class="menutext">Export Database</h1></div>
    </div>
	<!-- Main Menu Div -->

	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="module" src="./scripts/const.js?random=<?= uniqid() ?>"></script>
	<script type="module" src="./scripts/func.js?random=<?= uniqid() ?>"></script>
</body>
</html>
