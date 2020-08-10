<main id="app" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Reference stations</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-1">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#addStation">Add new</button>
      </div>
    </div>
  </div>
  
  <div class="row row-cols-1 row-cols-xs-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-4 g-3">
    <div class="col" v-for="station in stationsList">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">
            <svg v-if="station.is_online === 'true'" width="35px" height="35px" viewBox="0 0 16 16" class="bi bi-wifi" fill="green" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.385 6.115a.485.485 0 0 0-.048-.736A12.443 12.443 0 0 0 8 3 12.44 12.44 0 0 0 .663 5.379a.485.485 0 0 0-.048.736.518.518 0 0 0 .668.05A11.448 11.448 0 0 1 8 4c2.507 0 4.827.802 6.717 2.164.204.148.489.13.668-.049z"/>
              <path d="M13.229 8.271c.216-.216.194-.578-.063-.745A9.456 9.456 0 0 0 8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065A8.46 8.46 0 0 1 8 7a8.46 8.46 0 0 1 4.577 1.336c.205.132.48.108.652-.065zm-2.183 2.183c.226-.226.185-.605-.1-.75A6.472 6.472 0 0 0 8 9c-1.06 0-2.062.254-2.946.704-.285.145-.326.524-.1.75l.015.015c.16.16.408.19.611.09A5.478 5.478 0 0 1 8 10c.868 0 1.69.201 2.42.56.203.1.45.07.611-.091l.015-.015zM9.06 12.44c.196-.196.198-.52-.04-.66A1.99 1.99 0 0 0 8 11.5a1.99 1.99 0 0 0-1.02.28c-.238.14-.236.464-.04.66l.706.706a.5.5 0 0 0 .708 0l.707-.707z"/>
            </svg>
            <svg v-if="station.is_online === 'false'" width="35px" height="35px" viewBox="0 0 16 16" class="bi bi-wifi-off" fill="red" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.706 3.294A12.545 12.545 0 0 0 8 3 12.44 12.44 0 0 0 .663 5.379a.485.485 0 0 0-.048.736.518.518 0 0 0 .668.05A11.448 11.448 0 0 1 8 4c.63 0 1.249.05 1.852.148l.854-.854zM8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065 8.448 8.448 0 0 1 3.51-1.27L8 6zm2.596 1.404l.785-.785c.63.24 1.228.545 1.785.907a.482.482 0 0 1 .063.745.525.525 0 0 1-.652.065 8.462 8.462 0 0 0-1.98-.932zM8 10l.934-.933a6.454 6.454 0 0 1 2.012.637c.285.145.326.524.1.75l-.015.015a.532.532 0 0 1-.611.09A5.478 5.478 0 0 0 8 10zm4.905-4.905l.747-.747c.59.3 1.153.645 1.685 1.03a.485.485 0 0 1 .048.737.518.518 0 0 1-.668.05 11.496 11.496 0 0 0-1.812-1.07zM9.02 11.78c.238.14.236.464.04.66l-.706.706a.5.5 0 0 1-.708 0l-.707-.707c-.195-.195-.197-.518.04-.66A1.99 1.99 0 0 1 8 11.5c.373 0 .722.102 1.02.28zm4.355-9.905a.53.53 0 1 1 .75.75l-10.75 10.75a.53.53 0 0 1-.75-.75l10.75-10.75z"/>
            </svg>
            {{ station.mountpoint }}</h5>
          <p class="card-text">{{ station.misc }}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Nav-systems: </strong>{{station['nav-system']}}</li>
          <li class="list-group-item"><strong>Format: </strong>{{station['format']}}</li>
          <li class="list-group-item"><strong>Format-details: </strong>{{station['format-details']}}</li>
          <li class="list-group-item"><strong>Identifier: </strong>{{station['identifier']}}</li>
          <li class="list-group-item"><strong>Country: </strong>{{station['country']}}</li>
        </ul>
        <div class="card-body">
          <a href="#" class="card-link">Card link</a>
        </div>
      </div>
    </div>

  </div>

</main>


<!-- add station modal -->
<div class="modal fade" id="addStation">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new station</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="f_addstation">
          <div class="mb-3">
            <label for="fns_mountpoint" class="form-label">MountPoint</label>
            <input type="text" class="form-control" name="mountpoint" id="fns_mountpoint">
          </div>
          <div class="mb-3">
            <label for="fns_password" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" id="fns_password">
          </div>
          <div class="mb-3">
            <label for="fns_misc" class="form-label">Misc</label>
            <textarea class="form-control" id="fns_misc" name="misc" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="f_addstation_submit" type="button" v-on:click="addStation" class="btn btn-primary" data-loading="Loading..." data-original="Continue">Continue</button>
      </div>
    </div>
  </div>
</div>
<!-- /add station modal -->
