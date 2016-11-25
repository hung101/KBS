<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_informasi_persatuan".
 *
 * @property integer $informasi_persatuan_id
 * @property string $nama_persatuan
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel
 * @property string $no_faks
 * @property string $emel
 * @property string $laman_web
 */
class InformasiPersatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_informasi_persatuan';
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
            [['nama_persatuan', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel', 'no_faks'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['nama_persatuan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_tel', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel', 'laman_web'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'informasi_persatuan_id' => GeneralLabel::informasi_persatuan_id,
            'nama_persatuan' => GeneralLabel::nama_persatuan,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel' => GeneralLabel::no_tel,
            'no_faks' => GeneralLabel::no_faks,
            'emel' => GeneralLabel::emel,
            'laman_web' => GeneralLabel::laman_web,

        ];
    }
}
