<div class="page-title">
  <h3>Dashboard</h3>
  <p class="text-subtitle text-muted">Dashboard WikiMovieMedia</p>
</div>
<section class="section">
  <!-- if user is admin -->
  <?php
  // if ($this->session->userdata('hak_akses') == 'admin') : 
  ?>
  <div class="mb-2 row">
    <div class="col-12 col-md-4">
      <div class="card card-statistic">
        <div class="p-0 card-body">
          <div class="d-flex flex-column">
            <div class='px-3 py-3 d-flex justify-content-between'>
              <h3 class='card-title'>Jumlah User</h3>
              <div class="card-right d-flex align-items-center">
                <p> 10</p>
              </div>
            </div>
            <div class="chart-wrapper">
              <canvas id="canvas1" style="height:100px !important"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card card-statistic">
        <div class="p-0 card-body">
          <div class="d-flex flex-column">
            <div class='px-3 py-3 d-flex justify-content-between'>
              <h3 class='card-title'>Jumlah Film</h3>
              <div class="card-right d-flex align-items-center">
                <p>
                <p> 11</p>
                </p>
              </div>
            </div>
            <div class="chart-wrapper">
              <canvas id="canvas2" style="height:100px !important"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card card-statistic">
        <div class="p-0 card-body">
          <div class="d-flex flex-column">
            <div class='px-3 py-3 d-flex justify-content-between'>
              <h3 class='card-title'>Jumlah Home Production</h3>
              <div class="card-right d-flex align-items-center">
                <p> 13</p>
              </div>
            </div>
            <div class="chart-wrapper">
              <canvas id="canvas3" style="height:100px !important"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  // endif; 
  ?>

</section>