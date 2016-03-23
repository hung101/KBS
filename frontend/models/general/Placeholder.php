<?php
namespace app\models\general;

use Yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Placeholder{
    const acara = "-- Pilih Acara --";
    const acaraOlimpik = "-- Pilih Acara Olimpik --";
    const agama = " -- Pilih Agama -- ";
    const agensi = " -- Pilih Agensi -- ";
    const ahliJawatankuasaInduk = " -- Pilih Ahli Jawatankuasa Induk -- ";
    const ahliJawatankuasaKecilBiro = " -- Pilih Ahli Jawatankuasa Kecil / Biro -- ";
    const ahliJKK_JKP = "-- Pilih Ahli JKK/JKP --";
    const anthropometricsUjian =  "-- Pilih Anthropometrics Ujian --";
    const atlet = "-- Pilih Atlet --";
    const badanSukan = "-- Pilih Badan Sukan --";
    const badanSukanAntarabangsa = "-- Pilih Badan Sukan Antarabangsa --";
    const bahagian = " -- Pilih Bahagian -- ";
    const bahasa = " -- Pilih Bahasa -- ";
    const bandar = " -- Pilih Bandar -- ";
    const bank = "-- Pilih Bank --";
    const bangsa = " -- Pilih Bangsa -- ";
    const bidangDiminati = " -- Pilih Bidang Diminati -- ";
    const bidangKonsultansi = " -- Pilih Bidang Konsultansi -- ";
    const biomekanikUjian = " -- Pilih Biomekanik Ujian -- ";
    const cawangan = " -- Pilih Cawangan -- ";
    const darjah = " -- Pilih Darjah -- ";
    const delegasi = " -- Pilih Delegasi -- ";
    const doktor = " -- Pilih Doktor -- ";
    const format = " -- Pilih Format -- ";
    const fasilitiSatelit = " -- Pilih Fasiliti Satelit -- ";
    const fisio = " -- Pilih Fisio -- ";
    const hubungan = " -- Pilih Hubungan -- ";
    const instructor = " -- Pilih Instructor -- ";
    const jabatan = " -- Pilih Jabatan -- ";
    const jantina = " -- Pilih Jantina -- ";
    const jawatan = " -- Pilih Jawatan -- ";
    const jawapan = " -- Pilih Jawapan -- ";
    const jenama = " -- Pilih Jenama -- ";
    const jenis = " -- Pilih Jenis -- ";
    const jenisAkaun = " -- Pilih Jenis Akaun -- ";
    const jenisAlkohol = " -- Pilih Jenis Alkohol -- ";
    const jenisAset = " -- Pilih Jenis Aset -- ";
    const jenisAsetSub = "-- Pilih Jenis Harta/Pengangkutan/Perniagaan --";
    const jenisBajet = "-- Pilih Jenis Bajet --";
    const jenisBantuan = "-- Pilih Jenis Bantuan --";
    const jenisBantuanSKAK = "-- Pilih Jenis Bantuan SKAK --";
    const jenisBiasiswa = " -- Pilih Jenis Biasiswa -- ";
    const jenisCawanganKuasa = "-- Pilih Jenis Cawangan Kuasa --";
    const jenisDiet = "-- Pilih Jenis Diet --";
    const jenisElaun = " -- Pilih Jenis Elaun -- ";
    const jenisHarta = " -- Pilih Jenis Harta -- ";
    const jenisInsentif = " -- Pilih Jenis Insentif -- ";
    const jenisLatihanAmali = "-- Pilih Jenis Latihan Amali --";
    const jenisLesenMemandu = " -- Pilih Jenis Lesen Memandu -- ";
    const jenisPinjaman = "-- Pilih Jenis Pinjaman --";
    const jenisKadar = "-- Pilih Jenis Kadar --";
    const jenisKebajikan = "-- Pilih Jenis Kebajikan --";
    const jenisKecederaanMasalahKesihatan = "-- Pilih Jenis Kecederaan / Masalah Kesihatan --";
    const jenisKemahiran = "-- Pilih Jenis Kemahiran --";
    const jenisKemudahan = "-- Pilih Jenis Kemudahan --";
    const jenisKewangan = " -- Pilih Jenis -- ";
    const jenisKewanganSumber = " -- Pilih Sumber -- ";
    const jenisKontrak = "-- Pilih Jenis Kontrak --";
    const jenisKurangUpaya = "-- Pilih Jenis Kurang Upaya --";
    const jenisKurangUpayaPendengaran = "-- Pilih Jenis Kurang Upaya Pendengaran --";
    const jenisKursus = "-- Pilih Jenis Kursus --";
    const jenisOrgan = "-- Pilih Jenis Organ --";
    const jenisPakaian = "-- Pilih Jenis Pakaian --";
    const jenisPendapatan = "-- Pilih Jenis Pendapatan --";
    const jenisPenganjuran = "-- Pilih Jenis Penganjuran --";
    const jenisPermohonan = "-- Pilih Jenis Permohonan --";
    const jenisPermohonanProgramBinaan = "-- Pilih Jenis Permohonan --";
    const jenisProgram = "-- Pilih Jenis Program --";
    const jenisRekod = "-- Pilih Jenis Rekod --";
    const jenisSejarahPerubatan = "-- Pilih Jenis Sejarah Perubatan --";
    const jenisSijil = "-- Pilih Jenis Sijil --";
    const jenisTempahan = "-- Pilih Jenis Tempahan --";
    const jenisTemujanji = "-- Pilih Jenis Temujanji --";
    const jurulatih = "-- Pilih Jurulatih --";
    const juruUrut = "-- Pilih Juru Urut --";
    const kaum = "-- Pilih Kaum --";
    const kejohanan = "-- Pilih Kejohanan --";
    const kejohananMewakili = "-- Pilih Kejohanan Mewakili --";
    const kelayakanAkademik = "-- Pilih Kelayakan Akademik --";
    const kelayakanPingat = "-- Pilih Kelayakan Pingat --";
    const kerja = "-- Pilih Kerja --";
    const kategori = "-- Pilih Kategori --";
    const kategoriAduan = "-- Pilih Kategori Aduan --";
    const kategoriAtlet = "-- Pilih Kategori Atlet --";
    const kategoriBajet = "-- Pilih Kategori Bajet --";
    const kategoriBerita = "-- Pilih Kategori Berita --";
    const kategoriDokumen = "-- Pilih Kategori Dokumen --";
    const kategoriElaun = "-- Pilih Kategori Elaun --";
    const kategoriELaporan = " -- Pilih Ketegori E-Laporan -- ";
    const kategoriGeran = " -- Pilih Ketegori Geran -- ";
    const kategoriGeranBantuan = " -- Pilih Ketegori Geran Bantuan -- ";
    const kategoriHakmilik = " -- Pilih Ketegori Hakmilik -- ";
    const kategoriKeahlian = " -- Pilih Ketegori Keahlian -- ";
    const kategoriKecergasan = "-- Pilih Kategori Kecergasan --";
    const kategoriKos = "-- Pilih Kategori Kos --";
    const kategoriKursus = "-- Pilih Kategori Kursus --";
    const kategoriInsentif = "-- Pilih Kategori Insentif --";
    const kategoriMasalah = "-- Pilih Kategori Masalah --";
    const kategoriMuatNaik = "-- Pilih Kategori Muat Naik --";
    const kategoriOKU = "-- Pilih Kategori OKU --";
    const kategoriPenilaian = "-- Pilih Kategori Penilaian --";
    const kategoriPengajian = "-- Pilih Kategori Pengajian --";
    const kategoriPenganjuran = "-- Pilih Kategori Penganjuran --";
    const kategoriPenggunaan = "-- Pilih Kategori Penggunaan --";
    const kategoriPensijilan = "-- Pilih Kategori Pensijilan --";
    const kategoriPermohonanProgramBinaan = "-- Pilih Kategori Permohonan --";
    const kategoriPersatuan = "-- Pilih Kategori Persatuan --";
    const kategoriPeserta = "-- Pilih Kategori Peserta --";
    const kategoriProgram = "-- Pilih Kategori Program --";
    const kategoriSukan = "-- Pilih Kategori Sukan --";
    const kawasanTemuduga = "-- Pilih Kawasan Temuduga --";
    const keaktifanJurulatih = "-- Pilih Keaktifan Jurulatih --";
    const kewarganegara = "-- Pilih Kewarganegara --";
    const kelulusan = "-- Pilih Kelulusan --";
    const kelulusanHQ = "-- Pilih Kelulusan HQ --";
    const kelulusanAkademi = "-- Pilih Kelulusan Akademi --";
    const kelulusanAkademik = "-- Pilih Kelulusan Akademik --";
    const kelulusanSainsSukan = "-- Pilih Kelulusan Sains Sukan --";
    const kelulusanSukanSpesifik = "-- Pilih Kelulusan Sukan Spesifik --";
    const kemudahan = " -- Pilih Kemudahan -- ";
    const kumpulan = "-- Pilih Kumpulan --";
    const kumpulanDarah = "-- Pilih Kumpulan Darah --";
    const lantikan = "-- Pilih Lantikan--";
    const laporan = "-- Pilih Laporan --";
    const latarbelakangKes = "-- Pilih Latarbelakang Kes --";
    const lainLainProgram = "-- Pilih Lain-lain Program --";
    const lesenKejurulatihan = "-- Pilih Lesen Kejurulatihan --";
    const lokasi = "-- Pilih Lokasi --";
    const maklumatProgram = "-- Pilih Maklumat Program --";
    const masalahKesihatan = "-- Pilih Masalah Kesihatan --";
    const namaAhli = "-- Pilih Nama Ahli --";
    const namaInsentif = "-- Pilih Nama Insentif --";
    const namaPersatuanPersekutuandunia = "-- Pilih Nama Persatuan / Persekutuan Dunia --";
    const negara = " -- Pilih Negara -- ";
    const negeri = " -- Pilih Negeri -- ";
    const negeriSokongan = " -- Pilih Negeri Sokongan -- ";
    const parlimen = " -- Pilih Parlimen -- ";
    const pasukan = " -- Pilih Pasukan -- ";
    const pencapaian = " -- Pilih Pecapaian -- ";
    const pangkat = " -- Pilih Pangkat -- ";
    const pejabatYangMendaftarkan = " -- Pilih Pejabat Yang Mendaftarkan -- ";
    const pemohon = " -- Pilih Pemohon -- ";
    const pengajian = " -- Pilih Pengajian -- ";
    const peralatan = " -- Pilih Peralatan -- ";
    const peralatanKemudahan = " -- Pilih Peralatan Kemudahan -- ";
    const peranan = " -- Pilih Peranan -- ";
    const perananPeserta = " -- Pilih Peranan Peserta -- ";
    const perkhidmatan = " -- Pilih Perkhidmatan -- ";
    const perkhidmatanPemakanan = " -- Pilih Perkhidmatan Pemakanan -- ";
    const perkhidmatanSatelit = " -- Pilih Perkhidmatan Satelit -- ";
    const peringkat = " -- Pilih Peringkat -- ";
    const peringkatBadanSukan = "-- Pilih Peringkat Badan Sukan --";
    const peringkatProgram = "-- Pilih Peringkat Program --";
    const pertandingan = " -- Pilih Pertandingan -- ";
    const programRumusan = " -- Pilih Program Rumusan -- ";
    const pegawai = " -- Pilih Pegawai -- ";
    const pegawaiTeknikal = " -- Pilih Pegawai Teknikal -- ";
    const pegawaiPsikologi = " -- Pilih Pegawai Psikologi -- ";
    const penyakit = "-- Pilih Penyakit --";
    const permohonan = "-- Pilih Permohonan --";
    const permohonanPelanjutan = "-- Pilih Permohonan Pelanjutan --";
    const persatuan = "-- Pilih Persatuan --";
    const peserta = "-- Pilih Peserta --";
    const pingat = "-- Pilih Pingat --";
    const program = "-- Pilih Program --";
    const programPengajian = "-- Pilih Program Pengajian --";
    const programSemasa = "-- Pilih Program Semasa --";
    const rating = "-- Pilih Rating --";
    const rekodBaru = "-- Pilih Rekod Baru --";
    const saizPakaian = "-- Pilih Saiz Pakaian --";
    const saizBaju = "-- Pilih Saiz Baju --";
    const sebabPermohonan = "-- Pilih Sebab Permohonan --";
    const sektor = "-- Pilih Sektor --";
    const sekolah = "-- Pilih Sekolah --";
    const semesterBaki = "-- Pilih Baki Semester --";
    const semesterTerkini = "-- Pilih Semester Terkini --";
    const sesiPermohonan = "-- Pilih Sesi Permohonan --";
    const shuttle = "-- Pilih Shuttle --";
    const sijilSPKK = "-- Pilih Sijil SPKK --";
    const sokongan = "-- Pilih Sokongan --";
    const soalan = "-- Pilih Soalan --";
    const status = "-- Pilih Status --";
    const statusAduan = "-- Pilih Status Aduan --";
    const statusDiagnosisPreskripsiPemeriksaanPenyiasatan = "-- Pilih Status Diagnosis/Preskripsi/Pemeriksaan/Penyiasatan --";
    const statusElaun = "-- Pilih Status Elaun --";
    const statusGeran = "-- Pilih Status Geran --";
    const statusHaid = "-- Pilih Status Haid --";
    const statusJournal = "-- Pilih Status Journal --";
    const statusJurulatih = "-- Pilih Status Jurulatih --";
    const statusPencalonan = "-- Pilih Status Pencalonan --";
    const statusPermohonan = "-- Pilih Status Permohonan --";
    const statusPerokok = "-- Pilih Status Perokok --";
    const statusTemujanji = "-- Pilih Status Temujanji --";
    const statusTugas = "-- Pilih Status Tugas --";
    const statusUjian = "-- Pilih Status Ujian --";
    const stage = "-- Pilih Stage --";
    const subKategoriPenilaian = "-- Pilih Sub Kategori Penilaian --";
    const subProgramPelapis = "-- Pilih Sub Program Pelapis --";
    const sukan = "-- Pilih Sukan --";
    const sukanAkademi = "-- Pilih Sukan Akademi --";
    const sukanRekreasi = "-- Pilih Sukan / Rekreasi --";
    const tahap = "-- Pilih Tahap --";
    const tahapAtlet = " -- Pilih Tahap -- ";
    const tahapPendidikan = " -- Pilih Tahap Pendidikan -- ";
    const tahapPenganjuran = " -- Pilih Tahap Penganjuran -- ";
    const tarafPerkahwinan = " -- Pilih Taraf Perkahwinan -- "; 
    const temasya = " -- Pilih Temasya -- "; 
    const tempat = " -- Pilih Tempat -- "; 
    const ubat = " -- Pilih Ubat -- "; 
    const unitDiagnosisPreskripsiPemeriksaanPenyiasatan = " -- Pilih Fisio atau Rehab -- "; 
    const universitiInstitusi = " -- Pilih Universiti / Institusi -- "; 
    const venue = " -- Pilih Venue -- "; 
    const wartawan = " -- Pilih Wartawan -- ";
    const waktuKetikaDiperlukan = " -- Pilih Waktu Ketika Diperlukan -- ";
}

