<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Theli Quality Control</title>
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
    require("query_user_fields.php");
  ?>
</div>

<div id="tabs" style="display:none;">

  <ul>
    <li><a href="#tab-calib">Calibration</a></li>
    <li><a href="#tab-coadd">Coadd</a></li>
    <li><a href="#tab-mags">Number counts...</a></li>
    <li><a href="#tab-masks">Masks</a></li>
    <li><a href="#tab-psf">PSF</a></li>
    <form action="submit.php" method="post" target="submit-results-edinburgh" id="formEdinburgh">
    <input type="hidden" value="" class="pointing" name="pointing">
    <input type="hidden" value="<?php echo "{$user}";?>" name="user">
    <input type="submit" style="font-weight:bold;" value="Submit good for Edinburgh" name="submit_to_edinburgh" id="submit_to_edinburgh" onclick="clickEdinburgh()">
    </form>
  </ul>

  <div id="tab-calib">

    <div class="div-current-pointing" style="display:none;">
    </div>

    <div class="div-inst">
      <div class="div-instructions-tb">
      </div>
      Left to right: bias, dark, sky.
    </div>

    <div id="div-img-calib">
      <a href="" id="href-calib" target="_blank">
      <img src="" id="img-calib">
      </a>
    </div>

    <div id="div-form-calib">
 
      <span style="font-weight:bold; float:left;">Choose issues:</span>
      <img id="img-help-calib" src="images/buttons/help.jpg" width="7%"><br>

      <form action="submit.php" method="post" target="submit-results-calib">
      <input type="checkbox" name="r_cross_talk" value="true">r-band cross-talk<br>
      <input type="checkbox" name="r_elec_noise" value="true">r-band electronic noise<br>
      <input type="checkbox" name="i_cross_talk" value="true">i-band cross-talk<br>
      <input type="checkbox" name="i_elec_noise" value="true">i-band electronic noise<br>
      other:<input type="text" name="other_calib" id="other-calib" size="10" title="enclose in single quotes (') letters, numbers, and most special characters" pattern="^'[A-Za-z0-9,;:_<>\/\=\+\-\{\}\|\(\)\[\]\*\^\@\#\.\&\%\?\s]*'$"><br>
      <input type="hidden" value="" class="pointing" name="pointing">
      <input type="hidden" value="<?php echo "{$user}";?>" name="user">
      <input type="submit" value="Submit" name="submit_calib">
      <input type="submit" value="Submit no issues" name="submit_nothing_calib">
      </form>

    </div>

    <div id="div-comments-calib">
      <span style="font-weight:bold;">Submissions in database:</span>
      <iframe name="submit-results-calib" id="submit-results-calib">
        <p>Your browser does not support iframes.</p>
      </iframe>
    </div>

    <iframe src="pages_help/calibration.html" id="iframe-help-calib"></iframe>

  </div>

  <div id="tab-coadd">
  
    <div class="div-current-pointing" style="display:none;">
    </div>
    
    <div class="div-inst">
      <div class="div-instructions-lr">
      </div>
      Top: coadd image. Bottom: weight image.
    </div>
    
    <a href="" id="href-coadd" target="_blank">
    <img src="" id="img-coadd" style="float:left;">
    </a>
  
    <div id="div-form-coadd">
      <span style="font-weight:bold; float:left;">Choose issues:</span>
      <img id="img-help-coadd" src="images/buttons/help.jpg" width="7%"><br>

      <form action="submit.php" method="post" target="submit-results-coadd">
      <input type="checkbox" name="r_sat_track" value="true">r-band satellite track<br>
      <input type="checkbox" name="r_gain_jumps" value="true">r-band gain jumps<br>
      <input type="checkbox" name="r_bckgd_var" value="true">r-band background variations<br>
      <input type="checkbox" name="r_reflections" value="true">r-band reflections<br>
      <input type="checkbox" name="r_weight_unusual" value="true">r-band unusual weightmap<br>
      <input type="checkbox" name="r_missing_ccd" value="true">r-band missing ccd<br>
      <input type="checkbox" name="i_sat_track" value="true">i-band satellite track<br>
      <input type="checkbox" name="i_gain_jumps" value="true">i-band gain jumps<br>
      <input type="checkbox" name="i_bckgd_var" value="true">i-band background variations<br>
      <input type="checkbox" name="i_reflections" value="true">i-band reflections<br>
      <input type="checkbox" name="i_weight_unusual" value="true">i-band unusual weightmap<br>
      <input type="checkbox" name="i_missing_ccd" value="true">i-band missing ccd<br>
      <input type="checkbox" name="i_gaps" value="true">i-band gaps reflections<br>
      <input type="checkbox" name="i_fringing" value="true">i-band fringing<br>
      other:<input type="text" name="other_coadd" id="other-coadd" size="10" title="enclose in single quotes (') letters, numbers, and most special characters" pattern="^'[A-Za-z0-9,;:_<>\/\=\+\-\{\}\|\(\)\[\]\*\^\@\#\.\&\%\?\s]*'$"><br>
      <input type="hidden" value="" class="pointing" name="pointing">
      <input type="hidden" value="<?php echo "{$user}";?>" name="user">
      <input type="submit" value="Submit" name="submit_coadd">
      <input type="submit" value="Submit no issues" name="submit_nothing_coadd">
      </form>

    </div>

    <div id="div-comments-coadd">
      <span style="font-weight:bold;">Submissions in database:</span>
      <iframe name="submit-results-coadd" id="submit-results-coadd">
        <p>Your browser does not support iframes.</p>
      </iframe>
    </div>

    <iframe src="pages_help/coadd.html" id="iframe-help-coadd"></iframe>

  </div>

  <div id="tab-mags">
    
    <div class="div-current-pointing" style="display:none;">
    </div>
    
    <div class="div-inst">
      <div class="div-instructions-lr">
      </div>
      Top to bottom: number counts, SExtractor magnitude, astrometry.
    </div>
    
    <a href="" id="href-mags" target="_blank">
    <img src="" id="img-mags" style="float:left;">
    </a>
    
    <div id="div-form-mags">
      <span style="font-weight:bold; float:left;">Choose issues:</span>
      <img id="img-help-mags" src="images/buttons/help.jpg" width="7%"><br>

      <form action="submit.php" method="post" target="submit-results-mags">
      <input type="checkbox" name="r_gal_turnover" value="true">r-band galaxy turnover<br>
      <input type="checkbox" name="r_star_sel" value="true">r-band star selection<br>
      <input type="checkbox" name="r_astro" value="true">r-band bad astrometry<br>
      <input type="checkbox" name="i_gal_turnover" value="true">i-band galaxy turnover<br>
      <input type="checkbox" name="i_star_sel" value="true">i-band star selection<br>
      <input type="checkbox" name="i_astro" value="true">i-band bad astrometry<br>
      other:<input type="text" name="other_mags" id="other-mags" size="10" title="enclose in single quotes (') letters, numbers, and most special characters" pattern="^'[A-Za-z0-9,;:_<>\/\=\+\-\{\}\|\(\)\[\]\*\^\@\#\.\&\%\?\s]*'$"><br>
      <input type="hidden" value="" class="pointing" name="pointing">
      <input type="hidden" value="<?php echo "{$user}";?>" name="user">
      <input type="submit" value="Submit" name="submit_mags">
      <input type="submit" value="Submit no issues" name="submit_nothing_mags">
      </form>

    </div>

    <div id="div-comments-mags">
      <span style="font-weight:bold;">Submissions in database:</span>
      <iframe name="submit-results-mags" id="submit-results-mags"><p>Your browser does not support iframes.</p></iframe>
    </div>
    
    <iframe src="pages_help/mags.html" id="iframe-help-mags"></iframe>
  </div>

  <div id="tab-masks">
    
    <div class="div-current-pointing" style="display:none;">
    </div>
    
    <div style="margin-left:20%;">
      Pink, yellow, and blue colors are conservative, intermediate, and strong, respectively.
    </div>
    
    <div id="div-img-masks">
      <a href="" id="href-masks" target="_blank">
      <img src="" height="40%" width="40%" id="img-masks">
      </a>
    </div>

    <div id="div-form-masks">
      <span style="font-weight:bold;">Choose issues:</span>
      <form action="submit.php" method="post" target="submit-results-masks">
      <input type="checkbox" name="mask_conservative" value="true">conservative mask...<br>
      <input type="checkbox" name="mask_intermediate" value="true">intermediate mask...<br>
      <input type="checkbox" name="mask_strong" value="true">strong mask...<br>
      other:<input type="text" name="other_masks" size="10" title="enclose in single quotes (') letters, numbers, and most special characters" pattern="^'[A-Za-z0-9,;:_<>\/\=\+\-\{\}\|\(\)\[\]\*\^\@\#\.\&\%\?\s]*'$"><br>
      <input type="hidden" value="" class="pointing" name="pointing">
      <input type="hidden" value="<?php echo "{$user}";?>" name="user">
      <input type="submit" value="Submit" name="submit_masks" disabled>
      <input type="submit" value="Submit no issues" name="submit_nothing_masks" disabled>
      </form>
    </div>

    <div id="div-comments-masks">
      <span style="font-weight:bold;">Submissions in database:</span>
      <iframe name="submit-results-masks" id="submit-results-masks">
        <p>Your browser does not support iframes.</p>
      </iframe>
    </div>
    
  </div>

  <div id="tab-psf">
    
    <div class="div-current-pointing" style="display:none;">
    </div>
    
    <div class="div-inst">
      <div class="div-instructions-tb">
      </div>
    </div><br>

    <div width="100%" id="div-psf-r" style="display:none;">
    <a href="" id="href-psf-1" target="_blank"><img src="" height="397" width="307" id="img-psf-1"></a>
    <a href="" id="href-psf-2" target="_blank"><img src="" height="397" width="307" id="img-psf-2"></a>
    <a href="" id="href-psf-3" target="_blank"><img src="" height="397" width="307" id="img-psf-3"></a>
    <a href="" id="href-psf-4" target="_blank"><img src="" height="397" width="307" id="img-psf-4"></a>
    <a href="" id="href-psf-5" target="_blank"><img src="" height="397" width="307" id="img-psf-5"></a>
    </div><br>

    <div width="100%" id="div-psf-i" style="display:none;">
    <a href="" id="href-psf-6" target="_blank"><img src="" height="397" width="307" id="img-psf-6"></a>
    <a href="" id="href-psf-7" target="_blank"><img src="" height="397" width="307" id="img-psf-7"></a>
    <a href="" id="href-psf-8" target="_blank"><img src="" height="397" width="307" id="img-psf-8"></a>
    <a href="" id="href-psf-9" target="_blank"><img src="" height="397" width="307" id="img-psf-9"></a>
    <a href="" id="href-psf-10" target="_blank"><img src="" height="397" width="307" id="img-psf-10"></a>
    </div><br>

    <div id="div-form-psf">

      <div>
        <span style="font-weight:bold; float:left;">Choose issues:</span>
        <img id="img-help-psf" src="images/buttons/help.jpg" width="7%">
      </div><br>

      <form action="submit.php" method="post" target="submit-results-psf">
      <input type="checkbox" name="r_psf" value="true">r-band PSF variations<br>
      <input type="checkbox" name="i_psf" value="true">i-band PSF variations<br>
      other:<input type="text" name="other_psf" id="other-psf" size="10" title="enclose in single quotes (') letters, numbers, and most special characters" pattern="^'[A-Za-z0-9,;:_<>\/\=\+\-\{\}\|\(\)\[\]\*\^\@\#\.\&\%\?\s]*'$"><br>
      <input type="hidden" value="" class="pointing" name="pointing">
      <input type="hidden" value="<?php echo "{$user}";?>" name="user">
      <input type="submit" value="Submit" name="submit_psf">
      <input type="submit" value="Submit no issues" name="submit_nothing_psf">
      </form>

    </div>

    <div id="div-comments-psf">
      <span style="font-weight:bold;">Submissions in database:</span>
      <iframe name="submit-results-psf" id="submit-results-psf">
        <p>Your browser does not support iframes.</p>
      </iframe>
    </div>
    
    <div id="div-psf-stats">
        <span style="font-weight:bold;">PSF stats:</span>
    </div>
    
    <iframe src="pages_help/psf.html" id="iframe-help-psf"></iframe>
  
  </div>

</div>

<div id="div-iframe-edinburgh" style="float:left">
  <iframe name="submit-results-edinburgh" id="submit-results-edinburgh" width="20%" height="2%">
    <p>Your browser does not support iframes.</p>
  </iframe>
</div>

<div id="div-help-docs" style="display:none;">

  <span style="padding:1%">
  <a href="KiDS-TrainingPartIII-Checkplots.pdf">
    Dominik Klaes' slides about checkplots
  </a>
  </span>
  
  <a href="pages_help/readme.html">Please readme</a>

</div>

</body>

<script src="clickHandler.js"></script>
</html>
