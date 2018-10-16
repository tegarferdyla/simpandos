 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Update File</h3>
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
                        <a class="dropdown-item" href="<?php echo base_url()."ppk/viewfilependukung/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>">View Dokumen</a>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <ul class="nav nav-tabs nav-linetriangle no-hover-bg">
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab31" data-toggle="tab" aria-controls="tab31"
                        href="#tab31" aria-expanded="true">BMN</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab32" data-toggle="tab" aria-controls="tab32"
                        href="#tab32" aria-expanded="true">Keuangan / SPM</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab33" data-toggle="tab" aria-controls="tab33"
                        href="#tab33" aria-expanded="true">Bendahara</a>
                      </li>
                    </ul>
                    <!-- --------------------------------------------------------------------- -->
                    <!-- -------------------LAPORAN PERENCANAAN -------------------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                      <form class="form input-append" action="<?php echo site_url('ppk/bmn') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                        <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Surat Alih Status</b></label>
                            <a class="text-success btn-add-input" style="padding-left:16em" data-counter=0 data-tipefile="sas" value="Add sas"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_sas)): ?>
                              <?php foreach ($file_sas as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Rekomendasi Teknis</b></label>
                            <a class="text-success btn-add-input" style="padding-left:16em" data-counter=0 data-tipefile="rt" value="Add rt"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_rt)): ?>
                              <?php foreach ($file_rt as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Surat Hibah ke Kementerian Keuangan</b></label>
                            <a class="text-success btn-add-input" style="padding-left:6em" data-counter=0 data-tipefile="shkk" value="Add shkk"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_shkk)): ?>
                              <?php foreach ($file_shkk as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                        </div>
                        <div class="form-actions right">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-check-square-o"></i> Save
                        </button>
                      </div>                      
                      </form>
                      </div>

                      <div role="tabpanel" class="tab-pane" id="tab32" aria-expanded="true" aria-labelledby="base-tab32">
                        <form class="form input-append" action="<?php echo site_url('ppk/spm') ?>" method ="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                          <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Permohonan Pembayaran</b></label>
                            <a class="text-success btn-add-input" style="padding-left:12em" data-counter=0 data-tipefile="pp" value="Add pp"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_pp)): ?>
                              <?php foreach ($file_pp as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Kuitansi</b></label>
                            <a class="text-success btn-add-input" style="padding-left:22em" data-counter=0 data-tipefile="kuitansi" value="Add kuitansi"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_kuitansi)): ?>
                              <?php foreach ($file_kuitansi as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Kartu Pengawasan (Karwas)</b></label>
                            <a class="text-success btn-add-input" style="padding-left:12em" data-counter=0 data-tipefile="karwas" value="Add karwas"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_karwas)): ?>
                              <?php foreach ($file_karwas as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Faktur Pajak</b></label>
                            <a class="text-success btn-add-input" style="padding-left:20em" data-counter=0 data-tipefile="fp" value="Add fp"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_fp)): ?>
                              <?php foreach ($file_fp as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>PPH dan PPN</b></label>
                            <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="ppn" value="Add ppn"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_ppn)): ?>
                              <?php foreach ($file_ppn as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>SPP</b></label>
                            <a class="text-success btn-add-input" style="padding-left:24em" data-counter=0 data-tipefile="spp" value="Add spp"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_spp)): ?>
                              <?php foreach ($file_spp as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>SPM</b></label>
                            <a class="text-success btn-add-input" style="padding-left:23em" data-counter=0 data-tipefile="spm" value="Add spm"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_spm)): ?>
                              <?php foreach ($file_spm as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>SP2D</b></label>
                            <a class="text-success btn-add-input" style="padding-left:24em" data-counter=0 data-tipefile="sp2d" value="Add sp2d"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_sp2d)): ?>
                              <?php foreach ($file_sp2d as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                        </div>
                        <div class="form-actions right">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-check-square-o"></i> Save
                        </button>
                      </div>
                        </form>
                      </div>

                      <div role="tabpanel" class="tab-pane" id="tab33" aria-expanded="true" aria-labelledby="base-tab33">
                      <form class="form input-append" action="<?php echo site_url('ppk/bendahara') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>LPJ</b></label>
                            <a class="text-success btn-add-input" style="padding-left:25em" data-counter=0 data-tipefile="lpj" value="Add lpj"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_lpj)): ?>
                              <?php foreach ($file_lpj as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Berita Acara Pemeriksaan Kas dan Rekonsiliasi</b></label>
                            <a class="text-success btn-add-input" style="padding-left:3.5em" data-counter=0 data-tipefile="rekonsi" value="Add rekonsi"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_rekonsi)): ?>
                              <?php foreach ($file_rekonsi as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Rekening Koran</b></label>
                            <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="rk" value="Add rk"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_rk)): ?>
                              <?php foreach ($file_rk as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Berita Acara Pemeriksaan Kas</b></label>
                            <a class="text-success btn-add-input" style="padding-left:12em" data-counter=0 data-tipefile="bapk" value="Add bapk"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_bapk)): ?>
                              <?php foreach ($file_bapk as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilependukung/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                              <?php } ?>
                            <?php else: ?>
                              <p style="color:red">Tidak Ada Data</p>  
                            <?php endif ?>
                            <div class ="form-group" style="margin-top:12 ">
                               <div class="input-div">
                                
                              </div>
                            </div>  
                          </div>
                          </div>
                        </div>
                        <div class="form-actions right">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-check-square-o"></i> Save
                        </button>
                      </div>
                      </form>
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