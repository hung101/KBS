<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_atlet_pakaian_peralatan".
 *
 * @property integer $peralatan_id
 * @property integer $atlet_id
 * @property string $jenis_sukan
 * @property string $saiz
 * @property string $jenama
 * @property string $warna
 */
class AtletPakaianPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pakaian_peralatan';
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
            [['atlet_id', 'tarikh_serahan', 'peralatan','jenis_sukan', 'jenama'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['jenis_sukan', 'jenama'], 'string', 'max' => 30],
            [['model'], 'string', 'max' => 50],
            [['saiz', 'warna'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'peralatan_id' => GeneralLabel::peralatan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jenis_sukan' => GeneralLabel::jenis_sukan,
            'peralatan' => GeneralLabel::peralatan,
            'saiz' => GeneralLabel::saiz,
            'jenama' => GeneralLabel::jenama,
            'model' => GeneralLabel::model,
            'warna' => GeneralLabel::warna,
            'tarikh_serahan' => GeneralLabel::tarikh_serahan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'jenis_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenamaPeralatan(){
        return $this->hasOne(RefJenamaPeralatan::className(), ['id' => 'jenama']);
    }
}
