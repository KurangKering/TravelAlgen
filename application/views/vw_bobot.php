
<div class="row" id="card-masonry">
 <div class="col-xs-12 col-sm-12 col-md-12">
  <div class="pmd-card pmd-z-depth statistics-content">      
    <div class="pmd-card-title">
      <div class="media-body media-middle">
        <h2 class="pmd-card-title-text typo-fill-secondary">Data Bobot</h2>
      </div>
    </div>
    <div class="pmd-card-body">
      <table width="100%" class="table table-striped">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <?php foreach ($master_data as $key => $value): ?>
              <th><?php echo $value->kode; ?></th>
            <?php endforeach ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($master_data as $index1 => $value1): ?>
            <tr>
              <td><?php echo $value1->kode ?></td>
              <td><?php echo $value1->nama ?></td>
              <?php foreach ($master_data as $index2 => $value2): ?>
                <td><?php echo $kumpulan['rows'][$index1]['elements'][$index2]['distance']['text'] ?></td>
              <?php endforeach ?>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>  

