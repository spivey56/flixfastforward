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
	time=setInterval(function(){

		var tvLong = $("span").text();
		var locNum = tvLong.search("Season");
		var tvName = tvLong.slice(0, locNum);
		var tvSeason = tvLong.slice(locNum+7, locNum+8);
		var tvEpisode = tvLong.slice(locNum+14, locNum+15);	
		var skip = $("video").get(0).currentTime; 
		var time = parseInt(skip);
		var timeSkip = 115;//Get this from database
		var intro = 34; //call from database depending on tvName
		var toThisPoint = timeSkip+intro;
		
		
		if(time>=timeSkip && time<toThisPoint-1){
			if(!localStorage.getItem("skipped")) {
            	

					
						
				
                window.open(window.location.href + "&t=" + toThisPoint, "_self");
                localStorage.setItem("skipped", tvName+"."+tvSeason+"."+tvEpisode);
                var id = '#dialog';
						
					//Get the screen height and width
					var maskHeight = $(document).height();
					var maskWidth = $(window).width();
						
					//Set heigth and width to mask to fill up the whole screen
					$('#mask').css({'width':maskWidth,'height':maskHeight});

					//transition effect
					$('#mask').fadeIn(500);	
					$('#mask').fadeTo("slow",0.9);	
						
					//Get the window height and width
					var winH = $(window).height();
					var winW = $(window).width();
					              
					//Set the popup window to center
					$(id).css('top',  winH/2-$(id).height()/2);
					$(id).css('left', winW/2-$(id).width()/2);
						
					//transition effect
					$(id).fadeIn(2000); 	
						
					//if close button is clicked
					$('.window .close').click(function (e) {
					//Cancel the link behavior
					e.preventDefault();

					$('#mask').hide();
					$('.window').hide();
					});

					//if mask is clicked
					$('#mask').click(function () {
					$(this).hide();
					$('.window').hide();
					});
                
            }
		}

		console.log(time);

	},500);
});