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

            if(!localStorage.getItem("skipped")) {

                var skipTime = 1000;

                window.open(window.location.href + "&t=" + skipTime, "_self");

                localStorage.setItem("skipped", "FullHouse");

            }


        });

    });


});