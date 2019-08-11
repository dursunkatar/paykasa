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

$sql = "SELECT ID,SatisKuru,Kar,Satilan,KasadakiKod,PaneldekiKod,FROM_UNIXTIME(tarih,'%d.%m.%Y') AS Tarih FROM rapor WHERE FROM_UNIXTIME(tarih,'%Y%m%d')>='" . $_POST['Tarih1'] . "' AND FROM_UNIXTIME(tarih,'%Y%m%d')<='" . $_POST['Tarih2'] . "'";

$stmt = $db->query($sql, PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();
$xml_converter = new SimpleXMLElement("<?xml version=\"1.0\"?><PaykasaModelArray></PaykasaModelArray>");
array_to_xml($result, $xml_converter);
echo $xml_converter->asXML();
?>