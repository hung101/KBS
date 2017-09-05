<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_jenis_kebajikan".
 *
 * @property integer $jenis_kebajikan_id
 * @property string $jenis_kebajikan
 * @property string $perkara
 * @property string $sukan_sea_para_asean
 * @property string $sukan_asia_komenwel_para_asia_ead
 * @property string $sukan_olimpik_paralimpik
 * @property string $kejohanan_asia_dunia
 */
class JenisKebajikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jenis_kebajikan';
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
            [['jenis_kebajikan', 'perkara', 'sukan_sea_para_asean', 'sukan_asia_komenwel_para_asia_ead', 'sukan_olimpik_paralimpik',
                'kejohanan_asia_dunia', 'sukan', 'jumlah', 'maksimum', 'peratus'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['sukan_sea_para_asean', 'sukan_asia_komenwel_para_asia_ead', 'sukan_olimpik_paralimpik', 'kejohanan_asia_dunia', 'jumlah'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['jenis_kebajikan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['perkara'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_kebajikan','perkara'], function ($attribute, $params) {
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
            'jenis_kebajikan_id' => GeneralLabel::jenis_kebajikan_id,
            'jenis_kebajikan' => GeneralLabel::jenis_kebajikan,
            'perkara' => GeneralLabel::perkara,
            'sukan_sea_para_asean' => GeneralLabel::sukan_sea_para_asean,
            'sukan_asia_komenwel_para_asia_ead' => GeneralLabel::sukan_asia_komenwel_para_asia_ead,
            'sukan_olimpik_paralimpik' => GeneralLabel::sukan_olimpik_paralimpik,
            'kejohanan_asia_dunia' => GeneralLabel::kejohanan_asia_dunia,
            'sukan' => GeneralLabel::sukan,
            'jumlah' => GeneralLabel::jumlah,
            'maksimum' => GeneralLabel::maksimum,
            'peratus' => GeneralLabel::peratus_daripada_kos_perubatan,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKebajikan(){
        return $this->hasOne(RefJenisKebajikan::className(), ['id' => 'jenis_kebajikan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPerkara(){
        return $this->hasOne(RefPerkara::className(), ['id' => 'perkara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukanSkimKebajikan(){
        return $this->hasOne(RefSukanSkimKebajikan::className(), ['id' => 'sukan']);
    }
}
