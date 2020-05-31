var map = L.map('map').setView([51.505, -0.09], 13);
L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);
L.control.scale().addTo(map);

//update stations list
function stationsListUpdate() {
  $('#stationsList').load('ajax/stationsList');
}
setInterval(stationsListUpdate(),5000);

//blink stations icon
var blinkIndicator = false;
setInterval(function () {
  if(blinkIndicator){
    $('.station .on').each(function() {
      $(this).attr("src", "assets/icons8/icons8-online-f2.png");
      blinkIndicator = false;
    });
  }else{
    $('.station .on').each(function() {
      $(this).attr("src", "assets/icons8/icons8-online-f1.png");
      blinkIndicator = true;
    });
  }
},1000);

//station modal
function stationModalUpdate(id){
  $('#stationModalbody').load('ajax/stationModal/'+id);
}