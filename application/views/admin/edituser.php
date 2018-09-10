 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Edit User</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Edit User</a>
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
        <section id="horizontal-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Edit User</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">

                    <form class="form form-horizontal" action="<?php echo base_url('admin/updateuser') ?>" method="post">
                        <div class="form-body">
                          <div class="form-group row">
                            <div class="col-md-9">
                              <input type="hidden" id="projectinput1" class="form-control" placeholder="Nama Lengkap"
                              name="id_user" value="<?php echo $get_user['id_user'] ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="projectinput1">NIP</label>
                            <div class="col-md-9">
                              <span class="text-danger"><?=form_error('nip') ?></span>
                              <input type="text" id="projectinput1" class="form-control" placeholder="NIP"
                              name="nip" required value="<?php echo $get_user['nip'] ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="projectinput1">Nama Lengkap</label>
                            <div class="col-md-9">
                              <input type="text" id="projectinput1" class="form-control" placeholder="Nama Lengkap"
                              name="nama" value="<?php echo $get_user['nama_user'] ?>" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="projectinput1">Divisi</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" placeholder="" name="bagian" value="<?php echo $get_user['bagian'] ?>" readonly>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="projectinput1">Email</label>
                            <div class="col-md-9">
                              <input type="email" id="projectinput1" class="form-control" placeholder="Email"
                              name="email" value ="<?php echo $get_user['email'] ?>" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="projectinput1">Alamat</label>
                            <div class="col-md-9">
                              <textarea name="alamat" id="" cols="20" rows="10" class="form-control"><?php echo $get_user['alamat']?></textarea>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="projectinput1">Username</label>
                            <div class="col-md-9">
                              <input type="text" id="projectinput1" class="form-control" placeholder="Username"
                              name="username" value="<?php echo $get_user['username'] ?>" required>
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
        </section>
      </div>
    </div>
  </div>