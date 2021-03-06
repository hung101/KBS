<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_pencapaian_rekods".
 *
 * @property integer $pencapaian_rekods_id
 * @property integer $pencapaian_id
 * @property string $tarikh
 * @property string $peringkat
 * @property string $opponent
 * @property string $result
 * @property string $venue
 * @property string $personal_best
 * @property string $season_best
 */
class AtletPencapaianRekods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pencapaian_rekods';
    }
    
    public function behaviors()
    {
        return [
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
            [['tarikh', 'peringkat', 'opponent', 'jenis_rekod', 'result'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pencapaian_id', 'menang'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['peringkat'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['opponent'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['result', 'personal_best', 'season_best'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['venue'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['peringkat','opponent','result', 'personal_best', 'season_best','venue'], function ($attribute, $params) {
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
            'pencapaian_rekods_id' => GeneralLabel::pencapaian_rekods_id,
            'pencapaian_id' => GeneralLabel::pencapaian_id,
            'tarikh' => GeneralLabel::tarikh,
            'peringkat' => GeneralLabel::peringkat,
            'opponent' => GeneralLabel::opponent,
            'jenis_rekod' => GeneralLabel::jenis_rekod,
            'result' => GeneralLabel::result,
            'venue' => GeneralLabel::venue,
            'personal_best' => GeneralLabel::personal_best,
            'season_best' => GeneralLabel::season_best,
            'menang' => GeneralLabel::menang,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisRekod(){
        return $this->hasOne(RefJenisRekod::className(), ['id' => 'jenis_rekod']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtletPencapaian(){
        return $this->hasOne(AtletPencapaian::className(), ['pencapaian_id' => 'pencapaian_id']);
    }
}
