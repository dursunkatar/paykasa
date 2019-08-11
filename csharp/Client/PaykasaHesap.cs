using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Xml;

namespace PayHesap
{
    public class PaykasaHesap
    {
        const int KasaID = 2;
        public DataGridView dataGrid { get; set; }
        public TextBox txtKur { get; set; }
        public TextBox txtPaykasa { get; set; }
        public TextBox txtFiyat { get; set; }
        public TextBox txtKasadakiIs { get; set; }
        public TextBox txtPaneldekiIs { get; set; }
        public TextBox txtSatilanPaykasa { get; set; }
        public TextBox txtToplamKar { get; set; }

        private void init()
        {
            using (WebClient client = new WebClient())
            {
                var initXml = client.DownloadString("http://localhost/api.php?paykasa-init");
                var doc = new XmlDocument();
                doc.LoadXml(initXml);
                dataGrid.Rows.Clear();
                foreach (XmlNode node in doc.DocumentElement.ChildNodes)
                {

                    dataGrid.Rows.Add(
                        getItemByNode(node, "ID"),
                        getItemByNode(node, "Paykasa1"),
                        getItemByNode(node, "Fiyati"),
                        getItemByNode(node, "OlmasiGereken"),
                        getItemByNode(node, "Kar"),
                        getItemByNode(node, "Satis"),
                        getItemByNode(node, "Paykasa2"),
                        getItemByNode(node, "Basilmis")
                        );
                }
            }
        }

        private string getItemByNode(XmlNode node, string text)
        {
            return node.SelectSingleNode(text).InnerText;
        }

        public void RaporKaydet()
        {
            string tarih = DateTimeOffset.UtcNow.ToUnixTimeSeconds().ToString();
            string kur = "0", toplamKar = "0", satilanPaykasa = "0", kasadakiIs = "0", paneldekiIs = "0";

            if (!string.IsNullOrWhiteSpace(txtKur.Text))
            {
                kur = txtKur.Text.Replace(',', '.');
            }
            if (!string.IsNullOrWhiteSpace(txtToplamKar.Text))
            {
                toplamKar = txtToplamKar.Text.Replace(',', '.');
            }
            if (!string.IsNullOrWhiteSpace(txtSatilanPaykasa.Text))
            {
                satilanPaykasa = txtSatilanPaykasa.Text.Replace(',', '.');
            }
            if (!string.IsNullOrWhiteSpace(txtKasadakiIs.Text))
            {
                kasadakiIs = txtKasadakiIs.Text.Replace(',', '.');
            }
            if (!string.IsNullOrWhiteSpace(txtPaneldekiIs.Text))
            {
                paneldekiIs = txtPaneldekiIs.Text.Replace(',', '.');
            }

            using (WebClient client = new WebClient())
            {
                var reqparm = new NameValueCollection();
                reqparm.Add("KasaID", KasaID.ToString());
                reqparm.Add("Kur", kur);
                reqparm.Add("ToplamKar", toplamKar);
                reqparm.Add("SatilanPaykasa", satilanPaykasa);
                reqparm.Add("KasadakiIs", kasadakiIs);
                reqparm.Add("Tarih", tarih);
                reqparm.Add("PaneldekiIs", paneldekiIs);

                client.UploadValues("http://localhost/api.php?paykasa-rapor-kaydet", "POST", reqparm);

            }


        }
        private string KasadakiIs()
        {
            using (WebClient client = new WebClient())
            {
                var initXml = client.DownloadString("http://localhost/api.php?paykasa-kasadaki-is");
                var doc = new XmlDocument();
                doc.LoadXml(initXml);
                return getItemByNode(doc.DocumentElement.ChildNodes[0], "kasadaki_is");
            }

        }

        private string SatilanPaykasa()
        {
            using (WebClient client = new WebClient())
            {
                var initXml = client.DownloadString("http://localhost/api.php?paykasa-satilan");
                var doc = new XmlDocument();
                doc.LoadXml(initXml);
                return getItemByNode(doc.DocumentElement.ChildNodes[0], "satilan_paykasa");
            }
        }

        private string ToplamKar()
        {
            using (WebClient client = new WebClient())
            {
                var initXml = client.DownloadString("http://localhost/api.php?paykasa-toplam-kar");
                var doc = new XmlDocument();
                doc.LoadXml(initXml);
                return getItemByNode(doc.DocumentElement.ChildNodes[0], "toplam_kar");
            }
        }

        private string PaneldekiIs()
        {
            using (WebClient client = new WebClient())
            {
                var initXml = client.DownloadString("http://localhost/api.php?paykasa-paneldeki-is");
                var doc = new XmlDocument();
                doc.LoadXml(initXml);
                return getItemByNode(doc.DocumentElement.ChildNodes[0], "BasilmamisKod");
            }
        }


