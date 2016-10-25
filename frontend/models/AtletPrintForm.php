<?php
namespace app\models;

use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * Password reset request form
 */
class AtletPrintForm extends Model
{
    public $maklumat_diri;
    public $maklumat_perhubungan_kecemasan;
    public $maklumat_sukan_dan_program;
    public $maklumat_acara;
    public $maklumat_sejarah_sukan_dan_program;
    public $maklumat_sejarah_acara;
    public $maklumat_sejarah_sukan;
    public $maklumat_kewangan;
    public $maklumat_sejarah_elaun_atlet;
    public $maklumat_keluarga;
    public $maklumat_pakaian;
    public $maklumat_peralatan_sukan;
    public $maklumat_pendidikan;
    public $maklumat_sekolah_institusi_semasa;
    public $maklumat_kerjaya_semasa;
    public $maklumat_sejarah_kerjaya;
    public $maklumat_kursus_kem_semasa;
    public $maklumat_sejarah_kursus_kem;
    public $maklumat_kaunseling;
    public $maklumat_sejarah_kaunseling;
    public $maklumat_kemahiran;
    public $maklumat_senarai_kemahiran;
    public $maklumat_perubatan;
    public $maklumat_insurans;
    public $maklumat_penderma;
    public $maklumat_perubatan_sains_sukan;
    public $maklumat_insentif;
    public $maklumat_sejarah_penerimaan_insentif;
    public $maklumat_penajaan;
    public $maklumat_sejarah_penajaan;
    public $maklumat_biasiswa;
    public $maklumat_persatuan_persekutuan_dunia;
    public $maklumat_anugerah;
    public $maklumat_pencapaian_sukan_semasa;
    public $maklumat_sejarah_pencapaian_sukan;
    public $maklumat_tawaran;
    public $maklumat_oku;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maklumat_diri', 'maklumat_perhubungan_kecemasan','maklumat_sukan_dan_program','maklumat_acara','maklumat_sejarah_sukan_dan_program','maklumat_sejarah_acara',
                'maklumat_sejarah_sukan', 'maklumat_kewangan','maklumat_sejarah_elaun_atlet','maklumat_keluarga','maklumat_pakaian','maklumat_peralatan_sukan','maklumat_pendidikan',
                'maklumat_sekolah_institusi_semasa','maklumat_kerjaya_semasa','maklumat_sejarah_kerjaya','maklumat_kursus_kem_semasa','maklumat_sejarah_kursus_kem','maklumat_kaunseling',
                'maklumat_sejarah_kaunseling','maklumat_kemahiran','maklumat_senarai_kemahiran','maklumat_perubatan','maklumat_insurans','maklumat_penderma','maklumat_perubatan_sains_sukan',
                'maklumat_insentif','maklumat_sejarah_penerimaan_insentif','maklumat_penajaan','maklumat_sejarah_penajaan','maklumat_biasiswa','maklumat_persatuan_persekutuan_dunia',
                'maklumat_anugerah','maklumat_pencapaian_sukan_semasa','maklumat_sejarah_pencapaian_sukan','maklumat_tawaran', 'maklumat_oku'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'maklumat_diri' => GeneralLabel::maklumat_diri, 
            'maklumat_perhubungan_kecemasan' => GeneralLabel::maklumat_perhubungan_kecemasan,
            'maklumat_sukan_dan_program' => GeneralLabel::maklumat_sukan_dan_program,
            'maklumat_acara' => GeneralLabel::maklumat_acara,
            'maklumat_sejarah_sukan_dan_program' => GeneralLabel::maklumat_sejarah_sukan_dan_program,
            'maklumat_sejarah_acara' => GeneralLabel::maklumat_sejarah_acara,
            'maklumat_sejarah_sukan' => GeneralLabel::maklumat_sejarah_sukan, 
            'maklumat_kewangan' => GeneralLabel::maklumat_kewangan,
            'maklumat_sejarah_elaun_atlet' => GeneralLabel::maklumat_sejarah_elaun_atlet,
            'maklumat_keluarga' => GeneralLabel::maklumat_keluarga_form,
            'maklumat_pakaian' => GeneralLabel::maklumat_pakaian,
            'maklumat_peralatan_sukan' => GeneralLabel::maklumat_peralatan_sukan,
            'maklumat_pendidikan' => GeneralLabel::maklumat_pendidikan,
            'maklumat_sekolah_institusi_semasa' => GeneralLabel::maklumat_sekolah_institusi_semasa,
            'maklumat_kerjaya_semasa' => GeneralLabel::maklumat_kerjaya_semasa,
            'maklumat_sejarah_kerjaya' => GeneralLabel::maklumat_sejarah_kerjaya,
            'maklumat_kursus_kem_semasa' => GeneralLabel::maklumat_kursus_kem_semasa,
            'maklumat_sejarah_kursus_kem' => GeneralLabel::maklumat_sejarah_kursus_kem,
            'maklumat_kaunseling' => GeneralLabel::maklumat_kaunseling,
            'maklumat_sejarah_kaunseling' => GeneralLabel::maklumat_sejarah_kaunseling,
            'maklumat_kemahiran' => GeneralLabel::maklumat_kemahiran,
            'maklumat_senarai_kemahiran' => GeneralLabel::maklumat_senarai_kemahiran,
            'maklumat_perubatan' => GeneralLabel::maklumat_perubatan,
            'maklumat_insurans' => GeneralLabel::maklumat_insurans,
            'maklumat_penderma' => GeneralLabel::maklumat_penderma,
            'maklumat_perubatan_sains_sukan' => GeneralLabel::maklumat_perubatan_sains_sukan,
            'maklumat_insentif' => GeneralLabel::maklumat_insentif,
            'maklumat_sejarah_penerimaan_insentif' => GeneralLabel::maklumat_sejarah_penerimaan_insentif,
            'maklumat_penajaan' => GeneralLabel::maklumat_penajaan,
            'maklumat_sejarah_penajaan' => GeneralLabel::maklumat_sejarah_penajaan,
            'maklumat_biasiswa' => GeneralLabel::maklumat_biasiswa,
            'maklumat_persatuan_persekutuan_dunia' => GeneralLabel::maklumat_persatuan_persekutuan_dunia,
            'maklumat_anugerah' => GeneralLabel::maklumat_anugerah,
            'maklumat_pencapaian_sukan_semasa' => GeneralLabel::maklumat_pencapaian_sukan_semasa,
            'maklumat_sejarah_pencapaian_sukan' => GeneralLabel::maklumat_sejarah_pencapaian_sukan,
            'maklumat_tawaran' => GeneralLabel::maklumat_tawaran,
            'maklumat_oku' => GeneralLabel::maklumat_oku,
        ];
    }
}
