<?php

namespace app\models;

use Yii;

use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan_senarai_aktiviti_projek".
 *
 * @property integer $senarai_aktiviti_projek_id
 * @property integer $permohonan_e_bantuan_id
 * @property string $nama_aktiviti_projek
 * @property string $keterangan_ringkas
 * @property string $kejayaan_yang_dicapai
 */
class PermohonanEBantuanSenaraiAktivitiProjek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan_senarai_aktiviti_projek';
    }
    
    public function behaviors()
    {
        return [
            //'bedezign\yii2\audit\AuditTrailBehavior',
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
            [['permohonan_e_bantuan_id', 'nama_aktiviti_projek', 'keterangan_ringkas'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['permohonan_e_bantuan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_aktiviti_projek'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['keterangan_ringkas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kejayaan_yang_dicapai'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_aktiviti_projek_id' => 'Senarai Aktiviti Projek ID',
            'permohonan_e_bantuan_id' => 'Permohonan E Bantuan ID',
            'nama_aktiviti_projek' => 'Nama Aktiviti / Projek',
            'keterangan_ringkas' => 'Keterangan Ringkas',
            'kejayaan_yang_dicapai' => 'Kejayaan Yang Dicapai',
        ];
    }
}
