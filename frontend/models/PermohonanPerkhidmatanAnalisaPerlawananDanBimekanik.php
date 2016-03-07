<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik".
 *
 * @property integer $permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $sukan
 * @property string $tujuan
 * @property string $perkhidmatan
 */
class PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik';
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
            [['atlet_id', 'tarikh', 'tujuan', 'perkhidmatan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['tujuan', 'perkhidmatan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id' => 'Permohonan Perkhidmatan Analisa Perlawanan Dan Bimekanik ID',
            'atlet_id' => 'Atlet',
            'tarikh' => 'Tarikh',
            'sukan' => 'Sukan',
            'tujuan' => 'Tujuan',
            'perkhidmatan' => 'Perkhidmatan',
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
    public function getRefPerkhidmatanBiomekanik(){
        return $this->hasOne(RefPerkhidmatanBiomekanik::className(), ['id' => 'perkhidmatan']);
    }
}
