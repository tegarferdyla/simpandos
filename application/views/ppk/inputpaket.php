 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Input Paket</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Input Paket</a>
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
                  <h4 class="card-title">Input Paket</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <?php if ($this->session->flashdata('kontraktualberhasil')): ?>
                    <div class="alert alert-success alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> Paket Kontraktual anda berhasil ditambahkan !</strong>
                    </div>
                    <?php elseif ($this->session->flashdata('swakelolaberhasil')): ?>
                    <div class="alert alert-success alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> Paket Swakelola anda berhasil ditambahkan !</strong>
                    </div>
                    <?php elseif ($this->session->flashdata('pakettersedia')): ?>
                    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> Paket yang anda daftarkan sudah tersedia !</strong>
                    </div>
                    <?php elseif ($this->session->flashdata('gagal')): ?>
                    <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                      </button>
                      <strong> User baru gagal di tambahkan !</strong>
                    </div>
                    <?php endif ?>
                    <ul class="nav nav-tabs nav-underline no-hover-bg">
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab31" data-toggle="tab" aria-controls="tab31"
                        href="#tab31" aria-expanded="true">Paket Kontraktual</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab32" data-toggle="tab" aria-controls="tab32" href="#tab32"
                        aria-expanded="false">Paket Swakelola</a>
                      </li>
                    </ul>
                    <!-- User PPK -->
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                          <br>
                          <form class="form form-horizontal" action="<?php echo base_url('ppk/tambahkontraktual') ?>" method="post">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Nama Paket</label>
                                <div class="col-md-9">
                                  <span class="text-danger"><?=form_error('nip') ?></span>
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Nama Paket"
                                  name="nama_paket" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Jenis Paket</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" name="" readonly="" value="Kontraktual"> 
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Sub Jenis</label>
                                <div class="col-md-9">
                                  <select name="id_jenis" class="form-control" required>
                                    <option value="">-- Pilih Sub Jenis Kontraktual --</option>
                                    <?php foreach ($data_jenis as $u) { ?>
                                      <option value="<?php echo $u['id_jenis'] ?>"><?php echo $u['sub_jenis']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Tahun</label>
                                <div class="col-md-9">
                                  <select name="id_tahun" class="form-control" required>
                                    <option value="">-- Pilih Tahun Paket --</option>
                                    <?php foreach ($data_tahun as $u) { ?>
                                      <option value="<?php echo $u['id_tahun'] ?>"> Tahun <?php echo $u['nama_tahun']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Deskripsi Paket</label>
                                <div class="col-md-9">
                                  <textarea name="deskripsi" id="" cols="20" rows="10" class="form-control"></textarea>
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
                        <form class="form form-horizontal" action="<?php echo base_url('ppk/tambahswakelola') ?>" method="post">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Nama Paket</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Nama Paket"
                                  name="nama_paket" required>
                                </div>
                              </div>
                                <div class="col-md-9">
                                  <input type="hidden" id="projectinput1" class="form-control" name="id_jenis" value="JNS0005">
                                </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Jenis Paket</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Nama Paket"
                                  name="" value="Swakelola" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Tahun</label>
                                <div class="col-md-9">
                                  <select name="id_tahun" class="form-control" required>
                                    <option value="">-- Pilih Tahun Paket --</option>
                                    <?php foreach ($data_tahun as $u) { ?>
                                      <option value="<?php echo $u['id_tahun'] ?>"> Tahun <?php echo $u['nama_tahun']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Deskripsi Paket</label>
                                <div class="col-md-9">
                                  <textarea name="deskripsi" id="" cols="20" rows="10" class="form-control"></textarea>
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
          </div>
        </section>
        <!--/ Zero configuration table -->
      </div>
    </div>
  </div>