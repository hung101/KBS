<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pembayaran_elaun".
 *
 * @property integer $pembayaran_elaun_id
 * @property string $jenis_atlet
 * @property integer $atlet_id
 * @property string $kategori_elaun
 * @property string $tempoh_elaun
 * @property string $sebab_elaun
 * @property string $jumlah_elaun
 * @property integer $kelulusan
 */
class PembayaranElaun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pembayaran_elaun';
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
            [[ 'atlet_id', 'kategori_elaun', 'tempoh_elaun', 'tarikh_mula', 'tarikh_tamat', 'jumlah_elaun', 'status_elaun', 'kelulusan', 'sukan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'kelulusan', 'sukan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_elaun'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kategori_elaun'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jumlah_elaun'], 'string', 'max' => 10, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempoh_elaun'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sebab_elaun'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pembayaran_elaun_id' => GeneralLabel::pembayaran_elaun_id,
            'jenis_atlet' => GeneralLabel::jenis_atlet,
            'atlet_id' => GeneralLabel::atlet_id,
            'kategori_elaun' => GeneralLabel::kategori_elaun,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'tempoh_elaun' => GeneralLabel::tempoh_elaun,
            'sebab_elaun' => GeneralLabel::sebab_elaun,
            'status_elaun' => GeneralLabel::status_pembayaran_elaun,
            'jumlah_elaun' => GeneralLabel::jumlah_elaun,
            'kelulusan' => GeneralLabel::kelulusan,
            'sukan' => GeneralLabel::sukan,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriElaun(){
        return $this->hasOne(RefKategoriElaun::className(), ['id' => 'kategori_elaun']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusElaun(){
        return $this->hasOne(RefStatusElaun::className(), ['id' => 'status_elaun']);
    }
}
