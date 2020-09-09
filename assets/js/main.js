var app = new Vue({
  el: "#app",
  data: {
    map: null,
    tileLayer: null,
    layers: [],
    casters: [],
    stationsList: [],
    requireNmea: false,
    selectedStations: [],
  },
  mounted() {
    this.initMap();
    this.getAllStations();
    this.getAllCasters();
  },
  methods: {
    initMap() {
      if (document.getElementById("map") == null) return;

      this.map = L.map("map").setView([0, 0], 2);
      this.tileLayer = L.tileLayer(
        "https://cartodb-basemaps-{s}.global.ssl.fastly.net/rastertiles/voyager/{z}/{x}/{y}.png",
        {
          maxZoom: 18,
          attribution:
            '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, &copy; <a href="https://carto.com/attribution">CARTO</a>',
        }
      );
      this.tileLayer.addTo(this.map);
    },
    renderMap() {
      if (document.getElementById("map") == null) return;

      for (let station of this.stationsList) {
        if (station["lat"] != null && station["lon"] != null) {
          station["marker"] = L.marker([station["lat"], station["lon"]])
            .bindPopup("<b>" + station["name"] + "</b>")
            .addTo(this.map);
        }
      }
    },
   
    mountpointStatusSwitcher(mountpoint, event) {
      let input = event.currentTarget;

      let data = new FormData();
      data.append("id", mountpoint["id"]);
      data.append("status", mountpoint["available"]);

      axios
        .post("ajax/mountpoint/onOffMountpoint", data)
        .then((response) => {
          input.disabled = false;
        })
        .catch((error) => {
          input.disabled = false;
        });
    },
    addMountpoint() {
      let button = document.querySelector("#f_addmountpoint_submit");
      loading_btn(button);
      let form = document.getElementById("f_addmountpoint");
      let data = new FormData(form);
      data.delete('stations_id');
      data.append('stations_id', JSON.stringify(app.selectedStations));
      // clear error messages
      var list = document.querySelectorAll("#f_addmountpoint input");
      for (let item of list) item.classList.remove("is-invalid");

      list = document.querySelectorAll("#f_addmountpoint .invalid-feedback");
      for (let item of list) item.parentNode.removeChild(item);

      // post
      axios
        .post("ajax/mountpoint/addMountpoint", data)
        .then((response) => {
          if (response.data == "1") {
            form.reset();
            let modal = bootstrap.Modal.getInstance(
              document.getElementById("addMountpoint")
            );
            modal.hide();
          } else {
            for (let err in response.data) {
              if (response.data[err] === "") continue;
              let element = document.getElementsByName(err)[0];
              element.classList.add("is-invalid");
              element.insertAdjacentHTML("afterend", response.data[err]);
            }
          }

          original_btn(button);
        })
        .catch((error) => {
          console.log(error);
          original_btn(button);
        });
    },
    removeMountpoint(id){
      if (confirm("Do you really want to delete this mount point?")) {
        let data = new FormData();
        data.append("id", id);

        axios
          .post("ajax/mountpoint/removeMountpoint", data)
          .then((response) => {
            console.log(response.data);
            app.getAllCasters();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    // STATIONS
    getAllStations() {
      axios.post("ajax/station/getAllStations").then(function (response) {
        app.stationsList = response.data;
        app.renderMap();
      });
    },

    addStation() {
      let button = document.querySelector("#f_addstation_submit");
      loading_btn(button);
      let form = document.getElementById("f_addstation");
      let data = new FormData(form);

      // remove error messages
      var list = document.querySelectorAll("#f_addstation input");
      for (let item of list) item.classList.remove("is-invalid");

      list = document.querySelectorAll("#f_addstation .invalid-feedback");
      for (let item of list) item.parentNode.removeChild(item);

      // post
      axios
        .post("ajax/station/addStation", data)
        .then((response) => {
          if (response.data == "1") {
            form.reset();
            let modal = bootstrap.Modal.getInstance(
              document.getElementById("addStation")
            );
            modal.hide();
            app.stationsList();
          } else {
            for (let err in response.data) {
              console.log(response.data);
              if (response.data[err] === "") continue;
              let element = document.getElementsByName(err)[0];
              element.classList.add("is-invalid");
              element.insertAdjacentHTML("afterend", response.data[err]);
            }
          }
          original_btn(button);
        })
        .catch((error) => {
          console.log(error);
          original_btn(button);
        });
    },

    removeStation(id) {
      if (confirm("Do you really want to delete this station?")) {
        let data = new FormData();
        data.append("id", id);

        axios
          .post("ajax/station/removeStation", data)
          .then((response) => {
            console.log(response.data);
            app.getAllStations();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    // STATIONS
    // CASTERS
    getAllCasters() {
      axios.post("ajax/caster/getAllCasters").then(function (response) {
        app.casters = response.data;
      });
    },
    addCaster() {
      let button = document.querySelector("#f_addcaster_submit");
      loading_btn(button);
      let form = document.getElementById("f_addcaster");
      let data = new FormData(form);

      // clear error messages
      var list = document.querySelectorAll("#f_addcaster input");
      for (let item of list) item.classList.remove("is-invalid");

      list = document.querySelectorAll("#f_addcaster .invalid-feedback");
      for (let item of list) item.parentNode.removeChild(item);

      axios
        .post("ajax/caster/addCaster", data)
        .then((response) => {
          if (response.data == "1") {
            form.reset();

            let modal = bootstrap.Modal.getInstance(
              document.getElementById("addCaster")
            );
            modal.hide();
          } else {
            for (let err in response.data) {
              let element = document.getElementsByName(err)[0];
              element.classList.add("is-invalid");
              element.insertAdjacentHTML("afterend", response.data[err]);
            }
          }
          original_btn(button);
        })
        .catch((error) => {
          original_btn(button);
          console.log(error);
        });
    },
    removeCaster() {
      if (confirm("Do you really want to leave this station?")) {
        let id = document.querySelector("#v-pills-tab .active").dataset.id;
        let data = new FormData();
        data.append("id", id);

        axios
          .post("ajax/caster/removeCaster", data)
          .then((response) => {
            if (response.data == "1") {
              app.getAllCasters();
            } else {
              console.log(response);
            }
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    casterStatusSwitcher(key, event) {
      let input = event.currentTarget;
      // input.disabled = true;

      let caster = this.casters[key];
      let data = new FormData();
      data.append("casterid", caster["id"]);
      data.append("status", caster["status"]);

      axios
        .post("ajax/caster/onOffCaster", data)
        .then((response) => {
          // input.disabled = false;
        })
        .catch((error) => {
          console.log(error);
          // input.disabled = false;
        });
    },
    // CASTERS
  },
});

function loading_btn(button) {
  button.disabled = true;
  let text = button.getAttribute("data-loading");
  button.innerHTML =
    '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>' +
    text;
}
function original_btn(button) {
  button.disabled = false;
  let text = button.getAttribute("data-original");
  button.innerHTML = text;
}

//set class active
let links = document.querySelectorAll("#sidebarMenu a");
for (let link of links) {
  if (window.location.pathname.includes(link.getAttribute("href"))) {
    link.classList.add("active");
  }
}

