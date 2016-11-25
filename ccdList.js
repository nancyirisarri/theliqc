var fileList = [];
var urlList = [];
var mainURL = '';

function initialize() {

  // Get all img of CCD's to listen when user double clicks.
  var ccdImages = document.getElementsByClassName('ccdImg');

  for(var i=0; i < ccdImages.length; i++) {
    var ccdImage = ccdImages[i];

    ccdImage.addEventListener('contextmenu', addToFile);
  }

  // Simple line; store as variable, since used several times.
  var dividerLine = '<br><div class="divider-line"></div>';

  var js9 = document.getElementsByClassName('JS9');
  
  var newLeft = js9[0].offsetLeft + js9[0].offsetWidth + 150;

  // Create box to hold instructions and list of CCD's and append it to DOM.
  var div = document.createElement('div');
  div.id = 'ccds-box';
  div.className = 'nice-box';

  div.setAttribute('style', 'position:absolute;left:'+newLeft+'px;bottom:10%');

  document.body.appendChild(div);

  var ccdBox = document.getElementById('ccds-box');

  var div = document.createElement('div');
  div.className = 'title-style';
  div.innerHTML = 'Make list of chips';
  ccdBox.appendChild(div);

  // Create div with instructions text and append it to previous box.
  var div = document.createElement('div');
  div.id = 'keyInstructions';
  div.innerHTML = 'RIGHT CLICK+CONTROL KEY on a chip to add it to list<br>\
  RIGHT CLICK on any chip to show list contents<br>'
  div.style.fontWeight = 'bold';
  div.style.padding = '10px 10px';
  div.style.color = 'green';
  ccdBox.appendChild(div);

  var div = document.createElement('div');
  div.id = 'keyInstLine';
  div.innerHTML = dividerLine;
  ccdBox.appendChild(div);

  // Create section for showing the list contents.
  var div = document.createElement('div');
  div.id = 'showButton';
  div.innerHTML = '<span style="cursor:pointer"><img src="http://kids.strw.leidenuniv.nl/TheliQC/images/buttons/expandButton.jpg" width="20" height="20" border="0" alt="show" title="Show list"></span> Show list contents'
  div.style.fontWeight = 'bold';
  div.style.padding = '10px 10px';
  ccdBox.appendChild(div);

  // Create section for adding to the list and result of adding.
  var div = document.createElement('div');
  div.id = 'resultAdd';
  div.style.padding = '0px 10px 0px 10px';
  ccdBox.appendChild(div);

  var div = document.createElement('div');
  div.id = 'resultShow';
  div.style.padding = '0px 10px 0px 10px';
  ccdBox.appendChild(div);

  var div = document.createElement('div');
  div.id = 'showButtonLine';
  div.innerHTML = dividerLine;
  ccdBox.appendChild(div);

  resultHeight = document.getElementById('resultShow').clientHeight;

  // Create section for saving options.
  var div = document.createElement('div');
  div.id = 'saveButton';
  
  div.innerHTML = '<span style="cursor:pointer"><img src="http://kids.strw.leidenuniv.nl/TheliQC/images/buttons/emailButton.jpg" width="30" height="30" border="0" alt="save" title="Download list"></span> Send list by email to kids@strw.leidenuniv.nl<br>';
  div.style.fontWeight = 'bold';
  div.style.padding = '10px 10px';
  ccdBox.appendChild(div);

  var div = document.createElement('div');
  div.id = 'resultSave';
  div.style.padding = '0px 10px 0px 10px';
  ccdBox.appendChild(div);

  var div = document.createElement('div');
  div.id = 'iframeSubmit';
  div.style.padding = '0px 10px 0px 10px';

  var iframe = document.createElement('IFRAME');
  iframe.setAttribute('name', 'submit-results');
  iframe.setAttribute('id', 'submit-results');

  div.appendChild(iframe);

  ccdBox.appendChild(div);

  // Add listeners.
  document.getElementById('showButton').addEventListener('click', showFile);

  document.getElementById('saveButton').addEventListener('click', saveFileCcd);

  document.getElementById('resultSave').innerHTML = '';

  document.getElementById('resultAdd').innerHTML = '';

  if (fileList.length == 0) {
    document.getElementById('showButton').innerHTML = '<span style="cursor:pointer"><img src="http://kids.strw.leidenuniv.nl/TheliQC/images/buttons/expandButton.jpg" width="20" height="20" border="0" alt="show" title="Show list"></span> Show list contents'
    document.getElementById('resultShow').innerHTML = '';
    document.getElementById('resultShow').style.height = resultHeight;
  }

}

