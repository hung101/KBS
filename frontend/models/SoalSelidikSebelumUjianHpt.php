<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_soal_selidik_sebelum_ujian".
 *
 * @property integer $soal_selidik_sebelum_ujian_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $soalan
 * @property string $jawapan
 */
class SoalSelidikSebelumUjianHpt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_soal_selidik_sebelum_ujian_hpt';
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
            [['atlet_id', 'tarikh', 'pemilihan_ujian', 'pegawai_bertanggungjawab'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['soalan', 'pemilihan_ujian', 'pegawai_bertanggungjawab'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jawapan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['soalan', 'pemilihan_ujian', 'pegawai_bertanggungjawab','jawapan','catatan'], function ($attribute, $params) {
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
            'soal_selidik_sebelum_ujian_id' => GeneralLabel::soal_selidik_sebelum_ujian_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tarikh' => GeneralLabel::tarikh,
            'pemilihan_ujian' => GeneralLabel::pemilihan_ujian,
            'pegawai_bertanggungjawab' => GeneralLabel::pegawai_bertanggungjawab,
            'catatan' => GeneralLabel::catatan,
            'soalan' => GeneralLabel::soalan,
            'jawapan' => GeneralLabel::jawapan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSoalanSoalSelidik(){
        return $this->hasOne(RefSoalanSoalSelidik::className(), ['id' => 'soalan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawapanSoalSelidik(){
        return $this->hasOne(RefJawapanSoalSelidik::className(), ['id' => 'jawapan']);
    }
}
