<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>PHP Veri Sayfalama</title>
</head>
<body>
<?php
/*
FK Veri Sayfalama
Yazar: Firat KOYUNCU
Nick: FK Designer
Website: www.fkdesigner.com
E-Mail: fkdesigner@hotmail.com - iletisim@fkdesigner.com
Facebook Sayfasi: www.facebook.com/fkdesigner
Twitter Sayfasi: www.twitter.com/fkdesigner
*/

#BURADA VERİTABANINIZA BAGLANMAK ICIN GEREKLI KODLARI YAZMAYI UNUTMAYIN !

//Sayfalama icin islemler:
//Sayfa numarasi aliniyor no degiskeni ile.
@$no = $_GET["no"];
//Sayfa numarasi yerine numaradan baska bir sey girmesi engelleniyor.
if (eregi ("^[0-9]{1,}$", $no, $no)){
$no = $no[0];
}
else {
$no = 1;
}
//Eger sayfa numarasi girilmemisse otomatik olarak ilk sayfa aciliyor.
if(empty($no)){
$no = 1;
}
//Her sayfada listelenecek veri sayisi giriliyor.
$sayfalik_kayit = 10;
//Toplam kayit bulunuyor.
#BURADA BEN VERiTABANI OLARAK "veritabanim" YAZDIM SiZ KENDiNiZE GORE ALACAGiNiZ VERiYi CEKMEK iCiN GEREKLi KODU YAZIN.
$toplam = mysql_query("SELECT * FROM veritabanim");
$toplam_kayit = mysql_num_rows($toplam);
//Toplam sayfa sayisi bulunuyor.
$toplam_sayfa = ceil($toplam_kayit/$sayfalik_kayit);
//Eger olmayan sayfa girilmisse otomatik olarak ilk sayfa aciliyor.
if($no>$toplam_sayfa){
$no=1;
}
//Acik olan sayfada listelenecek ilk kayit numarasi.
$baslangic = (($no*$sayfalik_kayit)-$sayfalik_kayit);
//Acik olan sayfada listelenecek son kayit numarasi.
$bitis = ($no * $sayfalik_kayit);
//Listeleme icin secilen veriler.
#TEKRAR VERiTABANI OLARAK "veritabanim" ADINI KULLANDIK.
$veriler = mysql_query("select * from veritabanim order by no limit $baslangic,$bitis");
//Eğer sayfamiz 1'den buyukse o zaman geri linki olusturup ekrana yazdiriyoruz. 
if($no>1){
echo '<a href='.$PHP_SELF.'?no='.($no-1).'>Geri</a> | ';
}
//For dongusu ile diger sayfalarin linkini ekrana yazdiriyoruz.
for($i=0; $i<$toplam_sayfa; $i++){
	if($no == ($i+1)){
	echo ($i+1).' ';
	}
	else{
	echo' <a href='.$PHP_SELF.'?no='.($i+1).'>'.($i+1).'</a> ';
	}
}
//Eger toplam sayfamiz su anda bulundugumuz sayfanin bir fazlasindan daha fazla ise o zaman ileri linki olusturuyoruz.
if($toplam_sayfa>$no){
echo'| <a href='.$PHP_SELF.'?no='.($no+1).'>Ileri</a>';
}
//VERİLERİ YAZDIRMA:
while($veri = mysql_fetch_array($veriler)){ 
	echo $veri['veri'];
}
?>
</body>
</html>
