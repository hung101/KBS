<?php
namespace app\models;

use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * Password reset request form
 */
class JurulatihPrintForm extends Model
{
    public $maklumat_diri;
    public $maklumat_pelantikan;
    public $maklumat_sukan_dan_program;
    public $maklumat_acara;
    public $maklumat_atlet;
    public $maklumat_kesihatan;
    public $maklumat_keluarga_jika_berlaku_kecemasan;
    public $maklumat_pendidikan;
    public $maklumat_majikan;
    public $maklumat_pengalaman_penglibatan_sukan_dan_kejurulatihan;
    public $maklumat_skim_pensijilan_kejurulatihan_kebangsaan;
    public $maklumat_kelayakan_kursus_tertinggi_spesifik;
    public $maklumat_penilaian_ketua_jurulatih;
    public $maklumat_penilaian;
    public $maklumat_tawaran;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maklumat_diri', 'maklumat_pelantikan','maklumat_sukan_dan_program','maklumat_acara','maklumat_atlet','maklumat_kesihatan',
                'maklumat_keluarga_jika_berlaku_kecemasan', 'maklumat_pendidikan','maklumat_majikan','maklumat_pengalaman_penglibatan_sukan_dan_kejurulatihan',
                'maklumat_skim_pensijilan_kejurulatihan_kebangsaan','maklumat_kelayakan_kursus_tertinggi_spesifik','maklumat_penilaian_ketua_jurulatih',
                'maklumat_penilaian','maklumat_tawaran'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'maklumat_diri' => GeneralLabel::maklumat_diri, 
            'maklumat_pelantikan' => GeneralLabel::maklumat_pelantikan,
            'maklumat_sukan_dan_program' => GeneralLabel::maklumat_sukan_dan_program,
            'maklumat_acara' => GeneralLabel::maklumat_acara,
            'maklumat_atlet' => GeneralLabel::maklumat_atlet,
            'maklumat_kesihatan' => GeneralLabel::maklumat_kesihatan,
            'maklumat_keluarga_jika_berlaku_kecemasan' => GeneralLabel::maklumat_keluarga_jika_berlaku_kecemasan, 
            'maklumat_pendidikan' => GeneralLabel::maklumat_pendidikan,
            'maklumat_majikan' => GeneralLabel::maklumat_majikan,
            'maklumat_pengalaman_penglibatan_sukan_dan_kejurulatihan' => GeneralLabel::maklumat_pengalaman_penglibatan_sukan_dan_kejurulatihan,
            'maklumat_skim_pensijilan_kejurulatihan_kebangsaan' => GeneralLabel::maklumat_skim_pensijilan_kejurulatihan_kebangsaan,
            'maklumat_kelayakan_kursus_tertinggi_spesifik' => GeneralLabel::maklumat_kelayakan_kursus_tertinggi_spesifik,
            'maklumat_penilaian_ketua_jurulatih' => GeneralLabel::maklumat_penilaian_ketua_jurulatih,
            'maklumat_penilaian' => GeneralLabel::maklumat_penilaian,
            'maklumat_tawaran' => GeneralLabel::maklumat_tawaran,
        ];
    }
}
