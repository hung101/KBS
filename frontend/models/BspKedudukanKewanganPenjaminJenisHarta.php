<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_kedudukan_kewangan_penjamin_jenis_harta".
 *
 * @property integer $bsp_kedudukan_kewangan_penjamin_jenis_harta_id
 * @property integer $bsp_kedudukan_kewangan_penjamin_id
 * @property string $jenis_harta
 * @property integer $jumlah_ekar_kaki_persegi
 * @property string $nilai
 */
class BspKedudukanKewanganPenjaminJenisHarta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_kedudukan_kewangan_penjamin_jenis_harta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_harta', 'jumlah_ekar_kaki_persegi', 'nilai'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_kedudukan_kewangan_penjamin_id', 'jumlah_ekar_kaki_persegi'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nilai'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['jenis_harta'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
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
    public function attributeLabels()
    {
        return [
            'bsp_kedudukan_kewangan_penjamin_jenis_harta_id' => GeneralLabel::bsp_kedudukan_kewangan_penjamin_jenis_harta_id,
            'bsp_kedudukan_kewangan_penjamin_id' => GeneralLabel::bsp_kedudukan_kewangan_penjamin_id,
            'jenis_harta' => GeneralLabel::jenis_harta,
            'jumlah_ekar_kaki_persegi' => GeneralLabel::jumlah_ekar_kaki_persegi,
            'nilai' => GeneralLabel::nilai,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisHarta(){
        return $this->hasOne(RefJenisHarta::className(), ['id' => 'jenis_harta']);
    }
}
