<div>
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item">Dashboard Monitoring Total</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Beasiswa</h4>
            </div>
            <div class="card-body">
              {{ $scholarship }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-mail-bulk"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Surat Tugas</h4>
            </div>
            <div class="card-body">
              {{ $letter }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-scroll"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Proposal</h4>
            </div>
            <div class="card-body">
              {{ $proposal }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-paste"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Laporan</h4>
            </div>
            <div class="card-body">
              {{ $report }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-table"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Formulir Pengajuan</h4>
            </div>
            <div class="card-body">
              {{ $formulir }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>