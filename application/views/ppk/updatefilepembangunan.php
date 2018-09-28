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
                        aria-expanded="false">Uji Berita konstruksi</a>
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
  <script language="javascript">

</script>