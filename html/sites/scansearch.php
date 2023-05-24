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
    <!--------------------------------->



      <!-- Div for scanner box -->
      <h1>Scan QR-Code!</h1>
      <button onclick=window.location='../index.php'>Main Menu</button>
	  <br>
      <canvas id="qr-canvas"></canvas>
      <br>



	<!-- Importing scripts -->
 	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="module" src="../scripts/const.js?random=<?= uniqid() ?>"></script>
	<script type="module" src="../scripts/func.js?random=<?= uniqid() ?>"></script>
	<script src="../scripts/jsqr.js?random=<?= uniqid() ?>"></script>

  </body>
</html>
