<?php
namespace app\models\general;

use yii\web\UploadedFile;
use common\models\general\GeneralFunction;

use Yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$session = Yii::$app->getSession();

if($session->get('language') == "BM" || $session->get('language') == null || $session->get('language') == "") {

    class Upload{
        const MesyuaratJkkFolder = "mesyuarat_jkk";
        const adminEBiasiswaFolder = "admin_e_biasiswa";
        const akademiAkkFolder = "akademi_akk";
        const akademiAkkKegiatanPengalamanJurulatihAkkFolder = "kegiatan_pengalaman_jurulatih_akk";
        const akademiAkkPemohonKursusTahapAkkFolder = "pemohon_kursus_tahap_akk";
        const akademiAkkSijilPertolonganCemasFolder = "akk_sijil_pertolongan_cemas";
        const akademiAkkSijilCprFolder = "akk_sijil_cpr";
        const akademiAkkPermitKerjaFolder = "akk_permit_kerja";
        const akkProgramJurulatihFolder = "akk_program_jurulatih";
        const anugerahPencalonanAtletFolder = "anugerah_pencalonan_atlet";
        const anugerahPencalonanJurulatihFolder = "anugerah_pencalonan_jurulatih";
        const anugerahPencalonanKepimpinanSukanFolder = "anugerah_pencalonan_kepimpinan_sukan";
        const anugerahPencalonanLainFolder = "anugerah_pencalonan_lain";
        const anugerahPencalonanPasukanFolder = "anugerah_pencalonan_pasukan";
        const anugerahPencalonanTokohSukanFolder = "anugerah_pencalonan_tokoh_sukan";
        const atletFolder = "atlet";
        const borangaduankerosakanjeniskerosakanFolder = "borang_aduan_kerosakan_jenis_kerosakan";
        const atletKursusKemFolder = "atlet_kursus_kem";
        const bantuanElaunFolder = "bantuan_elaun";
        const bantuanElaunMuatnaikFolder = "bantuan_elaun_muatnaik";
        const bantuanPenganjuranKejohananFolder = "bantuan_penganjuran_kejohanan";
        const bantuanPenganjuranKejohananLaporanFolder = "bantuan_penganjuran_kejohanan_laporan";
        const bantuanPenganjuranKejohananSirkitFolder = "bantuan_penganjuran_kejohanan_sirkit";
        const bantuanPenganjuranKejohananSirkitLaporanFolder = "bantuan_penganjuran_kejohanan_sirkit_laporan";
        const bantuanPenganjuranKursusFolder = "bantuan_penganjuran_kursus";
        const bantuanPentadbiranPejabatFolder = "bantuan_pentadbiran_pejabat";
        const forumSeminarPersidanganDiLuarNegaraFolder = "forum_seminar_persidangan_di_luar_negara";
        const pengurusanPermohonanKursusPersatuanFolder = "pengurusan_permohonan_kursus_persatuan";
        const bantuanPenganjuranKursusPegawaiTeknikalFolder = "bantuan_penganjuran_kursus_pegawai_teknikal";
        const bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder = "bantuan_penganjuran_kursus_pegawai_teknikal_laporan";
        const bantuanPenganjuranKursusPenceramahFolder = "bantuan_penganjuran_kursus_penceramah";
        const bantuanPenyertaanPegawaiTeknikalFolder = "bantuan_penyertaan_pegawai_teknikal";
        const bspElaunLatihanPraktikal = "bsp_elaun_latihan_praktikal";
        const laporanPemantauanJurulatihKategoriFolder = "laporan_pemantauan_jurulatih_kategori";
        const bspBorangBorang = "bsp_borang_borang";
        const bspBorang10Folder = "bsp_borang_10";
        const bspBorang11Folder = "bsp_borang_11";
        const bspElaunPerjalananUdara = "bsp_elaun_perjalanan_udara";
        const bspPrestasiAkademik = "bsp_prestasi_akademik";
        const bspPerlanjutanDokumenFolder = "bsp_perlanjutan_dokumen";
        const bspPertukaranProgramPengajianDokumenFolder = "bsp_pertukaran_program_pengajian_dokumen";
        const bspTamatPengesahanPengajian = "bsp_tamat_pengesahan_pengajian";
        const bspTuntutanElaunTesisFolder = "bsp_tuntutan_elaun_tesis";
        const dokumenPenyelidikanFolder = "dokumen_penyelidikan";
        const eBantuanFolder = "e_bantuan";
        const eBantuanSenaraiPermohonanSubFolder = "senarai_permohonan";
        const eBantuanSenaraiSemakSubFolder = "senarai_semak";
        const eBantuanPublicUserFolder = "e_bantuan_public_user";
        const eBiasiswaFolder = "permohonan_e_biasiswa";
        const eLaporanFolder = "e_laporan";
        const eLaporanGambarSubFolder = "gambar";
        const farmasiPermohonanLiputanPerubatanSukanFolder = "farmasi_permohonan_liputan_perubatan_sukan";
        const farmasiPermohonanUbatanFolder = "farmasi_permohonan_ubatan";
        const gajiDanElaunJurulatihFolder = "gaji_dan_elaun_jurulatih";
        const geranBantuanGajiFolder = "geran_bantuan_gaji";
        const geranBantuanGajiLampiranFolder = "geran_bantuan_gaji_lampiran";
        const hptLaporanBulananPegawaiFolder = "hpt_laporan_bulanan_pegawai";
        const jurulatihFolder = "jurulatih";
        const jurulatihKelayakan = "jurulatih_kelayakan";
        const jurulatihKursusTertinggi = "jurulatih_kursus_tertinggi";
        const kelayakanSukanSpesifikAkkFolder = "kelayakan_sukan_spesifik_akk";
        const khidmatPerubatanDanSainsSukanFolder = "khidmat_perubatan_dan_sains_sukan";
        const informasiPermohonanFolder = "informasi_permohonan";
        const ltbsMesyuaratFolder = "ltbs_mesyuarat";
        const ltbsMinitMesyuaratJawatankuasaFolder = "ltbs_minit_mesyuarat_jawatankuasa";
        const ltbsMesyuaratMuatNaikJawatankuasaSubFolder = "muat_naik_jawatankuasa";
        const ltbsNotisAGMSubFolder = "notis_agm";
        const ltbsPenyataKewanganFolder = "ltbs_penyata_kewangan";
        const maklumatPegawaiTeknikalFolder = "maklumat_pegawai_teknikal";
        const manualSilibusKurikulumTeknikalKepegawaianFolder = "manual_silibus_kurikulum_teknikal_kepegawaian";
        const mesyuaratFolder = "mesyuarat";
        const muatNaikDokumenFolder = "muat_naik_dokumen";
        const paobsPenganjuranFolder = "paobs_penganjuran";
        const paobsPenganjurFolder = "paobs_penganjur";
        const perkhidmatanAnalisaPerlawananBiomekanikFolder = "perkhidmatan-analisa-perlawanan-biomekanik";
        const pernilaianPrestasiFolder = "pernilaian_prestasi";
        const penganjuranKursusPesertaFolder  = "penganjuran_kursus_peserta";
        const pelanjutanPenamatanKontrakJurulatihFolder = "pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih";
        const pengurusanBeritaAntarabangsaFolder = "pengurusan_berita_antarabangsa";
        const pengurusanBeritaAntarabangsaMuatnaikFolder = "pengurusan_berita_antarabangsa_muatnaik";
        const pengurusanMediaProgramFolder = "pengurusan_media_program";
        const pengurusanMediaProgramDokumenSubFolder = "dokumen_media_program";
        const pengurusanInsentifFolder = "pengurusan_insentif";
        const pengurusanInsuranFolder = "pengurusan_insuran";
        const pengurusanInsuranLampiranFolder = "pengurusan_insuran_lampiran";
        const pengurusanKemudahanSediaAdaFolder = "pengurusan_kemudahan_sedia_ada";
        const pengurusanKemudahanSediaAdaMsnFolder = "pengurusan_kemudahan_sedia_ada_msn";
        const pengurusanPerhimpunanKemFolder = "pengurusan_perhimpunan_kem";
        const pengurusanProgramBinaanFolder = "pengurusan_program_binaan";
        const laporanPenyertaanKejohananFolder = "laporan_penyertaan_kejohanan";
        const laporanPendedahanLatihanFolder = "laporan_pendedahan_latihan";
        const perancanganProgramFolder = "perancangan_program";
        const perancanganProgramHPTFolder = "perancangan_program_hpt";
        const permohonanBiasiswaFolder = "permohonan_biasiswa";
        const permohonanPendidikanFolder = "permohonan_pendidikan";
        const permohonanPenyelidikanFolder = "permohonan_penyelidikan";
        const permohonanProgramPendidikanKesihatanFolder = "permohonan_program_pendidikan_kesihatan";
        const plTemujanjiFisioterapiFolder = "pl_temujanji_fisioterapi";
        const plTemujanjiRehabilitasiFolder = "pl_temujanji_rehabilitasi";
        const profilBadanSukanFolder = "profil_badan_sukan";
        const profilKonsultanFolder = "profil_konsultan";
        const profilPanelPenasihatKpskFolder = "profil_panel_penasihat_kpsk";
        const profilPsikologiFolder = "profil_psikologi";
        const profilWartawanSukanFolder = "profil_wartawan_sukan";
        const perlembagaanBadanSukanFolder = "perlembagaan_badan_sukan";
        const sixStepSuaianFizikalFolder = "six_step_suaian_fizikal";
        const skimKebajikanFolder = "skim_kebajikan";
        const sukarelawanFolder = "sukarelawan";
        const uploadRootFolder = "uploads";

        public static function uploadFile($file, $Folder, $id, $SubFolder = ""){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                return null;
            }
            
            // if got sub folder
            if($SubFolder != ""){
                $Folder = $Folder . '/' . $SubFolder;
            }
            
            $filename = $file->baseName;
            if(strlen($file->baseName) != mb_strlen($file->baseName, 'utf-8')){
                // content non-english characters
                $filename = md5($file->baseName);
            }
            
            $fileLocation = self::uploadRootFolder . '/' . $Folder . '/' . $filename . '_' . $id . '.' . $file->extension;
            $file->saveAs($fileLocation);
            
            return $fileLocation;
        }
        
        /**
         * return error description base on server upload error code
         */
        public static function getUploadErrorDesc($error_code){
            $error_desc = "";
            
            switch($error_code){
                case 0:
                    $error_desc = "Tidak ada kesilapan, fail telah berjaya dimuat naik";
                    break;
                case 1: // The uploaded file exceeds the upload_max_filesize directive in php.ini
                    $error_desc = "Fail yang dimuat naik melebihi saiz had muat naik " . ini_get('upload_max_filesize');
                    break;
                case 2:
                    $error_desc = "Fail yang dimuat naik melebihi arahan MAX_FILE_SIZE yang dinyatakan di dalam borang HTML";
                    break;
                case 3:
                    $error_desc = "Fail yang dimuat naik telah dimuat naik dengan sepenuhnya";
                    break;
                case 4:
                    $error_desc = "Tiada fail telah dimuat naik";
                    break;
                case 6:
                    $error_desc = "Hilang folder sementara";
                    break;
            }
            
            return $error_desc;
        }
    }

}

