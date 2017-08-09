<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kemudahan_dan_peralatan".
 *
 * @property integer $pengurusan_kemudahan_dan_peralatan_id
 * @property string $kerja
 * @property string $masa
 * @property string $catatan_ringkas
 * @property string $tindakan_yang_diambil
 * @property string $hasil
 * @property string $ketidakpatuhan
 */
class PengurusanKemudahanDanPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kemudahan_dan_peralatan';
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
            [['kerja', 'masa'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['status'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['masa'], 'safe'],
            [['kerja'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan_ringkas', 'tindakan_yang_diambil', 'hasil', 'ketidakpatuhan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kerja','catatan_ringkas', 'tindakan_yang_diambil', 'hasil', 'ketidakpatuhan','masa'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kemudahan_dan_peralatan_id' => GeneralLabel::pengurusan_kemudahan_dan_peralatan_id,
            'kerja' => GeneralLabel::kerja,
            'masa' => GeneralLabel::masa,
            'catatan_ringkas' => GeneralLabel::catatan_ringkas,
            'tindakan_yang_diambil' => GeneralLabel::tindakan_yang_diambil,
            'hasil' => GeneralLabel::hasil,
            'ketidakpatuhan' => GeneralLabel::ketidakpatuhan,
            'status' => GeneralLabel::status,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKerjaPengurusanKemudahanPeralatan(){
        return $this->hasOne(RefKerjaPengurusanKemudahanPeralatan::className(), ['id' => 'kerja']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPengurusanKemudahan(){
        return $this->hasOne(RefStatusPengurusanKemudahan::className(), ['id' => 'status']);
    }
}
