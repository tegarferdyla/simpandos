 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Pilih Paket</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('ppk') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('ppk/jenispaket/'.$data_tahun['id_tahun']) ?>"><?php echo $data_tahun['nama_tahun']; ?></a>
                </li>
                <li class="breadcrumb-item"><a href=""><?php echo $where_jenis['main_jenis']; ?></a></li>
                <?php if ($where_jenis['sub_jenis']) :?>
                  <li class="breadcrumb-item"><a href=""><?php echo $where_jenis['sub_jenis']; ?></a></li>
                <?php endif ?>  
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
        <?php if ($this->session->flashdata('kosong')):?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-warning alert-dismissible mb-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="false">&times;</span>
              </button>
              <strong> Maaf,  Tidak ada daftar paket yang tersedia pada jenis paket yang anda pilih  !</strong>
            </div>
          </div>
        </div>
        <?php endif ?>
        <section>
          <div class="row match-height">
            <div class="col-lg-12 col-xl-12">
              <div class="mb-2 mt-2">
                <h5 class="mb-0 text-uppercase">Jenis Paket : <font color="Blue"><?php echo $where_jenis['main_jenis']; ?></font></h5>
                <?php if ($where_jenis['sub_jenis']) :?>
                  <p>Sub Jenis Paket : <?php echo $where_jenis['sub_jenis']; ?></p>
                <?php endif ?> 
              </div>
              <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                <div class="card collapse-icon accordion-icon-rotate">
                  <?php foreach ($view_paket as $u) { ?>
                  <div id="heading11" class="card-header">
                    <a data-toggle="collapse" data-parent="#accordionWrap1" href="#<?php echo $u['id_paket']; ?>" aria-expanded="false" class="card-title lead"><?php echo $u['nama_paket']; ?></a>
                  </div>
                  <div id="<?php echo $u['id_paket']; ?>" role="tabpanel" aria-labelledby="heading11" class="collapse">
                    <div class="card-content">
                      <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                              <a href=""><span class="fa fa-file"></span> <font style="color:black">&nbsp; Dokumen Utama</font></a>
                            </li>
                            <li class="list-group-item">
                              <a href=""><span class="fa fa-file-text"></span> <font style="color:black">&nbsp; Dokumen Pendukung</font></a>
                            </li>
                          </ul>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Zero configuration table -->
      </div>
    </div>
  </div>