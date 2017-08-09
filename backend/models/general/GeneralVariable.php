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

    class GeneralVariable{
        // Atlet Tab Content IDs
        const tabPendidikanID = "pendidikan_tab";
        const tabKarrierID = "karrier_tab";
        const tabAsetID = "aset_tab";
        const tabPerubatanID = "perubatan_tab";
        const tabPerubatanSejarahID = "perubatan_sejarah_tab";
        const tabPerubatanDoktorID = "perubatan_doktor_tab";
        const tabPerubatanInsuransID = "perubatan_insurans_tab";
        const tabPerubatanDonatorID = "perubatan_donator_tab";
        const tabPerubatanRekodsID = "perubatan_rekods_tab";
        const tabKewanganAkaunID = "kewangan_akaun_tab";
        const tabKewanganBiasiswaID  = "kewangan_biasiswa_tab";
        const tabKewanganElaunID = "kewangan_elaun_tab";
        const tabKewanganInsentifID = "kewangan_insentif_tab";
        const tabPembangunanKursuskemID = "pembangunan_kursuskem_tab";
        const tabPembangunanKaunselingID = "pembangunan_kaunseling_tab";
        const tabPembangunanKemahiranID = "pembangunan_kemahiran_tab";
        const tabSukanID = "sukan_tab";
        const tabSukanPersatuanpersekutuanduniaID = "sukan_persatuanpersekutuandunia_tab";
        const tabPakaianSukanID = "pakaian_sukan_tab";
        const tabPeralatanSukanID = "peralatan_sukan_tab";
        const tabPencapaianID = "pencapaian_tab";
        const tabPencapaianAnugerahID = "pencapaian_anugerah_tab";
        const tabPenajaanID = "penajaan_tab";
        const tabOKUID = "OKU_tab";
        const tabKeluargaID = "keluarga_tab";
        
        // Atlet List Content IDs
        const listPendidikanID = "pendidikan_list";
        const listKarrierID = "karrier_list";
        const listAsetID = "aset_list";
        const listPerubatanSejarahID = "perubatan_sejarah_list";
        const listPerubatanDoktorID = "perubatan_doktor_list";
        const listPerubatanInsuransID = "perubatan_insurans_list";
        const listPerubatanDonatorID = "perubatan_donator_list";
        const listKewanganAkaunID = "kewangan_akaun_list";
        const listKewanganElaunID = "kewangan_elaun_list";
        const listKewanganInsentifID = "kewangan_insentif_list";
        const listPembangunanKursuskemID = "pembangunan_kursuskem_list";
        const listPembangunanKaunselingID = "pembangunan_kaunseling_list";
        const listPembangunanKemahiranID = "pembangunan_kemahiran_list";
        const listSukanID = "sukan_list";
        const listSukanPersatuanpersekutuanduniaID = "sukan_persatuanpersekutuandunia_list";
        const listPakaianSukanID = "pakaian_sukan_list";
        const listPeralatanSukanID = "peralatan_sukan_list";
        const listPencapaianID = "pencapaian_list";
        const listPencapaianAnugerahID = "pencapaian_anugerah_list";
        const listPenajaanID = "penajaan_list";
        const listOKUID = "OKU_list";
        const listKeluargaID = "keluarga_list";
        
        // Atlet Form IDs
        const formAtletPendidikanID = "atlet_pendidikan_form";
        const formAtletKarrierID = "atlet_karrier_form";
        const formAtletAsetID = "atlet_aset_form";
        const formAtletPerubatanID = "atlet_perubatan_form";
        const formAtletPerubatanSejarahID = "atlet_perubatan_sejarah_form";
        const formAtletPerubatanDoktorID = "atlet_perubatan_doktor_form";
        const formAtletPerubatanInsuransID = "atlet_perubatan_insurans_form";
        const formAtletPerubatanDonatorID = "atlet_perubatan_donator_form";
        const formAtletKewanganAkaunID = "atlet_kewangan_akaun_form";
        const formAtletKewanganElaunID = "atlet_kewangan_elaun_form";
        const formAtletKewanganInsentifID = "atlet_kewangan_insentif_form";
        const formAtletPembangunanKursuskemID = "atlet_pembangunan_kursuskem_form";
        const formAtletPembangunanKaunselingID = "atlet_pembangunan_kaunseling_form";
        const formAtletPembangunanKemahiranID = "atlet_pembangunan_kemahiran_form";
        const formAtletSukanID = "atlet_sukan_form";
        const formAtletSukanPersatuanpersekutuanduniaID = "atlet_sukan_persatuanpersekutuandunia_form";
        const formAtletPakaianSukanID = "atlet_pakaian_sukan_form";
        const formAtletPeralatanSukanID = "atlet_peralatan_sukan_form";
        const formAtletPencapaianID = "atlet_pencapaian_form";
        const formAtletPencapaianAnugerahID = "atlet_pencapaian_anugerah_form";
        const formAtletPenajaanID = "atlet_penajaan_form";
        const formAtletOKUID = "atlet_OKU_form";
        const formAtletKeluargaID = "atlet_keluarga_form";
        
        
        // Jurulatih Tab Content IDs
        const tabKelayakanID = "kelayakan_tab";
        const tabPengalamanID = "pengalaman_tab";
        const tabPendidikanJurulatihID = "pendidikan_jurulatih_tab";
        const tabKelayakanKursusTertinggiID = "kelayakan_kursus_tertinggi_tab";
        const tabKesihatanID = "kesihatan_tab";
        const tabKeluargaJurulatihID = "keluarga_jurulatih_tab";
        const tabJurulatihAtletID = "jurulatih_atlet_tab";
        const tabJurulatihPenilaianID = "jurulatih_penilaian_tab";
        const tabSukanJurulatihID = "sukan_jurulatih_tab";
        
        // Jurulatih List Content IDs
        const listKelayakanID = "kelayakan_list";
        const listPengalamanID = "pengalaman_list";
        const listPendidikanJurulatihID = "pendidikan_jurulatih_list";
        const listKelayakanKursusTertinggiID = "kelayakan_kursus_tertinggi_list";
        const listKesihatanID = "kesihatan_list";
        const listKeluargaJurulatihID = "keluarga_jurulatih_list";
        const listSukanJurulatihID = "sukan_jurulatih_list";
        
        // Jurulatih Form IDs
        const formJurulatihKelayakanID = "jurulatih_kelayakan_form";
        const formJurulatihPengalamanID = "jurulatih_pengalaman_form";
        const formJurulatihPendidikanID = "jurulatih_pendidikan_form";
        const formJurulatihKelayakanKursusTertinggiID = "jurulatih_kelayakan_kursus_tertinggi_form";
        const formJurulatihKesihatanID = "jurulatih_kesihatan_form";
        const formJurulatihKeluargaID = "jurulatih_keluarga_form";
        const formJurulatihSukanID = "jurulatih_sukan_form";
        
        // Jurulatih tab mutiple entry model ids
        const jurulatihSukanTabModalTitle = "modalTitleJurulatihSukanAcara";
        const jurulatihSukanTabModal = "modalJurulatihSukanAcara";
        const jurulatihSukanTabModalContent = "modalContentJurulatihSukanAcara";
        const jurulatihKesihatanTabModalTitle = "modalTitleJurulatihKesihatanMasalah";
        const jurulatihKesihatanTabModal = "modalJurulatihKesihatanMasalah";
        const jurulatihKesihatanTabModalContent = "modalContentJurulatihKesihatanMasalah";
        
        //System Display Date Format 
        const displayDateFormat = "dd-mm-yyyy";
        
        //System Save Date Format 
        const saveDateTimeFormat = "Y-m-d H:i:s";
        const saveDateFormat = "Y-m-d";
        
        //Year Validation Rule
        const yearMin = 1900;
        const yearMax = 2020;
        
        //User - From Module
        const moduleMSNAduanPenyelia= "MSN_Aduan-Penyelia";
        const moduleMSNUsptnPpn= "MSN_USPTN-PPN";
        const modulePJSPersatuan = "PJS Persatuan";
        const moduleKBSeBiasiswa = "KBS_e-Biasiswa";
        const moduleKBSeBantuan= "KBS_e-Bantuan";
        
        //Login page path
        const loginPagePath = "site/login";
        
        //System Profile ID
        const systemProfileID = 1;
    }
}

