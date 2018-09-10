 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Input User</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Input User</a>
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
                  <h4 class="card-title">Input User</h4>
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
                        href="#tab31" aria-expanded="true">Input User PPK</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab32" data-toggle="tab" aria-controls="tab32" href="#tab32"
                        aria-expanded="false">Input User BMN</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab33" data-toggle="tab" aria-controls="tab33" href="#tab33"
                        aria-expanded="false">Input User SPM</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab33" data-toggle="tab" aria-controls="tab33" href="#tab34"
                        aria-expanded="false">Input User Bendahara</a>
                      </li>
                    </ul>
                    <!-- User PPK -->
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                          <br>
                          <form class="form form-horizontal" action="<?php echo base_url('admin/tambahuserppk') ?>" method="post">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">NIP</label>
                                <div class="col-md-9">
                                  <span class="text-danger"><?=form_error('nip') ?></span>
                                  <input type="text" id="projectinput1" class="form-control" placeholder="NIP"
                                  name="nip" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Nama Lengkap</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Nama Lengkap"
                                  name="nama" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Divisi</label>
                                <div class="col-md-9">
                                  <select name="id_ppk" class="form-control" required>
                                    <option value="">-- Pilih Divisi --</option>
                                    <?php foreach ($data_ppk as $u) { ?>
                                      <option value="<?php echo $u['id_ppk'] ?>"><?php echo $u['nama_ppk']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                <div class="col-md-9">
                                  <input type="email" id="projectinput1" class="form-control" placeholder="Email"
                                  name="email" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Alamat</label>
                                <div class="col-md-9">
                                  <textarea name="alamat" id="" cols="20" rows="10" class="form-control"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Username</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Username"
                                  name="username" required>
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
                        <form class="form form-horizontal" action="<?php echo base_url('admin/tambahuserbmn') ?>" method="post">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">NIP</label>
                                <div class="col-md-9">
                                  <span class="text-danger"><?=form_error('nip') ?></span>
                                  <input type="text" id="projectinput1" class="form-control" placeholder="NIP"
                                  name="nip" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Nama Lengkap</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Nama Lengkap"
                                  name="nama" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Divisi</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" placeholder="BMN" name="bagian" value="BMN" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                <div class="col-md-9">
                                  <input type="email" id="projectinput1" class="form-control" placeholder="Email"
                                  name="email" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Alamat</label>
                                <div class="col-md-9">
                                  <textarea name="alamat" id="" cols="20" rows="10" class="form-control"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Username</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Username"
                                  name="username" required>
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
                      <div class="tab-pane" id="tab33" aria-labelledby="base-tab33">
                        <br>
                        <form class="form form-horizontal" action="<?php echo base_url('admin/tambahuserspm') ?>" method="post">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">NIP</label>
                                <div class="col-md-9">
                                  <span class="text-danger"><?=form_error('nip') ?></span>
                                  <input type="text" id="projectinput1" class="form-control" placeholder="NIP"
                                  name="nip" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Nama Lengkap</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Nama Lengkap"
                                  name="nama" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Divisi</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" placeholder="SPM" name="bagian" value="SPM" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                <div class="col-md-9">
                                  <input type="email" id="projectinput1" class="form-control" placeholder="Email"
                                  name="email" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Alamat</label>
                                <div class="col-md-9">
                                  <textarea name="alamat" id="" cols="20" rows="10" class="form-control"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Username</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Username"
                                  name="username" required>
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
                      <div class="tab-pane" id="tab34" aria-labelledby="base-tab34">
                        <br>
                        <form class="form form-horizontal" action="<?php echo base_url('admin/tambahuserbendahara') ?>" method="post">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">NIP</label>
                                <div class="col-md-9">
                                  <span class="text-danger"><?=form_error('nip') ?></span>
                                  <input type="text" id="projectinput1" class="form-control" placeholder="NIP"
                                  name="nip" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Nama Lengkap</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Nama Lengkap"
                                  name="nama" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Divisi</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" placeholder="Bendahara" name="bagian" value="Bendahara" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                <div class="col-md-9">
                                  <input type="email" id="projectinput1" class="form-control" placeholder="Email"
                                  name="email" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Alamat</label>
                                <div class="col-md-9">
                                  <textarea name="alamat" id="" cols="20" rows="10" class="form-control"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Username</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput1" class="form-control" placeholder="Username"
                                  name="username" required>
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