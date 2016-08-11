$(document).ready(function () {
  var goneIn = false;
  time = setInterval(function(){
    var currentWindow = window.location.href;
    var timeSkip = 115;//Get this from database
    var intro = 34; //call from database depending on tvName
    var toThisPoint = timeSkip + intro;
    var tvLong = $("span").text();
    var locNum = tvLong.search("Season");
    var tvName = tvLong.slice(0, locNum);
    if(tvLong.slice(locNum + 8, locNum + 9)===":"){
      var tvSeason = tvLong.slice(locNum + 7, locNum + 8);
    } else {
      var tvSeason = tvLong.slice(locNum + 7, locNum + 9);
    }
    var locEp = tvLong.search("Ep.");
    var isInt = tvLong.slice(locEp+1, locEp + 2);
    var epNum = parseInt(isInt);

    if (Number.isInteger(epNum)) {
      var tvEpisode = tvLong.slice(locNum + 14, locNum + 15);
    } else {
      var tvEpisode = tvLong.slice(locNum + 14, locNum + 16);
    }
    console.log(tvLong.slice(locNum + 15, locNum + 16));
    var title = tvName + "." + tvSeason + "." + tvEpisode;
    console.log(goneIn);
    if(true){
      goneIn = true;
      ajaxCall(title);
    }
    console.log(title);
    if(currentWindow==="https://www.netflix.com/browse"){
      console.log("Browsing");
    } else {
      localStorage.clear();
      var skip = $("video").get(0).currentTime;
      var time = parseInt(skip);
      if (time >= timeSkip && time < toThisPoint - 1) {
        if (!localStorage.getItem("skipped")) {
			var shouldLoad = currentWindow.search("&t=");
			if(shouldLoad>0){
				window.open(window.location.href, "_self");
			} else {
				window.open(window.location.href + "&t=" + toThisPoint, "_self");
			}
			document.getElementById("loading").style.display = "none"
            localStorage.setItem("skipped", tvName + "." + tvSeason + "." + tvEpisode);
            }
          }
  }
          console.log(time);

      }, 500);

});
function ajaxCall(title) {
  console.log("MADE IT");
    //-----------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-----------------------------------------------------------------------
    $.ajax({
      url: 'admin/intros/times/'+title,                  //the script to call to get data
      data: "",                        //you can insert url argumnets here to pass to api.php
      type: "GET",                                 //for example "id=5&parent=6"
      dataType: 'json',                //data format
      success: function(data)          //on recieve of reply
      {
        console.log(data);

      },
      error: function (error) {
        console.log(error);
      }
    });
  }
