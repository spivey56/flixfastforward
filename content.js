$(document).ready(function() {

  var tvLong = $("span").text();
  var locNum = tvLong.search("Season");
  var tvName = tvLong.slice(0, locNum);
  var tvSeason = tvLong.slice(locNum + 7, locNum + 8);
  var tvEpisode = tvLong.slice(locNum + 14, locNum + 15);
  var skipTime = 300;

    if (!window.location.hash) {
        window.open(window.location.href + "&t=" + skipTime + "#skipped", "_self");
    }
    else{

      console.log('gets to else');

      //$("video").bind("play", function(e) {
          time = setInterval(function() {

              var skip = $("video").get(0).currentTime;
              var time = parseInt(skip);
              var beforeIntro = 250; //Get this from database
              var intro = 50; //call from database depending on tvName
              var toThisPoint = beforeIntro + intro;

              console.log(toThisPoint);

              if (time >= beforeIntro && time < toThisPoint-1) {
                  console.log("skippedIntro")
                  window.open(window.location.href + "&t=" + toThisPoint + "#skipped", "_self");
              }

              console.log(time);

          }, 500);
      //});
    }

});
