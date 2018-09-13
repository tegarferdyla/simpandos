<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="navigation-header">
          <button type="button" class="btn btn-success btn-block">PPK <br><hr><?php echo $data_ppk['nama_ppk']; ?></button>
        </li>
        <li class=" navigation-header">
          <span>General</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="General"></i>
        </li>
        <li class="nav-item <?php if($this->uri->segment(2)==""){echo 'active';}?>"><a href="<?php echo site_url('admin') ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
        </li>
        <hr>
        <!-- Kategori Barang -->
        <li class=" navigation-header">
          <span>Tahun</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="Apps"></i>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="daftartahun" OR $this->uri->segment(2)=="editppk"){
          echo 'active';} ?>"><a href="<?php  echo site_url('ppk/daftartahun') ?>"><i class="ft-bookmark"></i><span class="menu-title" data-i18n="">Daftar Tahun</span></a>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="inputtahun"){
          echo 'active';} ?>"><a href="<?php echo base_url('ppk/inputtahun') ?>"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n="">Input Tahun </span></a>
        </li>
        <!-- Barang -->
        <li class=" navigation-header">
          <span>Paket</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="Apps"></i>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="daftaruser" OR $this->uri->segment(2)=="edituser"){
          echo 'active';} ?>"><a href="index.html"><i class="ft-folder"></i><span class="menu-title" data-i18n="">Daftar Paket</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="">Kontraktual</a>
            </li>
            <li><a class="menu-item" href="">Swakelola</a>
            </li>
          </ul>
        </li>
        <li class="nav-item <?php if ( $this->uri->segment(2)=="inputpaket"){
          echo 'active';} ?>"><a href="<?php echo base_url('ppk/inputpaket') ?>"><i class="ft-plus-circle"></i><span class="menu-title" data-i18n="">Input Paket</span></a>
        </li>
        <hr>
        <!-- Profile -->
        <li class=" navigation-header">
          <span>Profile</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="Apps"></i>
        </li>
        <li class=" nav-item"><a href="<?php echo base_url('admin/editprofile') ?>"><i class="ft-user"></i><span class="menu-title" data-i18n="">Edit Profile</span></a>
        </li>
        <li class=" nav-item <?php if ( $this->uri->segment(2)=="gantipassword"){
          echo 'active';} ?>"><a href="<?php echo base_url('admin/gantipassword') ?>"><i class="ft-lock"></i><span class="menu-title" data-i18n="">Ganti Password</span></a>
        </li>
      </ul>
    </div>
  </div>