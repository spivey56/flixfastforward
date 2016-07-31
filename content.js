/*
 window.onload = function () {
 document.getElementsByTagName('video').addEventListener('loadedmetadata', function() {
 this.currentTime = 50;
 console.log("Made it fucker");
 }, false);
 }

 */

$(document).ready(function () {

    jQuery(document).delegate('video', 'DOMNodeInserted', function () {

        $('video').bind('play', function (e) {
            alert('hey');
            var video = $("video").eq(0)[0];
            console.log(video);
            console.log(video.currentTime);

            video.currentTime=360;


        });

    });



});