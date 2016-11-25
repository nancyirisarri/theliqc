function clickPointing(pointing) {
  // Check if there are plots for each of the bands. Keep in a variable.
  // (divr=='' && divi=='') || (divr=='_r' && divi=='') means r-band present
  // (divr=='' && divi=='') || (divr=='' && divi=='_i') means i-band present
  var divr = document.getElementById("r-exists-"+pointing).innerHTML;
  var divi = document.getElementById("i-exists-"+pointing).innerHTML;

  // Set src and href of tabs according to clicked-on pointing.
  document.getElementById("img-calib").src = "images/" + pointing + "/checkplots/" + pointing + ".V0.5.7A_calib.jpg";
  document.getElementById("img-calib").style.width = '90%';
  document.getElementById("href-calib").href = "images/" + pointing + "/checkplots/" + pointing + ".V0.5.7A_calib.jpg";

  document.getElementById("img-coadd").src = "images/" + pointing + "/checkplots/" + pointing + ".V0.5.7A_coadds.jpg";
  document.getElementById("img-coadd").style.width = '60%';
  document.getElementById("href-coadd").href = "images/" + pointing + "/checkplots/" + pointing + ".V0.5.7A_coadds.jpg";

  document.getElementById("img-mags").src = "images/" + pointing + "/checkplots/" + pointing + ".V0.5.7A_mag.jpg";
  document.getElementById("img-coadd").style.height = '80%';
  document.getElementById("href-mags").href = "images/" + pointing + "/checkplots/" + pointing + ".V0.5.7A_mag.jpg";

  document.getElementById("img-masks").src = "images/" + pointing + "/checkplots/" + pointing + ".V0.5.7A_masks_final.jpg";
  document.getElementById("href-masks").href = "images/" + pointing + "/checkplots/" + pointing + ".V0.5.7A_masks_final.jpg";

  if((divr=='' && divi=='') || (divr=='_r' && divi=='')) {
    document.getElementById("div-psf-r").setAttribute('style', 'display:block;');
    document.getElementById("img-psf-1").src = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-0.jpg";
    document.getElementById("href-psf-1").href = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-0.jpg";
    document.getElementById("img-psf-2").src = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-1.jpg";
    document.getElementById("href-psf-2").href = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-1.jpg";
    document.getElementById("img-psf-3").src = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-2.jpg";
    document.getElementById("href-psf-3").href = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-2.jpg";
    document.getElementById("img-psf-4").src = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-3.jpg";
    document.getElementById("href-psf-4").href = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-3.jpg";
    document.getElementById("img-psf-5").src = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-4.jpg";
    document.getElementById("href-psf-5").href = "images/" + pointing + "/r_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-4.jpg";
  } else {
    document.getElementById("div-psf-r").setAttribute('style', 'display:none;');    
  }
  
  if((divr=='' && divi=='') || (divr=='' && divi=='_i')) {
    document.getElementById("div-psf-i").setAttribute('style', 'display:block;');
    document.getElementById("img-psf-6").src = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-0.jpg";
    document.getElementById("href-psf-6").href = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-0.jpg";
    document.getElementById("img-psf-7").src = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-1.jpg";
    document.getElementById("href-psf-7").href = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-1.jpg";
    document.getElementById("img-psf-8").src = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-2.jpg";
    document.getElementById("href-psf-8").href = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-2.jpg";
    document.getElementById("img-psf-9").src = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-3.jpg";
    document.getElementById("href-psf-9").href = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-3.jpg";
    document.getElementById("img-psf-10").src = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-4.jpg";
    document.getElementById("href-psf-10").href = "images/" + pointing + "/i_SDSS/precoadd_V0.5.7A/plots/PSFcheck/" + pointing + "-4.jpg";
  } else {
    document.getElementById("div-psf-i").setAttribute('style', 'display:none;');    
  }
  
  // Set the pointing of hidden div that holds which pointing was clicked on,
  // in order to pass info to submit.php.
  var divs = document.getElementsByClassName("pointing");
  
  for(var i = 0; i < divs.length; i++) {
    divs[i].value = pointing;
  }

  // Make clicked button disabled and the rest removeAttribute disabled.
  var buttons = document.getElementsByTagName("button");
  
  for(var i = 0; i < buttons.length; i++) {
    buttons[i].removeAttribute("disabled");
    buttons[i].style.removeProperty("background-color");// = 'transparent';
  }
  
  document.getElementById("butt-" + pointing).disabled = "true";

  // Set the background and font color of button of clicked-on pointing.
  document.getElementById("butt-"+pointing).style.backgroundColor = 'yellow';
  document.getElementById("butt-"+pointing).style.color = 'black';

  // Make table that shows PSF stats.
  document.getElementById("div-psf-stats").innerHTML = '<span style="font-weight:bold;">PSF stats:</span><br>';

  var table = '<table>\
    <tr><td>image</td>\
    <td>&lt;e1&gt;</td>\
    <td>&lt;e1&gt; SDEV</td>\
    <td>&lt;e2&gt;</td>\
    <td>&lt;e2&gt; SDEV</td>';
    
  if((divr=='' && divi=='') || (divr=='_r' && divi=='')) {
    for(var j = 1; j < 6; j++) {
      jS = j.toString();
      table += '<tr><td>r-' + j + '</td>';
      for(var e = 1; e < 3; e++) {
        eS = e.toString();
        value = document.getElementById("r_e"+eS+"_"+jS+"-"+pointing).innerHTML;
        valueF = Math.abs(value);
        if(valueF > 0.1) {
          table += '<td bgcolor="red"><font color="white">' + value + '</font></td>';
        } else {
          table += '<td>' + value + '</td>';
        }
  
        value = document.getElementById("r_e"+eS+"_SDEV_"+jS+"-"+pointing).innerHTML;
        valueF = Math.abs(value);
        if(valueF > 0.05) {
          table += '<td bgcolor="red"><font color="white">' + value + '</font></td>';
        } else {
          table += '<td>' + value + '</td>';
        }
      }
      table += '</tr>';
    }
  }

  if((divr=='' && divi=='') || (divr=='' && divi=='_i')) {
    for(var j = 1; j < 6; j++) {
      jS = j.toString();
      table += '<tr><td>i-' + j + '</td>';
      for(var e = 1; e < 3; e++) {
        eS = e.toString();
  
        value = document.getElementById("i_e"+eS+"_"+jS+"-"+pointing).innerHTML;
        valueF = Math.abs(value);
        if(valueF > 0.1) {
          table += '<td bgcolor="red"><font color="white">' + value + '</font></td>';
        } else {
          table += '<td>' + value + '</td>';
        }
  
        value = document.getElementById("i_e"+eS+"_SDEV_"+jS+"-"+pointing).innerHTML;
        valueF = Math.abs(value);
        if(valueF > 0.05) {
          table += '<td bgcolor="red"><font color="white">' + value + '</font></td>';
        } else {
          table += '<td>' + value + '</td>';
        }
      }
      table += '</tr>';
    }
  }
  
  table += '</table>';

  document.getElementById("div-psf-stats").innerHTML += table;

  // Set the pointing of div that shows clicked-on pointing on tabs.
  var divs = document.getElementsByClassName("div-current-pointing");

  for(var i = 0; i < divs.length; i++) {
    divs[i].innerHTML = pointing + divr + divi;
  }

  // Set the instructions, depending on if i and/or r is available.
  var divs = document.getElementsByClassName("div-instructions-tb");

  for(var i = 0; i < divs.length; i++) {
    divs[i].innerHTML = document.getElementById("div-hidden-instructions-tb-"+pointing).innerHTML;
  }

  var divs = document.getElementsByClassName("div-instructions-lr");

  for(var i = 0; i < divs.length; i++) {
    divs[i].innerHTML = document.getElementById("div-hidden-instructions-lr-"+pointing).innerHTML;
  }

  // Set to visible the tabs, that is, the page itself with plots.
  document.getElementById("tabs").setAttribute('style', 'display:block;');

}

// When window is loaded, show div with currently clicked on pointing.
// It's the div in each of the tabs with yellow background and black text.
window.onload = function() {
  var divs = document.getElementsByClassName("div-current-pointing");

  for(var i = 0; i < divs.length; i++) {
    divs[i].setAttribute('style', 'display:block;');
  }
}
