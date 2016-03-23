<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_atlet_pakaian".
 *
 * @property integer $pakaian_id
 * @property integer $atlet_id
 * @property string $jenis_pakaian
 * @property string $saiz_pakaian
 */
class AtletPakaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pakaian';
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
            [['atlet_id', 'kuantiti', 'tarikh_serahan', 'jenis_pakaian', 'saiz_pakaian', 'sukan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'jenama'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pakaian_id' => GeneralLabel::pakaian_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'sukan' => GeneralLabel::sukan,
            'jenis_pakaian' => GeneralLabel::jenis_pakaian,
            'saiz_pakaian' => GeneralLabel::saiz_pakaian,
            'kuantiti' => GeneralLabel::kuantiti,
            'jenama' => GeneralLabel::jenama,
            'tarikh_serahan' => GeneralLabel::tarikh_serahan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisPakaian(){
        return $this->hasOne(RefJenisPakaian::className(), ['id' => 'jenis_pakaian']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSaizPakaian(){
        return $this->hasOne(RefSaizPakaian::className(), ['id' => 'saiz_pakaian']);
    }
}