if($session->get('language') == "EN") {

    class Upload{
        
        const MesyuaratJkkFolder = "mesyuarat_jkk";
        const adminEBiasiswaFolder = "admin_e_biasiswa";
        const akademiAkkFolder = "akademi_akk";
        const akademiAkkKegiatanPengalamanJurulatihAkkFolder = "kegiatan_pengalaman_jurulatih_akk";
        const akademiAkkPemohonKursusTahapAkkFolder = "pemohon_kursus_tahap_akk";
        const akademiAkkSijilPertolonganCemasFolder = "akk_sijil_pertolongan_cemas";
        const akademiAkkSijilCprFolder = "akk_sijil_cpr";
        const akademiAkkPermitKerjaFolder = "akk_permit_kerja";
        const akkProgramJurulatihFolder = "akk_program_jurulatih";
        const anugerahPencalonanAtletFolder = "anugerah_pencalonan_atlet";
        const anugerahPencalonanJurulatihFolder = "anugerah_pencalonan_jurulatih";
        const anugerahPencalonanKepimpinanSukanFolder = "anugerah_pencalonan_kepimpinan_sukan";
        const anugerahPencalonanLainFolder = "anugerah_pencalonan_lain";
        const anugerahPencalonanPasukanFolder = "anugerah_pencalonan_pasukan";
        const anugerahPencalonanTokohSukanFolder = "anugerah_pencalonan_tokoh_sukan";
        const atletFolder = "atlet";
        const borangaduankerosakanjeniskerosakanFolder = "borang_aduan_kerosakan_jenis_kerosakan";
        const atletKursusKemFolder = "atlet_kursus_kem";
        const bantuanElaunFolder = "bantuan_elaun";
        const bantuanElaunMuatnaikFolder = "bantuan_elaun_muatnaik";
        const bantuanPenganjuranKejohananFolder = "bantuan_penganjuran_kejohanan";
        const bantuanPenganjuranKejohananLaporanFolder = "bantuan_penganjuran_kejohanan_laporan";
        const bantuanPenganjuranKejohananSirkitFolder = "bantuan_penganjuran_kejohanan_sirkit";
        const bantuanPenganjuranKejohananSirkitLaporanFolder = "bantuan_penganjuran_kejohanan_sirkit_laporan";
        const bantuanPenganjuranKursusFolder = "bantuan_penganjuran_kursus";
        const bantuanPentadbiranPejabatFolder = "bantuan_pentadbiran_pejabat";
        const forumSeminarPersidanganDiLuarNegaraFolder = "forum_seminar_persidangan_di_luar_negara";
        const pengurusanPermohonanKursusPersatuanFolder = "pengurusan_permohonan_kursus_persatuan";
        const bantuanPenganjuranKursusPegawaiTeknikalFolder = "bantuan_penganjuran_kursus_pegawai_teknikal";
        const bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder = "bantuan_penganjuran_kursus_pegawai_teknikal_laporan";
        const bantuanPenganjuranKursusPenceramahFolder = "bantuan_penganjuran_kursus_penceramah";
        const bantuanPenyertaanPegawaiTeknikalFolder = "bantuan_penyertaan_pegawai_teknikal";
        const bspElaunLatihanPraktikal = "bsp_elaun_latihan_praktikal";
        const laporanPemantauanJurulatihKategoriFolder = "laporan_pemantauan_jurulatih_kategori";
        const bspBorangBorang = "bsp_borang_borang";
        const bspBorang10Folder = "bsp_borang_10";
        const bspBorang11Folder = "bsp_borang_11";
        const bspElaunPerjalananUdara = "bsp_elaun_perjalanan_udara";
        const bspPrestasiAkademik = "bsp_prestasi_akademik";
        const bspPerlanjutanDokumenFolder = "bsp_perlanjutan_dokumen";
        const bspPertukaranProgramPengajianDokumenFolder = "bsp_pertukaran_program_pengajian_dokumen";
        const bspTamatPengesahanPengajian = "bsp_tamat_pengesahan_pengajian";
        const bspTuntutanElaunTesisFolder = "bsp_tuntutan_elaun_tesis";
        const dokumenPenyelidikanFolder = "dokumen_penyelidikan";
        const eBantuanFolder = "e_bantuan";
        const eBantuanSenaraiPermohonanSubFolder = "senarai_permohonan";
        const eBantuanSenaraiSemakSubFolder = "senarai_semak";
        const eBantuanPublicUserFolder = "e_bantuan_public_user";
        const eBiasiswaFolder = "permohonan_e_biasiswa";
        const eLaporanFolder = "e_laporan";
        const eLaporanGambarSubFolder = "gambar";
        const farmasiPermohonanLiputanPerubatanSukanFolder = "farmasi_permohonan_liputan_perubatan_sukan";
        const farmasiPermohonanUbatanFolder = "farmasi_permohonan_ubatan";
        const gajiDanElaunJurulatihFolder = "gaji_dan_elaun_jurulatih";
        const geranBantuanGajiFolder = "geran_bantuan_gaji";
        const geranBantuanGajiLampiranFolder = "geran_bantuan_gaji_lampiran";
        const hptLaporanBulananPegawaiFolder = "hpt_laporan_bulanan_pegawai";
        const jurulatihFolder = "jurulatih";
        const jurulatihKelayakan = "jurulatih_kelayakan";
        const jurulatihKursusTertinggi = "jurulatih_kursus_tertinggi";
        const kelayakanSukanSpesifikAkkFolder = "kelayakan_sukan_spesifik_akk";
        const khidmatPerubatanDanSainsSukanFolder = "khidmat_perubatan_dan_sains_sukan";
        const informasiPermohonanFolder = "informasi_permohonan";
        const ltbsMesyuaratFolder = "ltbs_mesyuarat";
        const ltbsMinitMesyuaratJawatankuasaFolder = "ltbs_minit_mesyuarat_jawatankuasa";
        const ltbsMesyuaratMuatNaikJawatankuasaSubFolder = "muat_naik_jawatankuasa";
        const ltbsNotisAGMSubFolder = "notis_agm";
        const ltbsPenyataKewanganFolder = "ltbs_penyata_kewangan";
        const maklumatPegawaiTeknikalFolder = "maklumat_pegawai_teknikal";
        const manualSilibusKurikulumTeknikalKepegawaianFolder = "manual_silibus_kurikulum_teknikal_kepegawaian";
        const mesyuaratFolder = "mesyuarat";
        const muatNaikDokumenFolder = "muat_naik_dokumen";
        const paobsPenganjuranFolder = "paobs_penganjuran";
        const paobsPenganjurFolder = "paobs_penganjur";
        const perkhidmatanAnalisaPerlawananBiomekanikFolder = "perkhidmatan-analisa-perlawanan-biomekanik";
        const pernilaianPrestasiFolder = "pernilaian_prestasi";
        const penganjuranKursusPesertaFolder  = "penganjuran_kursus_peserta";
        const pelanjutanPenamatanKontrakJurulatihFolder = "pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih";
        const pengurusanBeritaAntarabangsaFolder = "pengurusan_berita_antarabangsa";
        const pengurusanBeritaAntarabangsaMuatnaikFolder = "pengurusan_berita_antarabangsa_muatnaik";
        const pengurusanMediaProgramFolder = "pengurusan_media_program";
        const pengurusanMediaProgramDokumenSubFolder = "dokumen_media_program";
        const pengurusanInsentifFolder = "pengurusan_insentif";
        const pengurusanInsuranFolder = "pengurusan_insuran";
        const pengurusanInsuranLampiranFolder = "pengurusan_insuran_lampiran";
        const pengurusanKemudahanSediaAdaFolder = "pengurusan_kemudahan_sedia_ada";
        const pengurusanKemudahanSediaAdaMsnFolder = "pengurusan_kemudahan_sedia_ada_msn";
        const pengurusanPerhimpunanKemFolder = "pengurusan_perhimpunan_kem";
        const pengurusanProgramBinaanFolder = "pengurusan_program_binaan";
        const laporanPenyertaanKejohananFolder = "laporan_penyertaan_kejohanan";
        const laporanPendedahanLatihanFolder = "laporan_pendedahan_latihan";
        const perancanganProgramFolder = "perancangan_program";
        const perancanganProgramHPTFolder = "perancangan_program_hpt";
        const permohonanBiasiswaFolder = "permohonan_biasiswa";
        const permohonanPendidikanFolder = "permohonan_pendidikan";
        const permohonanPenyelidikanFolder = "permohonan_penyelidikan";
        const permohonanProgramPendidikanKesihatanFolder = "permohonan_program_pendidikan_kesihatan";
        const plTemujanjiFisioterapiFolder = "pl_temujanji_fisioterapi";
        const plTemujanjiRehabilitasiFolder = "pl_temujanji_rehabilitasi";
        const profilBadanSukanFolder = "profil_badan_sukan";
        const profilKonsultanFolder = "profil_konsultan";
        const profilPanelPenasihatKpskFolder = "profil_panel_penasihat_kpsk";
        const profilPsikologiFolder = "profil_psikologi";
        const profilWartawanSukanFolder = "profil_wartawan_sukan";
        const perlembagaanBadanSukanFolder = "perlembagaan_badan_sukan";
        const sixStepSuaianFizikalFolder = "six_step_suaian_fizikal";
        const skimKebajikanFolder = "skim_kebajikan";
        const sukarelawanFolder = "sukarelawan";
        const uploadRootFolder = "uploads";
        
        
        public static function uploadFile($file, $Folder, $id, $SubFolder = ""){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                return null;
            }
            
            // if got sub folder
            if($SubFolder != ""){
                $Folder = $Folder . '/' . $SubFolder;
            }
            
            $filename = $file->baseName;
            if(strlen($file->baseName) != mb_strlen($file->baseName, 'utf-8')){
                // content non-english characters
                $filename = md5($file->baseName);
            }
            
            $fileLocation = self::uploadRootFolder . '/' . $Folder . '/' . $filename . '_' . $id . '.' . $file->extension;
            $file->saveAs($fileLocation);
            
            return $fileLocation;
        }
        
        /**
         * return error description base on server upload error code
         */
        public static function getUploadErrorDesc($error_code){
            $error_desc = "";
            
            switch($error_code){
                case 0:
                    $error_desc = "There is no error, the file uploaded with success";
                    break;
                case 1: // The uploaded file exceeds the upload_max_filesize directive in php.ini
                    $error_desc = "The uploaded file exceeds the upload limit size " . ini_get('upload_max_filesize');
                    break;
                case 2:
                    $error_desc = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                    break;
                case 3:
                    $error_desc = "The uploaded file was only partially uploaded";
                    break;
                case 4:
                    $error_desc = "No file was uploaded";
                    break;
                case 6:
                    $error_desc = "Missing a temporary folder";
                    break;
            }
            
            return $error_desc;
        }
    }


}

