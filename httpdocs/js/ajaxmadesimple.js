
function gethttp() {
  var http_request = false;
  if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    http_request = new XMLHttpRequest();
  } else if (window.ActiveXObject) { // IE
    try {
      http_request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        http_request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {}
    }
  }
  if (!http_request) {
    alert("Giving up :( Cannot create an XMLHTTP instance");
    return false;
  } else {
    return http_request;
  }
}

function makePollspollRequest() {
  var http_request=gethttp();
  http_request.onreadystatechange = function() { alertPollspoll(http_request,true); };
  http_request.open('GET', 'modules/AjaxMadeSimple/requesthandler.php?module=Polls&method=ExecuteVote&pollid=2', true);
  http_request.send(null);
}

function PollspollFormSubmit(myform) {
  
	var radiochoices=document.getElementsByName('pollvotingchoice');
	var value0='';
	for(var i=0; i < radiochoices.length; i++) {
	  if (radiochoices[i].checked==1) {
	    value0=radiochoices[i].value;
	    break;
	  }
	}
  var field1=document.getElementById('vote');
  var value1=field1.value;
  

  var http_request=gethttp();
  http_request.onreadystatechange = function() { alertPollspoll(http_request,false); };

  http_request.open('GET', 'modules/AjaxMadeSimple/requesthandler.php?module=Polls&method=ExecuteVote&pollvotingchoice='+value0+'&vote='+value1+'&pollid=2', true);
  http_request.send(null);
  return false;
}

function alertPollspoll(http_request,refresh) {
  if (http_request.readyState == 4) {
    if (http_request.status == 200) {
      element=document.getElementById('pollcontent');
      element.innerHTML=http_request.responseText;
      h = element.scrollHeight;
      element.scrollTop = h;
      if (refresh) window.setTimeout('makePollspollRequest()',-1);
    } else {
      alert('There was a problem with the request.');
    };
  }
}

function gethttp() {
  var http_request = false;
  if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    http_request = new XMLHttpRequest();
  } else if (window.ActiveXObject) { // IE
    try {
      http_request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        http_request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {}
    }
  }
  if (!http_request) {
    alert("Giving up :( Cannot create an XMLHTTP instance");
    return false;
  } else {
    return http_request;
  }
}

function makePollspeekRequest() {
  var http_request=gethttp();
  http_request.onreadystatechange = function() { alertPollspeek(http_request,true); };
  http_request.open('GET', 'modules/AjaxMadeSimple/requesthandler.php?module=Polls&method=PeekPoll&pollid=2', true);
  http_request.send(null);
}

function PollspeekFormSubmit(myform) {
  
  var field0=document.getElementById('peek');
  var value0=field0.value;
  

  var http_request=gethttp();
  http_request.onreadystatechange = function() { alertPollspeek(http_request,false); };

  http_request.open('GET', 'modules/AjaxMadeSimple/requesthandler.php?module=Polls&method=PeekPoll&peek='+value0+'&pollid=2', true);
  http_request.send(null);
  return false;
}

function alertPollspeek(http_request,refresh) {
  if (http_request.readyState == 4) {
    if (http_request.status == 200) {
      element=document.getElementById('pollcontent');
      element.innerHTML=http_request.responseText;
      h = element.scrollHeight;
      element.scrollTop = h;
      if (refresh) window.setTimeout('makePollspeekRequest()',-1);
    } else {
      alert('There was a problem with the request.');
    };
  }
}

function gethttp() {
  var http_request = false;
  if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    http_request = new XMLHttpRequest();
  } else if (window.ActiveXObject) { // IE
    try {
      http_request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        http_request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {}
    }
  }
  if (!http_request) {
    alert("Giving up :( Cannot create an XMLHTTP instance");
    return false;
  } else {
    return http_request;
  }
}

function makePollsreturnRequest() {
  var http_request=gethttp();
  http_request.onreadystatechange = function() { alertPollsreturn(http_request,true); };
  http_request.open('GET', 'modules/AjaxMadeSimple/requesthandler.php?module=Polls&method=ReturnToPoll&pollid=2', true);
  http_request.send(null);
}

function PollsreturnFormSubmit(myform) {
  
  var field0=document.getElementById('returntovote');
  var value0=field0.value;
  

  var http_request=gethttp();
  http_request.onreadystatechange = function() { alertPollsreturn(http_request,false); };

  http_request.open('GET', 'modules/AjaxMadeSimple/requesthandler.php?module=Polls&method=ReturnToPoll&returntovote='+value0+'&pollid=2', true);
  http_request.send(null);
  return false;
}

function alertPollsreturn(http_request,refresh) {
  if (http_request.readyState == 4) {
    if (http_request.status == 200) {
      element=document.getElementById('pollcontent');
      element.innerHTML=http_request.responseText;
      h = element.scrollHeight;
      element.scrollTop = h;
      if (refresh) window.setTimeout('makePollsreturnRequest()',-1);
    } else {
      alert('There was a problem with the request.');
    };
  }
}
