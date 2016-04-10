<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_farmasi_pengurusan_stok".
 *
 * @property integer $farmasi_pengurusan_stok
 * @property string $nama_ubat
 * @property string $dos
 * @property string $harga
 * @property integer $kuantiti
 * @property string $jumlah_harga
 */
class FarmasiPengurusanStok extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_farmasi_pengurusan_stok';
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
            [['nama_ubat', 'dos', 'harga', 'kuantiti', 'jumlah_harga'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['harga', 'jumlah_harga'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kuantiti'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_ubat'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['dos'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'farmasi_pengurusan_stok' => GeneralLabel::farmasi_pengurusan_stok,
            'nama_ubat' => GeneralLabel::nama_ubat,
            'dos' => GeneralLabel::dos,
            'harga' => GeneralLabel::harga,
            'kuantiti' => GeneralLabel::kuantiti,
            'jumlah_harga' => GeneralLabel::jumlah_harga,

        ];
    }
}
