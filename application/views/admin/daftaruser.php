 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Daftar User</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Daftar User</a>
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
                  <h4 class="card-title">Daftar User</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <?php if ($this->session->flashdata('ppkberhasil')):?>
                      <div class="alert alert-success alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="false">&times;</span>
                        </button>
                        <strong> User PPK Baru Berhasil Ditambahkan !</strong>
                      </div>
                    <?php elseif ($this->session->flashdata('bmnberhasil')): ?>
                      <div class="alert alert-success alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="false">&times;</span>
                        </button>
                        <strong> User BMN Baru Berhasil Ditambahkan !</strong>
                      </div>
                    <?php elseif ($this->session->flashdata('spmberhasil')): ?>
                      <div class="alert alert-success alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="false">&times;</span>
                        </button>
                        <strong> User SPM Baru Berhasil Ditambahkan !</strong>
                      </div>
                    <?php elseif ($this->session->flashdata('bendaharaberhasil')): ?>
                      <div class="alert alert-success alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="false">&times;</span>
                        </button>
                        <strong> User Bendahara Baru Berhasil Ditambahkan !</strong>
                      </div>
                    <?php elseif ($this->session->flashdata('updateberhasil')): ?>
                      <div class="alert alert-info alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="false">&times;</span>
                        </button>
                        <strong> User Berhasil di Perbaharui !</strong>
                      </div>
                    <?php elseif ($this->session->flashdata('deleteberhasil')): ?>
                      <div class="alert alert-primary alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="false">&times;</span>
                        </button>
                        <strong> User Berhasil di Hapus !</strong>
                      </div>
                    <?php endif ?>
                    <ul class="nav nav-tabs nav-underline no-hover-bg">
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab31" data-toggle="tab" aria-controls="tab31"
                        href="#tab31" aria-expanded="true">User PPK</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab32" data-toggle="tab" aria-controls="tab32" href="#tab32"
                        aria-expanded="false">User BMN</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab33" data-toggle="tab" aria-controls="tab33" href="#tab33"
                        aria-expanded="false">User SPM</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab33" data-toggle="tab" aria-controls="tab33" href="#tab34"
                        aria-expanded="false">User Bendahara</a>
                      </li>
                    </ul>
                    <!-- User PPK -->
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                        <table class="table table-striped table-bordered zero-configuration">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>NIP</th>
                              <th>Nama</th>
                              <th>Divisi</th>
                              <th>Email</th>
                              <th>Username</th>
                              <th>Action</th>
                              <!-- <th>Action</th> -->
                            </tr>
                          </thead>
                          <tbody>
                              <?php $no = 1; ?>
                              <?php 
                                foreach ($user_ppk as $u) {
                              ?> 
                              <tr>
                                <td class="center"><?php echo ($no++); ?></td>
                                <td><?php echo($u->nip);?></td>
                                <td><?php echo ($u->nama_user); ?></td>
                                <td><?php echo ($u->divisi); ?></td>
                                <td><?php echo ($u->email); ?></td>
                                <td><?php echo ($u->username); ?></td>
                                <td class="">
                                  <a href ="<?php echo base_url()."admin/edituser/".$u->id_user; ?>"><button type="button" class="btn btn-outline-primary "><i class="fa fa-edit"></i> Edit</button></a>
                                  <a href ="<?php echo base_url()."admin/hapususer/".$u->id_user; ?>" onclick="return confirm('Apa anda yakin ingin menghapus PPK ini?')"><button type="button" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Hapus</button></a>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>No</th>
                              <th>NIP</th>
                              <th>Nama</th>
                              <th>Divisi</th>
                              <th>Email</th>
                              <th>Username</th>
                              <th>Action</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- End User PPK -->
                      <div class="tab-pane" id="tab32" aria-labelledby="base-tab32">
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php 
                              foreach ($user_bmn as $u) {
                            ?>                        
                            <tr>
                              <td class="center"><?php echo($no++); ?></td>
                              <td><?php echo($u->nip);?></td>
                              <td><?php echo ($u->nama_user); ?></td>
                              <td><?php echo ($u->divisi); ?></td>
                              <td><?php echo ($u->email); ?></td>
                              <td><?php echo ($u->username); ?></td>
                              <td class="right">
                                <a href ="<?php echo base_url()."admin/edituser/".$u->id_user; ?>"><button type="button" class="btn btn-outline-primary mr-1"><i class="fa fa-edit"></i> Edit</button></a>
                                <a href ="<?php echo base_url()."admin/hapususer/".$u->id_user; ?>" onclick="return confirm('Apa anda yakin ingin menghapus PPK ini?')"><button type="button" class="btn btn-outline-danger mr-1"><i class="fa fa-trash"></i> Hapus</button></a>
                              </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                      </div>
                      <div class="tab-pane" id="tab33" aria-labelledby="base-tab33">
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php 
                              foreach ($user_spm as $u) {
                            ?> 
                            <tr>
                              <td class="center"><?php echo($no++); ?></td>
                              <td><?php echo($u->nip);?></td>
                              <td><?php echo ($u->nama_user); ?></td>
                              <td><?php echo ($u->divisi); ?></td>
                              <td><?php echo ($u->email); ?></td>
                              <td><?php echo ($u->username); ?></td>
                              <td class="right">
                                <a href ="<?php echo base_url()."admin/edituser/".$u->id_user; ?>"><button type="button" class="btn btn-outline-primary mr-1"><i class="fa fa-edit"></i> Edit</button></a>
                                <a href ="<?php echo base_url()."admin/hapususer/".$u->id_user; ?>" onclick="return confirm('Apa anda yakin ingin menghapus PPK ini?')"><button type="button" class="btn btn-outline-danger mr-1"><i class="fa fa-trash"></i> Hapus</button></a>
                              </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                      </div>
                      <div class="tab-pane" id="tab34" aria-labelledby="base-tab34">
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php 
                              foreach ($user_bendahara as $u) {
                            ?> 
                            <tr>
                              <td class="center"><?php echo($no++); ?></td>
                              <td><?php echo($u->nip);?></td>
                              <td><?php echo ($u->nama_user); ?></td>
                              <td><?php echo ($u->divisi); ?></td>
                              <td><?php echo ($u->email); ?></td>
                              <td><?php echo ($u->username); ?></td>
                              <td class="right">
                                <a href ="<?php echo base_url()."admin/edituser/".$u->id_user; ?>"><button type="button" class="btn btn-outline-primary mr-1"><i class="fa fa-edit"></i>Edit</button></a>
                                <a href ="<?php echo base_url()."admin/hapususer/".$u->id_user; ?>" onclick="return confirm('Apa anda yakin ingin menghapus PPK ini?')"><button type="button" class="btn btn-outline-danger mr-1"><i class="fa fa-trash"></i>Hapus</button></a>
                              </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
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