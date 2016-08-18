var dataObject;
var timeSkip;
var intro;
var title;
var win = window.location.href;
$(document).ready(function () {
    dataObject = null;

    time = setInterval(function () {

        if (window.location.href.search("watch") > 0) {
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
          var newTvName = "";
          if(tvName.search("/")>0 ||tvName.search("%")>0||tvName.search("\\")>0){
            for(var i=0; i<tvName.length; i++){
              if(tvName.charAt(i) === "/"||tvName.charAt(i) === "\\"||tvName.charAt(i) === "%"){
                newTvName += '_';
              } else {
                newTvName += tvName.charAt(i);
              }
            }
            tvName = newTvName;
          }
          title = tvName + "." + tvSeason + "." + tvEpisode;

          if ((title != "..")||(win!==currentWindow)) {
            dataObject = null;
              if (sessionStorage.getItem(title)) {
                  var dataPulled=sessionStorage.getItem(title).split(":");
                  timeSkip = parseInt(dataPulled[0]);
                  intro = parseInt(dataPulled[1]);
              }
              else {

                  if (dataObject == null) {
                      ajaxCall(title);
                  }
                  else {
                      timeSkip = parseInt(dataObject.start_time);
                      intro = parseInt(dataObject.duration);
                  }
              }
          }
            var skip = $("video").get(0).currentTime;
            var currentTime = parseInt(skip);

            if (currentTime >= timeSkip && currentTime < (timeSkip + intro) - 4) {
                window.open(window.location.href + "&t=" + (timeSkip + intro), "_self");
            }
        } else {
          console.log("Browsing");
        }


    }, 100);

});
function ajaxCall(title) {
    console.log(title);

    $.ajax({
        //url: 'https://localhost:8000/admin/intros/times/'+title,
        url: 'https://phplaravel-19273-43928-140812.cloudwaysapps.com/admin/intros/times/' + title,                  //the script to call to get data                      //you can insert url argumnets here to pass to api.php
        type: "GET",
        success: function (data)          //on recieve of reply
        {
            console.log("Success!");
            dataObject = $.parseJSON(data)
            sessionStorage.setItem(title, dataObject.start_time + ":" + dataObject.duration);

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
