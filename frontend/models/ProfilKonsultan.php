<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_profil_konsultan".
 *
 * @property integer $profil_konsultan_id
 * @property string $nama_konsultan
 * @property string $ic_no
 * @property string $emel
 * @property string $no_bimbit
 * @property string $bidang_konsultansi
 */
class ProfilKonsultan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_konsultan';
    }
    
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_konsultan', 'ic_no', 'no_bimbit', 'umur', 'kategori_agensi', 'agensi', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod',
                'no_tel_pejabat', 'no_kaunselor_berdaftar', 'tarikh', 'status_permohonan', 'emel'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['nama_konsultan', 'bidang_konsultansi', 'lain_lain'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ic_no'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kepakaran_pengalaman'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_bimbit'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_konsultan_id' => GeneralLabel::profil_konsultan_id,
            'nama_konsultan' => GeneralLabel::nama_konsultan,
            'ic_no' => GeneralLabel::ic_no,
            'emel' => GeneralLabel::emel,
            'no_bimbit' => GeneralLabel::no_bimbit,
            'bidang_konsultansi' => GeneralLabel::bidang_konsultansi,
            'kepakaran_pengalaman' => GeneralLabel::kepakaran_pengalaman,
            'umur' => GeneralLabel::umur,
            'kategori_agensi' => GeneralLabel::kategori_agensi,
            'agensi' => GeneralLabel::agensi,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel_pejabat' => GeneralLabel::no_tel_pejabat,
            'no_kaunselor_berdaftar' => GeneralLabel::no_kaunselor_berdaftar,
            'lain_lain' => GeneralLabel::lain_lain,
            'tarikh' => GeneralLabel::tarikh,
            'status_permohonan' => GeneralLabel::status_permohonan,
        ];
    }
}
