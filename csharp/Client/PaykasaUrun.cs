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
    public class PaykasaUrun
    {
        const int KasaID = 2;
        public DataGridView dataGrid { get; set; }

        public void UrunleriGetir(string miktar)
        {
            using (WebClient client = new WebClient())
            {
                var reqparm = new NameValueCollection();
                reqparm.Add("KasaID", KasaID.ToString());
                reqparm.Add("Miktar", miktar);
                var responseBytes = client.UploadValues("http://localhost/urun.php?paykasa-urunleri-getir", "POST", reqparm);

                string responsebody = Encoding.UTF8.GetString(responseBytes);

                var doc = new XmlDocument();
                doc.LoadXml(responsebody);

                dataGrid.Rows.Clear();
                foreach (XmlNode node in doc.DocumentElement.ChildNodes)
                {

                    dataGrid.Rows.Add(
                        getItemByNode(node, "ID"),
                        getItemByNode(node, "Miktar"),
                        getItemByNode(node, "Paykasa"),
                        getItemByNode(node, "Banka"),
                        getItemByNode(node, "Satildimi"),
                        getItemByNode(node, "tarih")
                        );
                }

            }

            for (int i = 0; i < dataGrid.Rows.Count - 1; i++)
            {
                if (dataGrid.Rows[i].Cells["Satildimi"].Value == null)
                    continue;

                if (dataGrid.Rows[i].Cells["Satildimi"].Value.ToString() == "1")
                {
                    dataGrid.Rows[i].DefaultCellStyle.BackColor = Color.Red;
                }
                else
                {
                    dataGrid.Rows[i].DefaultCellStyle.BackColor = i % 2 == 0 ? Color.LightGreen : Color.LightCyan;
                }
            }
        }
        private string getItemByNode(XmlNode node, string text)
        {
            return node.SelectSingleNode(text).InnerText;
        }
        public void UrunEkle(string miktar, string urun)
        {
            using (WebClient client = new WebClient())
            {
                string tarih = DateTimeOffset.UtcNow.ToUnixTimeSeconds().ToString();
                var reqparm = new NameValueCollection();
                reqparm.Add("KasaID", KasaID.ToString());
                reqparm.Add("Miktar", miktar);
                reqparm.Add("Urun", urun);
                reqparm.Add("Tarih", tarih);
                client.UploadValues("http://localhost/urun.php?paykasa-urun-ekle", "POST", reqparm);
            }

        }

        public void UrunSil(int id)
        {
            using (WebClient client = new WebClient())
            {
                string tarih = DateTimeOffset.UtcNow.ToUnixTimeSeconds().ToString();
                var reqparm = new NameValueCollection();
                reqparm.Add("UrunID", id.ToString());
                client.UploadValues("http://localhost/urun.php?paykasa-urun-sil", "POST", reqparm);
            }
        }

        public void UrunGuncelle(string paykasa, string banka, string satildimi, string id)
        {
            using (WebClient client = new WebClient())
            {
                string tarih = DateTimeOffset.UtcNow.ToUnixTimeSeconds().ToString();
                var reqparm = new NameValueCollection();
                reqparm.Add("ID", id);
                reqparm.Add("Paykasa", paykasa);
                reqparm.Add("Banka", banka);
                reqparm.Add("Satildimi", satildimi);
                client.UploadValues("http://localhost/urun.php?paykasa-urun-guncelle", "POST", reqparm);
            }
        }

    }
}
