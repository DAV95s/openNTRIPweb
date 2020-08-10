var app = new Vue({
  el: "#app",
  data: {
    map: null,
    tileLayer: null,
    layers: [],
    casters: [],
    stationsList: [],
    checkedNames: [],
  },
  mounted() {
    this.initMap();
    this.getStations();
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
            .bindPopup("<b>" + station["mountpoint"] + "</b>")
            .addTo(this.map);
        }
      }
    },
    select_casteId(){
      //replace caster_id in form "New mountpoint"
      let input = document.querySelector("#f_addmountpoint [name='caster_id']");
      let active = document.querySelector("#v-pills-tab .active").dataset.id;
      input.value = active;
    },
    casterStatusSwitcher(key, event) {
      let input = event.currentTarget;
      input.disabled = true;

      let caster = this.casters[key];
      let data = new FormData();
      data.append("casterid", caster["id"]);
      data.append("status", caster["status"]);

      axios
        .post("ajax/onOffCaster", data)
        .then((response) => {
          input.disabled = false;
        })
        .catch((error) => {
          console.log(error);
          input.disabled = false;
        });
    },
    mountpointStatusSwitcher(mountpoint, event) {
      let input = event.currentTarget;
      input.disabled = true;

      let data = new FormData();
      data.append("id", mountpoint["id"]);
      data.append("status", mountpoint["available"]);

      axios
        .post("ajax/onOffMountpoint", data)
        .then((response) => {
          input.disabled = false;
        })
        .catch((error) => {
          input.disabled = false;
        });
    },
    selectAll() {
      let pool = document.querySelectorAll("[name='mountpoints']");
      let indicator = 0;
      for (input of pool) {
        if (!input.checked) {
          input.checked = true;
          this.checkedNames.push(input.value);
          indicator++;
        }
      }
      if (indicator === 0) {
        for (input of pool) {
          input.checked = false;
          removeElement(this.checkedNames, input.value);
        }
      }
    },
    newChecked() {
      let checked = document.querySelectorAll("[name='mountpoints']:checked");
      if (checked.length > 1) {
        document.getElementById("f_nmea").checked = true;
      }
    },
    addMountpoint() {
      let button = document.querySelector("#f_addmountpoint_submit");
      loading_btn(button);
      let form = document.getElementById("f_addmountpoint");
      let data = new FormData(form);
      data.append("list", JSON.stringify(this.checkedNames));
      // clear error messages
      var list = document.querySelectorAll("#f_addmountpoint input");
      for (let item of list) item.classList.remove("is-invalid");

      list = document.querySelectorAll("#f_addmountpoint .invalid-feedback");
      for (let item of list) item.parentNode.removeChild(item);

      // post
      axios
        .post("ajax/addMountPoint", data)
        .then((response) => {
          if (response.data == "OK") {
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
    getStations() {
      axios.post("ajax/stationsList").then(function (response) {
        app.stationsList = response.data;
        app.renderMap();
      });
    },
    addStation() {
      let button = document.querySelector("#f_addstation_submit");
      loading_btn(button);
      let form = document.getElementById("f_addstation");
      let data = new FormData(form);

      // clear error messages
      var list = document.querySelectorAll("#f_addstation input");
      for (let item of list) item.classList.remove("is-invalid");

      list = document.querySelectorAll("#f_addstation .invalid-feedback");
      for (let item of list) item.parentNode.removeChild(item);

      // post
      axios
        .post("ajax/addStation", data)
        .then((response) => {
          if (response.data == "OK") {
            form.reset();
            let modal = bootstrap.Modal.getInstance(
              document.getElementById("addStation")
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
    getAllCasters() {
      axios.post("ajax/getCasters").then(function (response) {
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
        .post("ajax/addCaster", data)
        .then((response) => {
          if (response.data == "OK") {
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

function removeElement(arr, el) {
  for (var i = 0; i < arr.length; i++) {
    if (arr[i] === el) {
      arr.splice(i, 1);
      return;
    }
  }
}
