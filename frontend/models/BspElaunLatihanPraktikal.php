<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_elaun_latihan_praktikal".
 *
 * @property integer $bsp_elaun_latihan_praktikal_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $jenis_latihan_amali
 * @property string $tempat_latihan_praktikal
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property integer $jumlah_hari
 */
class BspElaunLatihanPraktikal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_elaun_latihan_praktikal';
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
            [['tarikh', 'jenis_latihan_amali', 'tempat_latihan_praktikal', 'tarikh_mula', 'tarikh_tamat', 'jumlah_hari'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_pemohon_id', 'jumlah_hari'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh', 'tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['jenis_latihan_amali'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_latihan_praktikal'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_latihan_praktikal','jenis_latihan_amali'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_elaun_latihan_praktikal_id' => GeneralLabel::bsp_elaun_latihan_praktikal_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'tarikh' => GeneralLabel::tarikh,
            'jenis_latihan_amali' => GeneralLabel::jenis_latihan_amali,
            'tempat_latihan_praktikal' => GeneralLabel::tempat_latihan_praktikal,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'jumlah_hari' => GeneralLabel::jumlah_hari,
            'muat_naik' => GeneralLabel::muat_naik,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisLatihanAmali(){
        return $this->hasOne(RefJenisLatihanAmali::className(), ['id' => 'jenis_latihan_amali']);
    }
}
