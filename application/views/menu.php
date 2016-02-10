<div class='menu'>
<div class='logo'>
<img src='<?php echo base_url(); ?>media/img/logo.png' width='70px'>
</div>
<ul class="menubutton">

<?php if($this->session->userdata('status') == '1'){ ?>


<li><a href="<?php echo base_url(); ?>" >Beranda</a></li>
<li><a href="#" data-flexmenu="flexmenu1">Data Master</a></li>
<li><a href="#" data-flexmenu="flexmenu2">Transaksi</a></li>
<li><a href="#" data-flexmenu="flexmenu3">Laporan</a></li> 
<li><a href="<?php echo base_url(); ?>home/dashboard" data-flexmenu="flexmenu5">Pengaturan</a></li>
<li><a href="<?php echo base_url(); ?>login/logout">Keluar</a></li>
<li style='float:right'>Hi, <?php echo $this->session->userdata('user'); ?></li>

<?php }elseif($this->session->userdata('status') == '2'){ ?>

<li><a href="<?php echo base_url(); ?>" >Beranda</a></li>
<li><a href="<?php echo base_url(); ?>catalog">Katalog</a></li>
<li><a href="<?php echo base_url(); ?>">Recent</a></li>
<li><a href="<?php echo base_url(); ?>login/logout">Keluar</a></li>
<li style='float:right'>Hi, <?php echo $this->session->userdata('user'); ?></li>

<?php }elseif($this->session->userdata('status') == '3'){ ?>

<li><a href="<?php echo base_url(); ?>" >Beranda</a></li>
<li><a href="#" data-flexmenu="flexmenu1">Data Master</a></li>
<li><a href="#" data-flexmenu="flexmenu2">Transaksi</a></li>
<li><a href="<?php echo base_url(); ?>login/logout">Keluar</a></li>
<li style='float:right'>Hi, <?php echo $this->session->userdata('user'); ?></li>

<?php } ?>
</ul>
</div>





<!--HTML for Flex Drop Down Menu 1-->
<ul id="flexmenu1" class="flexdropdownmenu">
<li><a href="<?php echo base_url(); ?>catalog">Katalog</a></li>
<li><a href="<?php echo base_url(); ?>user">Anggota</a></li>
<!--
<li><a href="<?php echo base_url(); ?>jenis">Kategori</a></li>
<li><a href="<?php echo base_url(); ?>">Belum Ditentukan</a></li>
-->
</ul>


<!--HTML for Flex Drop Down Menu 2-->
<ul id="flexmenu2" class="flexdropdownmenu">
<!--
<li><a href="<?php echo base_url(); ?>trx/rent">Peminjaman Buku</a>
	<ul>
	<li><a href='<? echo base_url();?>trx/rent/peminjaman'>Form Peminjaman</a></li>
	<li><a href=''>Status Peminjaman</a></li>
	</ul>
</li>
-->
<li><a href="<?php echo base_url();?>peminjaman">Peminjaman</a></li>
<li><a href="<?php echo base_url(); ?>pengembalian">Pengembalian Buku</a></li>
</ul>

<ul id="flexmenu3" class="flexdropdownmenu">
<li><a href="<?php echo base_url(); ?>report/denda">Laporan Denda</a></li>
<li><a href="<?php echo base_url(); ?>report/activity">Aktifitas Histori</a></li>
<!--
<li><a href="<?php echo base_url(); ?>report/postalmail">Postal Mail</a></li>
-->
</ul>