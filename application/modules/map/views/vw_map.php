<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiDdGyp6n2hKHPECuB6JZIT-8dVHCpwI0&language=id&region=ID&libraries=places"></script>
</head>
<body>

	<div class="container">

		<div class="page-header">
			<h1>Tambah Titik</h1>
		</div>
			<div id="map" style="height: 400px;"></div>  
		<form>
			<div class="row">
				<div class="col-sm-6">
					<div class="col-sm-6">
						<div class="form-group">
							<input class="form-control" type="text" id="pac-input" placeholder="Cari lokasi" />
						</div>
					          
					</div> 

					<div class="form-group">
						<label>Nama Titik <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama" value="" id="nama" readonly="" />
					</div>
					<div class="form-group">
						<label>Latitude <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="lat" id="lat" value="" readonly=""/>
					</div>
					<div class="form-group">
						<label>Longitude <span class="text-danger">*</span></label>
						<input class="form-control" type="text" id="lng" name="lng" value="" readonly=""/>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" id="simpan"><span class="glyphicon glyphicon-save"></span> Simpan</button>
					</div>
					
				</div>

			</div>
		</form>

	</div>

	<script>
		var defaultCenter = {
			lat : -8.251889, 
			lng : 115.076818};
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

				var input = document.getElementById('pac-input');
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
			$('#simpan').click(function(e) {
				e.preventDefault();
				var dataForm = $('form').serialize();
				$.ajax({
					url: '<?php echo base_url('map/map/insert') ?>',
					type: 'POST',
					data: dataForm,
				})
				.done(function(ok) {
					alert(ok);
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
		</script>
	</body>
	</html>