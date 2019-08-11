using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.ComponentModel;
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
    public partial class FrmPaykasaRapor : Form
    {
        public FrmPaykasaRapor()
        {
            InitializeComponent();
            this.dataGridPaykasaUrun.Font = new Font("Tahoma", 10);
        }

        private void btnPaykasaRaporListele_Click(object sender, EventArgs e)
        {

            dataGridPaykasaUrun.Columns["ID"].Visible = false;

            using (WebClient client = new WebClient())
            {
                var reqparm = new NameValueCollection();
                reqparm.Add("Tarih1", dateTimeBaslangic.Value.ToString("yyyyMMdd"));
                reqparm.Add("Tarih2", dateTimeBitis.Value.ToString("yyyyMMdd"));
                byte[] responsebytes = client.UploadValues("http://localhost/rapor.php", "POST", reqparm);
                string responsebody = Encoding.UTF8.GetString(responsebytes);

                var doc = new XmlDocument();
                doc.LoadXml(responsebody);
                dataGridPaykasaUrun.Rows.Clear();
                foreach (XmlNode node in doc.DocumentElement.ChildNodes)
                {

                    dataGridPaykasaUrun.Rows.Add(
                        getItemByNode(node, "ID"),
                        getItemByNode(node, "SatisKuru"),
                        getItemByNode(node, "Kar"),
                        getItemByNode(node, "Satilan"),
                        getItemByNode(node, "KasadakiKod"),
                        getItemByNode(node, "PaneldekiKod"),
                        getItemByNode(node, "Tarih")
                        );
                }
            }

            for (int i = 0; i < dataGridPaykasaUrun.Rows.Count - 1; i++)
            {
                dataGridPaykasaUrun.Rows[i].DefaultCellStyle.BackColor = i % 2 == 0 ? Color.LightGreen : Color.LightCyan;
            }

            dataGridPaykasaUrun.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dataGridPaykasaUrun.AutoSizeRowsMode = DataGridViewAutoSizeRowsMode.None;
            dataGridPaykasaUrun.BackgroundColor = Color.White;
            dataGridPaykasaUrun.RowHeadersVisible = false;

            paykasaRaporDataGridFontAyarla();
        }
        private string getItemByNode(XmlNode node, string text)
        {
            return node.SelectSingleNode(text).InnerText;
        }

        private void paykasaRaporDataGridFontAyarla()
        {
            var font = new Font("Tahoma", 20, GraphicsUnit.Pixel);
            for (int i = 0; i < dataGridPaykasaUrun.Rows.Count - 1; i++)
            {
                dataGridPaykasaUrun.Rows[i].DefaultCellStyle.Font = font;
            }
        }
    }
}
