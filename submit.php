<?php
require("database_access.php");

$pointing = $_POST['pointing'];
$user = $_POST['user'];

$arrayDBComments = array('r_cross_talk', 'r_elec_noise', 'i_cross_talk',
  'i_elec_noise', 'r_sat_track', 'r_gain_jumps', 'r_bckgd_var', 'r_reflections',
  'r_weight_unusual', 'r_missing_ccd', 'i_sat_track', 'i_gain_jumps',
  'i_bckgd_var', 'i_reflections',  'i_weight_unusual', 'i_missing_ccd', 'i_gaps',
  'i_fringing', 'r_gal_turnover', 'r_star_sel', 'r_astro', 'i_gal_turnover',
  'i_star_sel', 'i_astro', 'r_psf', 'i_psf', 'submit_noissues_calib',
  'submit_noissues_coadd', 'submit_noissues_mags', 'submit_noissues_psf');

$arrayUserComments = array('r-band cross-talk', 'r-band electronic noise',
  'i-band cross-talk', 'i-band electronic noise', 'r-band satellite track(s)',
  'r-band gain jumps', 'r-band background variations', 'r-band reflections',
  'r-band unusual weightmap', 'r-band missing ccd', 'i-band satellite track(s)',
  'i-band gain jumps', 'i-band background variations', 'i-band reflections',
  'i-band unusual weightmap', 'i-band missing ccd', 'i-band gaps reflections',
  'i-band fringing', 'r-band galaxy turnover', 'r-band star selection',
  'r-band bad astrometry', 'i-band galaxy turnover', 'i-band star selection',
  'i-band bad astrometry', 'r-band PSF variations', 'i-band PSF variations',
  'calibration good', 'coadd good', 'number counts, magnitudes, & astrometry good',
  'psf good');

$arrayDBOthers = array('other_calib', 'other_coadd', 'other_mags', 'other_psf');

echo "<span style='color:green; font-family: arial; font-size: large'>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function updateSQL($comment, $value) {
  $pointing = $GLOBALS["pointing"];

  $user = $GLOBALS["user"];

  $conn = $GLOBALS["conn"];

  $sql = "UPDATE kids_theliqc SET {$comment}={$value} WHERE ob='{$pointing}' AND user='{$user}'";

  $arrayDBComments = $GLOBALS["arrayDBComments"];
  $arrayDBOthers = $GLOBALS["arrayDBOthers"];
  $arrayUserComments = $GLOBALS["arrayUserComments"];

  if ($conn->query($sql) === TRUE) {
    if($value != 0 or $value != '0') {
      $indx1 = array_search($comment, $arrayDBComments);
      $indx2 = array_search($comment, $arrayDBOthers);
      if($indx1 === FALSE && $indx2 === FALSE) {
        return;
      } elseif ($indx1 === FALSE) {
        return;
      } else {
        return "{$arrayUserComments[$indx1]}<br>";
      }
    }
  } else {
    return "Error updating: " . $conn->error;
  }
}

function selectOtherComment($comment) {
  $pointing = $GLOBALS["pointing"];

  $user = $GLOBALS["user"];

  $conn = $GLOBALS["conn"];

  $sql = "SELECT {$comment} FROM kids_theliqc WHERE user='{$user}'
  AND ob='{$pointing}'";

  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()) {
    if($row[$comment] != '0') {
      return $row[$comment] . "<br>";
    }
  }

}

$submits = array('submit_calib', 'submit_coadd', 'submit_mags', 'submit_psf');

