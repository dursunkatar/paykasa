namespace PayHesap
{
    partial class FrmPaykasaRapor
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle2 = new System.Windows.Forms.DataGridViewCellStyle();
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(FrmPaykasaRapor));
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.btnPaykasaRaporListele = new MaterialSkin.Controls.MaterialRaisedButton();
            this.dateTimeBitis = new System.Windows.Forms.DateTimePicker();
            this.dateTimeBaslangic = new System.Windows.Forms.DateTimePicker();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.dataGridPaykasaUrun = new System.Windows.Forms.DataGridView();
            this.ID = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.SatisKuru = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Kar = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Satilan = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.KasadakiKod = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.PaneldekiKod = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Tarih = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.groupBox1.SuspendLayout();
            this.groupBox2.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridPaykasaUrun)).BeginInit();
            this.SuspendLayout();
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.btnPaykasaRaporListele);
            this.groupBox1.Controls.Add(this.dateTimeBitis);
            this.groupBox1.Controls.Add(this.dateTimeBaslangic);
            this.groupBox1.Location = new System.Drawing.Point(6, 12);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(657, 64);
            this.groupBox1.TabIndex = 0;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Tarih Aralığı";
            // 
            // btnPaykasaRaporListele
            // 
            this.btnPaykasaRaporListele.Cursor = System.Windows.Forms.Cursors.Hand;
            this.btnPaykasaRaporListele.Depth = 0;
            this.btnPaykasaRaporListele.Location = new System.Drawing.Point(431, 31);
            this.btnPaykasaRaporListele.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnPaykasaRaporListele.Name = "btnPaykasaRaporListele";
            this.btnPaykasaRaporListele.Primary = true;
            this.btnPaykasaRaporListele.Size = new System.Drawing.Size(215, 20);
            this.btnPaykasaRaporListele.TabIndex = 2;
            this.btnPaykasaRaporListele.Text = "Listele";
            this.btnPaykasaRaporListele.UseVisualStyleBackColor = true;
            this.btnPaykasaRaporListele.Click += new System.EventHandler(this.btnPaykasaRaporListele_Click);
            // 
            // dateTimeBitis
            // 
            this.dateTimeBitis.Location = new System.Drawing.Point(229, 31);
            this.dateTimeBitis.Name = "dateTimeBitis";
            this.dateTimeBitis.Size = new System.Drawing.Size(196, 20);
            this.dateTimeBitis.TabIndex = 1;
            // 
            // dateTimeBaslangic
            // 
            this.dateTimeBaslangic.Location = new System.Drawing.Point(18, 31);
            this.dateTimeBaslangic.Name = "dateTimeBaslangic";
            this.dateTimeBaslangic.Size = new System.Drawing.Size(196, 20);
            this.dateTimeBaslangic.TabIndex = 0;
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.dataGridPaykasaUrun);
            this.groupBox2.Location = new System.Drawing.Point(6, 82);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(826, 380);
            this.groupBox2.TabIndex = 1;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "Rapor";
            // 
            // dataGridPaykasaUrun
            // 
            dataGridViewCellStyle2.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.dataGridPaykasaUrun.AlternatingRowsDefaultCellStyle = dataGridViewCellStyle2;
            this.dataGridPaykasaUrun.BackgroundColor = System.Drawing.Color.White;
            this.dataGridPaykasaUrun.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridPaykasaUrun.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.ID,
            this.SatisKuru,
            this.Kar,
            this.Satilan,
            this.KasadakiKod,
            this.PaneldekiKod,
            this.Tarih});
            this.dataGridPaykasaUrun.Location = new System.Drawing.Point(6, 19);
            this.dataGridPaykasaUrun.Name = "dataGridPaykasaUrun";
            this.dataGridPaykasaUrun.Size = new System.Drawing.Size(814, 355);
            this.dataGridPaykasaUrun.TabIndex = 6;
            // 
            // ID
            // 
            this.ID.HeaderText = "ID";
            this.ID.Name = "ID";
            // 
            // SatisKuru
            // 
            this.SatisKuru.HeaderText = "SatisKuru";
            this.SatisKuru.Name = "SatisKuru";
            // 
            // Kar
            // 
            this.Kar.HeaderText = "Kar";
            this.Kar.Name = "Kar";
            // 
            // Satilan
            // 
            this.Satilan.HeaderText = "Satilan";
            this.Satilan.Name = "Satilan";
            // 
            // KasadakiKod
            // 
            this.KasadakiKod.HeaderText = "KasadakiKod";
            this.KasadakiKod.Name = "KasadakiKod";
            // 
            // PaneldekiKod
            // 
            this.PaneldekiKod.HeaderText = "PaneldekiKod";
            this.PaneldekiKod.Name = "PaneldekiKod";
            // 
            // Tarih
            // 
            this.Tarih.HeaderText = "Tarih";
            this.Tarih.Name = "Tarih";
            // 
            // FrmPaykasaRapor
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(841, 470);
            this.Controls.Add(this.groupBox2);
            this.Controls.Add(this.groupBox1);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.MaximizeBox = false;
            this.Name = "FrmPaykasaRapor";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Paykasa Rapor";
            this.groupBox1.ResumeLayout(false);
            this.groupBox2.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridPaykasaUrun)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.GroupBox groupBox1;
        private MaterialSkin.Controls.MaterialRaisedButton btnPaykasaRaporListele;
        private System.Windows.Forms.DateTimePicker dateTimeBitis;
        private System.Windows.Forms.DateTimePicker dateTimeBaslangic;
        private System.Windows.Forms.GroupBox groupBox2;
        private System.Windows.Forms.DataGridView dataGridPaykasaUrun;
        private System.Windows.Forms.DataGridViewTextBoxColumn ID;
        private System.Windows.Forms.DataGridViewTextBoxColumn SatisKuru;
        private System.Windows.Forms.DataGridViewTextBoxColumn Kar;
        private System.Windows.Forms.DataGridViewTextBoxColumn Satilan;
        private System.Windows.Forms.DataGridViewTextBoxColumn KasadakiKod;
        private System.Windows.Forms.DataGridViewTextBoxColumn PaneldekiKod;
        private System.Windows.Forms.DataGridViewTextBoxColumn Tarih;
    }
}