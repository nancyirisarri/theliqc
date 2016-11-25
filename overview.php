<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Overview Theli Quality Control</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="styles.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="jquery.zoom.js"></script>

  <script>
  $(function() {
  $( "#tabs" ).tabs();
  });
  </script>

</head>

<body>
  
<div id="pointings">
  <?php
    require("query_input.php");
  ?>
</div>

<?php
  include("tabs.html");
?>

</body>

<script src="clickHandlerAll.js"></script>

</html>
