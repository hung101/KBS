<?php
namespace app\models\general;

use Yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$session = Yii::$app->getSession();

if($session->get('language') == "BM" || $session->get('language') == null || $session->get('language') == "") {

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
        const bahagianCawanganPusat = " -- Pilih Bahagian / Cawangan / Pusat -- ";
        const bahagianKecederaan = " -- Pilih Bahagian Kecederaan -- ";
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
        const dokumenPenyelidikan = " -- Pilih Dokumen Penyelidikan -- ";
        const format = " -- Pilih Format -- ";
        const fasilitiSatelit = " -- Pilih Fasiliti Satelit -- ";
        const fisio = " -- Pilih Fisio -- ";
        const gelaran = " -- Pilih Gelaran -- ";
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
        const jenisPerkhidmatan = "-- Pilih Jenis Perkhidmatan --";
        const jenisPermohonan = "-- Pilih Jenis Permohonan --";
        const jenisPermohonanProgramBinaan = "-- Pilih Jenis Permohonan --";
        const jenisProgram = "-- Pilih Jenis Program --";
        const jenisProjek = "-- Pilih Jenis Projek --";
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
        const kursus = "-- Pilih Kursus --";
        const lantikan = "-- Pilih Lantikan--";
        const laporan = "-- Pilih Laporan --";
        const latarbelakangKes = "-- Pilih Latarbelakang Kes --";
        const lainLainProgram = "-- Pilih Lain-lain Program --";
        const lesenKejurulatihan = "-- Pilih Lesen Kejurulatihan --";
        const lokasi = "-- Pilih Lokasi --";
        const maklumatProgram = "-- Pulih Maklumat Program --";
        const masalahKesihatan = "-- Pilih Masalah Kesihatan --";
        const namaAhli = "-- Pilih Nama Ahli --";
        const namaFisioterapi = "-- Pilih Nama Fisioterapi --";
        const namaRehabilitasi = "-- Pilih Nama Rehabilitasi --";
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
        const penganjuranKursus = " -- Pilih Penganjuran Kursus -- ";
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
        const rawatanFisioterapi = "-- Pilih Rawatan Fisioterapi --";
        const rawatanRehabilitasi = "-- Pilih Rawatan Rehabilitasi --";
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
        const tindakanSelanjutnya = " -- Pilih Tindakan Selanjutnya -- "; 
        const ubat = " -- Pilih Ubat -- "; 
        const unitDiagnosisPreskripsiPemeriksaanPenyiasatan = " -- Pilih Fisio atau Rehab -- "; 
        const universitiInstitusi = " -- Pilih Universiti / Institusi -- "; 
        const venue = " -- Pilih Venue -- "; 
        const wartawan = " -- Pilih Wartawan -- ";
        const waktuKetikaDiperlukan = " -- Pilih Waktu Ketika Diperlukan -- ";
    }

}

