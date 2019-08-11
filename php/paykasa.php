<?php
require_once "header.php";
require_once "db.php";

?>

<style type="text/css">
    select {
        cursor: pointer;
    }

    .card-header {
        text-align: center;
    }

    .max-width {
        max-width: 100px;
    }

    div[class^=col-md] {
        padding-bottom: 10px;
    }

    label.urunsatildimi {
        padding-left: 10px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    th {
        background-color: #80BD8D !important;
        text-align: center;
        line-height: 15px;
        border: 2px;
        color: aliceblue;
    }

    button.sil {
        background-color: lightcoral;
        color: white;
    }
</style>

<?php
$kasaID = $kurID = 2;
$kur = $db->query("SELECT KurFiyat FROM kurlar WHERE ID =$kurID")->fetch(PDO::FETCH_ASSOC)['KurFiyat'];
?>
<div class="row">
    <div class="col-md-12">
        <div style="margin-bottom: 10px;" class="card">
            <div style="padding: 7px 10px;" class="card-header">
                Paykasa
            </div>
            <div style="padding: 10px" class="card-body">
                <form id="ustform">
                    <div style="margin: 0" class="form-group">
                        <div class="form-row">
                            <div class="col-md">
                                <div class="form-label-group ">
                                    <input name="aliskuru" type="text" id="aliskuru" class="form-control"
                                           placeholder="Alış Kuru €" value="<?php echo $kur; ?>">
                                    <label for="aliskuru">Alış Kuru €</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-label-group ">
                                    <input name="toplamkar" type="text" id="kar" class="form-control"
                                           placeholder="Kar TL">
                                    <label for="kar">Kar TL</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-label-group ">
                                    <input name="satilanpaykasa" type="text" id="satilanpaykasa" class="form-control"
                                           placeholder="Satılan Paykasa">
                                    <label for="satilan">Satılan Paykasa</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-label-group ">
                                    <input name="paneldekikod" type="text" id="paneldekikod" class="form-control"
                                           placeholder="Paneldeki Kod">
                                    <label for="paneldekikod">Paneldeki Kod</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-label-group ">
                                    <input name="basilmamiskod" type="text" id="basilmamiskod" class="form-control"
                                           placeholder="Basılmamış Kod">
                                    <label for="basilmamiskod">Basılmamış Kod</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button id="raporkaydet" style="padding: 10px 10px;width: 100%;line-height: 26px;"
                                        type="button"
                                        class="btn btn-outline-dark btn-sm">Kaydet
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div style="margin-bottom: 10px;" class="card">
            <div style="padding: 7px 10px;" class="card-header">
                Ürün Ekle
            </div>
            <div style="padding: 10px" class="card-body">
                <form id="urunform">
                    <div style="margin: 0" class="form-group">
                        <div class="form-row">
                            <div class="col-md">
                                <div class="form-label-group ">
                                    <input name="urun" type="text" id="urun" class="form-control"
                                           placeholder="Ürün Fiyatı">
                                    <label for="urun">Ürün Fiyatı</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-label-group ">
                                    <input name="fiyati" type="text" id="fiyati" class="form-control"
                                           placeholder="S. Fiyatı">
                                    <label for="fiyati">S. Fiyatı</label>
                                </div>
                            </div>

                        </div>
                        <button id="paykasaekle" style="width: 100%;" type="button"
                                class="btn btn-outline-dark btn-sm">Ekle
                        </button>
                        <hr/>
                        <div class="form-row">
                            <div id="paykasatablo" class="col-md-12">
                                <?php
                                require_once "paykasatablo.php";
                                ?>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div style="margin-bottom: 10px;" class="card">
            <div style="padding: 7px 10px;" class="card-header">
                Paykasa Ürün
            </div>
            <div style="padding: 10px" class="card-body">
                <form id="paykasaurunform">
                    <div style="margin: 0" class="form-group">
                        <div class="form-row">
                            <div class="col-md">
                                <div class="form-label-group ">
                                    <input name="Miktar" type="text" id="urunmiktar" class="form-control"
                                           placeholder="Miktar">
                                    <label for="urunmiktar">Miktar</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-label-group ">
                                    <input name="Paykasa" type="text" id="paykasaurun" class="form-control"
                                           placeholder="Ürün Kodu">
                                    <label for="paykasaurun">Ürün Kodu</label>
                                </div>
                            </div>

                        </div>
                        <button id="urunekle" style="width: 100%;" type="button"
                                class="btn btn-outline-dark btn-sm">Ekle
                        </button>
                        <hr/>
                        <div class="form-row">
                            <div class="col-md-4">
                                <select id="urunler" class="form-control">
                                    <?php
                                    $stmt = $db->query("SELECT Miktar FROM urunler WHERE KasaID=$kasaID GROUP BY Miktar");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                                        <tr>
                                            <option><?php echo $row['Miktar']; ?></option>
                                        </tr>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md">
                                <div style="padding: 0 10px">
                                    <label class="urunsatildimi"><input name="satilmadurum" value="1" type="radio">
                                        Satılanlar</label>
                                    <label class="urunsatildimi"><input checked name="satilmadurum" value="0"
                                                                        type="radio">
                                        Satılmayanlar</label>
                                    <label class="urunsatildimi"><input name="satilmadurum" value="-1"
                                                                        type="radio">
                                        Tümü</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div id="paykasauruntablo" class="col-md-12">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">

    $('#aliskuru').blur(() => {
        $.post('ajax.php?islem=paykasakurguncelle', {kur: $('#aliskuru').val()}, (res) => {
            tabloyuYenile();
            yenile();
        });
    });

    function fiyatGuncelle(id, fiyati) {
        $.post('ajax.php?islem=paykasafiyatiguncelle', {id: id, fiyati: fiyati}, (res) => {
            yenile();
            tabloyuYenile();
        });
    }

    function tabloyuYenile() {
        $.get('paykasatablo.php', (res) => {
            $('#paykasatablo').html(res);
        });
    }

    $('input#basilmamiskod').blur(() => {
        $.post("ajax.php?islem=paykasabasilmamiskodguncelle", {kod: $('#basilmamiskod').val()}, (res) => {

        });
    });
    $('button#paykasaekle').click(() => {
        $.post("ajax.php?islem=paykasaekle", $('form#urunform').serialize(), (res) => {
            tabloyuYenile();
            document.getElementById('urunform').reset();
        });
    });

    $('button#urunekle').click(() => {
        $.post("ajax.php?islem=paykasaurunekle", $('form#paykasaurunform').serialize(), (res) => {
            urunleriListele();
            tabloyuYenile();
            yenile();
            document.getElementById('paykasaurun').value = '';
        });
    });

    $('button#raporkaydet').click(() => {
        $.post("ajax.php?islem=paykasaraporkaydet", $('form#ustform').serialize(), (lastId) => {
            if (parseInt(lastId) > 0) {
                alert('Kaydedildi');
            } else {
                alert('Kaydedilemedi !');
            }
        });
    });

    function urunleriListele() {
        $.get('paykasauruntablo.php',
            {
                satildimi: $('input[name="satilmadurum"]:checked').val(),
                miktar: $('select#urunler').val()
            }, (res) => {
                $('#paykasauruntablo').html(res);
            });
    }

    urunleriListele();
    $('select#urunler,input[name="satilmadurum"]').click(urunleriListele);

    function sat(id, self) {
        $.post("ajax.php?islem=paykasaurunsat", {id: id}, (rowCount) => {
            if (parseInt(rowCount) == 1) {
                self.closest('tr').nextElementSibling.nextElementSibling.remove();
                self.closest('tr').nextElementSibling.remove();
                self.closest('tr').remove();
                yenile();
                tabloyuYenile();
            }
        });
    }

    function geriAl(id, self) {
        $.post("ajax.php?islem=paykasaurungerial", {id: id}, (rowCount) => {
            if (parseInt(rowCount) == 1) {
                self.closest('tr').nextElementSibling.nextElementSibling.remove();
                self.closest('tr').nextElementSibling.remove();
                self.closest('tr').remove();
                yenile();
                tabloyuYenile();
            }
        });
    }

    function urunSil() {
        let str = "";
        let secilenler = document.querySelectorAll('#paykasauruntablo input[name="idler"]:checked');
        secilenler.forEach(function (e) {
            str += e.value + ",";
        })
        $.post('ajax.php?islem=paykasaurunsil', {idler: str}, (res) => {
            secilenler.forEach(function (e) {
                e.closest('tr').nextElementSibling.nextElementSibling.remove();
                e.closest('tr').nextElementSibling.remove();
                e.closest('tr').remove();
            });
            yenile();
            tabloyuYenile();
        });
    }

    function paykasaSil() {
        let str = "";
        let secilenler = document.querySelectorAll('#paykasatablo input[name="idler"]:checked');
        secilenler.forEach(function (e) {
            str += e.value + ",";
        })
        $.post('ajax.php?islem=paykasasil', {idler: str}, (res) => {
            secilenler.forEach(function (e) {
                e.closest('tr').remove();
            });
            yenile();
        });
    }

    function bankaGuncelle(id, self) {
        $.post("ajax.php?islem=paykasabankaguncelle", {id: id, banka: self.value}, (rowCount) => {
        });
    }

    function yenile() {
        $.get('ajax.php?islem=paykasapaneldekiis', (res) => {
            $('#basilmamiskod').val(res);
        });
        $.get('ajax.php?islem=paykasakasadakiis', (res) => {
            $('#paneldekikod').val(res);
        });
        $.get('ajax.php?islem=satilanpaykasa', (res) => {
            $('#satilanpaykasa').val(res);
        });
        $.get('ajax.php?islem=paykasatoplamkar', (res) => {
            $('#kar').val(res);
        });
    }

    yenile();

</script>
<?php require_once "footer.php"; ?>
