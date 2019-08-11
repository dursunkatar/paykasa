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
$kasaID =   4;
$kurID = 3;
$kur = $db->query("SELECT KurFiyat FROM kurlar WHERE ID =$kurID")->fetch(PDO::FETCH_ASSOC)['KurFiyat'];
?>
<div class="row">
    <div class="col-md-12">
        <div style="margin-bottom: 10px;" class="card">
            <div style="padding: 7px 10px;" class="card-header">
                paykwik
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
                                    <input name="satilanpaykwik" type="text" id="satilanpaykwik" class="form-control"
                                           placeholder="Satılan paykwik">
                                    <label for="satilan">Satılan paykwik</label>
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
                        <button id="paykwikekle" style="width: 100%;" type="button"
                                class="btn btn-outline-dark btn-sm">Ekle
                        </button>
                        <hr/>
                        <div class="form-row">
                            <div id="paykwiktablo" class="col-md-12">
                                <?php
                                require_once "paykwiktablo.php";
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
                paykwik Ürün
            </div>
            <div style="padding: 10px" class="card-body">
                <form id="paykwikurunform">
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
                                    <input name="paykwik" type="text" id="paykwikurun" class="form-control"
                                           placeholder="Ürün Kodu">
                                    <label for="paykwikurun">Ürün Kodu</label>
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
                                    echo "SELECT Miktar FROM urunler WHERE KasaID=$kasaID GROUP BY Miktar";
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
                            <div id="paykwikuruntablo" class="col-md-12">

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
        $.post('ajax.php?islem=paykwikkurguncelle', {kur: $('#aliskuru').val()}, (res) => {
            tabloyuYenile();
            yenile();
        });
    });

    function fiyatGuncelle(id, fiyati) {
        $.post('ajax.php?islem=paykwikfiyatiguncelle', {id: id, fiyati: fiyati}, (res) => {
            yenile();
            tabloyuYenile();
        });
    }

    function tabloyuYenile() {
        $.get('paykwiktablo.php', (res) => {
            $('#paykwiktablo').html(res);
        });
    }

    $('input#basilmamiskod').blur(() => {
        $.post("ajax.php?islem=paykwikbasilmamiskodguncelle", {kod: $('#basilmamiskod').val()}, (res) => {

        });
    });
    $('button#paykwikekle').click(() => {
        $.post("ajax.php?islem=paykwikekle", $('form#urunform').serialize(), (res) => {
            tabloyuYenile();
            document.getElementById('urunform').reset();
        });
    });

    $('button#urunekle').click(() => {
        $.post("ajax.php?islem=paykwikurunekle", $('form#paykwikurunform').serialize(), (res) => {
            urunleriListele();
            tabloyuYenile();
            yenile();
            document.getElementById('paykwikurun').value = '';
        });
    });

    $('button#raporkaydet').click(() => {
        $.post("ajax.php?islem=paykwikraporkaydet", $('form#ustform').serialize(), (lastId) => {
            if (parseInt(lastId) > 0) {
                alert('Kaydedildi');
            } else {
                alert('Kaydedilemedi !');
            }
        });
    });

    function urunleriListele() {
        $.get('paykwikuruntablo.php',
            {
                satildimi: $('input[name="satilmadurum"]:checked').val(),
                miktar: $('select#urunler').val()
            }, (res) => {
                $('#paykwikuruntablo').html(res);
            });
    }

    urunleriListele();
    $('select#urunler,input[name="satilmadurum"]').click(urunleriListele);

    function sat(id, self) {
        $.post("ajax.php?islem=paykwikurunsat", {id: id}, (rowCount) => {
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
        $.post("ajax.php?islem=paykwikurungerial", {id: id}, (rowCount) => {
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
        let secilenler = document.querySelectorAll('#paykwikuruntablo input[name="idler"]:checked');
        secilenler.forEach(function (e) {
            str += e.value + ",";
        })
        $.post('ajax.php?islem=paykwikurunsil', {idler: str}, (res) => {
            secilenler.forEach(function (e) {
                e.closest('tr').nextElementSibling.nextElementSibling.remove();
                e.closest('tr').nextElementSibling.remove();
                e.closest('tr').remove();
            });
            yenile();
            tabloyuYenile();
        });
    }

    function paykwikSil() {
        let str = "";
        let secilenler = document.querySelectorAll('#paykwiktablo input[name="idler"]:checked');
        secilenler.forEach(function (e) {
            str += e.value + ",";
        })
        $.post('ajax.php?islem=paykwiksil', {idler: str}, (res) => {
            secilenler.forEach(function (e) {
                e.closest('tr').remove();
            });
            yenile();
        });
    }

    function bankaGuncelle(id, self) {
        $.post("ajax.php?islem=paykwikbankaguncelle", {id: id, banka: self.value}, (rowCount) => {
        });
    }

    function yenile() {
        $.get('ajax.php?islem=paykwikpaneldekiis', (res) => {
            $('#basilmamiskod').val(res);
        });
        $.get('ajax.php?islem=paykwikkasadakiis', (res) => {
            $('#paneldekikod').val(res);
        });
        $.get('ajax.php?islem=satilanpaykwik', (res) => {
            $('#satilanpaykwik').val(res);
        });
        $.get('ajax.php?islem=paykwiktoplamkar', (res) => {
            $('#kar').val(res);
        });
    }

    yenile();

</script>
<?php require_once "footer.php"; ?>
