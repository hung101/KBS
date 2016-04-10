<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_penjamin".
 *
 * @property integer $bsp_penjamin_id
 * @property integer $bsp_pemohon_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $alamat_tetap_1
 * @property string $alamat_tetap_2
 * @property string $alamat_tetap_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $alamat_surat_menyurat_1
 * @property string $alamat_surat_menyurat_2
 * @property string $alamat_surat_menyurat_3
 * @property string $alamat_surat_menyurat_negeri
 * @property string $alamat_surat_menyurat_bandar
 * @property string $alamat_surat_menyurat_poskod
 * @property string $no_telefon_rumah
 * @property string $no_telefon_pejabat
 * @property string $no_telefon_bimbit
 * @property string $email
 * @property string $alamat_pejabat_1
 * @property string $alamat_pejabat_2
 * @property string $alamat_pejabat_3
 * @property string $alamat_pejabat_negeri
 * @property string $alamat_pejabat_bandar
 * @property string $alamat_pejabat_poskod
 */
class BspPenjamin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_penjamin';
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
            [['nama', 'no_kad_pengenalan', 'alamat_tetap_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod',
                'alamat_surat_menyurat_1', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'no_telefon_bimbit'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_pemohon_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_tetap_1', 'alamat_tetap_2', 'alamat_tetap_3', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_pejabat_1', 'alamat_pejabat_2', 'alamat_pejabat_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri', 'alamat_surat_menyurat_negeri', 'alamat_pejabat_negeri'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_surat_menyurat_bandar', 'alamat_pejabat_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod', 'alamat_surat_menyurat_poskod', 'alamat_pejabat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon_rumah', 'no_telefon_pejabat', 'no_telefon_bimbit'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['email'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_penjamin_id' => GeneralLabel::bsp_penjamin_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'nama' => GeneralLabel::nama,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'alamat_tetap_1' => GeneralLabel::alamat_tetap_1,
            'alamat_tetap_2' => GeneralLabel::alamat_tetap_2,
            'alamat_tetap_3' => GeneralLabel::alamat_tetap_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'alamat_surat_menyurat_1' => GeneralLabel::alamat_surat_menyurat_1,
            'alamat_surat_menyurat_2' => GeneralLabel::alamat_surat_menyurat_2,
            'alamat_surat_menyurat_3' => GeneralLabel::alamat_surat_menyurat_3,
            'alamat_surat_menyurat_negeri' => GeneralLabel::alamat_surat_menyurat_negeri,
            'alamat_surat_menyurat_bandar' => GeneralLabel::alamat_surat_menyurat_bandar,
            'alamat_surat_menyurat_poskod' => GeneralLabel::alamat_surat_menyurat_poskod,
            'no_telefon_rumah' => GeneralLabel::no_telefon_rumah,
            'no_telefon_pejabat' => GeneralLabel::no_telefon_pejabat,
            'no_telefon_bimbit' => GeneralLabel::no_telefon_bimbit,
            'email' => GeneralLabel::email,
            'alamat_pejabat_1' => GeneralLabel::alamat_pejabat_1,
            'alamat_pejabat_2' => GeneralLabel::alamat_pejabat_2,
            'alamat_pejabat_3' => GeneralLabel::alamat_pejabat_3,
            'alamat_pejabat_negeri' => GeneralLabel::alamat_pejabat_negeri,
            'alamat_pejabat_bandar' => GeneralLabel::alamat_pejabat_bandar,
            'alamat_pejabat_poskod' => GeneralLabel::alamat_pejabat_poskod,

        ];
    }
}
