<?php
namespace app\models\general;

use yii\web\UploadedFile;

use Yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<<<<<<< HEAD
class Upload{
    const adminEBiasiswaFolder = "admin_e_biasiswa";
    const akademiAkkFolder = "akademi_akk";
    const akademiAkkKegiatanPengalamanJurulatihAkkFolder = "kegiatan_pengalaman_jurulatih_akk";
    const akademiAkkPemohonKursusTahapAkkFolder = "pemohon_kursus_tahap_akk";
    const atletFolder = "atlet";
    const bantuanElaunFolder = "bantuan_elaun";
    const bspElaunLatihanPraktikal = "bsp_elaun_latihan_praktikal";
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
    const jurulatihFolder = "jurulatih";
    const jurulatihKelayakan = "jurulatih_kelayakan";
    const informasiPermohonanFolder = "informasi_permohonan";
    const ltbsMesyuaratFolder = "ltbs_mesyuarat";
    const ltbsMinitMesyuaratJawatankuasaFolder = "ltbs_minit_mesyuarat_jawatankuasa";
    const ltbsMesyuaratMuatNaikJawatankuasaSubFolder = "muat_naik_jawatankuasa";
    const ltbsNotisAGMSubFolder = "notis_agm";
    const ltbsPenyataKewanganFolder = "ltbs_penyata_kewangan";
    const mesyuaratFolder = "mesyuarat";
    const muatNaikDokumenFolder = "muat_naik_dokumen";
    const paobsPenganjuranFolder = "paobs_penganjuran";
    const paobsPenganjurFolder = "paobs_penganjur";
    const perkhidmatanAnalisaPerlawananBiomekanikFolder = "perkhidmatan-analisa-perlawanan-biomekanik";
    const pernilaianPrestasiFolder = "pernilaian_prestasi";
    const penganjuranKursusPesertaFolder  = "penganjuran_kursus_peserta";
    const pelanjutanPenamatanKontrakJurulatihFolder = "pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih";
    const pengurusanBeritaAntarabangsaFolder = "pengurusan_berita_antarabangsa";
    const pengurusanMediaProgramFolder = "pengurusan_media_program";
    const pengurusanMediaProgramDokumenSubFolder = "dokumen_media_program";
    const pengurusanInsentifFolder = "pengurusan_insentif";
    const pengurusanKemudahanSediaAdaFolder = "pengurusan_kemudahan_sedia_ada";
    const pengurusanPerhimpunanKemFolder = "pengurusan_perhimpunan_kem";
    const perancanganProgramFolder = "perancangan_program";
    const permohonanBiasiswaFolder = "permohonan_biasiswa";
    const permohonanPendidikanFolder = "permohonan_pendidikan";
    const permohonanProgramPendidikanKesihatanFolder = "permohonan_program_pendidikan_kesihatan";
    const profilBadanSukanFolder = "profil_badan_sukan";
    const profilPsikologiFolder = "profil_psikologi";
    const perlembagaanBadanSukanFolder = "perlembagaan_badan_sukan";
    const sukarelawanFolder = "sukarelawan";
    const sixStepSuaianFizikalFolder = "six_step_suaian_fizikal";
    const uploadRootFolder = "uploads";
    
    
    public static function uploadFile($file, $Folder, $id, $SubFolder = ""){
        // if got sub folder
        if($SubFolder != ""){
            $Folder = $Folder . '/' . $SubFolder;
        }
=======
$session = Yii::$app->getSession();

if($session->get('language') == "BM" || $session->get('language') == null || $session->get('language') == "") {

    class Upload{
        const adminEBiasiswaFolder = "admin_e_biasiswa";
        const akademiAkkFolder = "akademi_akk";
        const akademiAkkKegiatanPengalamanJurulatihAkkFolder = "kegiatan_pengalaman_jurulatih_akk";
        const akademiAkkPemohonKursusTahapAkkFolder = "pemohon_kursus_tahap_akk";
        const atletFolder = "atlet";
        const bantuanElaunFolder = "bantuan_elaun";
        const bspElaunLatihanPraktikal = "bsp_elaun_latihan_praktikal";
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
        const jurulatihFolder = "jurulatih";
        const jurulatihKelayakan = "jurulatih_kelayakan";
        const informasiPermohonanFolder = "informasi_permohonan";
        const ltbsMesyuaratFolder = "ltbs_mesyuarat";
        const ltbsMinitMesyuaratJawatankuasaFolder = "ltbs_minit_mesyuarat_jawatankuasa";
        const ltbsMesyuaratMuatNaikJawatankuasaSubFolder = "muat_naik_jawatankuasa";
        const ltbsNotisAGMSubFolder = "notis_agm";
        const ltbsPenyataKewanganFolder = "ltbs_penyata_kewangan";
        const mesyuaratFolder = "mesyuarat";
        const muatNaikDokumenFolder = "muat_naik_dokumen";
        const paobsPenganjuranFolder = "paobs_penganjuran";
        const paobsPenganjurFolder = "paobs_penganjur";
        const perkhidmatanAnalisaPerlawananBiomekanikFolder = "perkhidmatan-analisa-perlawanan-biomekanik";
        const pernilaianPrestasiFolder = "pernilaian_prestasi";
        const penganjuranKursusPesertaFolder  = "penganjuran_kursus_peserta";
        const pelanjutanPenamatanKontrakJurulatihFolder = "pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih";
        const pengurusanBeritaAntarabangsaFolder = "pengurusan_berita_antarabangsa";
        const pengurusanMediaProgramFolder = "pengurusan_media_program";
        const pengurusanMediaProgramDokumenSubFolder = "dokumen_media_program";
        const pengurusanInsentifFolder = "pengurusan_insentif";
        const pengurusanKemudahanSediaAdaFolder = "pengurusan_kemudahan_sedia_ada";
        const pengurusanPerhimpunanKemFolder = "pengurusan_perhimpunan_kem";
        const perancanganProgramFolder = "perancangan_program";
        const permohonanBiasiswaFolder = "permohonan_biasiswa";
        const permohonanPendidikanFolder = "permohonan_pendidikan";
        const permohonanProgramPendidikanKesihatanFolder = "permohonan_program_pendidikan_kesihatan";
        const profilBadanSukanFolder = "profil_badan_sukan";
        const profilPsikologiFolder = "profil_psikologi";
        const perlembagaanBadanSukanFolder = "perlembagaan_badan_sukan";
        const sukarelawanFolder = "sukarelawan";
        const uploadRootFolder = "uploads";
>>>>>>> c7c89dfafdb9ae6b57129d667645eaed0d1c524d
        
        
        public static function uploadFile($file, $Folder, $id, $SubFolder = ""){
            // if got sub folder
            if($SubFolder != ""){
                $Folder = $Folder . '/' . $SubFolder;
            }
            
            $fileLocation = self::uploadRootFolder . '/' . $Folder . '/' . $file->baseName . '_' . $id . '.' . $file->extension;
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

if($session->get('language') == "EN") {

    class Upload{
        const adminEBiasiswaFolder = "admin_e_biasiswa";
        const akademiAkkFolder = "akademi_akk";
        const akademiAkkKegiatanPengalamanJurulatihAkkFolder = "kegiatan_pengalaman_jurulatih_akk";
        const akademiAkkPemohonKursusTahapAkkFolder = "pemohon_kursus_tahap_akk";
        const atletFolder = "atlet";
        const bantuanElaunFolder = "bantuan_elaun";
        const bspElaunLatihanPraktikal = "bsp_elaun_latihan_praktikal";
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
        const jurulatihFolder = "jurulatih";
        const jurulatihKelayakan = "jurulatih_kelayakan";
        const informasiPermohonanFolder = "informasi_permohonan";
        const ltbsMesyuaratFolder = "ltbs_mesyuarat";
        const ltbsMinitMesyuaratJawatankuasaFolder = "ltbs_minit_mesyuarat_jawatankuasa";
        const ltbsMesyuaratMuatNaikJawatankuasaSubFolder = "muat_naik_jawatankuasa";
        const ltbsNotisAGMSubFolder = "notis_agm";
        const ltbsPenyataKewanganFolder = "ltbs_penyata_kewangan";
        const mesyuaratFolder = "mesyuarat";
        const muatNaikDokumenFolder = "muat_naik_dokumen";
        const paobsPenganjuranFolder = "paobs_penganjuran";
        const paobsPenganjurFolder = "paobs_penganjur";
        const perkhidmatanAnalisaPerlawananBiomekanikFolder = "perkhidmatan-analisa-perlawanan-biomekanik";
        const pernilaianPrestasiFolder = "pernilaian_prestasi";
        const penganjuranKursusPesertaFolder  = "penganjuran_kursus_peserta";
        const pelanjutanPenamatanKontrakJurulatihFolder = "pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih";
        const pengurusanBeritaAntarabangsaFolder = "pengurusan_berita_antarabangsa";
        const pengurusanMediaProgramFolder = "pengurusan_media_program";
        const pengurusanMediaProgramDokumenSubFolder = "dokumen_media_program";
        const pengurusanInsentifFolder = "pengurusan_insentif";
        const pengurusanKemudahanSediaAdaFolder = "pengurusan_kemudahan_sedia_ada";
        const pengurusanPerhimpunanKemFolder = "pengurusan_perhimpunan_kem";
        const perancanganProgramFolder = "perancangan_program";
        const permohonanBiasiswaFolder = "permohonan_biasiswa";
        const permohonanPendidikanFolder = "permohonan_pendidikan";
        const permohonanProgramPendidikanKesihatanFolder = "permohonan_program_pendidikan_kesihatan";
        const profilBadanSukanFolder = "profil_badan_sukan";
        const profilPsikologiFolder = "profil_psikologi";
        const perlembagaanBadanSukanFolder = "perlembagaan_badan_sukan";
        const sukarelawanFolder = "sukarelawan";
        const uploadRootFolder = "uploads";
        
        
        public static function uploadFile($file, $Folder, $id, $SubFolder = ""){
            // if got sub folder
            if($SubFolder != ""){
                $Folder = $Folder . '/' . $SubFolder;
            }
            
            $fileLocation = self::uploadRootFolder . '/' . $Folder . '/' . $file->baseName . '_' . $id . '.' . $file->extension;
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

