<?php
require_once "db.php";
switch ($_GET['islem']) {
    case "paykasakurguncelle":
        $db->prepare("UPDATE kurlar SET KurFiyat=" . $_POST['kur'] . " WHERE ID=2")
            ->execute();
        echo paykasaHesapla();
        break;
    case "paykasafiyatiguncelle":
        $db->prepare("UPDATE paykasasatis SET Fiyati= {$_POST['fiyati']} WHERE ID=" . $_POST['id'])
            ->execute();
        echo paykasaHesapla();
        break;
    case "paykasaekle":
        $sorgu = "INSERT INTO paykasasatis (Paykasa1,Fiyati)
                    SELECT * FROM (SELECT " . $_POST['urun'] . "," . $_POST['fiyati'] . ") AS tmp
                    WHERE NOT EXISTS (
                        SELECT Paykasa1 FROM paykasasatis WHERE Paykasa1 = " . $_POST['urun'] . "
                    ) LIMIT 1";

        $stmt = $db->prepare($sorgu);
        $insert = $stmt->execute();
        echo $insert ? $db->lastInsertId() : 0;
        break;
    case "paykasaurunekle":
        $sorgu = "INSERT INTO urunler (KasaID, Miktar, Paykasa, tarih)
                    SELECT * FROM (SELECT 2," . $_POST['Miktar'] . ",'" . $_POST['Paykasa'] . "'," . time() . ") AS tmp
                    WHERE NOT EXISTS (
                        SELECT Paykasa FROM urunler WHERE Paykasa = '" . $_POST['Paykasa'] . "'
                    ) LIMIT 1";

        $stmt = $db->prepare($sorgu);
        $insert = $stmt->execute();
        echo $insert ? $db->lastInsertId() : 0;
        break;
    case "paykasaurunsat":
        echo $db->prepare("UPDATE urunler SET Satildimi =1 WHERE ID=" . $_POST['id'])
            ->execute();
        break;
    case "paykasaurungerial":
        echo $db->prepare("UPDATE urunler SET Satildimi =0 WHERE ID=" . $_POST['id'])
            ->execute();
        break;
    case "paykasaurunsil":
        $idler = explode(",", $_POST['idler']);
        $rowsCount = 0;
        for ($i = 0; $i < count($idler) - 1; $i++) {
            $stmt = $db->prepare("DELETE from urunler WHERE ID=" . $idler[$i]);
            $rowsCount += $stmt->execute();
        }
        echo $rowsCount;
        break;
    case "paykasasil":
        $idler = explode(",", $_POST['idler']);
        $rowsCount = 0;
        for ($i = 0; $i < count($idler) - 1; $i++) {
            $stmt = $db->prepare("DELETE from paykasasatis WHERE ID=" . $idler[$i]);
            $rowsCount += $stmt->execute();
        }
        echo $rowsCount;
        break;
    case "satilanpaykasa":
        $row = $db->query("SELECT
                                      SUM(Paykasa1 * (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=2 and urunler.Miktar=Paykasa1 AND urunler.Satildimi=1 ) ) AS satilan_paykasa
                                      FROM paykasasatis"
        )->fetch(PDO::FETCH_ASSOC);
        echo $row['satilan_paykasa'];
        break;
    case "paykasapaneldekiis":
        $row = $db->query("SELECT BasilmamisKod FROM kasalar WHERE ID =1"
        )->fetch(PDO::FETCH_ASSOC);
        echo $row['BasilmamisKod'];
        break;
    case "paykasakasadakiis":
        $row = $db->query("SELECT
                            SUM(Paykasa1 * (SELECT COUNT(0) FROM urunler WHERE urunler.KasaID=2 AND paykasasatis.Paykasa1=urunler.Miktar AND urunler.Satildimi=0 )  ) AS kasadaki_is
                            FROM paykasasatis"
        )->fetch(PDO::FETCH_ASSOC);
        echo $row['kasadaki_is'];
        break;
    case "paykasatoplamkar":
        $row = $db->query("SELECT
                                     SUM(Kar * (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=2 and urunler.Miktar=Paykasa1 AND urunler.Satildimi=1 ) ) AS toplam_kar
                                     FROM paykasasatis"
        )->fetch(PDO::FETCH_ASSOC);
        echo $row['toplam_kar'];
        break;
    case "paykasabasilmamiskodguncelle":
        echo $db->prepare("UPDATE kasalar SET BasilmamisKod = " . $_POST['kod'] . " WHERE ID =1")
            ->execute();
        break;
    case "paykasabankaguncelle":
        echo $db->prepare("UPDATE urunler SET Banka = '{$_POST['banka']}' WHERE ID=" . $_POST['id'])
            ->execute();
        break;
    case "paykasaraporkaydet":
        $sorgu = "INSERT INTO `rapor`(`KasaID`, `SatisKuru`, `Kar`, `Satilan`, `KasadakiKod`, `PaneldekiKod`, `tarih`) VALUES (2," . $_POST['aliskuru'] . "," . $_POST['toplamkar'] . "," . $_POST['satilanpaykasa'] . "," . $_POST['basilmamiskod'] . "," . $_POST['paneldekikod'] . "," . time() . ")";
        $stmt = $db->prepare($sorgu);
        $insert = $stmt->execute();
        echo $insert ? $db->lastInsertId() : 0;
        break;

    case "paykwikkurguncelle":
        $db->prepare("UPDATE kurlar SET KurFiyat=" . $_POST['kur'] . " WHERE ID=3")
            ->execute();
        echo paykwikHesapla();
        break;
    case "paykwikfiyatiguncelle":
        $db->prepare("UPDATE paykwik SET Fiyati= {$_POST['fiyati']} WHERE ID=" . $_POST['id'])
            ->execute();
        echo paykwikHesapla();
        break;
    case "paykwikekle":
        $sorgu = "INSERT INTO paykwik (paykwik1,Fiyati)
                    SELECT * FROM (SELECT " . $_POST['urun'] . "," . $_POST['fiyati'] . ") AS tmp
                    WHERE NOT EXISTS (
                        SELECT paykwik1 FROM paykwik WHERE paykwik1 = " . $_POST['urun'] . "
                    ) LIMIT 1";

        $stmt = $db->prepare($sorgu);
        $insert = $stmt->execute();
        echo $insert ? $db->lastInsertId() : 0;
        break;
    case "paykwikurunekle":
        $sorgu = "INSERT INTO urunler (KasaID, Miktar, Paykasa, tarih)
                    SELECT * FROM (SELECT 4," . $_POST['Miktar'] . ",'" . $_POST['paykwik'] . "'," . time() . ") AS tmp
                    WHERE NOT EXISTS (
                        SELECT Paykasa FROM urunler WHERE Paykasa = '" . $_POST['paykwik'] . "'
                    ) LIMIT 1";
       //echo $sorgu;

        $stmt = $db->prepare($sorgu);
        $insert = $stmt->execute();
        echo $insert ? $db->lastInsertId() : 0;
        break;
    case "paykwikurunsat":
        echo $db->prepare("UPDATE urunler SET Satildimi =1 WHERE ID=" . $_POST['id'])
            ->execute();
        break;
    case "paykwikurungerial":
        echo $db->prepare("UPDATE urunler SET Satildimi =0 WHERE ID=" . $_POST['id'])
            ->execute();
        break;
    case "paykwikurunsil":
        $idler = explode(",", $_POST['idler']);
        $rowsCount = 0;
        for ($i = 0; $i < count($idler) - 1; $i++) {
            $stmt = $db->prepare("DELETE from urunler WHERE ID=" . $idler[$i]);
            $rowsCount += $stmt->execute();
        }
        echo $rowsCount;
        break;
    case "paykwiksil":
        $idler = explode(",", $_POST['idler']);
        $rowsCount = 0;
        for ($i = 0; $i < count($idler) - 1; $i++) {
            $stmt = $db->prepare("DELETE from paykwik WHERE ID=" . $idler[$i]);
            $rowsCount += $stmt->execute();
        }
        echo $rowsCount;
        break;
    case "satilanpaykwik":
        $row = $db->query("SELECT
                                      SUM(Cashixir1 * (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=4 and urunler.Miktar=Cashixir1 AND urunler.Satildimi=1 ) ) AS satilan_paykwik
                                      FROM paykwik"
        )->fetch(PDO::FETCH_ASSOC);
        echo $row['satilan_paykwik'];
        break;
    case "paykwikpaneldekiis":
        $row = $db->query("SELECT BasilmamisKod FROM kasalar WHERE ID =4"
        )->fetch(PDO::FETCH_ASSOC);
        echo $row['BasilmamisKod'];
        break;
    case "paykwikkasadakiis":
        $row = $db->query("SELECT
                            SUM(Cashixir1 * (SELECT COUNT(0) FROM urunler WHERE urunler.KasaID=4 AND paykwik.Cashixir1=urunler.Miktar AND urunler.Satildimi=0 )  ) AS kasadaki_is
                            FROM paykwik"
        )->fetch(PDO::FETCH_ASSOC);
        echo $row['kasadaki_is'];
        break;
    case "paykwiktoplamkar":
        $row = $db->query("SELECT
                                     SUM(Kar * (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=4 and urunler.Miktar=Cashixir1 AND urunler.Satildimi=1 ) ) AS toplam_kar
                                     FROM paykwik"
        )->fetch(PDO::FETCH_ASSOC);
        echo $row['toplam_kar'];
        break;
    case "paykwikbasilmamiskodguncelle":
        echo $db->prepare("UPDATE kasalar SET BasilmamisKod = " . $_POST['kod'] . " WHERE ID =4")
            ->execute();
        break;
    case "paykwikbankaguncelle":
        echo $db->prepare("UPDATE urunler SET Banka = '{$_POST['banka']}' WHERE ID=" . $_POST['id'])
            ->execute();
        break;
    case "paykwikraporkaydet":
        $sorgu = "INSERT INTO `rapor`(`KasaID`, `SatisKuru`, `Kar`, `Satilan`, `KasadakiKod`, `PaneldekiKod`, `tarih`) VALUES (4," . $_POST['aliskuru'] . "," . $_POST['toplamkar'] . "," . $_POST['satilanpaykwik'] . "," . $_POST['basilmamiskod'] . "," . $_POST['paneldekikod'] . "," . time() . ")";
        $stmt = $db->prepare($sorgu);
        $insert = $stmt->execute();
        echo $insert ? $db->lastInsertId() : 0;
        break;
    default:
        echo "Hiç biri";
}


function paykasaHesapla()
{
    global $db;
    $stmt = $db->prepare("
UPDATE paykasasatis SET OlmasiGereken =(Paykasa1 * (SELECT KurFiyat FROM kurlar WHERE ID=2));
UPDATE paykasasatis SET Kar =(Fiyati - OlmasiGereken)
");
    return $stmt->execute();
}

function paykwikHesapla()
{
    global $db;
    $stmt = $db->prepare("
UPDATE paykwik SET OlmasiGereken =(Cashixir1 * (SELECT KurFiyat FROM kurlar WHERE ID=3));
UPDATE paykwik SET Kar =(Fiyati - OlmasiGereken)
");
    return $stmt->execute();
}

?>