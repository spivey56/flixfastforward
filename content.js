/*
$(document).ready(function () {


    jQuery(document).delegate('video', 'DOMNodeInserted', function () {

        $('video').bind('play', function (e) {

            


        });

    });


});
*/
	localStorage.clear();
	time=setInterval(function(){
		var time = $("label").text();
		var tvLong = $("span").text();
		var locNum = tvLong.search("Season");
		var tvName = tvLong.slice(0, locNum);
		var tvSeason = tvLong.slice(locNum+7, locNum+8);
		var tvEpisode = tvLong.slice(locNum+14, locNum+15);	
		
		if(time==="19:18"){
			if(!localStorage.getItem("skipped")) {
                var skip = $("video").get(0).currentTime; 
                var num = parseInt(skip);
                num += 34;
                window.open(window.location.href + "&t=" + num, "_self");
                localStorage.setItem("skipped", tvName+"."+tvSeason+"."+tvEpisode);
            }
		}

		console.log(time);

	},500);