if($session->get('language') == "EN") {

    class Placeholder{
        const acara = "-- Select Event --";
        const acaraOlimpik = "-- Select Olympic Events --";
        const agama = " -- Select Religion -- ";
        const agensi = " -- Select Agency -- ";
        const ahliJawatankuasaInduk = " -- Select A Member Of The Main Committee -- ";
        const ahliJawatankuasaKecilBiro = " -- Select The Members Of The Subcommittee/Bureau -- ";
        const ahliJKK_JKP = "-- Select Members AS WELL/CMC --";
        const anthropometricsUjian =  "-- Select Test Anthropometrics --";
        const atlet = "-- Select Athletes --";
        const badanSukan = "-- Select Sports Bodies --";
        const badanSukanAntarabangsa = "-- Select International Sports Bodies --";
        const bahagian = " -- Select Part -- ";
        const bahagianCawanganPusat = " -- Pilih Division / Branch / Center -- ";
        const bahagianKecederaan = " -- Select Part Injuries -- ";
        const bahasa = " -- Select A Language -- ";
        const bandar = " -- Select City -- ";
        const bank = "-- Select Bank --";
        const bangsa = " -- Select Race -- ";
        const bidangDiminati = " -- Select Areas Of Interest -- ";
        const bidangKonsultansi = " -- Select Field Of Consultancy -- ";
        const biomekanikUjian = " -- Select The Biomechanics Test -- ";
        const cawangan = " -- Select Branch -- ";
        const darjah = " -- Select Degree -- ";
        const delegasi = " -- Select Delegation -- ";
        const doktor = " -- Select A Doctor -- ";
        const dokumenPenyelidikan = " -- Select A Research Document -- ";
        const format = " -- Select The Format -- ";
        const fasilitiSatelit = " -- Select Satellite Facility -- ";
        const fisio = " -- Select Physio -- ";
        const gelaran = " -- Pilih Title -- ";
        const hubungan = " -- Select Relationship -- ";
        const instructor = " -- Select Instructor -- ";
        const jabatan = " -- Select Department -- ";
        const jantina = " -- Select Gender -- ";
        const jawatan = " -- Select Position -- ";
        const jawapan = " -- Select An Answer -- ";
        const jenama = " -- Select Brand -- ";
        const jenis = " -- Select The Type Of -- ";
        const jenisAkaun = " -- Select Account Type -- ";
        const jenisAlkohol = " -- Select The Type Of Alcohol -- ";
        const jenisAset = " -- Select The Type Of Assets -- ";
        const jenisAsetSub = "-- Select Property Type/Transportation/Business --";
        const jenisBajet = "-- Select The Type Of Budget --";
        const jenisBantuan = "-- Select The Type Of Assistance --";
        const jenisBantuanSKAK = "-- Select The Type Of Assistance SKAK --";
        const jenisBiasiswa = " -- Select The Type Of Scholarship -- ";
        const jenisCawanganKuasa = "-- Select The Type Of Power Outlet --";
        const jenisDiet = "-- Select The Type Of Diet --";
        const jenisElaun = " -- Select The Type Of Allowance -- ";
        const jenisHarta = " -- Select Property Type -- ";
        const jenisInsentif = " -- Select The Type Of Incentives -- ";
        const jenisLatihanAmali = "-- Select The Type Of Practical Training --";
        const jenisLesenMemandu = " -- Select The Type Of Driving Licence -- ";
        const jenisPinjaman = "-- Select The Type Of Loan --";
        const jenisKadar = "-- Select The Type Of Rates --";
        const jenisKebajikan = "-- Select The Type Of Welfare --";
        const jenisKecederaanMasalahKesihatan = "-- Select The Type Of Injury/Health Problems --";
        const jenisKemahiran = "-- Select The Type Of Skills --";
        const jenisKemudahan = "-- Select The Type Of Facilities --";
        const jenisKewangan = " -- Select The Type Of -- ";
        const jenisKewanganSumber = " -- Select Source -- ";
        const jenisKontrak = "-- Select The Type Of Contract --";
        const jenisKurangUpaya = "-- Select The Type Of Disabilities --";
        const jenisKurangUpayaPendengaran = "-- Select The Type Of Disability Hearing --";
        const jenisKursus = "-- Select The Type Of Course --";
        const jenisOrgan = "-- Select The Type Of Organ --";
        const jenisPakaian = "-- Select The Type Of Clothing --";
        const jenisPendapatan = "-- Select The Type Of Income --";
        const jenisPenganjuran = "-- Select The Type Of Organisation --";
        const jenisPerkhidmatan = "-- Select The Type Of Service --";
        const jenisPermohonan = "-- Select The Type Of Application --";
        const jenisPermohonanProgramBinaan = "-- Select The Type Of Application --";
        const jenisProgram = "-- Select The Type Of Program --";
        const jenisProjek = "-- Select The Type Of Project --";
        const jenisRekod = "-- Select Record Type --";
        const jenisSejarahPerubatan = "-- Select The Type Of History Of Medicine --";
        const jenisSijil = "-- Select The Type Of Certificate --";
        const jenisTempahan = "-- Select The Type Of Reservation --";
        const jenisTemujanji = "-- Select The Type Of Appointment --";
        const jurulatih = "-- Choose A Coach --";
        const juruUrut = "-- Choose Juru Massage --";
        const kaum = "-- Select Race --";
        const kejohanan = "-- Select Tournament --";
        const kejohananMewakili = "-- Select The Tournament Represents --";
        const kelayakanAkademik = "-- Select Academic Qualifications --";
        const kelayakanPingat = "-- Select Qualification Medal --";
        const kerja = "-- Select Work --";
        const kategori = "-- Choose A Category --";
        const kategoriAduan = "-- Select The Category Of Complaints --";
        const kategoriAtlet = "-- Select The Category Of Athletes --";
        const kategoriBajet = "-- Select Budget Categories --";
        const kategoriBerita = "-- Select News Category --";
        const kategoriDokumen = "-- Select A Document Category --";
        const kategoriElaun = "-- Select The Category Of Allowances --";
        const kategoriELaporan = " -- Choose Category E-Report -- ";
        const kategoriGeran = " -- Select The Category Of Grants -- ";
        const kategoriGeranBantuan = " -- Choose Grant Category -- ";
        const kategoriHakmilik = " -- Select The Category Title -- ";
        const kategoriKeahlian = " -- Select A Membership Category -- ";
        const kategoriKecergasan = "-- Select Fitness Category --";
        const kategoriKos = "-- Select The Cost Category --";
        const kategoriKursus = "-- Select A Course Category --";
        const kategoriInsentif = "-- Select The Category Of Incentives --";
        const kategoriMasalah = "-- Select Categories Of Problem --";
        const kategoriMuatNaik = "-- Choose A Category Upload --";
        const kategoriOKU = "-- Select The Category Of DISABLED PERSONS --";
        const kategoriPenilaian = "-- Choose A Category Assessment --";
        const kategoriPengajian = "-- Select The Category Of Study --";
        const kategoriPenganjuran = "-- Select Categories Of Organising --";
        const kategoriPenggunaan = "-- Select The Category Of Use --";
        const kategoriPensijilan = "-- Choose Category Certification --";
        const kategoriPermohonanProgramBinaan = "-- Select Categories Application --";
        const kategoriPersatuan = "-- Select The Category Association --";
        const kategoriPeserta = "-- Select The Category Of Participants --";
        const kategoriProgram = "-- Select Program Category --";
        const kategoriSukan = "-- Select The Sports Category --";
        const kawasanTemuduga = "-- Select An Area Of The Interview --";
        const keaktifanJurulatih = "-- Select The Keaktifan Coach --";
        const kewarganegara = "-- Choose Citizenship --";
        const kelulusan = "-- Select Approval --";
        const kelulusanHQ = "-- Select The Approval Of HQ --";
        const kelulusanAkademi = "-- Select The Approval Of The Academy --";
        const kelulusanAkademik = "-- Select Academic Approval --";
        const kelulusanSainsSukan = "-- Select The Approval Of Sports Science --";
        const kelulusanSukanSpesifik = "-- Select The Specific Approval --";
        const kemudahan = " -- Select Facilities -- ";
        const kumpulan = "-- Select The Group --";
        const kumpulanDarah = "-- Select Blood Group --";
        const kursus = "-- Select Course --";
        const lantikan = "-- Select Appointment--";
        const laporan = "-- Select Report --";
        const latarbelakangKes = "-- Select The Background To The Case --";
        const lainLainProgram = "-- Select other Programs --";
        const lesenKejurulatihan = "-- Select License Coaching --";
        const lokasi = "-- Select A Location --";
        const maklumatProgram = "-- Select A Program Information --";
        const masalahKesihatan = "-- Select Health Problems --";
        const namaAhli = "-- Choose A Member Name --";
        const namaFisioterapi = "-- Choose A Physiotherapy Name --";
        const namaRehabilitasi = "-- Select A Name Rehabilitation --";
        const namaInsentif = "-- Select The Name Of The Incentive --";
        const namaPersatuanPersekutuandunia = "-- Select The Name Of Association/World Federation --";
        const negara = " -- Select Country -- ";
        const negeri = " -- Select State -- ";
        const negeriSokongan = " -- Select State Support -- ";
        const parlimen = " -- Select The Parliament -- ";
        const pasukan = " -- Select Team -- ";
        const pencapaian = " -- Select Pecapaian -- ";
        const pangkat = " -- Select Rank -- ";
        const pejabatYangMendaftarkan = " -- Select The Register Office -- ";
        const pemohon = " -- Select The Applicant -- ";
        const pengajian = " -- Select Study -- ";
        const penganjuranKursus = " -- Pilih A Organization Of Courses -- ";
        const peralatan = " -- Select Equipment -- ";
        const peralatanKemudahan = " -- Select Equipment Facilities -- ";
        const peranan = " -- Select Role -- ";
        const perananPeserta = " -- Select The Role Participants -- ";
        const perkhidmatan = " -- Select The Services -- ";
        const perkhidmatanPemakanan = " -- Select Nutrition Service -- ";
        const perkhidmatanSatelit = " -- Select Satellite Service -- ";
        const peringkat = " -- Select Level -- ";
        const peringkatBadanSukan = "-- Select Stage Body Sports --";
        const peringkatProgram = "-- Select A Level Programme --";
        const pertandingan = " -- Select Competition -- ";
        const programRumusan = " -- Select Program Summary -- ";
        const pegawai = " -- Select Officer -- ";
        const pegawaiTeknikal = " -- Select Technical Officer -- ";
        const pegawaiPsikologi = " -- Select The Officers Of Psychology -- ";
        const penyakit = "-- Select A Disease --";
        const permohonan = "-- Select Application --";
        const permohonanPelanjutan = "-- Select The Application Extension --";
        const persatuan = "-- Select Association --";
        const peserta = "-- Select Participants --";
        const pingat = "-- Select A Medal --";
        const program = "-- Select Program --";
        const programPengajian = "-- Select Study Programs --";
        const programSemasa = "-- Select The Current Program --";
        const rating = "-- Select Rating --";
        const rekodBaru = "-- Select The New Record --";
        const rawatanFisioterapi = "-- Select Physiotherapy Treatment --";
        const rawatanRehabilitasi = "-- Select Rehabilitation Treatment --";
        const saizPakaian = "-- Select The Size Of Clothing --";
        const saizBaju = "-- Select Shirt Size --";
        const sebabPermohonan = "-- Select The Reason For Application --";
        const sektor = "-- Select Sector --";
        const sekolah = "-- Select School --";
        const semesterBaki = "-- Select The Remaining Semester --";
        const semesterTerkini = "-- Select Semester Booking --";
        const sesiPermohonan = "-- Select The Session Application --";
        const shuttle = "-- Select Shuttle --";
        const sijilSPKK = "-- Select The Certificate Is PRACTICED --";
        const sokongan = "-- Select Support --";
        const soalan = "-- Select Question --";
        const status = "-- Select Status --";
        const statusAduan = "-- Select The Status Of The Complaint --";
        const statusDiagnosisPreskripsiPemeriksaanPenyiasatan = "-- Select The Status Diagnosis/Prescription/Inspection/Investigation --";
        const statusElaun = "-- Select The Status Of The Allowance --";
        const statusGeran = "-- Select The Status Of The Grant --";
        const statusHaid = "-- Select The Status Of The Menstrual --";
        const statusJournal = "-- Select The Status Of The Journal --";
        const statusJurulatih = "-- Select The Status Of Coach --";
        const statusPencalonan = "-- Select The Status Of The Nomination --";
        const statusPermohonan = "-- Select Application Status --";
        const statusPerokok = "-- Select The Status Of Smokers --";
        const statusTemujanji = "-- Select The Status Of An Appointment --";
        const statusTugas = "-- Select The Task Status --";
        const statusUjian = "-- Select The Status Test --";
        const stage = "-- Select Stage --";
        const subKategoriPenilaian = "-- Select Sub Category Assessment --";
        const subProgramPelapis = "-- Select The Sub Programme Will Become --";
        const sukan = "-- Select Sport --";
        const sukanAkademi = "-- Select Sports Academy --";
        const sukanRekreasi = "-- Select Sport/Recreation --";
        const tahap = "-- Select The Level Of --";
        const tahapAtlet = " -- Select The Level Of -- ";
        const tahapPendidikan = " -- Select Education Level -- ";
        const tahapPenganjuran = " -- Select The Level Of Organisation Of -- ";
        const tarafPerkahwinan = " -- Select Marital Status -- "; 
        const temasya = " -- Select Events -- "; 
        const tempat = " -- Select A Location -- "; 
        const tindakanSelanjutnya = " -- Select An Action -- "; 
        const ubat = " -- Select Medication -- "; 
        const unitDiagnosisPreskripsiPemeriksaanPenyiasatan = " -- Select Physio or Rehab -- "; 
        const universitiInstitusi = " -- Select Your University/Institution -- "; 
        const venue = " -- Select Venue -- "; 
        const wartawan = " -- Select Journalists -- ";
        const waktuKetikaDiperlukan = " -- Select The Time When Needed -- ";
    }
}

