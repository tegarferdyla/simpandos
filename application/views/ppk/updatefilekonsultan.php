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
                        <a class="dropdown-item" href="<?php echo base_url()."ppk/viewfilekonsultan/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>">View Dokumen</a>
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
                        href="#tab31" aria-expanded="true">Laporan Perencanaan</a>
                      </li>
                    </ul>
                    <!-- --------------------------------------------------------------------- -->
                    <!-- -------------------LAPORAN PERENCANAAN -------------------------------- -->
                    <!-- --------------------------------------------------------------------- -->
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                      <form class="form input-append" action="<?php echo site_url('ppk/konsultan') ?>" method ="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $where_paket['id_paket']; ?>" name="id_paket">
                        <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for=""><b>Laporan Pendahuluan </b></label>
                            <a class="text-success btn-add-input" style="padding-left:15em" data-counter=0 data-tipefile="lpn" value="Add lpn"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_lpn)): ?>
                              <?php foreach ($file_lpn as $u) { ?>
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
                            <label for=""><b>Laporan Antara </b></label>
                            <a class="text-success btn-add-input" style="padding-left:16em" data-counter=0 data-tipefile="lan" value="Add lan"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_lan)): ?>
                              <?php foreach ($file_lan as $u) { ?>
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
                            <label for=""><b>Draft Laporan Akhir </b></label>
                            <a class="text-success btn-add-input" style="padding-left:16em" data-counter=0 data-tipefile="dlp" value="Add dlp"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_dlp)): ?>
                              <?php foreach ($file_dlp as $u) { ?>
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
                            <label for=""><b>Laporan Akhir </b></label>
                            <a class="text-success btn-add-input" style="padding-left:16em" data-counter=0 data-tipefile="lak" value="Add lak"><i class="ft-plus"></i> Tambah File</a>
                            <br>
                            <?php if (!empty($file_lak)): ?>
                              <?php foreach ($file_lak as $u) { ?>
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