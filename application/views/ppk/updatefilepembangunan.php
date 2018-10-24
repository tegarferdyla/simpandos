 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Update File</h3>
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
                        <a class="dropdown-item" href="<?php echo base_url()."ppk/viewfile/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>">View Dokumen</a>
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
                      <strong> Kepala Dokumen Baru Berhasil Ditambahkan</strong>
                    </div>
                    <?php endif ?>
                    <ul class="nav nav-tabs nav-linetriangle no-hover-bg">
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab31" data-toggle="tab" aria-controls="tab31"
                        href="#tab31" aria-expanded="true">Readiness Criteria</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab32" data-toggle="tab" aria-controls="tab32" href="#tab32"
                        aria-expanded="false">Kontrak</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab33" data-toggle="tab" aria-controls="tab32" href="#tab33"
                        aria-expanded="false">MCO</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab34" data-toggle="tab" aria-controls="tab32" href="#tab34"
                        aria-expanded="false">Klarifikasi Pasca MCO</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab35" data-toggle="tab" aria-controls="tab32" href="#tab35"
                        aria-expanded="false">Addendum</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab36" data-toggle="tab" aria-controls="tab32" href="#tab36"
                        aria-expanded="false">Laporan</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab37" data-toggle="tab" aria-controls="tab32" href="#tab37"
                        aria-expanded="false">Uji Kualitas konstruksi</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab38" data-toggle="tab" aria-controls="tab32" href="#tab38"
                        aria-expanded="false"><i>SCM</i></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab39" data-toggle="tab" aria-controls="tab32" href="#tab39"
                        aria-expanded="false"><i>PHO</i></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab40" data-toggle="tab" aria-controls="tab32" href="#tab40"
                        aria-expanded="false"><i>FHO</i></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab41" data-toggle="tab" aria-controls="tab32" href="#tab41"
                        aria-expanded="false">Dokumentasi</a>
                      </li>
                    </ul>
                    <!-- --------------------------------------------------------------------- -->
                    <!-- -------------------READINESSS CRITERIA------------------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                      <form class="form input-append" action="<?php echo site_url('ppk/readyness') ?>" method="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="form-body">
                        <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Surat Minat Daerah</b></label>
                              <a class="text-success btn-add-input" style="padding-left:16em" data-counter=0 data-tipefile="smd" value="Add smd"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_smd)): ?>
                                <?php foreach ($file_smd as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              <div class="form-group" style="margin-top:12 ">
                                  <div class="input-div">
                                  
                                </div>
                              </div>  
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput2"><b>Surat Menerima Hibah</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="smh" value="Add smh"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_smh)): ?>
                                <?php foreach ($file_smh as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                 <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
                                <?php } ?>
                              <?php else: ?>
                                <p style="color:red">Tidak Ada Data</p>  
                              <?php endif ?>
                              <div class="form-group" style="margin-top:12 ">
                                <div class="input-div">
                                  
                                </div>
                              </div>  
                            </div>
                          </div>
                        </div>

                        <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Surat Kesiapan Lahan</b></label>
                              <a class="text-success btn-add-input" style="padding-left:14.5em" data-counter=0 data-tipefile="skl" value="Add skl"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_skl)): ?>
                                <?php foreach ($file_skl as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Kesepakatan Bersama</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="ksb" value="Add ksb"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_ksb)): ?>
                                <?php foreach ($file_ksb as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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

                        <div class ="row">

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Perjanjian Kerjasama (PKS)</b></label>
                              <a class="text-success btn-add-input" style="padding-left:12em" data-counter=0 data-tipefile="pks" value="Add pks"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_pks)): ?>
                                <?php foreach ($file_pks as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Surat Kuasa</b></label>
                              <a class="text-success btn-add-input" style="padding-left:20em" data-counter=0 data-tipefile="sk" value="Add sk"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_sk)): ?>
                                <?php foreach ($file_sk as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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

                      <!-- --------------------------------------------------------------------- -->
                      <!-- ---------------------------- KONTRAK -------------------------------- -->
                      <!-- --------------------------------------------------------------------- -->

                      <div class="tab-pane" id="tab32" aria-labelledby="base-tab32">
                      <form class="form input-append" action="<?php echo site_url('ppk/kontrak') ?>" method = "post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="form-body">
                        <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>SPPBJ</b></label>
                              <a class="text-success btn-add-input" style="padding-left:24em" data-counter=0 data-tipefile="sppbj" value="Add sppbj"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_sppbj)): ?>
                                <?php foreach ($file_sppbj as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>SPMK</b></label>
                              <a class="text-success btn-add-input" style="padding-left:24em" data-counter=0 data-tipefile="spmk" value="Add spmk"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_spmk)): ?>
                                <?php foreach ($file_spmk as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Naskah Kontrak</b></label>
                              <a class="text-success btn-add-input" style="padding-left:18.5em" data-counter=0 data-tipefile="naskon" value="Add naskon"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_naskon)): ?>
                                <?php foreach ($file_naskon as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Rencana Mutu Kontrak</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="rmk" value="Add rmk"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_rmk)): ?>
                                <?php foreach ($file_rmk as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                    <!-- --------------------------------------------------------------------- -->
                    <!-- ------------------------------- MC0 --------------------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-pane" id="tab33" aria-labelledby="base-tab33">
                      <form class="form input-append" action="<?php echo site_url('ppk/mc0') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="form-body">

                        <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Design Drawing</b></label>
                              <a class="text-success btn-add-input" style="padding-left:18em" data-counter=0 data-tipefile="dd" value="Add dd"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_dd)): ?>
                                <?php foreach ($file_dd as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Berita Acara Lapangan</b></label>
                              <a class="text-success btn-add-input" style="padding-left:14em" data-counter=0 data-tipefile="bal_mco" value="Add bal_mco"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bal_mco)): ?>
                                <?php foreach ($file_bal_mco as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Justifikasi dan Spesifikasi Teknis</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10em" data-counter=0 data-tipefile="jst_mco" value="Add jst_mco"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_jst_mco)): ?>
                                <?php foreach ($file_jst_mco as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Berita Acara <i>Pree Construction Meeting</i>(PCM)</b></label>
                              <a class="text-success btn-add-input" style="padding-left:4em" data-counter=0 data-tipefile="pcm" value="Add pcm"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_pcm)): ?>
                                <?php foreach ($file_pcm as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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

                      </div>
                      </form>
                    </div>
                    <!-- --------------------------------------------------------------------- -->
                    <!-- ------------------------ Hasil Klarifikasi MC0 ---------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-pane" id="tab34" aria-labelledby="base-tab34">
                      <form class="form input-append" action="<?php echo site_url('ppk/pasca') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="form-body">

                        <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b><i>Bill of Quantity</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:18.5em" data-counter=0 data-tipefile="boq_psc" value="Add boq_psc"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_boq_psc)): ?>
                                <?php foreach ($file_boq_psc as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Justifikasi dan Spesifikasi Teknis</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10.5em" data-counter=0 data-tipefile="jst_psc" value="Add jst_psc"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_jst_psc)): ?>
                                <?php foreach ($file_jst_psc as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Surat Lampiran Pendukung</b></label>
                              <a class="text-success btn-add-input" style="padding-left:12em" data-counter=0 data-tipefile="slp_psc" value="Add slp_psc"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_slp_psc)): ?>
                                <?php foreach ($file_slp_psc as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Kurva S Revisi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:20em" data-counter=0 data-tipefile="kurva_psc" value="Add kurva_psc"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_kurva_psc)): ?>
                                <?php foreach ($file_kurva_psc as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b><i>Shop Drawing</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="sd_psc" value="Add sd_psc"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_sd_psc)): ?>
                                <?php foreach ($file_sd_psc as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Berita Acara Klarifikasi Negosiasi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10em" data-counter=0 data-tipefile="bakn_psc" value="Add bakn_psc"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bakn_psc)): ?>
                                <?php foreach ($file_bakn_psc as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Naskah Addendum I</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="na1" value="Add na1"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_na1)): ?>
                                <?php foreach ($file_na1 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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

                      </div>
                      </form>
                    </div>
                    <!-- --------------------------------------------------------------------- -->
                    <!-- ------------------------ Hasil Addendum ---------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-pane" id="tab35" aria-labelledby="base-tab35">
                      <form class="form input-append" action="<?php echo site_url('ppk/addendum') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="row">
                        <p class="text-center text-danger">* Ceklis Jika Diperlukan</p>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label>
                           <input type="checkbox" name="topic1" onchange="ad2(this)" value="on" <?php if(!empty($file_bal_ad2) || !empty($file_boq_ad2) || !empty($file_jst_ad2) || !empty($file_slp_ad2) || !empty($file_kurva_ad2) || !empty($file_sd_ad2) || !empty($file_bakn_ad2)|| !empty($file_na2)){echo 'checked';}?>> Addendum II
                          </label>
                        </div> 
                        <div class="col-md-3">
                          <label>
                            <input type="checkbox" name="topic2" onchange="ad3(this)" value="on" <?php if(!empty($file_bal_ad3) || !empty($file_boq_ad3) || !empty($file_jst_ad3) || !empty($file_slp_ad3) || !empty($file_kurva_ad3) || !empty($file_sd_ad3) || !empty($file_bakn_ad3)|| !empty($file_na3)){echo 'checked';}?>> Addendum III
                          </label>
                        </div>
                        <div class="col-md-3">
                          <label>
                            <input type="checkbox" name="topic3" onchange="ad4(this)" value="on" <?php if(!empty($file_bal_ad4) || !empty($file_boq_ad4) || !empty($file_jst_ad4) || !empty($file_slp_ad4) || !empty($file_kurva_ad4) || !empty($file_sd_ad4) || !empty($file_bakn_ad4)|| !empty($file_na4)){echo 'checked';}?>> Addendum IV
                          </label>
                        </div>
                        <div class="col-md-3">
                          <label>
                            <input type="checkbox" name="topic4" onchange="ad5(this)" value="on" <?php if(!empty($file_bal_ad5) || !empty($file_boq_ad5) || !empty($file_jst_ad5) || !empty($file_slp_ad5) || !empty($file_kurva_ad5) || !empty($file_sd_ad5) || !empty($file_bakn_ad5)|| !empty($file_na5)){echo 'checked';}?>> Addendum V
                          </label>
                        </div>
                      </div>
                      <hr>
                      <!-- ------------------------------------------------------------------------------------------------------------- -->
                      <div style="<?php if(empty($file_bal_ad2) && empty($file_boq_ad2) && empty($file_jst_ad2) && empty($file_slp_ad2) && empty($file_kurva_ad2) && empty($file_sd_ad2) && empty($file_bakn_ad2) && empty($file_na2)){echo 'display: none';}?>" data-topic="addendumii">
                        <h4> - Adendum II</h4>
                        <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Berita Acara Lapangan</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="bal_ad2" value="Add bal_ad2"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bal_ad2)): ?>
                                <?php foreach ($file_bal_ad2 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b><i>Bill of Quantity</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="boq_ad2" value="Add boq_ad2"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_boq_ad2)): ?>
                                <?php foreach ($file_boq_ad2 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Justifikasi dan Spesifikasi Teknis</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10.5em" data-counter=0 data-tipefile="jst_ad2" value="Add jst_ad2"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_jst_ad2)): ?>
                                <?php foreach ($file_jst_ad2 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Surat Lampiran Pendukung</b></label>
                              <a class="text-success btn-add-input" style="padding-left:12em" data-counter=0 data-tipefile="slp_ad2" value="Add slp_ad2"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_slp_ad2)): ?>
                                <?php foreach ($file_slp_ad2 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Kurva S Revisi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:20em" data-counter=0 data-tipefile="kurva_ad2" value="Add kurva_ad2"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_kurva_ad2)): ?>
                                <?php foreach ($file_kurva_ad2 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b><i>Shop Drawing</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="sd_ad2" value="Add sd_ad2"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_sd_ad2)): ?>
                                <?php foreach ($file_sd_ad2 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Berita Acara Klarifikasi Negosiasi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10em" data-counter=0 data-tipefile="bakn_ad2" value="Add bakn_ad2"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bakn_ad2)): ?>
                                <?php foreach ($file_bakn_ad2 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Naskah Addendum II</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="na2" value="Add na2"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_na2)): ?>
                                <?php foreach ($file_na2 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                      </div>

                      <div style="<?php if(empty($file_bal_ad3) && empty($file_boq_ad3) && empty($file_jst_ad3) && empty($file_slp_ad3) && empty($file_kurva_ad3) && empty($file_sd_ad3) && empty($file_bakn_ad3) && empty($file_na3)){echo 'display: none';}?>" data-topic="addendumiii">
                        <h4>Adendum III</h4>
                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Berita Acara Lapangan</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="bal_ad3" value="Add bal_ad3"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bal_ad3)): ?>
                                <?php foreach ($file_bal_ad3 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b><i>Bill of Quantity</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="boq_ad3" value="Add boq_ad3"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_boq_ad3)): ?>
                                <?php foreach ($file_boq_ad3 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Justifikasi dan Spesifikasi Teknis</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10.5em" data-counter=0 data-tipefile="jst_ad3" value="Add jst_ad3"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_jst_ad3)): ?>
                                <?php foreach ($file_jst_ad3 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Surat Lampiran Pendukung</b></label>
                              <a class="text-success btn-add-input" style="padding-left:12em" data-counter=0 data-tipefile="slp_ad3" value="Add slp_ad3"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_slp_ad3)): ?>
                                <?php foreach ($file_slp_ad3 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Kurva S Revisi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:20em" data-counter=0 data-tipefile="kurva_ad3" value="Add kurva_ad3"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_kurva_ad3)): ?>
                                <?php foreach ($file_kurva_ad3 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b><i>Shop Drawing</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="sd_ad3" value="Add sd_ad3"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_sd_ad3)): ?>
                                <?php foreach ($file_sd_ad3 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Berita Acara Klarifikasi Negosiasi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10em" data-counter=0 data-tipefile="bakn_ad3" value="Add bakn_ad3"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bakn_ad3)): ?>
                                <?php foreach ($file_bakn_ad3 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Naskah Addendum III</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="na3" value="Add na3"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_na3)): ?>
                                <?php foreach ($file_na3 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                        
                      </div>

                      <div style="<?php if(empty($file_bal_ad4) && empty($file_boq_ad4) && empty($file_jst_ad4) && empty($file_slp_ad4) && empty($file_kurva_ad4) && empty($file_sd_ad4) && empty($file_bakn_ad4) && empty($file_na4)){echo 'display: none';}?>" data-topic="addendumiv">
                        <h4>Adendum IV</h4>
                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Berita Acara Lapangan</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="bal_ad4" value="Add bal_ad4"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bal_ad4)): ?>
                                <?php foreach ($file_bal_ad4 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b><i>Bill of Quantity</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="boq_ad4" value="Add boq_ad4"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_boq_ad4)): ?>
                                <?php foreach ($file_boq_ad4 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Justifikasi dan Spesifikasi Teknis</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10.5em" data-counter=0 data-tipefile="jst_ad4" value="Add jst_ad4"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_jst_ad4)): ?>
                                <?php foreach ($file_jst_ad4 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Surat Lampiran Pendukung</b></label>
                              <a class="text-success btn-add-input" style="padding-left:12em" data-counter=0 data-tipefile="slp_ad4" value="Add slp_ad4"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_slp_ad4)): ?>
                                <?php foreach ($file_slp_ad4 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Kurva S Revisi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:20em" data-counter=0 data-tipefile="kurva_ad4" value="Add kurva_ad4"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_kurva_ad4)): ?>
                                <?php foreach ($file_kurva_ad4 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b><i>Shop Drawing</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="sd_ad4" value="Add sd_ad4"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_sd_ad4)): ?>
                                <?php foreach ($file_sd_ad4 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Berita Acara Klarifikasi Negosiasi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10em" data-counter=0 data-tipefile="bakn_ad4" value="Add bakn_ad4"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bakn_ad4)): ?>
                                <?php foreach ($file_bakn_ad4 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Naskah Addendum IV</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="na4" value="Add na4"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_na4)): ?>
                                <?php foreach ($file_na4 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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

                      </div>

                      <div style="<?php if(empty($file_bal_ad5) && empty($file_boq_ad5) && empty($file_jst_ad5) && empty($file_slp_ad5) && empty($file_kurva_ad5) && empty($file_sd_ad5) && empty($file_bakn_ad5) && empty($file_na5)){echo 'display: none';}?>" data-topic="addendumv">
                        <h4>Adendum V</h4>
                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for=""><b>Berita Acara Lapangan</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="bal_ad5" value="Add bal_ad5"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bal_ad5)): ?>
                                <?php foreach ($file_bal_ad5 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b><i>Bill of Quantity</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="boq_ad5" value="Add boq_ad5"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_boq_ad5)): ?>
                                <?php foreach ($file_boq_ad5 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Justifikasi dan Spesifikasi Teknis</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10.5em" data-counter=0 data-tipefile="jst_ad5" value="Add jst_ad5"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_jst_ad5)): ?>
                                <?php foreach ($file_jst_ad5 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Surat Lampiran Pendukung</b></label>
                              <a class="text-success btn-add-input" style="padding-left:12em" data-counter=0 data-tipefile="slp_ad5" value="Add slp_ad5"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_slp_ad5)): ?>
                                <?php foreach ($file_slp_ad5 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Kurva S Revisi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:20em" data-counter=0 data-tipefile="kurva_ad5" value="Add kurva_ad5"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_kurva_ad5)): ?>
                                <?php foreach ($file_kurva_ad5 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b><i>Shop Drawing</i></b></label>
                              <a class="text-success btn-add-input" style="padding-left:19em" data-counter=0 data-tipefile="sd_ad5" value="Add sd_ad5"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_sd_ad5)): ?>
                                <?php foreach ($file_sd_ad5 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Berita Acara Klarifikasi Negosiasi</b></label>
                              <a class="text-success btn-add-input" style="padding-left:10em" data-counter=0 data-tipefile="bakn_ad5" value="Add bakn_ad5"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_bakn_ad5)): ?>
                                <?php foreach ($file_bakn_ad5 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                              <label for=""><b>Naskah Addendum V</b></label>
                              <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="na5" value="Add na5"><i class="ft-plus"></i> Tambah File</a>
                              <br>
                              <?php if (!empty($file_na5)): ?>
                                <?php foreach ($file_na5 as $u) { ?>
                                  <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                  <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                    <!-- --------------------------------------------------------------------- -->
                    <!-- ------------------------ Hasil Laporan ---------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                     <div class="tab-pane" id="tab36" aria-labelledby="base-tab36">
                      <form class="form input-append" action="<?php echo site_url('ppk/laporan') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Laporan Harian</b></label>
                            <a class="text-success btn-add-input" style="padding-left:17em" data-counter=0 data-tipefile="lh" value="Add lh"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_lh)): ?>
                              <?php foreach ($file_lh as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b>Laporan Mingguan</b></label>
                            <a class="text-success btn-add-input" style="padding-left:16em" data-counter=0 data-tipefile="lm" value="Add lm"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_lm)): ?>
                              <?php foreach ($file_lm as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b>Laporan Bulanan</b></label>
                            <a class="text-success btn-add-input" style="padding-left:16em" data-counter=0 data-tipefile="lb" value="Add lb"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_lb)): ?>
                              <?php foreach ($file_lb as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b>Sertifikat Pembayaran</b></label>
                            <a class="text-success btn-add-input" style="padding-left:14em" data-counter=0 data-tipefile="sp" value="Add sp"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_sp)): ?>
                              <?php foreach ($file_sp as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                    <!-- --------------------------------------------------------------------- -->
                    <!-- ------------------------ Uji Kualitas ---------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-pane" id="tab37" aria-labelledby="base-tab37">
                      <form class="form input-append" action="<?php echo site_url('ppk/ujikualitas') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Berita Acara Pengujian Material</b></label>
                            <a class="text-success btn-add-input" style="padding-left:10em" data-counter=0 data-tipefile="bapm" value="Add bapm"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_bapm)): ?>
                              <?php foreach ($file_bapm as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                    <!-- --------------------------------------------------------------------- -->
                    <!-- ------------------------ Show Cause Meeting (SCM) ------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-pane" id="tab38" aria-labelledby="base-tab38">
                      <form class="form input-append" action="<?php echo site_url('ppk/scm') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Berita Acara <i>Show Cause Meeting </i> (SCM)</b></label>
                            <a class="text-success btn-add-input" style="padding-left:6em" data-counter=0 data-tipefile="scm" value="Add scm"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_scm)): ?>
                              <?php foreach ($file_scm as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                    <!-- ---------------------------------------------------------------------- -->
                    <!-- ------------------------ Provosional Hand Over ------------------------ -->
                    <!-- ----------------------------------------------------------------------- -->
      
                    <div class="tab-pane" id="tab39" aria-labelledby="base-tab39">
                    <form class="form input-append" action="<?php echo site_url('ppk/pho') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Surat Permohonan PHO</b></label>
                            <a class="text-success btn-add-input" style="padding-left:13em" data-counter=0 data-tipefile="sp_pho" value="Add sp_pho"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_sp_pho)): ?>
                              <?php foreach ($file_sp_pho as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b>Berita Acara <i>First Visit</i></b></label>
                            <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="ba_pho" value="Add ba_pho"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_ba_pho)): ?>
                              <?php foreach ($file_ba_pho as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b>Berita Acara <i>Second Visit</i></b></label>
                            <a class="text-success btn-add-input" style="padding-left:13em" data-counter=0 data-tipefile="basv_pho" value="Add basv_pho"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_basv_pho)): ?>
                              <?php foreach ($file_basv_pho as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b>Berita Acara Serah Terima Pekerjaan</b></label>
                            <a class="text-success btn-add-input" style="padding-left:8em" data-counter=0 data-tipefile="bastp_pho" value="Add bastp_pho"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_bastp_pho)): ?>
                              <?php foreach ($file_bastp_pho as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b><i>As Build Drawing</i></b></label>
                            <a class="text-success btn-add-input" style="padding-left:18em" data-counter=0 data-tipefile="abd_pho" value="Add abd_pho"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_abd_pho)): ?>
                              <?php foreach ($file_abd_pho as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                    <!-- ---------------------------------------------------------------------- -->
                    <!-- ------------------------ Final Hand Over ----------------------------- -->
                    <!-- ----------------------------------------------------------------------- -->
      
                    <div class="tab-pane" id="tab40" aria-labelledby="base-tab40">
                    <form class="form input-append" action="<?php echo site_url('ppk/fho') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Surat Permohonan FHO</b></label>
                            <a class="text-success btn-add-input" style="padding-left:13em" data-counter=0 data-tipefile="sp_fho" value="Add sp_fho"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_sp_fho)): ?>
                              <?php foreach ($file_sp_fho as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b>Berita Acara <i>First Visit</i></b></label>
                            <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="ba_fho" value="Add ba_fho"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_ba_fho)): ?>
                              <?php foreach ($file_ba_fho as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b>Berita Acara <i>Second Visit</i></b></label>
                            <a class="text-success btn-add-input" style="padding-left:13em" data-counter=0 data-tipefile="basv_fho" value="Add basv_fho"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_basv_fho)): ?>
                              <?php foreach ($file_basv_fho as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                            <label for=""><b>Berita Acara Serah Terima Pekerjaan</b></label>
                            <a class="text-success btn-add-input" style="padding-left:8em" data-counter=0 data-tipefile="bastp_fho" value="Add bastp_fho"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_bastp_fho)): ?>
                              <?php foreach ($file_bastp_fho as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
                    <!-- ---------------------------------------------------------------------- -->
                    <!-- ------------------------ Final Hand Over ----------------------------- -->
                    <!-- ----------------------------------------------------------------------- -->
      
                    <div class="tab-pane" id="tab41" aria-labelledby="base-tab41">
                    <form class="form input-append" action="<?php echo site_url('ppk/dokumentasi') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Dokumentasi </b></label>
                            <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="dok" value="Add dok"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_dok)): ?>
                              <?php foreach ($file_dok as $u) { ?>
                                <p style="color: green"><?php echo $u['nama_file'] ?></p>
                                <a href="<?php echo base_url()."ppk/hapusfilekontraktual/".$where_paket['id_paket']."/".$u['id_file']; ?>"><button type="button" class="btn btn-icon btn-danger mr-1"><i class="fa fa-times"></i> Hapus</button></a>
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
 <script>

   function ad2(elm){
    $container = $('[data-topic="addendumii"]');
      $container.toggle();
    }
    $('#interviewForm').ready(function() {
    var n = $( "input[type='checkbox'][name='topic1']" );
    var c = n.is(":checked");
    if (c==true) {
      $container = $('[data-topic="addendumii"]');
        $container.toggle();
      }
    })

    function ad3(elm){
    $container = $('[data-topic="addendumiii"]');
      $container.toggle();
    }
    $('#interviewForm').ready(function() {
    var n = $( "input[type='checkbox'][name='topic2']" );
    var c = n.is(":checked");
    if (c==true) {
      $container = $('[data-topic="addendumiii"]');
        $container.toggle();
      }
    })
    function ad4(elm){
    $container = $('[data-topic="addendumiv"]');
      $container.toggle();
    }
    $('#interviewForm').ready(function() {
    var n = $( "input[type='checkbox'][name='topic3']" );
    var c = n.is(":checked");
    if (c==true) {
      $container = $('[data-topic="addendumiv"]');
        $container.toggle();
      }
    })
    function ad5(elm){
    $container = $('[data-topic="addendumv"]');
      $container.toggle();
    }
    $('#interviewForm').ready(function() {
    var n = $( "input[type='checkbox'][name='topic4']" );
    var c = n.is(":checked");
    if (c==true) {
      $container = $('[data-topic="addendumv"]');
        $container.toggle();
      }
    })

  </script>