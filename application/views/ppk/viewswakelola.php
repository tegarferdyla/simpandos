 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">View File</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('ppk') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('ppk/jenispaket/'.$where_paket['id_tahun']) ?>"><?php echo $where_paket['nama_tahun']; ?></a>
                </li>
                <li class="breadcrumb-item"><a href=""><?php echo $where_paket['main_jenis']; ?></a></li>
                <?php if ($where_paket['sub_jenis']) :?>
                  <li class="breadcrumb-item"><a href="<?php echo site_url('ppk/pilihpaket/'.$where_paket['id_tahun'].'/'.$where_paket['id_jenis']) ?>"><?php echo $where_paket['sub_jenis']; ?></a></li>
                <?php endif ?>
                <li class="breadcrumb-item"><a href=""><?php echo $where_paket['nama_paket']; ?></a></li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <?php date_default_timezone_set('Asia/Jakarta'); date_default_timezone_set("Asia/Jakarta"); $jam  =  date("H:i:s");  ?>
            <h4 class="text-success"><i class="ft-calendar"> <?php echo date('d-m-Y') ?> </i></h4>&nbsp; &nbsp; &nbsp;
            <i class="ft-clock text-info  "></i>&nbsp; &nbsp;<h4 class="text-info" id="txt"></h4>         
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Zero configuration table -->
        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                  <div class="col-md-10">
                    <h4 class="card-title"><?php echo $where_paket['nama_paket']; ?></h4>
                  </div>
                  <div class="col-md-2 right">
                    <div class="btn-group" role="group">
                      <button class="btn btn-outline-primary dropdown-toggle dropdown-menu-right" id="btnGroupDrop1"
                      type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-zap icon-left"></i> Aksi</button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="<?php echo base_url()."ppk/inputdokutamaswakelola/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>">Update Dokumen</a>
                         <a class="dropdown-item" href="<?php echo base_url()."ppk/printlaporanswakelola/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>" target="_blank">Print Laporan</a>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <?php if ($this->session->flashdata('berhasil')): ?>
                    <div class="alert alert-success alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> File Baru Berhasil ditambahkan</strong>
                    </div>
                    <?php elseif ($this->session->flashdata('deleteberhasil')): ?>
                    <div class="alert alert-info alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> File Berhasil Dihapus !</strong>
                    </div>
                    <?php endif ?>
                    <ul class="nav nav-tabs nav-linetriangle no-hover-bg">
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab31" data-toggle="tab" aria-controls="tab31"
                        href="#tab31" aria-expanded="true">Laporan Perencanaan</a>
                      </li>
                    </ul>
                    <!-- --------------------------------------------------------------------- -->
                    <!-- -------------------LAPORAN SWAKELOLA -------------------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                        <div class="form-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Laporan Swakelola</b></label>
                              <br>
                              <?php if (!empty($file_swa)): ?>
                                <?php foreach ($file_swa as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>KAK & HPS</b></label>
                              <br>
                              <?php if (!empty($file_kak_hps)): ?>
                                <?php foreach ($file_kak_hps as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                        </div>
                      </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <!--/ Zero configuration table -->
      </div>
    </div>
  </div>