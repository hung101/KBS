<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kemudahan_peralatan_sedia_ada".
 *
 * @property integer $pengurusan_kemudahan_peralatan_sedia_ada_id
 * @property integer $pengurusan_kemudahan_venue_id
 * @property string $nama_peralatan
 * @property integer $kuantiti
 */
class PengurusanKemudahanPeralatanSediaAda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kemudahan_peralatan_sedia_ada';
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
            [['pengurusan_kemudahan_venue_id', 'nama_peralatan', 'kuantiti'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_kemudahan_venue_id', 'kuantiti', 'jenama'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_peralatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_peralatan'], function ($attribute, $params) {
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
            'pengurusan_kemudahan_peralatan_sedia_ada_id' => GeneralLabel::pengurusan_kemudahan_peralatan_sedia_ada_id,
            'pengurusan_kemudahan_venue_id' => GeneralLabel::pengurusan_kemudahan_venue_id,
            'nama_kemudahan' => GeneralLabel::nama_kemudahan,
            'jenama' => GeneralLabel::jenama,
            'nama_peralatan' => GeneralLabel::nama_peralatan,
            'kuantiti' => GeneralLabel::kuantiti,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeralatanKemudahan(){
        return $this->hasOne(RefPeralatanKemudahan::className(), ['id' => 'nama_peralatan']);
    }
}
