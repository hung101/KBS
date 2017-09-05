<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_anjuran".
 *
 * @property integer $pengurusan_anjuran_id
 * @property string $nama_program_anjuran
 * @property string $tarikh_program_anjuran
 * @property string $nama_badan_sukan_antarabangsa
 * @property string $nama_delegasi
 * @property string $negara
 */
class PengurusanAnjuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_anjuran';
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
            [['nama_program_anjuran', 'tarikh_program_anjuran', 'nama_badan_sukan_antarabangsa', 'nama_delegasi', 'negara'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_program_anjuran'], 'safe'],
            [['nama_program_anjuran', 'nama_badan_sukan_antarabangsa', 'nama_delegasi'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['negara'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_program_anjuran', 'nama_badan_sukan_antarabangsa', 'nama_delegasi','negara'], function ($attribute, $params) {
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
            'pengurusan_anjuran_id' => GeneralLabel::pengurusan_anjuran_id,
            'nama_program_anjuran' => GeneralLabel::nama_program_anjuran,
            'tarikh_program_anjuran' => GeneralLabel::tarikh_program_anjuran,
            'nama_badan_sukan_antarabangsa' => GeneralLabel::nama_organisasi,
            'nama_delegasi' => GeneralLabel::nama_delegasi,
            'negara' => GeneralLabel::negara,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBadanSukanAntarabangsa(){
        return $this->hasOne(RefBadanSukanAntarabangsa::className(), ['id' => 'nama_badan_sukan_antarabangsa']);
    }
}
