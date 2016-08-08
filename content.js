$(document).ready(function () {
  time = setInterval(function(){
    var currentWindow = window.location.href;
    var timeSkip = 115;//Get this from database
    var intro = 34; //call from database depending on tvName
    var toThisPoint = timeSkip + intro;
    var tvLong = $("span").text();
    var locNum = tvLong.search("Season");
    var tvName = tvLong.slice(0, locNum);
    var tvSeason = tvLong.slice(locNum + 7, locNum + 8);
    var tvEpisode = tvLong.slice(locNum + 14, locNum + 15);
    currentWindow.toString();
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
          localStorage.setItem("skipped", tvName + "." + tvSeason + "." + tvEpisode);
          }
  }
          console.log(time);

      }, 500);

});
