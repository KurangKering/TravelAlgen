<div class="row" id="card-masonry">
	<!-- Today's Site Activity -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="pmd-card pmd-z-depth">      
			<div class="pmd-card-title">
				<div class="media-body media-middle">
					<h2 class="pmd-card-title-text typo-fill-secondary">Data Master</h2> 
				</div>
				<!-- <div class="media-right datetimepicker">
					calendar start
					<div class="range-calendar" style=" height:40px;">
						<div class="form-group pmd-textfield">
							<div class="input-group">
								<button class="btn pmd-btn-outline pmd-ripple-effect btn-primary" id="btnTambah" >Tambah Data</button>
							</div>
						</div>
						<span class="selected-date typo-fill-secondary"></span>
					</div>calendar end
				</div> -->
			</div>
			<div class="pmd-card-body">
				<div id="inputanan"></div>
				<div class="table-responsive">
					<table id="tabelDataMaster" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th></th>
								<th>Kode</th>
								<th>Nama Titik</th>
								<th>Longitude</th>
								<th>Latitude</th>
								<th>Date Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td>Kode</td>
								<td>Nama Titik</td>
								<td>Longitude</td>
								<td>Latitude</td>
								<td>Date Created</td>
								<td>Delete</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>	
</div>

<script>
	var t;
	$(function() {
		$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};
		t = $("#tabelDataMaster").dataTable({
			initComplete: function() {
				var api = this.api();
				$('#tabelDataMaster_filter input')
				.off('.DT')
				.on('keyup.DT', function(e) {
					if (e.keyCode == 13) {
						api.search(this.value).draw();
					}
				});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			bPaginate: false,
			bFilter: false,
			bLengthChange: false,
			processing: true,
			serverSide: true,
			ajax: {"url": "<?php echo base_url('induk/tampil_data') ?>", "type": "POST"},
			columns: [
			{"data" : "no_urut" ,
			"orderable": false},
			{
				"data": "kode",
			},
			{"data": "nama"},
			{"data": "lng"},
			{"data": "lat"},
			{"data" : "date_created"},
			{"data": "action", "orderable" : false},
			],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});
		$.ajax({
			url:"<?php echo base_url('induk/input_data') ?>",
			success:function(result){
				$("#inputanan").html(result);
				
			}
		});


		
	});

</script>