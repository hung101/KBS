<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pemberian_suplemen_makanan_jus_rundingan_pendidikan".
 *
 * @property integer $pemberian_suplemen_makanan_jus_rundingan_pendidikan_id
 * @property integer $perkhidmatan_permakanan_id
 * @property string $nama_suplemen_makanan_jus_rundingan_pendidikan
 * @property integer $kuantiti_ml_g
 * @property string $harga
 */
class PemberianSuplemenMakananJusRundinganPendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pemberian_suplemen_makanan_jus_rundingan_pendidikan';
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
            [['atlet', 'nama_suplemen_makanan_jus_rundingan_pendidikan', 'kuantiti_ml_g'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['perkhidmatan_permakanan_id', 'kuantiti_ml_g', 'kategori_atlet', 'acara', 'sukan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_suplemen_makanan_jus_rundingan_pendidikan'], 'safe'],
            [['harga'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['nama_suplemen_makanan_jus_rundingan_pendidikan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pemberian_suplemen_makanan_jus_rundingan_pendidikan_id' => GeneralLabel::pemberian_suplemen_makanan_jus_rundingan_pendidikan_id,
            'perkhidmatan_permakanan_id' => GeneralLabel::perkhidmatan_permakanan_id,
            'kategori_atlet' => GeneralLabel::kategori_atlet,
            'sukan' => GeneralLabel::sukan,
            'acara' => GeneralLabel::acara,
            'atlet' => GeneralLabel::atlet,
            'nama_suplemen_makanan_jus_rundingan_pendidikan' => GeneralLabel::nama_suplemen_makanan_jus_rundingan_pendidikan,
            'kuantiti_ml_g' => GeneralLabel::kuantiti,
            'harga' => GeneralLabel::harga,

        ];
    }
}
