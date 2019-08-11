using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace PayHesap
{
    public partial class MainFrm : Form
    {
        int grupBoxSol_Genislik = 0;
        int grupBoxSag_Genislik = 0;
        int formOrjinalGenislik = 0;

        int grupBoxSol_Yukseklik = 0;
        int grupBoxSag_Yukseklik = 0;
        int formOrjinalYukseklik = 0;


        private PaykasaHesap paykasaHesap;
        private PaykasaUrun paykasaUrun;
        public MainFrm()
        {
            InitializeComponent();

            paykasaHesap = new PaykasaHesap();

            paykasaHesap.txtFiyat = txtPaykasaFiyat;
            paykasaHesap.txtKasadakiIs = txtPaykasaKasadakiIs;
            paykasaHesap.txtPaykasa = txtPaykasa;
            paykasaHesap.txtSatilanPaykasa = txtSatilanPaykasa;
            paykasaHesap.txtToplamKar = txtPaykasaToplamKar;
            paykasaHesap.txtKur = txtPaykasaKur;
            paykasaHesap.txtPaneldekiIs = txtPaykasaPaneldekiIs;
            paykasaHesap.dataGrid = dataGridPaykasa;

            txtPaykasaKur.TextChanged += paykasaHesap.txtKur_TextChanged;
            paykasaHesap.Yukle();




            paykasaUrun = new PaykasaUrun();
            paykasaUrun.dataGrid = dataGridPaykasaUrun;


            dataGridPaykasa.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dataGridPaykasa.AutoSizeRowsMode = DataGridViewAutoSizeRowsMode.None;

            dataGridPaykasa.BackgroundColor = Color.White;
            //dataGridPaykasa.RowHeadersVisible = false;

            dataGridPaykasaUrun.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dataGridPaykasaUrun.AutoSizeRowsMode = DataGridViewAutoSizeRowsMode.None;

            openFileDialogPaykasa.FileName = "Txt Seç";
            openFileDialogPaykasa.Filter = "Text files(*.txt)| *.txt";
            openFileDialogPaykasa.Title = "Ürünleri Yükle";




            this.dataGridPaykasa.Font = new Font("Tahoma", 10);
            this.dataGridPaykasaUrun.Font = new Font("Tahoma", 10);



        }

        private void comboBoxPaykasaUrun_SelectedIndexChanged(object sender, EventArgs e)
        {
            paykasaUrun.UrunleriGetir(comboBoxPaykasaUrun.Text.Split(' ')[0]);
            paykasaUrunlerDataGridFontAyarla();
            dataGridPaykasaUrun.Columns[1].Width = 60;
            dataGridPaykasaUrun.Columns[2].Width = 220;
            dataGridPaykasaUrun.Columns[3].Width = 70;
            dataGridPaykasaUrun.Columns[4].Width = 50;
            dataGridPaykasaUrun.Columns[5].Width = 150;
        }

        private void MainFrm_Load(object sender, EventArgs e)
        {
            grupBoxSol_Genislik = groupBoxPaykasaSol.Width;
            grupBoxSag_Genislik = groupBoxPaykasaSag.Width;
            formOrjinalGenislik = this.Width;
            grupBoxSol_Yukseklik = groupBoxPaykasaSol.Height;
            grupBoxSag_Yukseklik = groupBoxPaykasaSag.Height;
            formOrjinalYukseklik = this.Height;

            dataGridPaykasa.Columns["ID"].Visible = false;
            dataGridPaykasa.Columns["Paykasa2"].Visible = false;


            dataGridPaykasa.Columns[5].Width = 50;


            paykasaDataGridRenklendir();



        }
        private void paykasaDataGridRenklendir()
        {
            var font = new Font("Tahoma", 20, GraphicsUnit.Pixel);
            for (int i = 0; i < dataGridPaykasa.Rows.Count - 1; i++)
            {
                dataGridPaykasa.Rows[i].Cells[1].Style.BackColor = Color.LightBlue;

                dataGridPaykasa.Rows[i].Cells[2].Style.BackColor = Color.LightPink;
                dataGridPaykasa.Rows[i].Cells[3].Style.BackColor = Color.LightSkyBlue;
                dataGridPaykasa.Rows[i].Cells[4].Style.BackColor = Color.LightGreen;
                dataGridPaykasa.Rows[i].Cells[5].Style.BackColor = Color.LightPink;
                dataGridPaykasa.Rows[i].Cells[7].Style.BackColor = Color.LightSalmon;

                dataGridPaykasa.Rows[i].DefaultCellStyle.Font = font;
            }
        }

        private void paykasaUrunlerDataGridFontAyarla()
        {
            var font = new Font("Tahoma", 20, GraphicsUnit.Pixel);
            for (int i = 0; i < dataGridPaykasaUrun.Rows.Count - 1; i++)
            {
                dataGridPaykasaUrun.Rows[i].DefaultCellStyle.Font = font;
            }
        }
        private void MainFrm_SizeChanged(object sender, EventArgs e)
        {
            int fark = (this.Width - formOrjinalGenislik);
            groupBoxPaykasaSol.Width = grupBoxSol_Genislik + (fark / 2)-100 ;
            int x = groupBoxPaykasaSol.Location.X * 2;
            Point p = groupBoxPaykasaSag.Location;
            p.X = groupBoxPaykasaSol.Width + x;
            groupBoxPaykasaSag.Location = p;
            groupBoxPaykasaSag.Width = grupBoxSag_Genislik + (fark / 2) + 100;

            int yukseklikFark = this.Height - formOrjinalYukseklik;
            groupBoxPaykasaSol.Height = grupBoxSol_Yukseklik + yukseklikFark;
            groupBoxPaykasaSag.Height = grupBoxSag_Yukseklik + yukseklikFark;

            dataGridPaykasa.Width = groupBoxPaykasaSol.Width - 10;
            dataGridPaykasa.Height = groupBoxPaykasaSol.Height - (dataGridPaykasa.Location.Y + 7);
            dataGridPaykasaUrun.Width = groupBoxPaykasaSag.Width - 15;
            dataGridPaykasaUrun.Height = groupBoxPaykasaSag.Height - (dataGridPaykasaUrun.Location.Y + 7);

        }

        private void btnPaykasaTopluUrunYukle_Click(object sender, EventArgs e)
        {
            if (comboBoxPaykasaUrun.SelectedIndex == -1)
            {
                MessageBox.Show("Ürünler bölümünden seçim yapınız", "Hata");
                return;
            }
            if (openFileDialogPaykasa.ShowDialog() == DialogResult.OK)
            {
                string miktar = comboBoxPaykasaUrun.Text.Split(' ')[0];
                foreach (var urun in File.ReadAllLines(openFileDialogPaykasa.FileName))
                {
                    if (!string.IsNullOrWhiteSpace(urun))
                        paykasaUrun.UrunEkle(miktar, urun.Trim());
                }
                paykasaUrun.UrunleriGetir(miktar);
                paykasaHesap.yenile();
                paykasaDataGridRenklendir();
            }
        }

        private void txtPaykasaUrun_KeyUp(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                if (comboBoxPaykasaUrun.SelectedIndex == -1)
                {
                    MessageBox.Show("Ürünler bölümünden seçim yapınız", "Hata");
                    return;
                }
                string miktar = comboBoxPaykasaUrun.Text.Split(' ')[0];
                paykasaUrun.UrunEkle(miktar, txtPaykasaUrun.Text);
                txtPaykasaUrun.Text = "";
                paykasaUrun.UrunleriGetir(miktar);
                paykasaHesap.yenile();
                paykasaDataGridRenklendir();
                e.Handled = true;
            }
        }

        private void btnPaykasaEkle_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrWhiteSpace(txtPaykasa.Text) && !string.IsNullOrWhiteSpace(txtPaykasaFiyat.Text))
            {
                paykasaHesap.Ekle();
                paykasaHesap.yenile();
                paykasaHesap.hesaplaVeKaydet();
                txtPaykasa.Text = "";
                txtPaykasaFiyat.Text = "";
                paykasaDataGridRenklendir();
            }

        }

        private void toolStripPaykasaSecilenUrunleriSil_Click(object sender, EventArgs e)
        {
            foreach (DataGridViewRow item in this.dataGridPaykasaUrun.SelectedRows)
            {
                int id = int.Parse(item.Cells[0].Value.ToString());
                dataGridPaykasaUrun.Rows.RemoveAt(item.Index);
                paykasaUrun.UrunSil(id);
            }
            paykasaHesap.yenile();
        }

        private void dataGridPaykasaUrun_CellEndEdit(object sender, DataGridViewCellEventArgs e)
        {
            var id = dataGridPaykasaUrun.Rows[e.RowIndex].Cells[0].Value.ToString();
            var paykasa = dataGridPaykasaUrun.Rows[e.RowIndex].Cells[2].Value.ToString();
            var banka = dataGridPaykasaUrun.Rows[e.RowIndex].Cells[3].Value.ToString();
            var satildimi = dataGridPaykasaUrun.Rows[e.RowIndex].Cells[4].Value.ToString();
            paykasaUrun.UrunGuncelle(paykasa, banka, satildimi, id);
            paykasaHesap.yenile();
            paykasaDataGridRenklendir();
        }

        private void dataGridPaykasa_CellEndEdit(object sender, DataGridViewCellEventArgs e)
        {
            paykasaHesap.hesaplaVeKaydet();
            paykasaHesap.yenile();
            paykasaDataGridRenklendir();
        }

        private void btnPaykasaYenile_Click(object sender, EventArgs e)
        {
            paykasaHesap.yenile();
            paykasaDataGridRenklendir();
        }

        private void btnPaykasaRaporKaydet_Click(object sender, EventArgs e)
        {
            paykasaHesap.RaporKaydet();
            MessageBox.Show("Kaydedildi", "IXLARGE.NET");
        }

        private void btnPaykasaRapor_Click(object sender, EventArgs e)
        {
            var form = new FrmPaykasaRapor();
            form.Show();
        }

        private void txtPaykasaPaneldekiIs_TextChanged(object sender, EventArgs e)
        {
            int sayi = 0;
            if (int.TryParse(txtPaykasaPaneldekiIs.Text, out sayi))
            {
                paykasaHesap.BasilmamisKoduGuncelle(sayi);
            }
        }

        private void secilenleriKopyalaToolStripMenuItem_Click(object sender, EventArgs e)
        {
            string kod = "";
            for (int i = this.dataGridPaykasaUrun.SelectedRows.Count - 1; i >= 0; i--)
            {
                kod += this.dataGridPaykasaUrun.SelectedRows[i].Cells[2].Value.ToString() + "\r\n";
            }
            Clipboard.SetData(DataFormats.Text, kod);
        }

        private void secilenleriSilToolStripMenuItem_Click(object sender, EventArgs e)
        {
            foreach (DataGridViewRow item in this.dataGridPaykasa.SelectedRows)
            {
                string id = item.Cells[0].Value.ToString();
                using (WebClient client = new WebClient())
                {
                    string tarih = DateTimeOffset.UtcNow.ToUnixTimeSeconds().ToString();
                    var reqparm = new NameValueCollection();
                    reqparm.Add("ID", id);
                    client.UploadValues("http://localhost/api.php?paykasa-kayit-sil", "POST", reqparm);
                    
                    try
                    {
                        dataGridPaykasaUrun.Rows.RemoveAt(item.Index);
                    }
                    catch { }
                    paykasaHesap.yenile();
                    paykasaDataGridRenklendir();
                }
            }
        }
    }
}
