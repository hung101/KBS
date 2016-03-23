<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_satelit".
 *
 * @property integer $satelit_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $sukan
 * @property string $perkhidmatan
 * @property string $fasiliti
 */
class Satelit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_satelit';
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
            [['atlet_id', 'tarikh', 'sukan', 'perkhidmatan', 'fasiliti'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['sukan'], 'string', 'max' => 30],
            [['perkhidmatan', 'fasiliti'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'satelit_id' => GeneralLabel::satelit_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tarikh' => GeneralLabel::tarikh,
            'sukan' => GeneralLabel::sukan,
            'perkhidmatan' => GeneralLabel::perkhidmatan,
            'fasiliti' => GeneralLabel::fasiliti,

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
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPerkhidmatanSatelit(){
        return $this->hasOne(RefPerkhidmatanSatelit::className(), ['id' => 'perkhidmatan']);
    }
}
