<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_soalan_penilaian_pendidikan_penganjur".
 *
 * @property integer $pengurusan_soalan_penilaian_pendidikan_penganjur_id
 * @property integer $pengurusan_penilaian_pendidikan_penganjur_intructor_id
 * @property string $soalan
 * @property integer $rating
 */
class PengurusanSoalanPenilaianPendidikanPenganjur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_soalan_penilaian_pendidikan_penganjur';
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
            [['soalan', 'rating'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_penilaian_pendidikan_penganjur_intructor_id', 'rating'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['soalan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['soalan'], function ($attribute, $params) {
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
            'pengurusan_soalan_penilaian_pendidikan_penganjur_id' => GeneralLabel::pengurusan_soalan_penilaian_pendidikan_penganjur_id,
            'pengurusan_penilaian_pendidikan_penganjur_intructor_id' => GeneralLabel::pengurusan_penilaian_pendidikan_penganjur_intructor_id,
            'soalan' => GeneralLabel::soalan,
            'rating' => GeneralLabel::skala,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSoalanPenilaianPendidikanPenganjurInstructor(){
        return $this->hasOne(RefSoalanPenilaianPendidikanPenganjurInstructor::className(), ['id' => 'soalan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRatingSoalan(){
        return $this->hasOne(RefRatingSoalan::className(), ['id' => 'rating']);
    }
}
