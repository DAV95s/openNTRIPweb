var obj = {
  addStation: function () {
    let btn = $("#form_addStations_accept");
    let form = $('#form_addStations');
    console.log(form.serialize());
    $.ajax({
      type: "POST",
      url: "ajax/addStations",
      data: form.serialize(),
      dataType: "json",
      beforeSend: function () {
        btn.prop("disabled", true);
        btn.html(btn.data("loadingText"));
      },
      success: function (data) {
        
      },
      complete: function () {
        btn.prop("disabled", false);
        btn.html(btn.data("originalText"));
      }      
    });
  },
  getStations: function() {
    $.ajax({
      type: "POST",
      url: "ajax/addStations",
      dataType: "json",
      beforeSend: function () {
        btn.prop("disabled", true);
        btn.html(btn.data("loadingText"));
      },
      success: function (data) {
        
      },
      complete: function () {
        btn.prop("disabled", false);
        btn.html(btn.data("originalText"));
      }      
    });
  }
};

const map = L.map("mapid", {
  center: [0.0, 0.0],
  zoom: 1,
});

L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);
L.control.scale().addTo(map);

function updateTableStation(array) {
  $('#tableStation tbody').empty();
  for (let i = 0; i < array.length; i++) {
    const el = array[i];
    $('#tableStation tbody').html('<tr><td>'+ el['mountpoint'] +'</td><td>'+ el['sourcetable'] +'</td> <td>'+ el['is_online'] +'</td></tr>');
  }
  
}