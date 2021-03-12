<?php
$unit = $_GET['unit'];
if($unit == "home_unit") {
    require_once 'unit/home_unit.php';
}
else if($unit == "slider_unit") {
    require_once 'unit/slider_unit.php';
}
else if($unit == "kategori_unit") {
    require_once 'unit/kategori_unit.php';
}
else if($unit == "brand_unit") {
    require_once 'unit/brand_unit.php';
}
else if($unit == "produk_unit") {
    require_once 'unit/produk_unit.php';
}
else if($unit == "detailproduk_unit") {
    require_once 'unit/detailproduk_unit.php';
}
else if($unit == "bloglist_unit") {
    require_once 'unit/bloglist_unit.php';
}
else if($unit == "detailblog_unit") {
    require_once 'unit/detailblog_unit.php';
}
else if($unit == "produkterbaru_unit") {
    require_once 'unit/produkterbaru_unit.php';
}
else if($unit == "produkkategori_unit") {
    require_once 'unit/produkkategori_unit.php';
}
else if($unit == "rekomendasiproduk_unit") {
    require_once 'unit/rekomendasiproduk_unit.php';
}
else if($unit == "kontak_unit") {
    require_once 'unit/kontak_unit.php';
}
else if($unit == "login_unit") {
    require_once 'unit/login_unit.php';
}
else if($unit == "produkpencarian_unit") {
    require_once 'unit/produkpencarian_unit.php';
}
else if($unit == "proseskomentar_unit") {
    require_once 'unit/proseskomentar_unit.php';
}
else if($unit == "brandpencarian_unit") {
    require_once 'unit/brandpencarian_unit.php';
}
else if($unit == "videoiklan_unit") {
    require_once 'unit/videoiklan_unit.php';
}
else if($unit == "produksubkat_unit") {
    require_once 'unit/produksubkat_unit.php';
}
else if($unit == "produkkat_unit") {
    require_once 'unit/produkkat_unit.php';
}
else if($unit == "captcha") {
    require_once 'unit/captcha.php';
}
else if($unit == "biografi_unit") {
    require_once 'unit/biografi_unit.php';
}