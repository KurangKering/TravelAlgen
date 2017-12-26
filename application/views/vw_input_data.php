	<form  id="formData" method="post">

		<div class="col-sm-4">
			<div class="form-group pmd-textfield pmd-textfield-floating-label">
				<input class="form-control" id="lokasi" placeholder="Masukkan Lokasi" type="text"><span class="pmd-textfield-focused"></span>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group pmd-textfield pmd-textfield-floating-label">
				<input class="form-control" name="nama" id="nama" placeholder="Nama Titik" type="text"><span class="pmd-textfield-focused"></span>
			</div>
		</div>
		<div class="col-sm-1">
			<div class="form-group pmd-textfield pmd-textfield-floating-label">
				<input class="form-control" name="lng" id="lat" readonly="" placeholder="Lat" type="text"><span class="pmd-textfield-focused"></span>
			</div>
		</div>
		<div class="col-sm-1">
			<div class="form-group pmd-textfield pmd-textfield-floating-label">
				<input class="form-control" name="lng" id="lng" readonly="" placeholder="Long" type="text"><span class="pmd-textfield-focused"></span>
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

<div id="map" style="height: 200px"></div>
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
	
		$("#simpan").click(function() {
			inputData();
		});
		function inputData()
		{
			var nama = $("#nama").val();
			var lat = $("#lat").val();
			var lng = $("#lng").val();
			var type = "lakukanInput";
			$.ajax({
				url: '<?php echo base_url('induk/input_data') ?>',
				type: 'POST',
				data: {type:type, nama : nama , lat : lat, lng : lng},
				success: function(data, textStatus, jqXHR)
				{
					t.api().ajax.reload();
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log('ERRORS: ' + textStatus);
				}
			});
		}
	</script>
