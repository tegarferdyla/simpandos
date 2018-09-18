 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Input Kepala Dokumen</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Input Kepala Dokumen</a>
                </li>
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
                  <h4 class="card-title">Input Kepala Dokumen</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <?php if ($this->session->flashdata('nipsalah')): ?>
                    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> NIP yang anda daftarkan sudah tersedia !</strong>
                    </div>
                    <?php elseif ($this->session->flashdata('berhasil')): ?>
                    <div class="alert alert-success alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> Kepala Dokumen Baru Berhasil Ditambahkan</strong>
                    </div>
                    <?php endif ?>
                    <ul class="nav nav-tabs nav-underline no-hover-bg">
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab31" data-toggle="tab" aria-controls="tab31"
                        href="#tab31" aria-expanded="true">Input Kepala Dokumen Utama</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab32" data-toggle="tab" aria-controls="tab32" href="#tab32"
                        aria-expanded="false">Input Kepala Dokumen Pendukung</a>
                      </li>
                    </ul>
                    <!-- User PPK -->
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                          <br>
                          <form class="form form-horizontal" action="<?php echo base_url('admin/tambahkepaladok') ?>" method="post">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Kepala Dokumen</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Kepala Dokumen"
                                  name="nama_kepala" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Kategori</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" value="Dokumen Utama" 
                                  name="kategori" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Main Jenis</label>
                                <div class="col-md-9">
                                  <select name="main_jenis" class="form-control" required>
                                    <option value="">-- Pilih Jenis --</option>
                                      <option value="Kontraktual">Kontraktual</option>
                                      <option value="Swakelola">Swakelola</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Sub Jenis</label>
                                <div class="col-md-9">
                                  <select name="sub_jenis" class="form-control" >
                                    <option value="">-- Pilih Sub Jenis --</option>
                                      <?php foreach ($data_jenis as $u) { ?>
                                        <option value="<?php echo $u['id_jenis'] ?>"><?php echo $u['sub_jenis'] ?></option>
                                      <?php } ?>
                                  </select>
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
                      <!-- End User PPK -->
                      <div class="tab-pane" id="tab32" aria-labelledby="base-tab32">
                        <br>
                        <form class="form form-horizontal" action="<?php echo base_url('admin/tambahkepaladokpend') ?>" method="post">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Kepala Dokumen</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Kepala Dokumen"
                                  name="nama_kepala" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Kategori</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" value="Dokumen Pendukung" 
                                  name="kategori" readonly>
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