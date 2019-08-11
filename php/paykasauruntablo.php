<div class="table-responsive">
    <table class="table table-bordered table-striped table-sm" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th style="width: 45px">
                <button onclick="urunSil()" style="padding: 2px 5px;line-height: 14px;" type="button" class="sil btn btn-outline-dark btn-sm">
                    Sil
                </button>
            </th>
            <th>Paykasa</th>
            <th>Tarih</th>
            <?php if ($_GET['satildimi'] != -1) echo "<th></th>"; ?>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once "db.php";
        $kasaID = $kurID = 2;
        $satildiKosul = $_GET['satildimi'] == -1 ? "" : ("and Satildimi=" . $_GET['satildimi']);
        $sql = "SELECT urunler.ID, urunler.Miktar,urunler.Paykasa,urunler.Banka,urunler.Satildimi,from_unixtime(urunler.tarih,'%d.%m.%Y')as tarih FROM urunler WHERE KasaID=$kasaID $satildiKosul and miktar ={$_GET['miktar']} order by ID desc";
        $stmt = $db->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
                <td><input name="idler" value="<?php echo $row['ID'] ?>" type="checkbox"/></td>
                <td><?php echo $row['Paykasa'] ?></td>
                <td><?php echo $row['tarih'] ?></td>
                <?php if ($_GET['satildimi'] != -1): ?>
                    <td  >
                        <button onclick="<?php echo $_GET['satildimi'] == 1 ? "geriAl({$row['ID']},this)" : "sat({$row['ID']},this)"; ?>" style="padding: 2px 5px;line-height: 14px;" type="button"
                                class="btn btn-outline-dark btn-sm">
                            <?php echo $_GET['satildimi'] == 1 ? "Geri Al" : "Sat"; ?>
                        </button>

                    </td>
                <?php endif; ?>
            </tr>

            <tr>
                <th colspan="4" style="height:15px;border-right:1px solid aliceblue">Banka</th>
            </tr>
            <tr style="border-bottom: 2px solid;text-align: center">
                <td colspan="4">
                    <textarea onblur="bankaGuncelle(<?php echo $row['ID'] ?>,this)" class="form-control"><?php echo $row['Banka'] ?></textarea>
                </td>

            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>