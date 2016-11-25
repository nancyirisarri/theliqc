  <?php
  if(!isset($_POST['query-issues']) && !isset($_POST['query-userinput'])) {
    echo "<h3>Welcome to the Theli QC at Leiden overview. <br><br><hr>
      Choose issues:</h3>
      <form action='overview.php' method='post'>
      <input type='checkbox' name='i_fringing' value='true'>i-band fringing<br>
      <input type='submit' value='Query by issues' name='query-issues'>
      </form><br>
      <hr>
      <h3>Build an SQL query<br><a href='pages_help/queries.html'>(how to)</a>:</h3>
      <form action='overview.php' method='post' id='form-query-userinput'>" .
      "<textarea form='form-query-userinput' name='text-userinput' id='query-userinput'
      placeholder='Enter an SQL query. Example: SELECT DISTINCT ob FROM kids_theliqc'
      rows='5' cols='35'></textarea>
      <input type='submit' value='Query by SQL' name='query-userinput'>
      </form>";
  }

  require("database_access.php");

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  //$GLOBALS['conn'] = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if(isset($_POST['query-userinput'])) {

    $sql0 = $_POST['text-userinput'];

    $result0 = $conn->query($sql0);

    $num_rows = $result0->num_rows;

    echo "<h3>{$num_rows} pointings found.<br><br>
    Select a pointing:</h3>";

    if($result0->num_rows > 0) {
      while($row0 = $result0->fetch_assoc()) {
        $ob = str_replace("KIDS_", "", $row0[ob]);

        $sql = "SELECT DISTINCT ob, i_e1_1, i_e1_2, i_e1_3, i_e1_4,
        i_e1_5, i_e1_SDEV_1, i_e1_SDEV_2, i_e1_SDEV_3, i_e1_SDEV_4,
        i_e1_SDEV_5, i_e2_1, i_e2_2, i_e2_3, i_e2_4, i_e2_5, i_e2_SDEV_1,
        i_e2_SDEV_2, i_e2_SDEV_3, i_e2_SDEV_4, i_e2_SDEV_5, r_e1_1, r_e1_2, r_e1_3,
        r_e1_4, r_e1_5, r_e1_SDEV_1, r_e1_SDEV_2, r_e1_SDEV_3, r_e1_SDEV_4,
        r_e1_SDEV_5, r_e2_1, r_e2_2, r_e2_3, r_e2_4, r_e2_5, r_e2_SDEV_1,
        r_e2_SDEV_2, r_e2_SDEV_3, r_e2_SDEV_4, r_e2_SDEV_5 FROM kids_theliqc
        WHERE ob='{$row0[ob]}'";

        $result = $conn->query($sql);

        $row = $result->fetch_assoc();

        // make hidden divs to hold psf stats
        echo "<div id='r_e1_1-{$row[ob]}' style='display:none;'>{$row[r_e1_1]}</div>";
        echo "<div id='r_e1_2-{$row[ob]}' style='display:none;'>{$row[r_e1_2]}</div>";
        echo "<div id='r_e1_3-{$row[ob]}' style='display:none;'>{$row[r_e1_3]}</div>";
        echo "<div id='r_e1_4-{$row[ob]}' style='display:none;'>{$row[r_e1_4]}</div>";
        echo "<div id='r_e1_5-{$row[ob]}' style='display:none;'>{$row[r_e1_5]}</div>";
        echo "<div id='r_e1_SDEV_1-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_1]}</div>";
        echo "<div id='r_e1_SDEV_2-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_2]}</div>";
        echo "<div id='r_e1_SDEV_3-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_3]}</div>";
        echo "<div id='r_e1_SDEV_4-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_4]}</div>";
        echo "<div id='r_e1_SDEV_5-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_5]}</div>";
        echo "<div id='r_e2_1-{$row[ob]}' style='display:none;'>{$row[r_e2_1]}</div>";
        echo "<div id='r_e2_2-{$row[ob]}' style='display:none;'>{$row[r_e2_2]}</div>";
        echo "<div id='r_e2_3-{$row[ob]}' style='display:none;'>{$row[r_e2_3]}</div>";
        echo "<div id='r_e2_4-{$row[ob]}' style='display:none;'>{$row[r_e2_4]}</div>";
        echo "<div id='r_e2_5-{$row[ob]}' style='display:none;'>{$row[r_e2_5]}</div>";
        echo "<div id='r_e2_SDEV_1-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_1]}</div>";
        echo "<div id='r_e2_SDEV_2-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_2]}</div>";
        echo "<div id='r_e2_SDEV_3-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_3]}</div>";
        echo "<div id='r_e2_SDEV_4-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_4]}</div>";
        echo "<div id='r_e2_SDEV_5-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_5]}</div>";

        echo "<div id='i_e1_1-{$row[ob]}' style='display:none;'>{$row[i_e1_1]}</div>";
        echo "<div id='i_e1_2-{$row[ob]}' style='display:none;'>{$row[i_e1_2]}</div>";
        echo "<div id='i_e1_3-{$row[ob]}' style='display:none;'>{$row[i_e1_3]}</div>";
        echo "<div id='i_e1_4-{$row[ob]}' style='display:none;'>{$row[i_e1_4]}</div>";
        echo "<div id='i_e1_5-{$row[ob]}' style='display:none;'>{$row[i_e1_5]}</div>";
        echo "<div id='i_e1_SDEV_1-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_1]}</div>";
        echo "<div id='i_e1_SDEV_2-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_2]}</div>";
        echo "<div id='i_e1_SDEV_3-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_3]}</div>";
        echo "<div id='i_e1_SDEV_4-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_4]}</div>";
        echo "<div id='i_e1_SDEV_5-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_5]}</div>";
        echo "<div id='i_e2_1-{$row[ob]}' style='display:none;'>{$row[i_e2_1]}</div>";
        echo "<div id='i_e2_2-{$row[ob]}' style='display:none;'>{$row[i_e2_2]}</div>";
        echo "<div id='i_e2_3-{$row[ob]}' style='display:none;'>{$row[i_e2_3]}</div>";
        echo "<div id='i_e2_4-{$row[ob]}' style='display:none;'>{$row[i_e2_4]}</div>";
        echo "<div id='i_e2_5-{$row[ob]}' style='display:none;'>{$row[i_e2_5]}</div>";
        echo "<div id='i_e2_SDEV_1-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_1]}</div>";
        echo "<div id='i_e2_SDEV_2-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_2]}</div>";
        echo "<div id='i_e2_SDEV_3-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_3]}</div>";
        echo "<div id='i_e2_SDEV_4-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_4]}</div>";
        echo "<div id='i_e2_SDEV_5-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_5]}</div>";

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

        echo "<button style='font-weight: bold; font-size: small' id='butt-{$row0[ob]}' onclick='clickPointing(" . '"' . $row0[ob] . '"' . ")'>{$ob}</button>\n";
      }
    } else {
      echo "0 pointings";
    }
  }

  if(isset($_POST['query-issues'])) {
    $issues = array();

    if($_POST['i_fringing'] == 'true') {
      array_push($issues, 'i_fringing');
    }

    echo "<h3>Select a pointing with ";
    foreach($issues as $issue) {
      echo "{$issue}";
      if(sizeof($issues)>1) {
        echo ", ";
      }
    }
    echo ":</h3>";

    $sql0 = "SELECT DISTINCT ob FROM kids_theliqc ORDER BY ra, de ASC";

    $result0 = $conn->query($sql0);

    $ctr = 0;

    if($result0->num_rows > 0) {
      while($row0 = $result0->fetch_assoc()) {
        $sql1 = "SELECT ob, ra, de, submit_to_edinburgh, i_e1_1, i_e1_2, i_e1_3, i_e1_4,
        i_e1_5, i_e1_SDEV_1, i_e1_SDEV_2, i_e1_SDEV_3, i_e1_SDEV_4,
        i_e1_SDEV_5, i_e2_1, i_e2_2, i_e2_3, i_e2_4, i_e2_5, i_e2_SDEV_1,
        i_e2_SDEV_2, i_e2_SDEV_3, i_e2_SDEV_4, i_e2_SDEV_5, r_e1_1, r_e1_2, r_e1_3,
        r_e1_4, r_e1_5, r_e1_SDEV_1, r_e1_SDEV_2, r_e1_SDEV_3, r_e1_SDEV_4,
        r_e1_SDEV_5, r_e2_1, r_e2_2, r_e2_3, r_e2_4, r_e2_5, r_e2_SDEV_1,
        r_e2_SDEV_2, r_e2_SDEV_3, r_e2_SDEV_4, r_e2_SDEV_5";
        $sql2 = " FROM kids_theliqc WHERE";
        $sql3 = " ORDER BY ra, de ASC";
        foreach($issues as $issue) {
          $sql1 .= ", {$issue}";
          $sql2 .= " {$issue} = 1";
          if(sizeof($issues)>1 && $issue!=end($issues)) {
            $sql2 .= " AND";
          }
        }
        $sql2 .= " AND submit_to_edinburgh = 1 AND ob='{$row0[ob]}'";
        $sql = $sql1 . $sql2 . $sql3;

        $result = $conn->query($sql);

        if($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $ob = str_replace("KIDS_", "", $row[ob]);

          $ctr++;

          // make hidden divs to hold psf stats
          echo "<div id='r_e1_1-{$row[ob]}' style='display:none;'>{$row[r_e1_1]}</div>";
          echo "<div id='r_e1_2-{$row[ob]}' style='display:none;'>{$row[r_e1_2]}</div>";
          echo "<div id='r_e1_3-{$row[ob]}' style='display:none;'>{$row[r_e1_3]}</div>";
          echo "<div id='r_e1_4-{$row[ob]}' style='display:none;'>{$row[r_e1_4]}</div>";
          echo "<div id='r_e1_5-{$row[ob]}' style='display:none;'>{$row[r_e1_5]}</div>";
          echo "<div id='r_e1_SDEV_1-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_1]}</div>";
          echo "<div id='r_e1_SDEV_2-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_2]}</div>";
          echo "<div id='r_e1_SDEV_3-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_3]}</div>";
          echo "<div id='r_e1_SDEV_4-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_4]}</div>";
          echo "<div id='r_e1_SDEV_5-{$row[ob]}' style='display:none;'>{$row[r_e1_SDEV_5]}</div>";
          echo "<div id='r_e2_1-{$row[ob]}' style='display:none;'>{$row[r_e2_1]}</div>";
          echo "<div id='r_e2_2-{$row[ob]}' style='display:none;'>{$row[r_e2_2]}</div>";
          echo "<div id='r_e2_3-{$row[ob]}' style='display:none;'>{$row[r_e2_3]}</div>";
          echo "<div id='r_e2_4-{$row[ob]}' style='display:none;'>{$row[r_e2_4]}</div>";
          echo "<div id='r_e2_5-{$row[ob]}' style='display:none;'>{$row[r_e2_5]}</div>";
          echo "<div id='r_e2_SDEV_1-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_1]}</div>";
          echo "<div id='r_e2_SDEV_2-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_2]}</div>";
          echo "<div id='r_e2_SDEV_3-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_3]}</div>";
          echo "<div id='r_e2_SDEV_4-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_4]}</div>";
          echo "<div id='r_e2_SDEV_5-{$row[ob]}' style='display:none;'>{$row[r_e2_SDEV_5]}</div>";

          echo "<div id='i_e1_1-{$row[ob]}' style='display:none;'>{$row[i_e1_1]}</div>";
          echo "<div id='i_e1_2-{$row[ob]}' style='display:none;'>{$row[i_e1_2]}</div>";
          echo "<div id='i_e1_3-{$row[ob]}' style='display:none;'>{$row[i_e1_3]}</div>";
          echo "<div id='i_e1_4-{$row[ob]}' style='display:none;'>{$row[i_e1_4]}</div>";
          echo "<div id='i_e1_5-{$row[ob]}' style='display:none;'>{$row[i_e1_5]}</div>";
          echo "<div id='i_e1_SDEV_1-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_1]}</div>";
          echo "<div id='i_e1_SDEV_2-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_2]}</div>";
          echo "<div id='i_e1_SDEV_3-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_3]}</div>";
          echo "<div id='i_e1_SDEV_4-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_4]}</div>";
          echo "<div id='i_e1_SDEV_5-{$row[ob]}' style='display:none;'>{$row[i_e1_SDEV_5]}</div>";
          echo "<div id='i_e2_1-{$row[ob]}' style='display:none;'>{$row[i_e2_1]}</div>";
          echo "<div id='i_e2_2-{$row[ob]}' style='display:none;'>{$row[i_e2_2]}</div>";
          echo "<div id='i_e2_3-{$row[ob]}' style='display:none;'>{$row[i_e2_3]}</div>";
          echo "<div id='i_e2_4-{$row[ob]}' style='display:none;'>{$row[i_e2_4]}</div>";
          echo "<div id='i_e2_5-{$row[ob]}' style='display:none;'>{$row[i_e2_5]}</div>";
          echo "<div id='i_e2_SDEV_1-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_1]}</div>";
          echo "<div id='i_e2_SDEV_2-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_2]}</div>";
          echo "<div id='i_e2_SDEV_3-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_3]}</div>";
          echo "<div id='i_e2_SDEV_4-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_4]}</div>";
          echo "<div id='i_e2_SDEV_5-{$row[ob]}' style='display:none;'>{$row[i_e2_SDEV_5]}</div>";

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

          echo "<button style='font-weight: bold; font-size: small' id='butt-{$row[ob]}' onclick='clickPointing(" . '"' . $row[ob] . '"' . ")'>{$ob}</button>\n";
        }
      }

      echo "<br><br><h3>{$ctr} pointings found.</h3>";
    } else {
      echo "0 pointings";
    }
  }

  mysql_free_result($result0);
  mysql_free_result($result);

  //$GLOBALS['conn']->close();
  $conn->close();
?>
