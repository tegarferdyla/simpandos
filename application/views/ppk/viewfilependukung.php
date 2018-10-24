 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">View File</h3>
          <h6>Dokumen Pendukung</h6>
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
                        <a class="dropdown-item" href="<?php echo base_url()."ppk/updatefilependukung/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>">Update Dokumen</a>
                        <?php if ($where_paket['id_jenis'] == 'JNS0003') :?>
                          <a class="dropdown-item" href="<?php echo base_url()."ppk/printlaporankonsultan/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>" target="_blank">Print Laporan</a>
                        <?php elseif ($where_paket['id_jenis'] == 'JNS0004') :?>
                           <a class="dropdown-item" href="<?php echo base_url()."ppk/printlaporanpengadaan/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>" target="_blank">Print Laporan</a> 
                        <?php elseif ($where_paket['id_jenis'] == 'JNS0005') :?>
                           <a class="dropdown-item" href="<?php echo base_url()."ppk/printlaporanswakelola/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>" target="_blank">Print Laporan</a>  
                        <?php endif ?>
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
                       <?php if ($where_paket['id_jenis'] != 'JNS0005') :?>
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab31" data-toggle="tab" aria-controls="tab31"
                        href="#tab31" aria-expanded="true">BMN</a>
                      </li>
                    <?php endif ?>
                      <li class="nav-item">
                        <a class="nav-link <?php if($where_paket['id_jenis'] == 'JNS0005') {echo 'active';} ?>" id="base-tab32" data-toggle="tab" aria-controls="tab32"
                        href="#tab32" aria-expanded="true">Keuangan / SPM</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " id="base-tab33" data-toggle="tab" aria-controls="tab33"
                        href="#tab33" aria-expanded="true">Bendahara</a>
                      </li>
                    </ul>
                    <!-- --------------------------------------------------------------------- -->
                    <!-- -------------------LAPORAN SWAKELOLA -------------------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-content px-1 pt-1">
                      <?php if ($where_paket['id_jenis'] != 'JNS0005' ) :?>
                      <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                        <div class="form-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Surat Alih Status / Hibah</b></label>
                              <br>
                              <?php if (!empty($file_sas)): ?>
                                <?php foreach ($file_sas as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Rekomendasi Teknis</b></label>
                              <br>
                              <?php if (!empty($file_rt)): ?>
                                <?php foreach ($file_rt as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>BAST Pengelolaan</b></label>
                              <br>
                              <?php if (!empty($file_shkk)): ?>
                                <?php foreach ($file_shkk as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>BAST Asset</b></label>
                              <br>
                              <?php if (!empty($file_bast_bmn)): ?>
                                <?php foreach ($file_bast_bmn as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                        </div>
                      </div>
                      </div>
                    <?php endif ?>
                      <div role="tabpanel" class="tab-pane <?php if($where_paket['id_jenis'] == 'JNS0005') {echo 'active';} ?>" id="tab32" aria-expanded="true" aria-labelledby="base-tab32">
                         <div class="form-body">

                          <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Permohonan Pembayaran</b></label>
                              <br>
                              <?php if (!empty($file_pp)): ?>
                                <?php foreach ($file_pp as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Kuitansi</b></label>
                              <br>
                              <?php if (!empty($file_kuitansi)): ?>
                                <?php foreach ($file_kuitansi as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Kartu Pengawasan (Karwas)</b></label>
                              <br>
                              <?php if (!empty($file_karwas)): ?>
                                <?php foreach ($file_karwas as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Faktur Pajak</b></label>
                              <br>
                              <?php if (!empty($file_fp)): ?>
                                <?php foreach ($file_fp as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>PPH dan PPN</b></label>
                              <br>
                              <?php if (!empty($file_ppn)): ?>
                                <?php foreach ($file_ppn as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>SPP</b></label>
                              <br>
                              <?php if (!empty($file_spp)): ?>
                                <?php foreach ($file_spp as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>SPM</b></label>
                              <br>
                              <?php if (!empty($file_spm)): ?>
                                <?php foreach ($file_spm as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>SP2D</b></label>
                              <br>
                              <?php if (!empty($file_sp2d)): ?>
                                <?php foreach ($file_sp2d as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                        </div>
      
                         </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="tab33" aria-expanded="true" aria-labelledby="base-tab33">
                         <div class="form-body">
                          <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Jaminan Uang Muka</b></label>
                              <br>
                              <?php if (!empty($file_lpj)): ?>
                                <?php foreach ($file_lpj as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div> 
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Jaminan Pelaksanaan</b></label>
                              <br>
                              <?php if (!empty($file_rekonsi)): ?>
                                <?php foreach ($file_rekonsi as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Jaminan Pemeliharaan</b></label>
                              <br>
                              <?php if (!empty($file_rk)): ?>
                                <?php foreach ($file_rk as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              </div>
                            </div> 
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Laporan Pajak</b></label>
                              <br>
                              <?php if (!empty($file_bapk)): ?>
                                <?php foreach ($file_bapk as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <?php if ($where_paket['id_jenis'] == 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php elseif ($where_paket['id_jenis'] != 'JNS0005') :?>
                                    <a href="<?php echo base_url('assets/data/'.$where_paket['nama_tahun']. '/'.$data_ppk['nama_ppk'].'/'.$where_paket['main_jenis'].'/'. $where_paket['sub_jenis'] .'/'. $where_paket['nama_paket'].'/'.$u['nama_file']) ?>" target = "_blank"><button type="button" class="btn btn-icon btn-primary mr-1"><i class="fa fa-download"></i> Download</button></a>
                                  <?php endif ?>  
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