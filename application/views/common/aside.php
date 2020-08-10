<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <base href="<?php echo site_url(); ?>">
  <link rel="icon" href="favicon.ico">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/leaflet.css">
  <link rel="stylesheet" href="assets/css/dashboard.css">
  <script src="assets/js/vue.min.js"></script>
  <title>Dashboard Template for Bootstrap</title>
</head>
<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Dashboard</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-4">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">
          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="mx-2 bi bi-file-person" fill="#fff"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z" />
            <path d="M13.784 14c-.497-1.27-1.988-3-5.784-3s-5.287 1.73-5.784 3h11.568z" />
            <path fill-rule="evenodd" d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
          </svg>
          <?php echo $login ?></a>
      </li>
    </ul>
    <ul class="navbar-nav px-4">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="map">
                <span data-feather="home"></span>
                Map
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="referencestation">
                <span data-feather="file"></span>
                Reference station
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="casters">
                <span data-feather="shopping-cart"></span>
                Casters
              </a>
            </li>
          </ul>
        </div>
      </nav>