if($session->get('language') == "EN") {

    class GeneralVariable{
        // Atlet Tab Content IDs
        const tabPendidikanID = "pendidikan_tab";
        const tabKarrierID = "karrier_tab";
        const tabAsetID = "aset_tab";
        const tabPerubatanID = "perubatan_tab";
        const tabPerubatanSejarahID = "perubatan_sejarah_tab";
        const tabPerubatanDoktorID = "perubatan_doktor_tab";
        const tabPerubatanInsuransID = "perubatan_insurans_tab";
        const tabPerubatanDonatorID = "perubatan_donator_tab";
        const tabPerubatanRekodsID = "perubatan_rekods_tab";
        const tabKewanganAkaunID = "kewangan_akaun_tab";
        const tabKewanganBiasiswaID  = "kewangan_biasiswa_tab";
        const tabKewanganElaunID = "kewangan_elaun_tab";
        const tabKewanganInsentifID = "kewangan_insentif_tab";
        const tabPembangunanKursuskemID = "pembangunan_kursuskem_tab";
        const tabPembangunanKaunselingID = "pembangunan_kaunseling_tab";
        const tabPembangunanKemahiranID = "pembangunan_kemahiran_tab";
        const tabSukanID = "sukan_tab";
        const tabSukanPersatuanpersekutuanduniaID = "sukan_persatuanpersekutuandunia_tab";
        const tabPakaianSukanID = "pakaian_sukan_tab";
        const tabPeralatanSukanID = "peralatan_sukan_tab";
        const tabPencapaianID = "pencapaian_tab";
        const tabPencapaianAnugerahID = "pencapaian_anugerah_tab";
        const tabPenajaanID = "penajaan_tab";
        const tabOKUID = "OKU_tab";
        const tabKeluargaID = "keluarga_tab";
        
        // Atlet List Content IDs
        const listPendidikanID = "pendidikan_list";
        const listKarrierID = "karrier_list";
        const listAsetID = "aset_list";
        const listPerubatanSejarahID = "perubatan_sejarah_list";
        const listPerubatanDoktorID = "perubatan_doktor_list";
        const listPerubatanInsuransID = "perubatan_insurans_list";
        const listPerubatanDonatorID = "perubatan_donator_list";
        const listKewanganAkaunID = "kewangan_akaun_list";
        const listKewanganElaunID = "kewangan_elaun_list";
        const listKewanganInsentifID = "kewangan_insentif_list";
        const listPembangunanKursuskemID = "pembangunan_kursuskem_list";
        const listPembangunanKaunselingID = "pembangunan_kaunseling_list";
        const listPembangunanKemahiranID = "pembangunan_kemahiran_list";
        const listSukanID = "sukan_list";
        const listSukanPersatuanpersekutuanduniaID = "sukan_persatuanpersekutuandunia_list";
        const listPakaianSukanID = "pakaian_sukan_list";
        const listPeralatanSukanID = "peralatan_sukan_list";
        const listPencapaianID = "pencapaian_list";
        const listPencapaianAnugerahID = "pencapaian_anugerah_list";
        const listPenajaanID = "penajaan_list";
        const listOKUID = "OKU_list";
        const listKeluargaID = "keluarga_list";
        
        // Atlet Form IDs
        const formAtletPendidikanID = "atlet_pendidikan_form";
        const formAtletKarrierID = "atlet_karrier_form";
        const formAtletAsetID = "atlet_aset_form";
        const formAtletPerubatanID = "atlet_perubatan_form";
        const formAtletPerubatanSejarahID = "atlet_perubatan_sejarah_form";
        const formAtletPerubatanDoktorID = "atlet_perubatan_doktor_form";
        const formAtletPerubatanInsuransID = "atlet_perubatan_insurans_form";
        const formAtletPerubatanDonatorID = "atlet_perubatan_donator_form";
        const formAtletKewanganAkaunID = "atlet_kewangan_akaun_form";
        const formAtletKewanganElaunID = "atlet_kewangan_elaun_form";
        const formAtletKewanganInsentifID = "atlet_kewangan_insentif_form";
        const formAtletPembangunanKursuskemID = "atlet_pembangunan_kursuskem_form";
        const formAtletPembangunanKaunselingID = "atlet_pembangunan_kaunseling_form";
        const formAtletPembangunanKemahiranID = "atlet_pembangunan_kemahiran_form";
        const formAtletSukanID = "atlet_sukan_form";
        const formAtletSukanPersatuanpersekutuanduniaID = "atlet_sukan_persatuanpersekutuandunia_form";
        const formAtletPakaianSukanID = "atlet_pakaian_sukan_form";
        const formAtletPeralatanSukanID = "atlet_peralatan_sukan_form";
        const formAtletPencapaianID = "atlet_pencapaian_form";
        const formAtletPencapaianAnugerahID = "atlet_pencapaian_anugerah_form";
        const formAtletPenajaanID = "atlet_penajaan_form";
        const formAtletOKUID = "atlet_OKU_form";
        const formAtletKeluargaID = "atlet_keluarga_form";
        
        
        // Jurulatih Tab Content IDs
        const tabKelayakanID = "kelayakan_tab";
        const tabPengalamanID = "pengalaman_tab";
        const tabPendidikanJurulatihID = "pendidikan_jurulatih_tab";
        const tabKelayakanKursusTertinggiID = "kelayakan_kursus_tertinggi_tab";
        const tabKesihatanID = "kesihatan_tab";
        const tabKeluargaJurulatihID = "keluarga_jurulatih_tab";
        const tabJurulatihAtletID = "jurulatih_atlet_tab";
        const tabJurulatihPenilaianID = "jurulatih_penilaian_tab";
        const tabSukanJurulatihID = "sukan_jurulatih_tab";
        
        // Jurulatih List Content IDs
        const listKelayakanID = "kelayakan_list";
        const listPengalamanID = "pengalaman_list";
        const listPendidikanJurulatihID = "pendidikan_jurulatih_list";
        const listKelayakanKursusTertinggiID = "kelayakan_kursus_tertinggi_list";
        const listKesihatanID = "kesihatan_list";
        const listKeluargaJurulatihID = "keluarga_jurulatih_list";
        const listSukanJurulatihID = "sukan_jurulatih_list";
        
        // Jurulatih Form IDs
        const formJurulatihKelayakanID = "jurulatih_kelayakan_form";
        const formJurulatihPengalamanID = "jurulatih_pengalaman_form";
        const formJurulatihPendidikanID = "jurulatih_pendidikan_form";
        const formJurulatihKelayakanKursusTertinggiID = "jurulatih_kelayakan_kursus_tertinggi_form";
        const formJurulatihKesihatanID = "jurulatih_kesihatan_form";
        const formJurulatihKeluargaID = "jurulatih_keluarga_form";
        const formJurulatihSukanID = "jurulatih_sukan_form";
        
        // Jurulatih tab mutiple entry model ids
        const jurulatihSukanTabModalTitle = "modalTitleJurulatihSukanAcara";
        const jurulatihSukanTabModal = "modalJurulatihSukanAcara";
        const jurulatihSukanTabModalContent = "modalContentJurulatihSukanAcara";
        const jurulatihKesihatanTabModalTitle = "modalTitleJurulatihKesihatanMasalah";
        const jurulatihKesihatanTabModal = "modalJurulatihKesihatanMasalah";
        const jurulatihKesihatanTabModalContent = "modalContentJurulatihKesihatanMasalah";
        
        //System Display Date Format 
        const displayDateFormat = "dd-mm-yyyy";
        
        //System Save Date Format 
        const saveDateTimeFormat = "Y-m-d H:i:s";
        const saveDateFormat = "Y-m-d";
        
        //Year Validation Rule
        const yearMin = 1900;
        const yearMax = 2020;
        
        //User - From Module
        const moduleMSNAduanPenyelia= "MSN Aduan Penyelia";
        const moduleMSNUsptnPpn= "MSN_USPTN-PPN";
        const modulePJSPersatuan = "PJS Persatuan";
        const moduleKBSeBiasiswa = "KBS_e-Biasiswa";
        const moduleKBSeBantuan= "KBS_e-Bantuan";
        
        //Login page path
        const loginPagePath = "site/login";
        
        //System Profile ID
        const systemProfileID = 1;
    }

}