$ctr = 0;
foreach($submits as $submit) {
  $others = $GLOBALS["arrayDBOthers"];

  if($submit == 'submit_calib') {
    $comments = array('r_cross_talk', 'r_elec_noise', 'i_cross_talk', 'i_elec_noise');
    $ins = 'inspected_calib';
    $otherComment = 'other_calib';
    $noIssue = 'submit_noissues_calib';
  } elseif($submit == 'submit_coadd') {
    $comments = array('r_sat_track', 'r_gain_jumps', 'r_bckgd_var', 'r_reflections',  'r_weight_unusual', 'r_missing_ccd', 'i_sat_track', 'i_gain_jumps', 'i_bckgd_var', 'i_reflections',  'i_weight_unusual', 'i_missing_ccd', 'i_gaps', 'i_fringing');
    $ins = 'inspected_coadd';
    $otherComment = 'other_coadd';
    $noIssue = 'submit_noissues_coadd';
  } elseif($submit == 'submit_mags') {
    $comments = array('r_gal_turnover', 'r_star_sel', 'r_astro', 'i_gal_turnover', 'i_star_sel', 'i_astro');
    $ins = 'inspected_mags';
    $otherComment = 'other_mags';
    $noIssue = 'submit_noissues_mags';
  } elseif($submit == 'submit_psf') {
    $comments = array('r_psf', 'i_psf');
    $ins = 'inspected_psf';
    $otherComment = 'other_psf';
    $noIssue = 'submit_noissues_psf';
  }

  if(isset($_POST[$submit]) && $_POST[$others[$ctr]]) {
    foreach($comments as $comment) {
      if($_POST[$comment] == 'true') {
        echo updateSQL($comment, 1);
        echo updateSQL($ins, 1);
        echo updateSQL($noIssue, 0);
      } else {
        echo updateSQL($comment, 0);
      }
    }

    echo updateSQL($others[$ctr], $_POST[$others[$ctr]]);
    echo updateSQL($ins, 1);
    echo updateSQL($noIssue, 0);
    echo selectOtherComment($otherComment);
  } elseif(isset($_POST[$submit])) {

    foreach($comments as $comment) {
      if($_POST[$comment] == 'true') {
        echo updateSQL($comment, 1);
        echo updateSQL($ins, 1);
        echo updateSQL($noIssue, 0);
      } else {
        echo updateSQL($comment, 0);
      }
    }

    echo selectOtherComment($otherComment);
  }

  $ctr++;
}

$noSubmits = array('submit_nothing_calib', 'submit_nothing_coadd', 'submit_nothing_mags', 'submit_nothing_psf');
$noIssues = array('submit_noissues_calib', 'submit_noissues_coadd', 'submit_noissues_mags', 'submit_noissues_psf');
foreach($noSubmits as $noSubmit) {
    if($noSubmit == 'submit_nothing_calib') {
      $comment = 'inspected_calib';
      $comments = array('r_cross_talk', 'r_elec_noise', 'i_cross_talk', 'i_elec_noise');
      $noIssue = 'submit_noissues_calib';
      $otherComment = 'other_calib';
    } elseif($noSubmit == 'submit_nothing_coadd') {
      $comment = 'inspected_coadd';
      $comments = array('r_sat_track', 'r_gain_jumps', 'r_bckgd_var', 'r_reflections',  'r_weight_unusual', 'r_missing_ccd', 'i_sat_track', 'i_gain_jumps', 'i_bckgd_var', 'i_reflections',  'i_weight_unusual', 'i_missing_ccd', 'i_gaps', 'i_fringing');
      $noIssue = 'submit_noissues_coadd';
      $otherComment = 'other_coadd';
    } elseif($noSubmit == 'submit_nothing_mags') {
      $comment = 'inspected_mags';
      $comments = array('r_gal_turnover', 'r_star_sel', 'r_astro', 'i_gal_turnover', 'i_star_sel', 'i_astro');
      $noIssue = 'submit_noissues_mags';
      $otherComment = 'other_mags';
    } elseif($noSubmit == 'submit_nothing_psf') {
      $comment = 'inspected_psf';
      $comments = array('r_psf', 'i_psf');
      $noIssue = 'submit_noissues_psf';
      $otherComment = 'other_psf';
    }

    if(isset($_POST[$noSubmit])) {
      echo updateSQL($comment, 1);

      echo updateSQL($noIssue, 1);

      echo updateSQL($otherComment, 0);

      foreach($comments as $acomment) {
        echo updateSQL($acomment, 0);
      }
    }
}

if(isset($_POST['submit_to_edinburgh'])) {
  echo updateSQL('submit_to_edinburgh', 1);
  echo "marked to copy to edinburgh";
}

$inspected = array('inspected_calib', 'inspected_coadd', 'inspected_mags', 'inspected_psf');
if(isset($_POST['submit_no_issues'])) {

  foreach($inspected as $ins) {
    echo updateSQL($ins, 1);
  }

  foreach($noIssues as $noIssue) {
    echo updateSQL($noIssue, 1);
  }
}

echo "</span>";

$conn->close();
?>

