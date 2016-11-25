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

  // Set the background color of the buttons with pointings, according
  // to the value of the inspected_<tab> comments in the database:
  // green = all tabs inspected or submitted as good; red = not inspected.
  // The actual color is stored in hidden div that is created by php when the
  // database is queried.
  var divs = document.getElementsByClassName('div-inspection');

  for(var i = 0; i < divs.length; i++) {
    var divPointing = "div-inspection-" + divs[i].getAttribute('name');
    var buttonColor = document.getElementById(divPointing).innerHTML;

    document.getElementById("butt-"+divs[i].getAttribute('name')).style.backgroundColor = buttonColor;
    document.getElementById("butt-"+divs[i].getAttribute('name')).style.color = 'white';
  }

  // Set the background color of the Submit to Edinburgh button, according
  // to the value of this comment in the database: green = has been clicked
  // on; red = has not been clicked on. The actual color is stored in hidden
  // div that is created by php when the database is queried.
  // If button is green, set as disabled. Else set as enabled.
  var buttonColor = document.getElementById("div-edinburgh-" + pointing).innerHTML;
  
  document.getElementById("submit_to_edinburgh").style.backgroundColor = buttonColor;
  
  if(document.getElementById("div-edinburgh-" + pointing).innerHTML == 'green') {
    document.getElementById("submit_to_edinburgh").disabled = true;
    document.getElementById("submit_to_edinburgh").style.color = 'grey';
  } else {
    document.getElementById("submit_to_edinburgh").disabled = false;
    document.getElementById("submit_to_edinburgh").style.color = 'white';
  }

  // Set the background and font color of button of clicked-on pointing.
  document.getElementById("butt-"+pointing).style.backgroundColor = 'yellow';
  document.getElementById("butt-"+pointing).style.color = 'black';

  // Make clicked button disabled and the rest removeAttribute disabled.
  var buttons = document.getElementsByTagName("button");
  
  for(var i = 0; i < buttons.length; i++) {
    buttons[i].removeAttribute("disabled");
  }
  
  document.getElementById("butt-" + pointing).disabled = "true";

  // Remove all checked checkboxes and text from textboxes.
  var checkboxes = document.getElementsByTagName('input');
  for(var i = 0; i < checkboxes.length; i++) {
    if(checkboxes[i].getAttribute('type') == 'checkbox') {
      checkboxes[i].checked = false;
    } else if(checkboxes[i].getAttribute('type') == 'text') {
      checkboxes[i].value = '';
    }
  }

  // Fill-in divs with already submitted comments, which are stored in hidden
  // divs created by php when database is queried.
  var divPointings = ["div-calib-", "div-coadd-", "div-mags-", "div-psf-"];
  
  var divResults = ["submit-results-calib", "submit-results-coadd", "submit-results-mags", "submit-results-psf"]
  
  for(var i=0; i<divPointings.length; i++) {
    var commentsAlready = '<span style="color:green; font-family: arial; font-size: large">' + document.getElementById(divPointings[i]+pointing).innerHTML + '</span>';
    
    var div = document.getElementById(divResults[i]);
    div.contentWindow.document.open();
    div.contentWindow.document.write(commentsAlready);
    div.contentWindow.document.close();
  }

  //remove message if previously clicked on pointing was submitted to edinburgh
  var div = document.getElementById("submit-results-edinburgh");
  div.contentWindow.document.open();
  div.contentWindow.document.write("");
  div.contentWindow.document.close();

  //make table that shows PSF stats
  document.getElementById("div-psf-stats").innerHTML = '<span style="font-weight:bold;">PSF stats:</span><br>';

  var table = '<table>\
    <tr><td>image</td>\
    <td>&lt;e1&gt;</td>\
    <td>&lt;e1&gt; SDEV</td>\
    <td>&lt;e2&gt;</td>\
    <td>&lt;e2&gt; SDEV</td>';

  if((divr=='' && divi=='') || (divr=='_r' && divi=='')) {
    for(var j = 1; j < 6; j++) {
      var jS = j.toString();
  
      table += '<tr><td>r-' + j + '</td>';
  
      for(var e = 1; e < 3; e++) {
        var eS = e.toString();
        var value = document.getElementById("r_e"+eS+"_"+jS+"-"+pointing).innerHTML;
        var valueF = Math.abs(value);
  
        if(valueF > 0.1) {
          table += '<td bgcolor="red"><font color="white">' + value + '</font></td>';
        } else {
          table += '<td>' + value + '</td>';
        }
  
        var value = document.getElementById("r_e"+eS+"_SDEV_"+jS+"-"+pointing).innerHTML;
        var valueF = Math.abs(value);
  
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
      var jS = j.toString();
      
      table += '<tr><td>i-' + j + '</td>';
      
      for(var e = 1; e < 3; e++) {
        var eS = e.toString();
        var value = document.getElementById("i_e"+eS+"_"+jS+"-"+pointing).innerHTML;
        var valueF = Math.abs(value);
  
        if(valueF > 0.1) {
          table += '<td bgcolor="red"><font color="white">' + value + '</font></td>';
        } else {
          table += '<td>' + value + '</td>';
        }
  
        var value = document.getElementById("i_e"+eS+"_SDEV_"+jS+"-"+pointing).innerHTML;
        var valueF = Math.abs(value);
  
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

  //set the instructions, depending on if i and/or r is available.
  var divs = document.getElementsByClassName("div-instructions-tb");
  for(var i = 0; i < divs.length; i++) {
    divs[i].innerHTML = document.getElementById("div-hidden-instructions-tb-"+pointing).innerHTML;
  }
  var divs = document.getElementsByClassName("div-instructions-lr");
  for(var i = 0; i < divs.length; i++) {
    divs[i].innerHTML = document.getElementById("div-hidden-instructions-lr-"+pointing).innerHTML;
  }

  // Set the pointing of div that shows clicked-on pointing on tabs.
  var divs = document.getElementsByClassName("div-current-pointing");

  for(var i = 0; i < divs.length; i++) {
    divs[i].innerHTML = pointing + divr + divi;
  }

  // Set to visible the tabs, that is, the page itself with plots.
  document.getElementById("tabs").setAttribute('style', 'display:block;');
  
  // Set to visible the help documents.
  var helpDocs = document.getElementById("div-help-docs");
  helpDocs.setAttribute('style', 'display:block;');
  helpDocs.marginLeft = 'auto'; 
  helpDocs.marginRight = 'auto'; 
  helpDocs.style.fontSize = '16pt'; 
  helpDocs.style.fontWeight = 'bold'; 
}

//change color of submit_to_edinburgh hidden div if user clicks on it
function clickEdinburgh() {
  var color = document.getElementById("submit_to_edinburgh").style.backgroundColor;

  if (color == 'red') {
    document.getElementById("formEdinburgh").submit();
    document.getElementById("submit_to_edinburgh").style.color = 'grey';
    document.getElementById("submit_to_edinburgh").style.backgroundColor = 'green';
  };
}

// Listen for clicks on the help icons (which are the question mark images inside
// the 'Choose issues' boxes) and open the corresponding help page.
document.getElementById("img-help-calib").addEventListener("click", function() {
  document.getElementById("iframe-help-calib").setAttribute('style', 'display:block; position:absolute; left:20%; top:1%; zIndex:100;');
  document.getElementById("iframe-help-calib").contentWindow.document.body.style.color='white';
});

document.getElementById("img-help-coadd").addEventListener("click", function() {
  document.getElementById("iframe-help-coadd").setAttribute('style', 'display:block; position:absolute; left:20%; top:1%; zIndex:100;');
  document.getElementById("iframe-help-coadd").contentWindow.document.body.style.color='white';
});

document.getElementById("img-help-mags").addEventListener("click", function() {
  document.getElementById("iframe-help-mags").setAttribute('style', 'display:block; position:absolute; left:20%; top:1%; zIndex:100;');
  document.getElementById("iframe-help-mags").contentWindow.document.body.style.color='white';
});

document.getElementById("img-help-psf").addEventListener("click", function() {
  document.getElementById("iframe-help-psf").setAttribute('style', 'display:block; position:absolute; left:20%; top:1%; zIndex:100;');
  document.getElementById("iframe-help-psf").contentWindow.document.body.style.color='white';
});

// When window is loaded, show div with currently clicked on pointing.
// It's the div in each of the tabs with yellow background and black text.
window.onload = function() {
  var divs = document.getElementsByClassName("div-current-pointing");

  for(var i = 0; i < divs.length; i++) {
    divs[i].setAttribute('style', 'display:block;');
  }
}
