var dataObject = null;
var goneIn = false;
$(document).ready(function () {
  var timeSkip = "";
  var intro = "";
  time = setInterval(function () {
    var currentWindow = window.location.href;
    if (dataObject != null) {
      //console.log(dataObject)
      timeSkip = parseInt(dataObject.start_time);
      intro = parseInt(dataObject.duration);
    }
    else {
      console.log("NULL DATAOBJ: " + dataObject);
    }
    var toThisPoint = timeSkip + intro;
    var tvLong = $("span").text();
    var locNum = tvLong.search("Season");
    var tvName = tvLong.slice(0, locNum);
    if (tvLong.slice(locNum + 8, locNum + 9) === ":") {
      var tvSeason = tvLong.slice(locNum + 7, locNum + 8);
    } else {
      var tvSeason = tvLong.slice(locNum + 7, locNum + 9);
    }
    var locEp = tvLong.search("Ep.");
    var isInt = tvLong.slice(locEp + 5, locEp + 6);

    //if isInt is not a number
    if (isNaN(isInt)) {
      var tvEpisode = tvLong.slice(locEp + 4, locEp + 5);
    } else { //if it is a number
      var tvEpisode = tvLong.slice(locEp + 4, locEp + 6);
    }
    var title = tvName + "." + tvSeason + "." + tvEpisode;
    if (title !== ".." && !goneIn) {
      ajaxCall(title);
    }

    console
    if (currentWindow === "https://www.netflix.com/browse") {
      console.log("Browsing");
    }
    else {
      var skip = $("video").get(0).currentTime;
      var time = parseInt(skip);

      if (time >= timeSkip && time < toThisPoint - 1) {
        var shouldLoad = currentWindow.search("&t=");
        if (shouldLoad > 0) {
          window.open(window.location.href, "_self");
        } else {
          window.open(window.location.href + "&t=" + toThisPoint, "_self");
        }
      }
    }

  }, 500);

});
function ajaxCall(title) {
  console.log("MADE IT");
  //-----------------------------------------------------------------------
  // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
  //-----------------------------------------------------------------------
  $.ajax({
    //url: 'https://localhost:8000/admin/intros/times/'+title,
    url: 'https://phplaravel-19273-43928-140812.cloudwaysapps.com/admin/intros/times/' + title,                  //the script to call to get data                      //you can insert url argumnets here to pass to api.php
    type: "GET",                                 //for example "id=5&parent=6"
    success: function (data)          //on recieve of reply
    {
      console.log("Success!");
      dataObject = $.parseJSON(data);
      goneIn = true;
      //localStorage.setItem("skipTime", dataObject.start_time);
      //localStorage.setItem("skipDuration", dataObject.duration);
      //console.log(localStorage.getItem("skipDuration"));
      //console.log(localStorage.getItem("skipTime"));

    },
    // start snippet
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      console.log("ERROR has occurred.");
      if (XMLHttpRequest.readyState == 4) {
        // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)

        console.log("HTTP ERROR " + textStatus);
      }
      else if (XMLHttpRequest.readyState == 0) {
        // Network error (i.e. connection refused, access denied due to CORS, etc.)
        console.log("CORS Error " + textStatus);
      }
      else {
        // something weird is happening
        console.log("Something weird is happening!");
      }
    }
    //end snippet
  });
}
