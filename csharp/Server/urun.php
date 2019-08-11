<?php
header('Content-Type: application/xml');
$db = new PDO("mysql:host=localhost;dbname=paykasa;charset=utf8", "root", "");

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

if (isset($_GET["paykasa-urunleri-getir"])) {
    $urunleri_getir_sql = "SELECT urunler.ID, urunler.Miktar,urunler.Paykasa,urunler.Banka,urunler.Satildimi,from_unixtime(urunler.tarih,'%d.%m.%Y')as tarih FROM urunler WHERE KasaID=" . $_POST['KasaID'] . " and miktar =" . $_POST['Miktar'] . " order by ID desc";
    $stmt = $db->query($urunleri_getir_sql, PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    $xml_converter = new SimpleXMLElement("<?xml version=\"1.0\"?><PaykasaModelArray></PaykasaModelArray>");
    array_to_xml($result, $xml_converter);
    echo $xml_converter->asXML();

} else if (isset($_GET["paykasa-urun-ekle"])) {
    $sql = "INSERT INTO `urunler`(`KasaID`, `Miktar`, `Paykasa`, `tarih`) VALUES (" . $_POST['KasaID'] . ",'" . $_POST['Miktar'] . "','" . $_POST['Urun'] . "'," . $_POST['Tarih'] . ")";
    $db->query($sql);
} else if (isset($_GET["paykasa-urun-sil"])) {
    $sql = "DELETE FROM `urunler` WHERE ID=" . $_POST['UrunID'];
    $db->query($sql);
} else if (isset($_GET["paykasa-urun-guncelle"])) {
    $sql = "UPDATE `urunler` SET `Paykasa`='" . $_POST['Paykasa'] . "' WHERE ID=" . $_POST['ID'] . ";UPDATE `urunler` SET `Banka`='" . $_POST['Banka'] . "' WHERE ID=" . $_POST['ID'] . ";UPDATE `urunler` SET `Satildimi`=" . $_POST['Satildimi'] . " WHERE ID=" . $_POST['ID'] . "";
    $db->query($sql);
}
?>