  <?php
  //Use PHP to connect to database and get user's pointings.
  require("database_access.php");

  if(!isset($_POST['submit-user'])) {
    echo "<h3>Welcome!<br>
      <hr>
      Select your user name:</h3>
      <form action='index.php' method='post'>
      <select size=8 name='user'>
        <option value='brouwer'>brouwer</option>
        <option value='dejong'>dejong</option>
        <option value='eriksen'>eriksen</option>
        <option value='irisarri'>irisarri</option>
        <option value='kohlinger'>kohlinger</option>
        <option value='kuijken'>kuijken</option>
        <option value='sifon'>sifon</option>
        <option value='viola'>viola</option>
      </select>
      <input type='submit' value='Go' name='submit-user'>
      </form><br>
      <hr>
      <div id='div-links'>
        <h3>To search for fields with specific issues or search with 
        an SQL query go to the 
        <a href='http://kids.strw.leidenuniv.nl/TheliQC/overview.php'>
        overview</a>.<br><br>
        To see all fields in the database go
        <a href='http://kids.strw.leidenuniv.nl/TheliQC/all.php'>
        here</a>.
        </h3>
      </div>";
  }

  if(isset($_POST['submit-user'])) {
    $user = $_POST['user'];

    echo "<h3>Welcome, {$user}<br><br>Select a pointing:</h3>";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT ob, ra, de, inspected_calib, inspected_coadd, inspected_mags,
        inspected_masks, inspected_psf FROM kids_theliqc WHERE user='{$user}'
        ORDER BY id DESC";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {

        $ob = str_replace("KIDS_", "", $row[ob]);

        if($row[inspected_calib] == 1 && $row[inspected_coadd] == 1 && $row[inspected_mags] == 1 && $row[inspected_psf] == 1) {
          echo "<button style='background-color:green; color: white; font-weight: bold; font-size: small' id='butt-{$row[ob]}' onclick='clickPointing(" . '"' . $row[ob] . '"' . ")'>{$ob}</button>\n";
        } else {
          echo "<button style='background-color:red; color:white; font-weight: bold; font-size:small' id='butt-{$row[ob]}' onclick='clickPointing(" . '"' . $row[ob] . '"' . ")'>{$ob}</button>\n";
        }
      
      }
    } else {
      echo "0 pointings";
    }

    mysql_free_result($result);

    $sql = "SELECT ob, r_cross_talk, r_elec_noise, r_sat_track, r_gain_jumps, 
      r_bckgd_var, r_reflections,  r_weight_unusual, r_missing_ccd, r_gal_turnover, 
      r_star_sel, r_astro,  r_psf,  i_cross_talk, i_elec_noise, i_sat_track, 
      i_gain_jumps, i_bckgd_var, i_reflections, i_weight_unusual, i_missing_ccd, 
      i_gaps, i_fringing, i_gal_turnover, i_star_sel, i_astro, i_psf,  other_calib, 
      other_coadd, other_mags, other_masks, other_psf, submit_noissues_calib,
      submit_noissues_coadd, submit_noissues_mags, submit_noissues_masks,
      submit_noissues_psf, inspected_calib, inspected_coadd, inspected_mags,
      inspected_masks, inspected_psf, i_e1_1, i_e1_2, i_e1_3, i_e1_4, i_e1_5, 
      i_e1_SDEV_1, i_e1_SDEV_2, i_e1_SDEV_3, i_e1_SDEV_4, i_e1_SDEV_5, i_e2_1, 
      i_e2_2, i_e2_3, i_e2_4, i_e2_5, i_e2_SDEV_1, i_e2_SDEV_2, i_e2_SDEV_3, 
      i_e2_SDEV_4, i_e2_SDEV_5, r_e1_1, r_e1_2, r_e1_3, r_e1_4, r_e1_5, 
      r_e1_SDEV_1, r_e1_SDEV_2, r_e1_SDEV_3, r_e1_SDEV_4, r_e1_SDEV_5, r_e2_1, 
      r_e2_2, r_e2_3, r_e2_4, r_e2_5, r_e2_SDEV_1, r_e2_SDEV_2, r_e2_SDEV_3, 
      r_e2_SDEV_4, r_e2_SDEV_5, submit_to_edinburgh FROM kids_theliqc WHERE 
      user='{$user}'";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        //echo "{$row[ob]}";
        // make hidden div to hold info about inspection status
        echo "<div id='div-inspection-{$row[ob]}' class='div-inspection' name='{$row[ob]}' style='display: none;'>";
        if($row[inspected_calib] == 1 && $row[inspected_coadd] == 1 && $row[inspected_mags] == 1 && $row[inspected_psf] == 1) {
          echo "green";
        } else {
          echo "red";
        }
        echo "</div>";

        // make hidden div to hold info about edinburgh status
        echo "<div id='div-edinburgh-{$row[ob]}' class='div-edinburgh' name='{$row[ob]}' style='display: none;'>";
        if($row[submit_to_edinburgh] == 1) {
          echo "green";
        } else {
          echo "red";
        }
        echo "</div>";

        // make hidden div to hold calibration comments
        echo "<div id='div-calib-{$row[ob]}' style='display: none;'>";
        if($row[r_cross_talk] == 1) { echo "r-band cross-talk<br>";}
        if($row[r_elec_noise] == 1) { echo "r-band electronic noise<br>";}
        if($row[i_cross_talk] == 1) { echo "i-band cross-talk<br>";}
        if($row[i_elec_noise] == 1) { echo "i-band electronic noise<br>";}
        if($row[other_calib]) { echo "{$row[other_calib]}<br>";}
        if($row[submit_noissues_calib] == 1) { echo "calibration good<br>";}
        echo "</div>";

        // make hidden div to hold coadd comments
        echo "<div id='div-coadd-{$row[ob]}' style='display: none;'>";
        if($row[r_sat_track] == 1) { echo "r-band satellite track(s)<br>";}
        if($row[r_gain_jumps] == 1) { echo "r-band gain jumps<br>";}
        if($row[r_bckgd_var] == 1) { echo "r-band background variations<br>";}
        if($row[r_reflections] == 1) { echo "r-band reflections<br>";}
        if($row[r_weight_unusual] == 1) { echo "r-band unusual weightmap<br>";}
        if($row[r_missing_ccd] == 1) { echo "r-band missing ccd<br>";}
        if($row[i_sat_track] == 1) { echo "i-band satellite track(s)<br>";}
        if($row[i_gain_jumps] == 1) { echo "i-band gain jumps<br>";}
        if($row[i_bckgd_var] == 1) { echo "i-band background variations<br>";}
        if($row[i_reflections] == 1) { echo "i-band reflections<br>";}
        if($row[i_weight_unusual] == 1) { echo "i-band unusual weightmap<br>";}
        if($row[i_missing_ccd] == 1) { echo "i-band missing ccd<br>";}
        if($row[i_gaps] == 1) { echo "i-band gaps reflections<br>";}
        if($row[i_fringing] == 1) { echo "i-band fringing<br>";}
        if($row[other_coadd]) { echo "{$row[other_coadd]}<br>";}
        if($row[submit_noissues_coadd] == 1) { echo "coadd good<br>";}
        echo "</div>";

        // make hidden div to hold num counts, mags, astro comments
        echo "<div id='div-mags-{$row[ob]}' style='display: none;'>";
        if($row[r_gal_turnover] == 1) { echo "r-band galaxy turnover<br>";}
        if($row[r_star_sel] == 1) { echo "r-band star selection<br>";}
        if($row[r_astro] == 1) { echo "r-band bad astrometry<br>";}
        if($row[i_gal_turnover] == 1) { echo "i-band galaxy turnover<br>";}
        if($row[i_stai_sel] == 1) { echo "i-band star selection<br>";}
        if($row[i_astro] == 1) { echo "i-band bad astrometry<br>";}
        if($row[other_mags]) { echo "{$row[other_mags]}<br>";}
        if($row[submit_noissues_mags] == 1) { echo "number counts, magnitudes, & astrometry good<br>";}
        echo "</div>";

        // make hidden div to hold psf comments
        echo "<div id='div-psf-{$row[ob]}' style='display: none;'>";
        if($row[r_psf] == 1) { echo "r-band PSF variations<br>";}
        if($row[i_psf] == 1) { echo "i-band PSF variations<br>";}
        if($row[other_psf]) { echo "{$row[other_psf]}<br>";}
        if($row[submit_noissues_psf] == 1) { echo "psf good<br>";}
        echo "</div>";

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

        echo "<div id='div-hidden-submitctr-{$row[ob]}' style='display:none;'>0, 0, 0, 0</div>";
        echo "<div id='div-hidden-submitnothingctr-{$row[ob]}' style='display:none;'>0, 0, 0, 0</div>";
      }
    }

    $conn->close();

}
?>
