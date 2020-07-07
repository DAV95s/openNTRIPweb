//Main object
var server = {
  stations: [],
  casters: [],
  mountpoints: [],
};

L.Icon.Default.imagePath = 'assets/images/';
//Map
var map = L.map("map").setView([0, 0], 1);
L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);
L.control.scale().addTo(map);

function mapPointUpdate() {
  server.stations.forEach(function(station){
    let coordinate = station['lla'].replace("POINT(", "").replace(")","");
    coordinate = coordinate.split(" ");
    L.marker([coordinate[0], coordinate[1]]).addTo(map);
  });
}

//Stations
function stationsListUpdate() {
  $("#stationsList").load("ajax/stationsList");
}
setInterval(stationsListUpdate(), 5000);

function stationsServerUpdate() {
  server.stations = JSON.parse(stationsData);
}

function renderStationModal(id) {
  $("#stationModelBody").load("ajax/stationModal/" + id);
}

//blink stations icon
var blinkIndicator = false;
setInterval(function () {
  if (blinkIndicator) {
    $(".station .on").each(function () {
      $(this).attr("src", "assets/icons8/icons8-online-f2.png");
      blinkIndicator = false;
    });
  } else {
    $(".station .on").each(function () {
      $(this).attr("src", "assets/icons8/icons8-online-f1.png");
      blinkIndicator = true;
    });
  }
}, 1000);