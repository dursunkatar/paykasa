<div class="table-responsive">
    <table class="table table-bordered table-striped table-sm" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th style="width: 45px">
                <button onclick="paykasaSil()" style="padding: 2px 5px;line-height: 14px;" type="button" class="sil btn btn-outline-dark btn-sm">
                    Sil
                </button>
            </th>
            <th>Ürün</th>
            <th>S. Fiyatı</th>
            <th>A. Fiyatı</th>
            <th>Kar</th>
            <th>Satış</th>
            <th>Basılmış</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once "db.php";
        $kasaID = $kurID = 2;
        $stmt = $db->query("SELECT
                                    pay.ID,
                                    pay.Paykasa1,
                                    pay.Fiyati,
                                    pay.OlmasiGereken,
                                    pay.Kar,
                                    (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=2 and urunler.Miktar=pay.Paykasa1 AND urunler.Satildimi=1 ) AS Satis,
                                    (SELECT COUNT(0) FROM urunler WHERE  urunler.KasaID=2 and urunler.Miktar=pay.Paykasa1 AND urunler.Satildimi=0  ) AS Basilmis
                                    FROM paykasasatis AS pay order by pay.Paykasa1");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
                <td><input name="idler" value="<?php echo $row['ID'] ?>" type="checkbox"/></td>
                <td><?php echo $row['Paykasa1'] ?> €</td>
                <td><input onblur="fiyatGuncelle(<?php echo $row['ID'] ?>,this.value)" type="text" class="max-width form-control form-control-sm"
                           value="<?php echo $row['Fiyati'] ?>"/></td>
                <td><?php  echo number_format($row['OlmasiGereken'], 2, ',', '.');  ?></td>
                <td><?php echo number_format($row['Kar'], 2, ',', '.');  ?></td>
                <td><?php echo $row['Satis'] ?></td>
                <td><?php echo $row['Basilmis'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>