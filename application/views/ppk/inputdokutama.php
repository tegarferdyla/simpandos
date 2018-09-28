 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Input File</h3>
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
                        <a class="dropdown-item" href="<?php echo base_url()."ppk/updatefilepembangunan/".$where_paket['id_jenis']."/".$where_paket['id_paket'] ?>">Update Dokumen</a>
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
                              <label for="">Surat Minat Daerah</label>
                                <a class="text-success add-smd" style="padding-left:17em"><i class="ft-plus"></i> Add More File</a>
                                <input class="form-control input" id="field1" name="smd[0]" type="file">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput2">Surat Menerima Hibah</label>
                              <a class="text-success add-smh" style="padding-left:15em"><i class="ft-plus"></i> Add More File</a>
                             <input class="form-control input" id="smh1" name="smh[0]" type="file">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput3">Surat Kesiapan Lahan</label>
                               <a class="text-success add-skl" style="padding-left:16em"><i class="ft-plus"></i> Add More File</a>
                              <input autocomplete="off" class="form-control input" id="skl1" name="skl[1]" type="text" placeholder="Surat Kesiapan Lahan 1" data-items="8">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput4">Kesepakatan Bersama</label>
                              <a class="text-success add-ksb" style="padding-left:15em"><i class="ft-plus"></i> Add More File</a>
                              <input autocomplete="off" class="form-control input" id="ksb1" name="ksb[1]" type="text" placeholder="Kesepakatan Bersama 1" data-items="8">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput3">Perjanjian Kerjasma (PKS)</label>
                               <a class="text-success add-pks" style="padding-left:14em"><i class="ft-plus"></i> Add More File</a>
                              <input autocomplete="off" class="form-control input" id="pks1" name="pks[1]" type="text" placeholder="Perjanjian Kerjasma (PKS) 1" data-items="8">
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
                      <form class="form input-append">
                      <div class="form-body">
                        <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">SPPBJ &nbsp;</label>
                                <a class="text-success add-SPPBJ" style="padding-left:23em"><i class="ft-plus"></i> Add More File</a>
                                <input autocomplete="off" class="form-control input" id="SPPBJ1" name="SPPBJ" type="text" placeholder="SPPBJ 1" data-items="8">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput2">SPMK</label>
                              <a class="text-success add-SPMK" style="padding-left:23em"><i class="ft-plus"></i> Add More File</a>
                             <input autocomplete="off" class="form-control input" id="SPMK1" name="SPMK1" type="text" placeholder="SPMK 1" data-items="8">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput3">Naskah Kontrak</label>
                               <a class="text-success add-naskon" style="padding-left:18em"><i class="ft-plus"></i> Add More File</a>
                              <input autocomplete="off" class="form-control input" id="naskon1" name="naskon1" type="text" placeholder="Naskah Kontrak 1" data-items="8">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput4">Rencana Mutu Kontrak</label>
                              <a class="text-success add-rmk" style="padding-left:15em"><i class="ft-plus"></i> Add More File</a>
                              <input autocomplete="off" class="form-control input" id="rmk1" name="rmk1" type="text" placeholder="Rencana Mutu Kontrak 1" data-items="8">
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