        private void KurGetir()
        {
            using (WebClient client = new WebClient())
            {
                var initXml = client.DownloadString("http://localhost/api.php?paykasa-kur-getir");
                var doc = new XmlDocument();
                doc.LoadXml(initXml);
                txtKur.Text = getItemByNode(doc.DocumentElement.ChildNodes[0], "KurFiyat");
            }
        }


        public void hesapla()
        {
            if (string.IsNullOrWhiteSpace(txtKur.Text))
            {
                return;
            }
            foreach (DataGridViewRow row in dataGrid.Rows)
            {
                if (row.Cells[1].Value == null)
                    continue;

                double urunFiyat = Convert.ToDouble(row.Cells[1].Value.ToString());
                row.Cells["OlmasiGereken"].Value = Convert.ToDouble(txtKur.Text) * urunFiyat;
                row.Cells["Kar"].Value = Convert.ToDouble(row.Cells["Fiyati"].Value.ToString()) - Convert.ToDouble(row.Cells["OlmasiGereken"].Value.ToString());
            }

        }

        public void hesaplamalariKaydet()
        {
            foreach (DataGridViewRow row in dataGrid.Rows)
            {
                if (row.Cells[1].Value == null)
                    continue;
                string olmasiGereken = row.Cells["OlmasiGereken"].Value.ToString();
                string kar = row.Cells["Kar"].Value.ToString();
                string fiyati = row.Cells["Fiyati"].Value.ToString();
                string id = row.Cells["ID"].Value.ToString();
                UrunGuncelle(fiyati, olmasiGereken, kar, id);
            }
        }

        private void UrunGuncelle(string fiyati, string olmasiGereken, string kar, string id)
        {
            using (WebClient client = new WebClient())
            {
                var reqparm = new NameValueCollection();
                reqparm.Add("fiyati", fiyati.Replace(',', '.'));
                reqparm.Add("olmasigereken", olmasiGereken.Replace(',', '.'));
                reqparm.Add("kar", kar.Replace(',', '.'));
                reqparm.Add("ID", id);
                client.UploadValues("http://localhost/api.php?paykasa-urun-guncelle", "POST", reqparm);
            }

        }


        public void Ekle()
        {
            string paykasa = txtPaykasa.Text.Replace(',', '.');
            string fiyat = txtFiyat.Text.Replace(',', '.');
            using (WebClient client = new WebClient())
            {
                var reqparm = new NameValueCollection();
                reqparm.Add("paykasa", paykasa);
                reqparm.Add("fiyat", txtFiyat.Text);
                client.UploadValues("http://localhost/api.php?paykasa-urun-ekle", "POST", reqparm);
            }
        }
        public void hesaplaVeKaydet()
        {
            hesapla();
            string kur = txtKur.Text.Replace(',', '.');

            using (WebClient client = new WebClient())
            {
                var reqparm = new NameValueCollection();
                reqparm.Add("kur", kur);
                client.UploadValues("http://localhost/api.php?paykasa-kur-fiyat-guncelle", "POST", reqparm);
            }

            hesaplamalariKaydet();


        }
        public void yenile()
        {
            init();
            KurGetir();
            txtKasadakiIs.Text = KasadakiIs();
            txtSatilanPaykasa.Text = SatilanPaykasa();
            txtToplamKar.Text = ToplamKar();
            txtPaneldekiIs.Text = PaneldekiIs();
        }

        public void BasilmamisKoduGuncelle(int kod)
        {
            using (WebClient client = new WebClient())
            {
                var reqparm = new NameValueCollection();
                reqparm.Add("kod", kod.ToString());
                client.UploadValues("http://localhost/api.php?paykasa-basilmamiskod-guncelle", "POST", reqparm);
            }
        }

        public void txtKur_TextChanged(object sender, EventArgs e)
        {
            if (string.IsNullOrWhiteSpace(txtKur.Text) || txtKur.Text.EndsWith(".") || txtKur.Text.EndsWith(","))
            {
                return;
            }
            txtKur.Text = txtKur.Text.Replace('.', ',');
            hesaplaVeKaydet();
            txtKasadakiIs.Text = KasadakiIs();
            txtSatilanPaykasa.Text = SatilanPaykasa();
            txtToplamKar.Text = ToplamKar();
        }

        private void dataGrid_CellEndEdit(object sender, DataGridViewCellEventArgs e)
        {
            hesapla();
            hesaplamalariKaydet();
        }

        public void Yukle()
        {
            init();
            KurGetir();
            txtKasadakiIs.Text = KasadakiIs();
            txtSatilanPaykasa.Text = SatilanPaykasa();
            txtToplamKar.Text = ToplamKar();
            txtPaneldekiIs.Text = PaneldekiIs();
            for (int i = 0; i < dataGrid.Rows.Count; i++)
            {
                dataGrid.Rows[i].DefaultCellStyle.BackColor = i % 2 == 0 ? Color.LightGreen : Color.LightCyan;
            }
        }
    }
}
