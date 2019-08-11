<?php
require_once("sorgular.php");
header('Content-Type: application/xml');
try {
    $db = new PDO("mysql:host=localhost;dbname=paykasa;charset=utf8", "root", "");
    $xml_converter = new SimpleXMLElement("<?xml version=\"1.0\"?><PaykasaModelArray></PaykasaModelArray>");

    function array_to_xml($array, &$xml_converter)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subnode = $xml_converter->addChild("$key");
                    array_to_xml($value, $subnode);
                } else {
                    $subnode = $xml_converter->addChild("item$key");
                    array_to_xml($value, $subnode);
                }
            } else {
                $xml_converter->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }

    if (isset($_GET["paykasa-init"])) {
        $paykasa_init_stmt = $db->query($init_sql, PDO::FETCH_ASSOC);
        $result_paykasa_init = $paykasa_init_stmt->fetchAll();
        array_to_xml($result_paykasa_init, $xml_converter);
        echo $xml_converter->asXML();
    } else if (isset($_GET["paykasa-kasadaki-is"])) {
        $stmt = $db->query($kasadaki_is_sql, PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        array_to_xml($result, $xml_converter);
        echo $xml_converter->asXML();
    } else if (isset($_GET["paykasa-satilan"])) {
        $stmt = $db->query($satilan_paykasa_sql, PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        array_to_xml($result, $xml_converter);
        echo $xml_converter->asXML();
    } else if (isset($_GET["paykasa-paneldeki-is"])) {
        $stmt = $db->query($paneldeki_is_sql, PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        array_to_xml($result, $xml_converter);
        echo $xml_converter->asXML();
    } else if (isset($_GET["paykasa-toplam-kar"])) {
        $stmt = $db->query($toplam_kar_sql, PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        array_to_xml($result, $xml_converter);
        echo $xml_converter->asXML();
    } else if (isset($_GET["paykasa-kur-getir"])) {
        $stmt = $db->query($kur_getir_sql, PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        array_to_xml($result, $xml_converter);
        echo $xml_converter->asXML();
    } else if (isset($_GET["paykasa-urun-guncelle"])) {
        $db->query("UPDATE `paykasasatis` SET `Fiyati`='" . $_POST['fiyati'] . "',`OlmasiGereken`='" . $_POST['olmasigereken'] . "',`Kar`='" . $_POST['kar'] . "' WHERE ID=" . $_POST['ID'] . "");
    } else if (isset($_GET["paykasa-urun-ekle"])) {
        $db->query("INSERT INTO `paykasasatis`( `Paykasa1`, `Fiyati`,`Paykasa2`) VALUES (" . $_POST['paykasa'] . "," . $_POST['fiyat'] . "," . $_POST['paykasa'] . ")");
    } else if (isset($_GET["paykasa-kur-fiyat-guncelle"])) {
        $db->query("UPDATE kurlar SET KurFiyat=" . $_POST['kur'] . " WHERE ID=2");
    } else if (isset($_GET["paykasa-basilmamiskod-guncelle"])) {
        $db->query("UPDATE kasalar SET BasilmamisKod = " . $_POST['kod'] . " WHERE ID =1");
    } else if (isset($_GET["paykasa-rapor-kaydet"])) {
        $db->query("INSERT INTO `rapor`(`KasaID`, `SatisKuru`, `Kar`, `Satilan`, `KasadakiKod`, `PaneldekiKod`, `tarih`) VALUES (" . $_POST['KasaID'] . "," . $_POST['Kur'] . "," . $_POST['ToplamKar'] . "," . $_POST['SatilanPaykasa'] . "," . $_POST['KasadakiIs'] . "," . $_POST['PaneldekiIs'] . "," . $_POST['Tarih'] . ")");
    } else if (isset($_GET["paykasa-kayit-sil"])) {
        $db->query("DELETE from paykasasatis WHERE ID=" . $_POST['ID']);
    } else {
        echo "<?xml version=\"1.0\"?><Bos>Ne Arıyosun</Bos>";
    }
} catch (PDOException $ex) {
    echo $ex;
}
?>