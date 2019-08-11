<?php

$init_sql = "SELECT
    pay.ID,
    pay.Paykasa1,
    pay.Fiyati,
    pay.OlmasiGereken,
    pay.Kar,
    (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=2 and urunler.Miktar=pay.Paykasa1 AND urunler.Satildimi=1 ) AS Satis,
    pay.Paykasa2,
    (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=2 and urunler.Miktar=pay.Paykasa1 AND urunler.Satildimi=0  ) AS Basilmis
    FROM paykasasatis AS pay";

$kasadaki_is_sql = "SELECT
SUM(Paykasa1 * (SELECT COUNT(0) FROM urunler WHERE urunler.KasaID=2 AND paykasasatis.Paykasa1=urunler.Miktar AND urunler.Satildimi=0 )  ) AS kasadaki_is
FROM paykasasatis";

$satilan_paykasa_sql = "SELECT
  SUM(Paykasa1 * (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=2 and urunler.Miktar=Paykasa1 AND urunler.Satildimi=1 ) ) AS satilan_paykasa
  FROM paykasasatis";

$paneldeki_is_sql = "SELECT BasilmamisKod FROM kasalar WHERE ID =1";

$toplam_kar_sql = "SELECT
 SUM(Kar * (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=2 and urunler.Miktar=Paykasa1 AND urunler.Satildimi=1 ) ) AS toplam_kar
 FROM paykasasatis ";

$kur_getir_sql = "SELECT KurFiyat FROM kurlar WHERE ID =2";

?>