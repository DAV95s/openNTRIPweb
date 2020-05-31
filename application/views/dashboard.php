<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Dashboard</h1>
  <div class="row">
    <div class="col-sm-6">
      <div id="map" class="map"></div>
    </div>
    <div id="stationsList" class="col-sm-6">

    </div>

  </div>

  <!-- Modal -->
  <div class="modal fade" id="stationModal" tabindex="-1" role="dialog" aria-labelledby="stationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Station</h4>
        </div>
        <div id="stationModalbody" class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
          <button type="button" class="btn btn-primary">Сохранить изменения</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Large modal -->