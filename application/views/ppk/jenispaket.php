 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Jenis Paket</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('ppk') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#"><?php echo $data_tahun['nama_tahun']; ?></a>
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
             <div class="col-xl-6 col-md-6 col-sm-12">
              <div class="card">
                <div class="card-content">
                  <img class="card-img-top img-fluid" src="<?php echo base_url('app-assets/images/gallery/jembatan1.jpg') ?>"
                  alt="Card image cap">
                  <div class="card-body">
                    <h2 class="text-center">Kontraktual</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita esse magni laborum deleniti.</p>
                    <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                      <div class="card collapse-icon panel mb-0 box-shadow-0 border-0">
                        <div id="heading11" role="tab" class="card-header border-bottom-blue-grey border-bottom-lighten-2">
                        <a data-toggle="collapse" data-parent="#accordionWrap1" href="#accordion11" aria-expanded="true"
                        aria-controls="accordion11" class="h6 red">Sub Paket Kontraktual</a>
                      </div>
                      <div id="accordion11" role="tabpanel" aria-labelledby="heading11" class="collapse show" aria-expanded="true">
                        <div class="card-body">
                          <ul class="list-group list-group-flush">
                            <?php foreach ($data_jenis as $u) { ?>
                            <li class="list-group-item">
                              <a href="<?php echo base_url()."ppk/pilihpaket/".$data_tahun['id_tahun']."/".$u['id_jenis'] ?>" style="none"><?php echo $u['sub_jenis']; ?></a>
                            </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                      </div>
                    </div>    
                  </div>
                </div>
              </div>
            </div>

             <div class="col-xl-6 col-md-6 col-sm-12">
              <div class="card">
                <div class="card-content">
                  <img class="card-img-top img-fluid" src="<?php echo base_url('app-assets/images/gallery/toba.jpg') ?>"
                  alt="Card image cap">
                  <div class="card-body">
                    <h2 class="text-center">Swakelola</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo autem culpa fuga assumenda totam.</p>
                    <a href="<?php echo base_url()."ppk/pilihpaket/".$data_tahun['id_tahun']."/JNS0005" ?>" class="btn btn-block btn-outline-amber">Lihat Paket </a>
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