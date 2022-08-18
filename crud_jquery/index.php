<?php
// include db config
include_once("config.php");
// Seting-an Database anda
// include dan membuat object
include(PHPGRID_LIBPATH."inc\jqgrid_dist.php");
$g = new jqgrid();
// seting tabel untuk CRUD sesuai dengan nama tabel
$g->table = "clients";
$grid["caption"] = "Daftar Nama Client";
$grid["form"]["position"] = "center";
$grid["autowidth"] = true;
$grid["autoresize"] = true; // responsive effect
$g->set_options($grid);
$col = array();
$col["title"] = "Id"; // nama kolom yang akan ditampilkan
$col["name"] = "client_id"; // nama colom client_id diambil dari database mysql
$col["editable"] = true;
$col["width"] = "30";
$cols[] = $col;
$col = array();
$col["title"] = "Nama"; // nama kolom yang akan ditampilkan
$col["name"] = "name"; // nama colom name diambil dari database mysql
$col["editable"] = true;
$col["required"] = true;
$cols[] = $col;
$col = array();
$col["title"] = "Jeni Kelamin"; // nama kolom yang akan ditampilkan
$col["name"] = "gender"; // nama colom gender diambil dari database mysql
$col["editable"] = true;
$cols[] = $col;
$col = array();
$col["title"] = "Perusahaan"; // nama kolom yang akan ditampilkan
$col["name"] = "company"; // nama colom company diambil dari database mysql
$col["editable"] = true;
$col["editoptions"] = array("defaultValue" => "Default Company");
$cols[] = $col;
$g->set_columns($cols);
$g->set_actions(array(  // untuk melakukan aksi
"add"=>true,
"edit"=>true,
"delete"=>true,
"clone"=>true,
"rowactions"=>true,
"search" => "advance",
"showhidecolumns" => false
)
);
// untuk menampilkan tabel
$tampil = $g->render("list1");
// untuk Tema
$themes = array("black-tie","blitzer","cupertino","dark-hive","dot-luv","eggplant","excite-bike","flick","hot-sneaks","humanity","le-frog","mint-choc","overcast","pepper-grinder","redmond","smoothness","south-street","start","sunny","swanky-purse","trontastic","ui-darkness","ui-lightness","vader");
$i = rand(0,8);
if (is_numeric($_GET["themeid"]))
$i = $_GET["themeid"];
else
$i = 14;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Membuat CRUD dengan phpjqGrid,boostrap & mysql</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" type="text/css" media="screen" href="lib/js/themes/<?php echo $themes[$i] ?>/jquery-ui.custom.css">
<link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.bootstrap.jqgrid.css">
<script src="lib/js/jquery.min.js" type="text/javascript"></script>
<script src="lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script src="lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<body>
<div class="row-fluid">
<div class="span12">
<div style="margin:10px">
<form method="get">
Pilih Theme: <select name="themeid" onchange="form.submit()">
<?php foreach($themes as $k=>$t) { ?>
<option value=<?php echo $k?> <?php echo ($i==$k)?"selected":""?>><?php echo ucwords($t)?></option>
<?php } ?>
</select> -
Anda bisa custum theme di (<a href="http://jqueryui.com/themeroller">jqueryui.com/themeroller</a>).
</form>
<?php echo $tampil?> <!--untuk menampilkan tabel-->
</div>
</div><!--/span-->
</div><!--/row-->
<div class="row-fluid">
<div class="span12">
<div class="row-fluid">
<div class="alert alert-info">
<a name="contact"></a>
<h2>www.andeznet.com</h2>
<p class="text-info">Gudang Teknologi & Informasi</p>
<p>&copy; <a href="http://andeznet.com">www.andeznet.com</a>&nbsp<?php echo date("Y");?></p>
</div><!--/span-->
</div><!--/row-->
</div><!--/span-->
</div><!--/row-->
</body>
</html>