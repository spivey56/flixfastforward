/*
 window.onload = function () {
 document.getElementsByTagName('video').addEventListener('loadedmetadata', function() {
 this.currentTime = 50;
 console.log("Made it fucker");
 }, false);
 }

 */

$(document).ready(function () {
    $(document).on("loadedmetadata", function () {
        this.currentTime = 50;
        console.log("Made it fucker");
    });
    
});