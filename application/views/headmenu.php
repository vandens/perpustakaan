<style>
.menu ul li.active{ /*IE6 hack- hide gooey effect from that browser*/
_visibility: hidden; /*IE6 rule*/
}
.menu{ position:fixed; width:100%; height:45px; background:white; font-size:14px; 
font-family:Bernard MT condensed; 
box-shadow: 3px 3px 8px #818181;
background-image:url(../ci/media/images/background.jpg);
background-repeat:no-repeat;
-webkit-box-shadow: 3px 3px 8px #818181;
-moz-box-shadow: 3px 3px 8px #818181;
margin:0;
}
ul.menubutton{ margin: 0; margin-bottom:1em; margin-top:1em; }
ul.menubutton li{ display: inline; padding-right:35px; }
ul.menubutton li a{ text-decoration:none; color:black;}
ul.menubutton li a:hover{ color:blue;}
ul.menubutton li.active{
position:absolute;
width:100%;
border-bottom:5px solid navy;
}

.logo{ position:absolute; float:left; margin:0;}
</style>

<div class='menu'>
<div class='logo'>
<img src='../ci/media/images/logo.png' width='100px'>
</div>
<ul class="menubutton">
<li><a href="?p=home" style='margin-left:75px;'>Home</a></li>
<li><a href="?p=profil"  data-flexmenu="flexmenu1">Profil</a></li>
<li><a href="?p=osis"  data-flexmenu="flexmenu2">OSIS</a></li>
<li><a href="?p=info"  data-flexmenu="flexmenu3">Info Sekolah</a></li>
<li><a href="?p=kontak"  data-flexmenu="flexmenu4">Kotak</a></li>
<li><a href="?p=bukutamu"  data-flexmenu="flexmenu5">Buku Tamu</a></li>
<li class='cari' style='float:right'><form name='cari' action='' method='' style='align:right'><input type='text' name='item' value=''></form></li>
</ul>
</div>

<!--HTML for Flex Drop Down Menu 1-->
<ul id="flexmenu1" class="flexdropdownmenu">
<li><a href="?p=visimisi">Visi dan Misi</a></li>
<li><a href="?p=sarana">Sarana Prasarana</a>
	<ul>
	<li><a href="?p=labkom">Lab. Komputer</a></li>
	<li><a href="?p=bengkof">Bengkel Otomotif</a></li>
	<li><a href="?p=kambangan">Kambangan</a></li>
	<li><a href="?p=fasum">Fasilitas Umum</a></li>
	</ul>
</li>
<li><a href="?p=kepsek">Kepala Sekolah</a></li>
<li><a href="?p=proker">Program Kerja</a>
	<ul>
	<li><a href="#">Sub Item 5.1a</a></li>
	<li><a href="#">Item Folder 5.2a</a>
		<ul>
		<li><a href="#">Sub Item 5.2.1a</a></li>
		<li><a href="#">Sub Item 5.2.2a</a></li>
		<li><a href="#">Sub Item 5.2.3a</a></li>
		<li><a href="#">Sub Item 5.2.4a</a></li>
		</ul>
	</li>
	</ul>
</li>
<li><a href="?p=komite">Komite Sekolah</a></li>
<li><a href="?p=prestasi">Prestasi</a></li>
</ul>


<!--HTML for Flex Drop Down Menu 2-->
<ul id="flexmenu2" class="flexdropdownmenu">
<li><a href="?p=ekskul">Ekstrakulikuler</a>
	<ul>
	<li><a href="?p=paskib">Paskibra</a></li>
	<li><a href="?p=pmr">PMR</a></li>
	<li><a href="?p=silat">Pencak Silat</a></li>
	<li><a href="?p=marawis">Marawis</a></li>
	</ul>
</li>
<li><a href="?p=prestasi">Prestasi</a></li>
</ul>

<!--HTML for Flex Drop Down Menu 3-->
<ul id="flexmenu3" class="flexdropdownmenu">
<li><a href="#">Agenda</a>
	<ul>
	<li><a href="#"> ========== </a></li>
	<li><a href="#"> ========== </a></li>
	<li><a href="#"> ========== </a></li>
	<li><a href="#"> ========== </a></li>
	</ul>
</li>
<li><a href="#">Program Studi</a>
	<ul>
	<li><a href="#"> Administrasi Perkantoran </a></li>
	<li><a href="#"> Teknik Otomotif </a></li>
	<li><a href="#"> Teknik Jaringan Komputer</a></li>
	<li><a href="#"> Rekayasa Perangkat Lunak </a></li>
	</ul>
</li>
<li><a href="#">Artikel</a></li>
<li><a href="#">Brosur</a></li>
<li><a href="#">Galeri</a></li>
<li><a href="#">Link</a></li>
</ul>