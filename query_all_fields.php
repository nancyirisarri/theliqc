<?php

  echo "<h3>Showing all fields.<br><br>Select a pointing:</h3>";

  require("database_access.php");

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT DISTINCT ob FROM kids_theliqc ORDER BY ra, de ASC";

  $result = $conn->query($sql);

  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $sql2 = "SELECT ob, ra, de, i_e1_1, i_e1_2, i_e1_3, i_e1_4,
      i_e1_5, i_e1_SDEV_1, i_e1_SDEV_2, i_e1_SDEV_3, i_e1_SDEV_4,
      i_e1_SDEV_5, i_e2_1, i_e2_2, i_e2_3, i_e2_4, i_e2_5, i_e2_SDEV_1,
      i_e2_SDEV_2, i_e2_SDEV_3, i_e2_SDEV_4, i_e2_SDEV_5, r_e1_1, r_e1_2, r_e1_3,
      r_e1_4, r_e1_5, r_e1_SDEV_1, r_e1_SDEV_2, r_e1_SDEV_3, r_e1_SDEV_4,
      r_e1_SDEV_5, r_e2_1, r_e2_2, r_e2_3, r_e2_4, r_e2_5, r_e2_SDEV_1,
      r_e2_SDEV_2, r_e2_SDEV_3, r_e2_SDEV_4, r_e2_SDEV_5 FROM kids_theliqc 
      WHERE ob='{$row[ob]}' ORDER BY ra, de ASC";
      
      $result2 = $conn->query($sql2);
      
      $row2 = $result2->fetch_assoc();
      $ob = str_replace("KIDS_", "", $row[ob]);
      echo "<button style='font-weight: bold; font-size: small' id='butt-{$row[ob]}' onclick='clickPointing(" . '"' . $row[ob] . '"' . ")'>{$ob}</button>\n";
      
      // Make hidden divs to hold psf stats.
      echo "<div id='r_e1_1-{$row2[ob]}' style='display:none;'>{$row2[r_e1_1]}</div>";
      echo "<div id='r_e1_2-{$row2[ob]}' style='display:none;'>{$row2[r_e1_2]}</div>";
      echo "<div id='r_e1_3-{$row2[ob]}' style='display:none;'>{$row2[r_e1_3]}</div>";
      echo "<div id='r_e1_4-{$row2[ob]}' style='display:none;'>{$row2[r_e1_4]}</div>";
      echo "<div id='r_e1_5-{$row2[ob]}' style='display:none;'>{$row2[r_e1_5]}</div>";
      echo "<div id='r_e1_SDEV_1-{$row2[ob]}' style='display:none;'>{$row2[r_e1_SDEV_1]}</div>";
      echo "<div id='r_e1_SDEV_2-{$row2[ob]}' style='display:none;'>{$row2[r_e1_SDEV_2]}</div>";
      echo "<div id='r_e1_SDEV_3-{$row2[ob]}' style='display:none;'>{$row2[r_e1_SDEV_3]}</div>";
      echo "<div id='r_e1_SDEV_4-{$row2[ob]}' style='display:none;'>{$row2[r_e1_SDEV_4]}</div>";
      echo "<div id='r_e1_SDEV_5-{$row2[ob]}' style='display:none;'>{$row2[r_e1_SDEV_5]}</div>";
      echo "<div id='r_e2_1-{$row2[ob]}' style='display:none;'>{$row2[r_e2_1]}</div>";
      echo "<div id='r_e2_2-{$row2[ob]}' style='display:none;'>{$row2[r_e2_2]}</div>";
      echo "<div id='r_e2_3-{$row2[ob]}' style='display:none;'>{$row2[r_e2_3]}</div>";
      echo "<div id='r_e2_4-{$row2[ob]}' style='display:none;'>{$row2[r_e2_4]}</div>";
      echo "<div id='r_e2_5-{$row2[ob]}' style='display:none;'>{$row2[r_e2_5]}</div>";
      echo "<div id='r_e2_SDEV_1-{$row2[ob]}' style='display:none;'>{$row2[r_e2_SDEV_1]}</div>";
      echo "<div id='r_e2_SDEV_2-{$row2[ob]}' style='display:none;'>{$row2[r_e2_SDEV_2]}</div>";
      echo "<div id='r_e2_SDEV_3-{$row2[ob]}' style='display:none;'>{$row2[r_e2_SDEV_3]}</div>";
      echo "<div id='r_e2_SDEV_4-{$row2[ob]}' style='display:none;'>{$row2[r_e2_SDEV_4]}</div>";
      echo "<div id='r_e2_SDEV_5-{$row2[ob]}' style='display:none;'>{$row2[r_e2_SDEV_5]}</div>";

      echo "<div id='i_e1_1-{$row2[ob]}' style='display:none;'>{$row2[i_e1_1]}</div>";
      echo "<div id='i_e1_2-{$row2[ob]}' style='display:none;'>{$row2[i_e1_2]}</div>";
      echo "<div id='i_e1_3-{$row2[ob]}' style='display:none;'>{$row2[i_e1_3]}</div>";
      echo "<div id='i_e1_4-{$row2[ob]}' style='display:none;'>{$row2[i_e1_4]}</div>";
      echo "<div id='i_e1_5-{$row2[ob]}' style='display:none;'>{$row2[i_e1_5]}</div>";
      echo "<div id='i_e1_SDEV_1-{$row2[ob]}' style='display:none;'>{$row2[i_e1_SDEV_1]}</div>";
      echo "<div id='i_e1_SDEV_2-{$row2[ob]}' style='display:none;'>{$row2[i_e1_SDEV_2]}</div>";
      echo "<div id='i_e1_SDEV_3-{$row2[ob]}' style='display:none;'>{$row2[i_e1_SDEV_3]}</div>";
      echo "<div id='i_e1_SDEV_4-{$row2[ob]}' style='display:none;'>{$row2[i_e1_SDEV_4]}</div>";
      echo "<div id='i_e1_SDEV_5-{$row2[ob]}' style='display:none;'>{$row2[i_e1_SDEV_5]}</div>";
      echo "<div id='i_e2_1-{$row2[ob]}' style='display:none;'>{$row2[i_e2_1]}</div>";
      echo "<div id='i_e2_2-{$row2[ob]}' style='display:none;'>{$row2[i_e2_2]}</div>";
      echo "<div id='i_e2_3-{$row2[ob]}' style='display:none;'>{$row2[i_e2_3]}</div>";
      echo "<div id='i_e2_4-{$row2[ob]}' style='display:none;'>{$row2[i_e2_4]}</div>";
      echo "<div id='i_e2_5-{$row2[ob]}' style='display:none;'>{$row2[i_e2_5]}</div>";
      echo "<div id='i_e2_SDEV_1-{$row2[ob]}' style='display:none;'>{$row2[i_e2_SDEV_1]}</div>";
      echo "<div id='i_e2_SDEV_2-{$row2[ob]}' style='display:none;'>{$row2[i_e2_SDEV_2]}</div>";
      echo "<div id='i_e2_SDEV_3-{$row2[ob]}' style='display:none;'>{$row2[i_e2_SDEV_3]}</div>";
      echo "<div id='i_e2_SDEV_4-{$row2[ob]}' style='display:none;'>{$row2[i_e2_SDEV_4]}</div>";
      echo "<div id='i_e2_SDEV_5-{$row2[ob]}' style='display:none;'>{$row2[i_e2_SDEV_5]}</div>";

      $filename_r = "images/{$row[ob]}/r_SDSS";
      $filename_i = "images/{$row[ob]}/i_SDSS";

      if (file_exists($filename_r) && file_exists($filename_i)) {
        echo "<div id='r-exists-{$row[ob]}' style='display:none;'></div>";
        echo "<div id='i-exists-{$row[ob]}' style='display:none;'></div>";
        echo "<div id='div-hidden-instructions-tb-{$row[ob]}' style='display:none;'>Top: r-band. Bottom: i-band.&nbsp;</div>";
        echo "<div id='div-hidden-instructions-lr-{$row[ob]}' style='display:none;'>Left: r-band. Right: i-band.&nbsp;</div>";
      } else if (file_exists($filename_r)) {
        echo "<div id='r-exists-{$row[ob]}' style='display:none;'>_r</div>";
        echo "<div id='i-exists-{$row[ob]}' style='display:none;'></div>";
        echo "<div id='div-hidden-instructions-tb-{$row[ob]}' style='display:none;'></div>";
        echo "<div id='div-hidden-instructions-lr-{$row[ob]}' style='display:none;'></div>";
      } else if (file_exists($filename_i)) {
        echo "<div id='r-exists-{$row[ob]}' style='display:none;'></div>";
        echo "<div id='i-exists-{$row[ob]}' style='display:none;'>_i</div>";
        echo "<div id='div-hidden-instructions-tb-{$row[ob]}' style='display:none;'></div>";
        echo "<div id='div-hidden-instructions-lr-{$row[ob]}' style='display:none;'></div>";
      }
    }
  } else {
    echo "0 pointings";
  }

  mysql_free_result($result);

  $conn->close();

?>
