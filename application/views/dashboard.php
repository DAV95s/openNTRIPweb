<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="assets/favicon.ico">
  <title>ADVNTRIP dashboard</title>
  <base href="<?php echo site_url(); ?>">
  <link href="assets/bootstrap.min.css" rel="stylesheet">
  <link href="assets/dashboard.css" rel="stylesheet">
  <link href="assets/leaflet.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/open-iconic.min.css">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">NTRIP dashboard</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="/">Sign out</a>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/">Dashboard</a>
              </li>
            </ul>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="8" x2="12" y2="16"></line>
                  <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                  </svg>
                  Current month
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
              <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
            </div>
            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
              <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
            </div>
          </div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                Settings
              </button>
            </div>
          </div>
          <div class="row">
            <div id="mapid" class="col-6" style="height: 450px; margin-bottom: 30px;"></div>
            <div class="col-6" style="max-height: 450px; overflow-y: scroll;">
              <div class="table-responsive">
                <table id="tableStations" class="table table-striped table-sm table-hover">
                  <thead>
                    <tr>
                      <th>Mountpoint</th>
                      <th>Type</th>
                      <th>Sourcetable</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{station.mountpoint}}</td>
                      <td>{{station.type}}</td>
                      <td>yes</td>
                      <td>avalible</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2 class="h2">GNSS Stations</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#addStations">
                Add new Station
              </button>
            </div>
          </div>

        </main>
      </div>
    </div>
  </div>

  <!-- Modal add stations -->
  <div class="modal fade" id="addStations" tabindex="-1" role="dialog" aria-labelledby="addStationsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStationsLabel">Add new Station</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_addStations">
            <div class="form-group">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" checked="" id="physical_station" name="type_station" value="physical" class="custom-control-input">
                <label class="custom-control-label" for="physical_station">Physical station</label>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" name="mountpoint" placeholder="Mountpoint">
                </div>
                <div class="col">
                  <input type="text" class="form-control" name="password" placeholder="Password">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" name="nmea" id="nmea">
                <label class="custom-control-label" for="nmea">Demand send NMEA</label>
              </div>
              <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" name="authentication" id="authentication">
                <label class="custom-control-label" for="authentication">Authentication</label>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Misc</label>
              <textarea class="form-control" name="misc" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="obj.addStation()" id="form_addStations_accept" class="btn btn-primary" data-original-text="Add" data-loading-text="Processing">Add</button>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/jquery-3.5.1.min.js"></script>
  <script src="assets/bootstrap.min.js"></script>
  <script src="assets/leaflet.js"></script>
  <script src="assets/main.js"></script>
</body>

</html>