function addToFile(event) {
  event.preventDefault();

  if (event.ctrlKey) {
	  var ccdImgSrc = event.target.id;

	  // Keep the URL of the clicked-on chip.
	  if (urlList.indexOf(ccdImgSrc) == -1) {
	    urlList[urlList.length] = ccdImgSrc;
	  }

      mainURL = ccdImgSrc;
	  
      ccdImgSrc = ccdImgSrc.split('/');

	  var toKeep = ccdImgSrc.pop();

      mainURL = mainURL.replace(toKeep, '');

	  var resultAdd = document.getElementById('resultAdd');
	  resultAdd.innerHTML = '';

	  document.getElementById('resultSave').innerHTML = '';

	  if (fileList.indexOf(toKeep) == -1) {
	    fileList[fileList.length] = toKeep;

	    resultAdd.style.color = 'black';
	    resultAdd.innerHTML = toKeep + ' added to list' + '<br>';

	    var showButton = document.getElementById('showButton');
	    showButton.innerHTML = '<span style="cursor:pointer"><img src="http://kids.strw.leidenuniv.nl/TheliQC/images/buttons/expandButton.jpg" width="20" height="20" border="0" alt="show" title="Show list"></span> Show list contents'

	    var resultShow = document.getElementById('resultShow');
	    resultShow.innerHTML = '';
	    resultShow.style.height = resultHeight;
	  } else {
	    resultAdd.style.color = 'red';
	    resultAdd.innerHTML = toKeep + ' already in list' + '<br>';
	  }
  } else {
	  showFile();
  }

  return false;
}

function showFile() {
  var resultShow = document.getElementById('resultShow');
  resultShow.innerHTML = '';
  resultShow.style.lineHeight = '2';

  document.getElementById('resultSave').innerHTML = '';
  document.getElementById('showButton').innerHTML = '<img src="http://kids.strw.leidenuniv.nl/TheliQC/images/buttons/expandButton.jpg" width="20" height="20" border="0" alt="show" > List contents'

  if (fileList.length > 0) {
    resultShow.style.color = 'black';
    document.getElementById('resultAdd').innerHTML = '';

    for (var i = 0; i < fileList.length; i++) {
      resultShow.innerHTML += i+1 + '. ' + fileList[i];
      resultShow.innerHTML += '   <span style="cursor:pointer"><img onclick="removeChip(' + "'" + fileList[i] + "'" + ');" src="http://kids.strw.leidenuniv.nl/TheliQC/images/buttons/removeButton.jpg" width="15" height="15" border="0" alt="remove" title="Remove ' + fileList[i] + '"></span><br>';
    }

    resultShow.style.height = '100px';
    resultShow.style.overflowY = 'auto';

  } else {
    resultShow.style.color = 'red';
    resultShow.innerHTML = 'No contents' + '<br>';
    resultShow.style.height = '20px';
  }
}

function removeChip(chip) {

  // Remove chip from file list.
  var index = fileList.indexOf(chip);

  if (index > -1) {
    fileList.splice(index, 1);
  }

  // Remove chip for URL list.
  var chipUrl = mainURL + chip;

  var index = urlList.indexOf(chipUrl);

  if (index > -1) {
    urlList.splice(index, 1);
  }

  showFile();
}

function saveFileCcd() {

  if (urlList.length > 0) {

    var div = document.getElementById('iframeSubmit');

    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'http://kids.strw.leidenuniv.nl/TheliQC/mail.php');
    form.setAttribute('target', 'submit-results');
      
    var i = document.createElement('input');
    i.setAttribute('type', 'text');
    i.setAttribute('name', 'ccdsInput');
    i.setAttribute('value', urlList);
    i.setAttribute('hidden', true);

    form.appendChild(i);

    var i = document.createElement('input');
    i.setAttribute('type', 'text');
    i.setAttribute('name', 'urlInput');
    i.setAttribute('value', window.location.href);
    i.setAttribute('hidden', true);

    form.appendChild(i);

    div.appendChild(form);
    
    form.submit();

  } else {
    document.getElementById('resultSave').style.color = 'red';
    document.getElementById('resultShow').innerHTML = '';
    document.getElementById('resultSave').innerHTML = 'No contents to send';
    document.getElementById('showButton').innerHTML = '<span style="cursor:pointer"><img src="http://kids.strw.leidenuniv.nl/TheliQC/images/buttons/expandButton.jpg" width="20" height="20" border="0" alt="show" title="Show list"></span> Show list contents'
    document.getElementById('resultShow').style.height = resultHeight;
  }
}

window.onload = initialize;
