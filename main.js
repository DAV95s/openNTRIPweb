var vv = new Vue({
  el: "#app",
  data: { 
    message: "hellow vuejs",
    server_status: {},
    stations: {}
  },
  methods: {
    sign_out: function() {
      document.cookie = "SESSION_KEY=0";
    },
    mapPointsRender : function(){
      for(station of this.stations){
        L.marker([station.latitude, station.longitude]).addTo(map).bindPopup(station.mountpoint)
        .openPopup();;
      }
    }
  },
  mounted() {
    axios.get("ajax/stations").then((response) => {
      this.stations = response.data;
      this.mapPointsRender();
    });
    
  }
});
const map = L.map('mapid', {
  center: [0.0, 0.0],
  zoom: 1,
});

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
L.control.scale().addTo(map);