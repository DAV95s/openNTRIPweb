<main id="app" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Casters</h1>
  </div>
  <div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a v-for="(caster, key) in casters" class="nav-link mt-1" :data-id="caster.id" data-toggle="pill" v-bind:href="'#body-'+key"
          :class="{ 'active': key === 0 }" role="tab">
          <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-hdd mr-1" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M14 9H2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM2 8a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2z" />
            <path d="M5 10.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
            <path fill-rule="evenodd"
              d="M4.094 4a.5.5 0 0 0-.44.26l-2.47 4.532A1.5 1.5 0 0 0 1 9.51v.99H0v-.99c0-.418.105-.83.305-1.197l2.472-4.531A1.5 1.5 0 0 1 4.094 3h7.812a1.5 1.5 0 0 1 1.317.782l2.472 4.53c.2.368.305.78.305 1.198v.99h-1v-.99a1.5 1.5 0 0 0-.183-.718L12.345 4.26a.5.5 0 0 0-.439-.26H4.094z" />
          </svg>
          Port: {{caster.port}}</a>
        <button class="nav-link btn btn-sm btn-outline-primary mt-2" v-on:click="addStation" data-toggle="modal" data-target="#addCaster">
          <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z" />
            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z" />
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
          </svg>
          Add new
        </button>
    
        <button class="nav-link btn btn-sm btn-outline-danger mt-2" v-on:click="removeCaster">
          <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
          </svg>
          Delete
        </button>
      </div>
    </div>
    <div class="col-10">
      <div class="tab-content" id="v-pills-tabContent">
        <div v-for="(caster, key) in casters" class="tab-pane fade show" :class="{ 'active': key === 0 }"
          v-bind:id="'body-'+key" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <div class="form-check form-switch">
              <label class="form-check-label"><input class="form-check-input" value="caster" type="checkbox"
                  v-model="caster.status" @change="casterStatusSwitcher(key, $event)"> On/Off caster
                :{{caster.port}}</label>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-1">
                <button type="button" data-toggle="modal" data-target="#addMountpoint"
                  class="btn btn-sm btn-outline-secondary">Add mountpoint</button>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="table-light">
                <tr>
                  <th scope="col">mountpoint</th>
                  <th scope="col">identifier</th>
                  <th scope="col">format</th>
                  <th scope="col">network</th>
                  <th scope="col">nmea</th>
                  <th scope="col">authentication</th>
                  <th scope="col">available</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="mountpoint in caster.mountpoints">
                  <th scope="row">
                    <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-dash" fill="currentColor"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M3.5 8a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.5-.5z" />
                    </svg>
                    {{mountpoint.mountpoint}}</th>
                  <td>{{mountpoint.identifier}}</td>
                  <td>{{mountpoint.format}}</td>
                  <td>{{mountpoint.network}}</td>
                  <td>{{mountpoint.nmea}}</td>
                  <td>{{mountpoint.authentication}}</td>
                  <td class="d-flex justify-content-between">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox"
                        @change="mountpointStatusSwitcher(mountpoint, $event)" v-model="mountpoint.available">
                    </div>
                    <div>
                    <button type="button" class="btn btn-sm btn-outline-primary">
                      <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                      <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                      </svg>
                    </button>
                    <button type="button" v-on:click="removeMountpoint(mountpoint.id)" class="btn btn-sm btn-outline-danger">
                      <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="bi bi-trash"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg>
                    </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addCaster" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new caster</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="f_addcaster">
            <div class="mb-3">
              <label for="fnc_port" class="form-label">Port</label>
              <input type="text" class="form-control" name="port" id="fnc_port">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="f_addcaster_submit" type="button" v-on:click="addCaster" class="btn btn-primary"
            data-loading="Loading..." data-original="Continue">Continue</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addMountpoint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add mountpoint</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="f_addmountpoint">
            <input type="hidden" name="caster_id" value="1">
            <div class="mb-3">
              <label for="f_mountpoint" class="form-label">Mountpoint</label>
              <input type="text" name="mountpoint" class="form-control" id="f_mountpoint">
            </div>
            <div class="mb-3">
              <label for="f_authentication" class="form-label">Authentication</label>
              <select id="f_authentication" name="authentication" class="form-select"
                aria-label="Default select example">
                <option selected value="None">None</option>
                <option value="Basic">Basic</option>
                <option disabled value="Digest">Digest</option>
              </select>
            </div>
            <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" v-model="requireNmea" name="nmea" type="checkbox" id="f_nmea">
                <label class="form-check-label" for="f_nmea">Require NMEA message from Client</label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-check-label mb-2" for="stationspull">List of reference stations</label>
              <select class="form-select" name="stations_id" v-model="selectedStations" id="stationspull" :multiple="requireNmea" aria-label="multiple select example">
                <option v-for="item in stationsList" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="f_addmountpoint_submit" class="btn btn-primary" v-on:click="addMountpoint"
            data-loading="Loading..." data-original="Continue">Continue</button>
        </div>
      </div>
    </div>
  </div>
</main>