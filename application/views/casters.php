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
        <button class="nav-link btn btn-sm btn-outline-primary mt-2" data-toggle="modal" data-target="#addCaster">
          <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z" />
            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z" />
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
          </svg>
          Add new</button>
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
                <button type="button" data-toggle="modal" v-on:click="select_casteId" data-target="#addMountpoint"
                  class="btn btn-sm btn-outline-secondary">New mountpoint</button>
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
                  <td>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox"
                        @change="mountpointStatusSwitcher(mountpoint, $event)" v-model="mountpoint.available">
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
          <h5 class="modal-title">New mountpoint</h5>
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
                <input class="form-check-input" name="nmea" type="checkbox" id="f_nmea">
                <label class="form-check-label" for="f_nmea">Require NMEA message from Client</label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-check-label mb-2" for="basepull">List of reference stations</label>
              <div class="border bg-light p-2" name="bases_id" id="basepull" style="height: 150px; overflow: auto;">
                <div v-for="item in stationsList" class="checkbox">
                  <label>
                    <input type="checkbox" name="mountpoints" v-model="checkedNames" v-on:click="newChecked" :value="item.id">
                    {{ item.mountpoint }}
                  </label>
                </div>
              </div>
              <a href="javascript:void(0)" v-on:click="selectAll(); newChecked();" class="font-weight-lighter">select
                all</a>
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