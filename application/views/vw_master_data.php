
<div class="row" id="card-masonry">
 <div class="col-xs-12 col-sm-12 col-md-12">
  <div class="pmd-card pmd-z-depth statistics-content">      
    <div class="pmd-card-title">
      <div class="media-body media-middle">
        <h2 class="pmd-card-title-text typo-fill-secondary">Data Master</h2>
      </div>
    </div>
    <div class="pmd-card-body">
      <?php if (validation_errors()): ?>
        <div role="alert" class="alert alert-danger alert-dismissible">
          <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
          <?php echo validation_errors(); ?>
        </div>
      <?php endif ?>

      <!-- Default tab -->
      <section class="row component-section">


        <!-- Default tab example and code -->
        <div class="col-md-12 col-sm-12"> 
          <div class="component-box">
            <!--Default tab example -->
            <div class="pmd-card pmd-z-depth"> 
              <div class="pmd-tabs pmd-tabs-bg">
                <div class="pmd-tab-active-bar"></div>
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#master" aria-controls="master" role="tab" data-toggle="tab">Master</a></li>
                  <li role="presentation"><a href="#inputan" aria-controls="inputan" role="tab" data-toggle="tab">Input</a></li>
                </ul>
              </div>
              <div class="pmd-card-body">
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="master">

                   <table width="100%" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $num = 1 ; foreach ($result as $res): ?>
                      <tr>
                        <td><?php echo $num++ ?></td>
                        <td><?php echo $res->kode ?></td>
                        <td><?php echo $res->nama ?></td>
                        <td><?php echo $res->lat ?></td>
                        <td><?php echo $res->lng ?></td>
                        <td>Delete</td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>

              <div role="tabpanel" class="tab-pane" id="inputan">
                  <form  id="formData" method="post">

                    <div class="col-sm-4">
                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <input class="form-control" id="lokasi" placeholder="Masukkan Lokasi" type="text"><span class="pmd-textfield-focused"></span>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <input class="form-control" name="nama" id="nama" disabled="" placeholder="Nama Titik" type="text"><span class="pmd-textfield-focused"></span>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <input class="form-control" name="lng" id="lat" disabled="" placeholder="Latitude" type="text"><span class="pmd-textfield-focused"></span>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <input class="form-control" name="lng" id="lng" disabled="" placeholder="Longitude" type="text"><span class="pmd-textfield-focused"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                   <div class="col-sm-2">
                    <button id="simpan" type="button" class="btn btn-primary pmd-ripple-effect">Tambah</button>
                  </div>
                  </div>
                </form>

              <div class="clearfix"></div>

              <div id="map" style="display: none"></div>
            </div>

          </div>
        </div> <!--Default tab example end-->

      </div>
    </div> <!-- end Default example and code -->

  </section><!-- end default tab --> 





</div>
</div>
</div>
</div>  
<script>
  var defaultCenter = {
    lat : 0.50456900, 
    lng : 101.45004100};
    function initMap() {

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: defaultCenter 
      });

      var marker = new google.maps.Marker({
        position: defaultCenter,
        map: map,
        title: 'Click to zoom',
        draggable:true
      });

      var input = document.getElementById('lokasi');
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      marker.addListener('drag', handleEvent);
      marker.addListener('dragend', handleEvent);

      var infowindow = new google.maps.InfoWindow({
        content: '<h4>Drag untuk pindah lokasi</h4>'
      });

      infowindow.open(map, marker);
      var infowindowContent = document.getElementById('infowindow-content');

      autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      document.getElementById('nama').value = place.name;
      document.getElementById('lat').value = place.geometry.location.lat();
      document.getElementById('lng').value = place.geometry.location.lng();

      var address = '';
      if (place.address_components) {
        address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
      }

      infowindow.setContent(place.name + '');
      infowindow.open(map, marker);
    });
    }

    function handleEvent(event) {
      document.getElementById('lat').value = event.latLng.lat();
      document.getElementById('lng').value = event.latLng.lng();
    }

    $(function(){
      initMap();
    })


  </script>

  
  <script type="text/javascript">
    $('#simpan').click(function(event) {

      event.preventDefault();
      var nama =  $("#nama").val(); 
      var lat = $("#lat").val();
      var lng = $("#lng").val();

      $.ajax({
        url: '<?php echo base_url('master/ins') ?>',
        type: 'POST',
        data: {nama: nama, lat : lat, lng : lng},
      })
      .done(function(msg) {
       alert(msg);
      })
      .fail(function(msg) {
       // location.reload();
      })
      .always(function() {
        console.log("complete");
      });
      
    });
  </script>