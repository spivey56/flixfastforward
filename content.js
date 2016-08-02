/*
 $(document).ready(function () {


 jQuery(document).delegate('video', 'DOMNodeInserted', function () {

 $('video').bind('play', function (e) {

 if(!localStorage.getItem("skipped")) {

 var skipTime = 1000;

 window.open(window.location.href + "&t=" + skipTime, "_self");

 localStorage.setItem("skipped", "FullHouse");



 }


 });

 });


 });
 */
$(document).ready(function () {
    localStorage.clear();
    time = setInterval(function () {

        var tvLong = $("span").text();
        var locNum = tvLong.search("Season");
        var tvName = tvLong.slice(0, locNum);
        var tvSeason = tvLong.slice(locNum + 7, locNum + 8);
        var tvEpisode = tvLong.slice(locNum + 14, locNum + 15);
        var skip = $("video").get(0).currentTime;
        var time = parseInt(skip);
        var timeSkip = 115;//Get this from database
        var intro = 34; //call from database depending on tvName
        var toThisPoint = timeSkip + intro;

        if (time >= timeSkip && time < toThisPoint - 1) {
            if (!localStorage.getItem("skipped")) {

                $.ajax({
                  url: window.location.href + "&t=" + toThisPoint,
                  type: 'GET',
                  success:function(){
                    console.log("ran get request")
                  },
                  error:function(error){
                    console.log(error);
                  }

                });

                //window.open(window.location.href + "&t=" + toThisPoint, "_self");
                localStorage.setItem("skipped", tvName + "." + tvSeason + "." + tvEpisode);
                var id = '#dialog';

            }
        }

        console.log(time);

    }, 500);
});
